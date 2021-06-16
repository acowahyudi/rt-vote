<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateHasilVotingAPIRequest;
use App\Http\Requests\API\UpdateHasilVotingAPIRequest;
use App\Models\HasilVoting;
use App\Repositories\HasilVotingRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\HasilVotingResource;
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
     * @return Response
     */
    public function index(Request $request)
    {
        $hasilVotings = $this->hasilVotingRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(HasilVotingResource::collection($hasilVotings), 'Hasil Votings retrieved successfully');
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
