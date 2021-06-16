<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePeriodeAPIRequest;
use App\Http\Requests\API\UpdatePeriodeAPIRequest;
use App\Models\Periode;
use App\Repositories\PeriodeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\PeriodeResource;
use Response;

/**
 * Class PeriodeController
 * @package App\Http\Controllers\API
 */

class PeriodeAPIController extends AppBaseController
{
    /** @var  PeriodeRepository */
    private $periodeRepository;

    public function __construct(PeriodeRepository $periodeRepo)
    {
        $this->periodeRepository = $periodeRepo;
    }

    /**
     * Display a listing of the Periode.
     * GET|HEAD /periodes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $periodes = $this->periodeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(PeriodeResource::collection($periodes), 'Periodes retrieved successfully');
    }

    /**
     * Store a newly created Periode in storage.
     * POST /periodes
     *
     * @param CreatePeriodeAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePeriodeAPIRequest $request)
    {
        $input = $request->all();

        $periode = $this->periodeRepository->create($input);

        return $this->sendResponse(new PeriodeResource($periode), 'Periode saved successfully');
    }

    /**
     * Display the specified Periode.
     * GET|HEAD /periodes/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Periode $periode */
        $periode = $this->periodeRepository->find($id);

        if (empty($periode)) {
            return $this->sendError('Periode not found');
        }

        return $this->sendResponse(new PeriodeResource($periode), 'Periode retrieved successfully');
    }

    /**
     * Update the specified Periode in storage.
     * PUT/PATCH /periodes/{id}
     *
     * @param int $id
     * @param UpdatePeriodeAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePeriodeAPIRequest $request)
    {
        $input = $request->all();

        /** @var Periode $periode */
        $periode = $this->periodeRepository->find($id);

        if (empty($periode)) {
            return $this->sendError('Periode not found');
        }

        $periode = $this->periodeRepository->update($input, $id);

        return $this->sendResponse(new PeriodeResource($periode), 'Periode updated successfully');
    }

    /**
     * Remove the specified Periode from storage.
     * DELETE /periodes/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Periode $periode */
        $periode = $this->periodeRepository->find($id);

        if (empty($periode)) {
            return $this->sendError('Periode not found');
        }

        $periode->delete();

        return $this->sendSuccess('Periode deleted successfully');
    }
}
