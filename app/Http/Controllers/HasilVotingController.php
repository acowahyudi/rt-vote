<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHasilVotingRequest;
use App\Http\Requests\UpdateHasilVotingRequest;
use App\Models\Kandidat;
use App\Models\Periode;
use App\Repositories\HasilVotingRepository;
use App\Http\Controllers\AppBaseController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Flash;
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
        $kandidatAktif = Kandidat::where('periode_id',$periode->id)->get();

        $hasilVotings = $this->hasilVotingRepository->all();
        return view('hasil_votings.index',compact('kandidatAktif'))
            ->with('hasilVotings', $hasilVotings);
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
}
