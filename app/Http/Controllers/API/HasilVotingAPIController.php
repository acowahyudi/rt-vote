<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateHasilVotingAPIRequest;
use App\Http\Requests\API\UpdateHasilVotingAPIRequest;
use App\Models\HasilVoting;
use App\Models\Kandidat;
use App\Models\Periode;
use App\Models\User;
use App\Repositories\HasilVotingRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\HasilVotingResource;
use Illuminate\Support\Facades\Auth;
use Response;

/**
 * Class HasilVotingController
 * @package App\Http\Controllers\API
 */

class HasilVotingAPIController extends AppBaseController
{
    /** @var  HasilVotingRepository */
    private $hasilVotingRepository;

    public function __construct(HasilVotingRepository $hasilVotingRepo)
    {
        $this->hasilVotingRepository = $hasilVotingRepo;
    }

    /**
     * Display a listing of the HasilVoting.
     * GET|HEAD /hasilVotings
     *
     * @param Request $request
     * @return bool
     */
    public function index(Request $request)
    {
        $user = User::find($request->users_id);
        $periode = Periode::where('rukun_tetangga_id',$user->rukun_tetangga_id)
            ->whereYear('selesai_vote','=',Carbon::now()->format('Y'))->get()->first();
        if (!empty($periode) && $periode!=null)
        {
            $kandidatAktif = Kandidat::where('periode_id',$periode->id)->with('user','periode')->get()->sortByDesc('vote_count');
            return $this->sendResponse($kandidatAktif, 'Hasil Voting retrieved successfully');
        }else{
            $today = Carbon::now();
            $endVote = Periode::whereDate('mulai_vote','<',Carbon::now()) ->whereDate('selesai_vote','>',Carbon::now())->get()->first();
            $remainDay = $endVote->selesai_vote->diffInDays($today);
            $periode['remain_day'] = $remainDay;
            $periode['periode_voting'] = $endVote->keterangan;
            return $this->sendResponse([$periode],'Voting masih berlangsung, tunggu hasil akhir setelah vote ditutup');
        }
    }

    /**
     * Store a newly created HasilVoting in storage.
     * POST /hasilVotings
     *
     * @param CreateHasilVotingAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateHasilVotingAPIRequest $request)
    {
        $input = $request->all();
        $cekPeriode = Periode::where('id',$input['periode_id'])->get()->first();
        if ($cekPeriode->selesai_vote<Carbon::today()){
            return $this->sendError('Voting telah ditutup');
        }

        $hasilVoting = $this->hasilVotingRepository->create($input);

        return $this->sendResponse(new HasilVotingResource($hasilVoting), 'Hasil Voting saved successfully');
    }

    /**
     * Display the specified HasilVoting.
     * GET|HEAD /hasilVotings/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var HasilVoting $hasilVoting */
        $hasilVoting = $this->hasilVotingRepository->find($id);

        if (empty($hasilVoting)) {
            return $this->sendError('Hasil Voting not found');
        }

        return $this->sendResponse(new HasilVotingResource($hasilVoting), 'Hasil Voting retrieved successfully');
    }

    /**
     * Update the specified HasilVoting in storage.
     * PUT/PATCH /hasilVotings/{id}
     *
     * @param int $id
     * @param UpdateHasilVotingAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHasilVotingAPIRequest $request)
    {
        $input = $request->all();

        /** @var HasilVoting $hasilVoting */
        $hasilVoting = $this->hasilVotingRepository->find($id);

        if (empty($hasilVoting)) {
            return $this->sendError('Hasil Voting not found');
        }

        $hasilVoting = $this->hasilVotingRepository->update($input, $id);

        return $this->sendResponse(new HasilVotingResource($hasilVoting), 'HasilVoting updated successfully');
    }

    /**
     * Remove the specified HasilVoting from storage.
     * DELETE /hasilVotings/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var HasilVoting $hasilVoting */
        $hasilVoting = $this->hasilVotingRepository->find($id);

        if (empty($hasilVoting)) {
            return $this->sendError('Hasil Voting not found');
        }

        $hasilVoting->delete();

        return $this->sendSuccess('Hasil Voting deleted successfully');
    }
}
