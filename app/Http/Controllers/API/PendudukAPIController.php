<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePendudukAPIRequest;
use App\Http\Requests\API\UpdatePendudukAPIRequest;
use App\Models\Penduduk;
use App\Repositories\PendudukRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\PendudukResource;
use Response;

/**
 * Class PendudukController
 * @package App\Http\Controllers\API
 */

class PendudukAPIController extends AppBaseController
{
    /** @var  PendudukRepository */
    private $pendudukRepository;

    public function __construct(PendudukRepository $pendudukRepo)
    {
        $this->pendudukRepository = $pendudukRepo;
    }

    /**
     * Display a listing of the Penduduk.
     * GET|HEAD /penduduks
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $penduduks = $this->pendudukRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(PendudukResource::collection($penduduks), 'Penduduks retrieved successfully');
    }

    /**
     * Store a newly created Penduduk in storage.
     * POST /penduduks
     *
     * @param CreatePendudukAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePendudukAPIRequest $request)
    {
        $input = $request->all();

        $penduduk = $this->pendudukRepository->create($input);

        return $this->sendResponse(new PendudukResource($penduduk), 'Penduduk saved successfully');
    }

    /**
     * Display the specified Penduduk.
     * GET|HEAD /penduduks/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Penduduk $penduduk */
        $penduduk = $this->pendudukRepository->find($id);

        if (empty($penduduk)) {
            return $this->sendError('Penduduk not found');
        }

        return $this->sendResponse(new PendudukResource($penduduk), 'Penduduk retrieved successfully');
    }

    /**
     * Update the specified Penduduk in storage.
     * PUT/PATCH /penduduks/{id}
     *
     * @param int $id
     * @param UpdatePendudukAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePendudukAPIRequest $request)
    {
        $input = $request->all();

        /** @var Penduduk $penduduk */
        $penduduk = $this->pendudukRepository->find($id);

        if (empty($penduduk)) {
            return $this->sendError('Penduduk not found');
        }

        $penduduk = $this->pendudukRepository->update($input, $id);

        return $this->sendResponse(new PendudukResource($penduduk), 'Penduduk updated successfully');
    }

    /**
     * Remove the specified Penduduk from storage.
     * DELETE /penduduks/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Penduduk $penduduk */
        $penduduk = $this->pendudukRepository->find($id);

        if (empty($penduduk)) {
            return $this->sendError('Penduduk not found');
        }

        $penduduk->delete();

        return $this->sendSuccess('Penduduk deleted successfully');
    }
}
