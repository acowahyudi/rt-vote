<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateKandidatAPIRequest;
use App\Http\Requests\API\UpdateKandidatAPIRequest;
use App\Models\HasilVoting;
use App\Models\Kandidat;
use App\Models\Periode;
use App\Repositories\KandidatRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\KandidatResource;
use Response;

/**
 * Class KandidatController
 * @package App\Http\Controllers\API
 */

class KandidatAPIController extends AppBaseController
{
    /** @var  KandidatRepository */
    private $kandidatRepository;

    public function __construct(KandidatRepository $kandidatRepo)
    {
        $this->kandidatRepository = $kandidatRepo;
    }

    /**
     * Display a listing of the Kandidat.
     * GET|HEAD /kandidats
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $periodeAktif = Periode::whereDate('mulai_vote','<',Carbon::now()) ->whereDate('selesai_vote','>',Carbon::now())->get()->first();
        if (!empty($periodeAktif)){
//            $today = Carbon::now();
//            $remainDay = $periodeAktif->selesai_vote->diffInDays($today);

            //pengecekan apakah user sudah pernah voting atau belum
            $voteAktif = HasilVoting::where('penduduk_id',$request->penduduk_id)
                ->where('periode_id',$periodeAktif->id)->get()->count();

            if ($voteAktif>0){
                return $this->sendError('Anda sudah pernah vote pada pemilihan periode ini',422);
            }else{
                $kandidats = Kandidat::where('periode_id',$periodeAktif->id)->with('periode')->get();
                return $this->sendResponse($kandidats->toArray(), 'Kandidats retrieved successfully');
            }
        }else{
            return $this->sendError('Belum ada pemilihan pada periode ini',404);
        }

    }

    /**
     * Store a newly created Kandidat in storage.
     * POST /kandidats
     *
     * @param CreateKandidatAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateKandidatAPIRequest $request)
    {
        $input = $request->all();

        $kandidat = $this->kandidatRepository->create($input);

        return $this->sendResponse(new KandidatResource($kandidat), 'Kandidat saved successfully');
    }

    /**
     * Display the specified Kandidat.
     * GET|HEAD /kandidats/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Kandidat $kandidat */
        $kandidat = $this->kandidatRepository->find($id);

        if (empty($kandidat)) {
            return $this->sendError('Kandidat not found');
        }

        return $this->sendResponse(new KandidatResource($kandidat), 'Kandidat retrieved successfully');
    }

    /**
     * Update the specified Kandidat in storage.
     * PUT/PATCH /kandidats/{id}
     *
     * @param int $id
     * @param UpdateKandidatAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateKandidatAPIRequest $request)
    {
        $input = $request->all();

        /** @var Kandidat $kandidat */
        $kandidat = $this->kandidatRepository->find($id);

        if (empty($kandidat)) {
            return $this->sendError('Kandidat not found');
        }

        $kandidat = $this->kandidatRepository->update($input, $id);

        return $this->sendResponse(new KandidatResource($kandidat), 'Kandidat updated successfully');
    }

    /**
     * Remove the specified Kandidat from storage.
     * DELETE /kandidats/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Kandidat $kandidat */
        $kandidat = $this->kandidatRepository->find($id);

        if (empty($kandidat)) {
            return $this->sendError('Kandidat not found');
        }

        $kandidat->delete();

        return $this->sendSuccess('Kandidat deleted successfully');
    }
}
