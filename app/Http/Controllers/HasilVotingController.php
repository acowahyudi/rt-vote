<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHasilVotingRequest;
use App\Http\Requests\UpdateHasilVotingRequest;
use App\Models\HasilVoting;
use App\Models\Kandidat;
use App\Models\Kelurahan;
use App\Models\Periode;
use App\Models\RukunTetangga;
use App\Repositories\HasilVotingRepository;
use App\Http\Controllers\AppBaseController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Response;

class HasilVotingController extends AppBaseController
{
    /** @var  HasilVotingRepository */
    private $hasilVotingRepository;

    public function __construct(HasilVotingRepository $hasilVotingRepo)
    {
        $this->hasilVotingRepository = $hasilVotingRepo;
    }

    /**
     * Display a listing of the HasilVoting.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $periode = Periode::whereDate('mulai_vote','<',Carbon::now())
            ->orWhereDate('selesai_vote','>',Carbon::now())
            ->whereYear('mulai_vote','<',Carbon::today()->year)
            ->get()->first();
        if (!empty($periode)){
            $today = Carbon::now();
            if ($periode->selesai_vote<$today){
                $periode['remainDay'] = 0;
            }else{
                $remainDay = $periode->selesai_vote->diffInDays($today);
                $periode['remainDay'] = $remainDay;
            }
        }

        $kandidatAktif = Kandidat::where('periode_id',$periode->id)->get();

        $hasilVotings = HasilVoting::where('periode_id',$periode->id)->get();
        return view('hasil_votings.index',compact('kandidatAktif','periode'))
            ->with('hasilVotings', $hasilVotings);
    }

    public function indexByRT(Request $request)
    {
        $rt = RukunTetangga::find($request->rt_id);
        $kelurahan = Kelurahan::find($request->kelurahan_id);

//        $periode = Periode::whereYear('mulai_vote','<',Carbon::today()->year)
//            ->where('rukun_tetangga_id',$request->rt_id)
//            ->get()->first();
        $periode = Periode::find($request->periode_id);

        if (!empty($periode)){
            $today = Carbon::now();
            if ($periode->selesai_vote<$today){
                $periode['remainDay'] = 0;
            }else{
                $remainDay = $periode->selesai_vote->diffInDays($today);
                $periode['remainDay'] = $remainDay;
            }
            $kandidatAktif = Kandidat::where('periode_id',$periode->id)
                ->whereHas('user',function ($q) use($request) {
                    $q->where('rukun_tetangga_id',$request->rt_id);
                })
                ->get();

            $kandidat=[];
            foreach ($kandidatAktif as $item){
                array_push($kandidat,$item->id);
            }
            $hasilVotings = HasilVoting::where('periode_id',$periode->id)
                ->whereIn('kandidat_id',$kandidat)->get();
            $kandidatAktif = Kandidat::where('periode_id',$periode->id)
                ->whereHas('user',function ($q) use($request) {
                    $q->where('rukun_tetangga_id',$request->rt_id);
                })
                ->get();
            return view('hasil_votings.index',compact('kandidatAktif','periode','hasilVotings','rt','kelurahan'));
        }
        return view('hasil_votings.index',compact('periode','rt','kelurahan'));
    }

    /**
     * Show the form for creating a new HasilVoting.
     *
     * @return Response
     */
    public function create()
    {
        return view('hasil_votings.create');
    }

    /**
     * Store a newly created HasilVoting in storage.
     *
     * @param CreateHasilVotingRequest $request
     *
     * @return Response
     */
    public function store(CreateHasilVotingRequest $request)
    {
        $input = $request->all();
        $hasilVoting = $this->hasilVotingRepository->create($input);

        Flash::success('Hasil Voting saved successfully.');

        return redirect(route('hasilVotings.index'));
    }

    /**
     * Display the specified HasilVoting.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $hasilVoting = $this->hasilVotingRepository->find($id);

        if (empty($hasilVoting)) {
            Flash::error('Hasil Voting not found');

            return redirect(route('hasilVotings.index'));
        }

        return view('hasil_votings.show')->with('hasilVoting', $hasilVoting);
    }

    /**
     * Show the form for editing the specified HasilVoting.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $hasilVoting = $this->hasilVotingRepository->find($id);

        if (empty($hasilVoting)) {
            Flash::error('Hasil Voting not found');

            return redirect(route('hasilVotings.index'));
        }

        return view('hasil_votings.edit')->with('hasilVoting', $hasilVoting);
    }

    /**
     * Update the specified HasilVoting in storage.
     *
     * @param int $id
     * @param UpdateHasilVotingRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHasilVotingRequest $request)
    {
        $hasilVoting = $this->hasilVotingRepository->find($id);

        if (empty($hasilVoting)) {
            Flash::error('Hasil Voting not found');

            return redirect(route('hasilVotings.index'));
        }

        $hasilVoting = $this->hasilVotingRepository->update($request->all(), $id);

        Flash::success('Hasil Voting updated successfully.');

        return redirect(route('hasilVotings.index'));
    }

    /**
     * Remove the specified HasilVoting from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $hasilVoting = $this->hasilVotingRepository->find($id);

        if (empty($hasilVoting)) {
            Flash::error('Hasil Voting not found');

            return redirect(route('hasilVotings.index'));
        }

        $this->hasilVotingRepository->delete($id);

        Flash::success('Hasil Voting deleted successfully.');

        return redirect(route('hasilVotings.index'));
    }

    public function chooseRT()
    {
        if (Auth::user()->roles_id!=1){
            $rt = RukunTetangga::where('id',Auth::user()->rukun_tetangga_id)->pluck('rt','id');
            $kelurahan = Kelurahan::whereHas('rukunTetanggas', function ($q){
                $q->where('id',Auth::user()->rukun_tetangga_id);
            })->pluck('kelurahan','id');
        }elseif (Auth::user()->roles_id==1){
            $rt = [];
            $kelurahan = Kelurahan::pluck('kelurahan','id');
        }
        return view('hasil_votings.chooseRT',compact('kelurahan','rt'));
    }
}
