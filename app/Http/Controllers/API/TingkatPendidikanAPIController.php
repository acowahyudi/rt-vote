<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTingkatPendidikanAPIRequest;
use App\Http\Requests\API\UpdateTingkatPendidikanAPIRequest;
use App\Models\TingkatPendidikan;
use App\Repositories\TingkatPendidikanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\TingkatPendidikanResource;
use Response;

/**
 * Class TingkatPendidikanController
 * @package App\Http\Controllers\API
 */

class TingkatPendidikanAPIController extends AppBaseController
{
    /** @var  TingkatPendidikanRepository */
    private $tingkatPendidikanRepository;

    public function __construct(TingkatPendidikanRepository $tingkatPendidikanRepo)
    {
        $this->tingkatPendidikanRepository = $tingkatPendidikanRepo;
    }

    /**
     * Display a listing of the TingkatPendidikan.
     * GET|HEAD /tingkatPendidikans
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $tingkatPendidikans = $this->tingkatPendidikanRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(TingkatPendidikanResource::collection($tingkatPendidikans), 'Tingkat Pendidikans retrieved successfully');
    }

    /**
     * Store a newly created TingkatPendidikan in storage.
     * POST /tingkatPendidikans
     *
     * @param CreateTingkatPendidikanAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTingkatPendidikanAPIRequest $request)
    {
        $input = $request->all();

        $tingkatPendidikan = $this->tingkatPendidikanRepository->create($input);

        return $this->sendResponse(new TingkatPendidikanResource($tingkatPendidikan), 'Tingkat Pendidikan saved successfully');
    }

    /**
     * Display the specified TingkatPendidikan.
     * GET|HEAD /tingkatPendidikans/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var TingkatPendidikan $tingkatPendidikan */
        $tingkatPendidikan = $this->tingkatPendidikanRepository->find($id);

        if (empty($tingkatPendidikan)) {
            return $this->sendError('Tingkat Pendidikan not found');
        }

        return $this->sendResponse(new TingkatPendidikanResource($tingkatPendidikan), 'Tingkat Pendidikan retrieved successfully');
    }

    /**
     * Update the specified TingkatPendidikan in storage.
     * PUT/PATCH /tingkatPendidikans/{id}
     *
     * @param int $id
     * @param UpdateTingkatPendidikanAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTingkatPendidikanAPIRequest $request)
    {
        $input = $request->all();

        /** @var TingkatPendidikan $tingkatPendidikan */
        $tingkatPendidikan = $this->tingkatPendidikanRepository->find($id);

        if (empty($tingkatPendidikan)) {
            return $this->sendError('Tingkat Pendidikan not found');
        }

        $tingkatPendidikan = $this->tingkatPendidikanRepository->update($input, $id);

        return $this->sendResponse(new TingkatPendidikanResource($tingkatPendidikan), 'TingkatPendidikan updated successfully');
    }

    /**
     * Remove the specified TingkatPendidikan from storage.
     * DELETE /tingkatPendidikans/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var TingkatPendidikan $tingkatPendidikan */
        $tingkatPendidikan = $this->tingkatPendidikanRepository->find($id);

        if (empty($tingkatPendidikan)) {
            return $this->sendError('Tingkat Pendidikan not found');
        }

        $tingkatPendidikan->delete();

        return $this->sendSuccess('Tingkat Pendidikan deleted successfully');
    }
}
