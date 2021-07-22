<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateKelurahanAPIRequest;
use App\Http\Requests\API\UpdateKelurahanAPIRequest;
use App\Models\Kelurahan;
use App\Repositories\KelurahanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\KelurahanResource;
use Response;

/**
 * Class KelurahanController
 * @package App\Http\Controllers\API
 */

class KelurahanAPIController extends AppBaseController
{
    /** @var  KelurahanRepository */
    private $kelurahanRepository;

    public function __construct(KelurahanRepository $kelurahanRepo)
    {
        $this->kelurahanRepository = $kelurahanRepo;
    }

    /**
     * Display a listing of the Kelurahan.
     * GET|HEAD /kelurahans
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $kelurahans = $this->kelurahanRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(KelurahanResource::collection($kelurahans), 'Kelurahans retrieved successfully');
    }

    /**
     * Store a newly created Kelurahan in storage.
     * POST /kelurahans
     *
     * @param CreateKelurahanAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateKelurahanAPIRequest $request)
    {
        $input = $request->all();

        $kelurahan = $this->kelurahanRepository->create($input);

        return $this->sendResponse(new KelurahanResource($kelurahan), 'Kelurahan saved successfully');
    }

    /**
     * Display the specified Kelurahan.
     * GET|HEAD /kelurahans/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Kelurahan $kelurahan */
        $kelurahan = $this->kelurahanRepository->find($id);

        if (empty($kelurahan)) {
            return $this->sendError('Kelurahan not found');
        }

        return $this->sendResponse(new KelurahanResource($kelurahan), 'Kelurahan retrieved successfully');
    }

    /**
     * Update the specified Kelurahan in storage.
     * PUT/PATCH /kelurahans/{id}
     *
     * @param int $id
     * @param UpdateKelurahanAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateKelurahanAPIRequest $request)
    {
        $input = $request->all();

        /** @var Kelurahan $kelurahan */
        $kelurahan = $this->kelurahanRepository->find($id);

        if (empty($kelurahan)) {
            return $this->sendError('Kelurahan not found');
        }

        $kelurahan = $this->kelurahanRepository->update($input, $id);

        return $this->sendResponse(new KelurahanResource($kelurahan), 'Kelurahan updated successfully');
    }

    /**
     * Remove the specified Kelurahan from storage.
     * DELETE /kelurahans/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Kelurahan $kelurahan */
        $kelurahan = $this->kelurahanRepository->find($id);

        if (empty($kelurahan)) {
            return $this->sendError('Kelurahan not found');
        }

        $kelurahan->delete();

        return $this->sendSuccess('Kelurahan deleted successfully');
    }
}
