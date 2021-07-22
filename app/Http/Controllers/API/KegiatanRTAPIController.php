<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateKegiatanRTAPIRequest;
use App\Http\Requests\API\UpdateKegiatanRTAPIRequest;
use App\Models\KegiatanRT;
use App\Repositories\KegiatanRTRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\KegiatanRTResource;
use Response;

/**
 * Class KegiatanRTController
 * @package App\Http\Controllers\API
 */

class KegiatanRTAPIController extends AppBaseController
{
    /** @var  KegiatanRTRepository */
    private $kegiatanRTRepository;

    public function __construct(KegiatanRTRepository $kegiatanRTRepo)
    {
        $this->kegiatanRTRepository = $kegiatanRTRepo;
    }

    /**
     * Display a listing of the KegiatanRT.
     * GET|HEAD /kegiatanRTs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $kegiatanRTs = $this->kegiatanRTRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(KegiatanRTResource::collection($kegiatanRTs), 'Kegiatan R Ts retrieved successfully');
    }

    /**
     * Store a newly created KegiatanRT in storage.
     * POST /kegiatanRTs
     *
     * @param CreateKegiatanRTAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateKegiatanRTAPIRequest $request)
    {
        $input = $request->all();

        $kegiatanRT = $this->kegiatanRTRepository->create($input);

        return $this->sendResponse(new KegiatanRTResource($kegiatanRT), 'Kegiatan R T saved successfully');
    }

    /**
     * Display the specified KegiatanRT.
     * GET|HEAD /kegiatanRTs/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var KegiatanRT $kegiatanRT */
        $kegiatanRT = $this->kegiatanRTRepository->find($id);

        if (empty($kegiatanRT)) {
            return $this->sendError('Kegiatan R T not found');
        }

        return $this->sendResponse(new KegiatanRTResource($kegiatanRT), 'Kegiatan R T retrieved successfully');
    }

    /**
     * Update the specified KegiatanRT in storage.
     * PUT/PATCH /kegiatanRTs/{id}
     *
     * @param int $id
     * @param UpdateKegiatanRTAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateKegiatanRTAPIRequest $request)
    {
        $input = $request->all();

        /** @var KegiatanRT $kegiatanRT */
        $kegiatanRT = $this->kegiatanRTRepository->find($id);

        if (empty($kegiatanRT)) {
            return $this->sendError('Kegiatan R T not found');
        }

        $kegiatanRT = $this->kegiatanRTRepository->update($input, $id);

        return $this->sendResponse(new KegiatanRTResource($kegiatanRT), 'KegiatanRT updated successfully');
    }

    /**
     * Remove the specified KegiatanRT from storage.
     * DELETE /kegiatanRTs/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var KegiatanRT $kegiatanRT */
        $kegiatanRT = $this->kegiatanRTRepository->find($id);

        if (empty($kegiatanRT)) {
            return $this->sendError('Kegiatan R T not found');
        }

        $kegiatanRT->delete();

        return $this->sendSuccess('Kegiatan R T deleted successfully');
    }
}
