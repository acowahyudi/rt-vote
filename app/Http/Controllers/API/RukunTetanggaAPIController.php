<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRukunTetanggaAPIRequest;
use App\Http\Requests\API\UpdateRukunTetanggaAPIRequest;
use App\Models\RukunTetangga;
use App\Repositories\RukunTetanggaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\RukunTetanggaResource;
use Response;

/**
 * Class RukunTetanggaController
 * @package App\Http\Controllers\API
 */

class RukunTetanggaAPIController extends AppBaseController
{
    /** @var  RukunTetanggaRepository */
    private $rukunTetanggaRepository;

    public function __construct(RukunTetanggaRepository $rukunTetanggaRepo)
    {
        $this->rukunTetanggaRepository = $rukunTetanggaRepo;
    }

    /**
     * Display a listing of the RukunTetangga.
     * GET|HEAD /rukunTetanggas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $rukunTetanggas = $this->rukunTetanggaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(RukunTetanggaResource::collection($rukunTetanggas), 'Rukun Tetanggas retrieved successfully');
    }

    /**
     * Store a newly created RukunTetangga in storage.
     * POST /rukunTetanggas
     *
     * @param CreateRukunTetanggaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateRukunTetanggaAPIRequest $request)
    {
        $input = $request->all();

        $rukunTetangga = $this->rukunTetanggaRepository->create($input);

        return $this->sendResponse(new RukunTetanggaResource($rukunTetangga), 'Rukun Tetangga saved successfully');
    }

    /**
     * Display the specified RukunTetangga.
     * GET|HEAD /rukunTetanggas/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var RukunTetangga $rukunTetangga */
        $rukunTetangga = $this->rukunTetanggaRepository->find($id);

        if (empty($rukunTetangga)) {
            return $this->sendError('Rukun Tetangga not found');
        }

        return $this->sendResponse(new RukunTetanggaResource($rukunTetangga), 'Rukun Tetangga retrieved successfully');
    }

    /**
     * Update the specified RukunTetangga in storage.
     * PUT/PATCH /rukunTetanggas/{id}
     *
     * @param int $id
     * @param UpdateRukunTetanggaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRukunTetanggaAPIRequest $request)
    {
        $input = $request->all();

        /** @var RukunTetangga $rukunTetangga */
        $rukunTetangga = $this->rukunTetanggaRepository->find($id);

        if (empty($rukunTetangga)) {
            return $this->sendError('Rukun Tetangga not found');
        }

        $rukunTetangga = $this->rukunTetanggaRepository->update($input, $id);

        return $this->sendResponse(new RukunTetanggaResource($rukunTetangga), 'RukunTetangga updated successfully');
    }

    /**
     * Remove the specified RukunTetangga from storage.
     * DELETE /rukunTetanggas/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var RukunTetangga $rukunTetangga */
        $rukunTetangga = $this->rukunTetanggaRepository->find($id);

        if (empty($rukunTetangga)) {
            return $this->sendError('Rukun Tetangga not found');
        }

        $rukunTetangga->delete();

        return $this->sendSuccess('Rukun Tetangga deleted successfully');
    }
}
