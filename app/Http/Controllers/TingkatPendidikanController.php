<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTingkatPendidikanRequest;
use App\Http\Requests\UpdateTingkatPendidikanRequest;
use App\Repositories\TingkatPendidikanRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class TingkatPendidikanController extends AppBaseController
{
    /** @var  TingkatPendidikanRepository */
    private $tingkatPendidikanRepository;

    public function __construct(TingkatPendidikanRepository $tingkatPendidikanRepo)
    {
        $this->tingkatPendidikanRepository = $tingkatPendidikanRepo;
    }

    /**
     * Display a listing of the TingkatPendidikan.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $tingkatPendidikans = $this->tingkatPendidikanRepository->all();

        return view('tingkat_pendidikans.index')
            ->with('tingkatPendidikans', $tingkatPendidikans);
    }

    /**
     * Show the form for creating a new TingkatPendidikan.
     *
     * @return Response
     */
    public function create()
    {
        return view('tingkat_pendidikans.create');
    }

    /**
     * Store a newly created TingkatPendidikan in storage.
     *
     * @param CreateTingkatPendidikanRequest $request
     *
     * @return Response
     */
    public function store(CreateTingkatPendidikanRequest $request)
    {
        $input = $request->all();

        $tingkatPendidikan = $this->tingkatPendidikanRepository->create($input);

        Flash::success('Tingkat Pendidikan saved successfully.');

        return redirect(route('tingkatPendidikans.index'));
    }

    /**
     * Display the specified TingkatPendidikan.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tingkatPendidikan = $this->tingkatPendidikanRepository->find($id);

        if (empty($tingkatPendidikan)) {
            Flash::error('Tingkat Pendidikan not found');

            return redirect(route('tingkatPendidikans.index'));
        }

        return view('tingkat_pendidikans.show')->with('tingkatPendidikan', $tingkatPendidikan);
    }

    /**
     * Show the form for editing the specified TingkatPendidikan.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tingkatPendidikan = $this->tingkatPendidikanRepository->find($id);

        if (empty($tingkatPendidikan)) {
            Flash::error('Tingkat Pendidikan not found');

            return redirect(route('tingkatPendidikans.index'));
        }

        return view('tingkat_pendidikans.edit')->with('tingkatPendidikan', $tingkatPendidikan);
    }

    /**
     * Update the specified TingkatPendidikan in storage.
     *
     * @param int $id
     * @param UpdateTingkatPendidikanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTingkatPendidikanRequest $request)
    {
        $tingkatPendidikan = $this->tingkatPendidikanRepository->find($id);

        if (empty($tingkatPendidikan)) {
            Flash::error('Tingkat Pendidikan not found');

            return redirect(route('tingkatPendidikans.index'));
        }

        $tingkatPendidikan = $this->tingkatPendidikanRepository->update($request->all(), $id);

        Flash::success('Tingkat Pendidikan updated successfully.');

        return redirect(route('tingkatPendidikans.index'));
    }

    /**
     * Remove the specified TingkatPendidikan from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tingkatPendidikan = $this->tingkatPendidikanRepository->find($id);

        if (empty($tingkatPendidikan)) {
            Flash::error('Tingkat Pendidikan not found');

            return redirect(route('tingkatPendidikans.index'));
        }

        $this->tingkatPendidikanRepository->delete($id);

        Flash::success('Tingkat Pendidikan deleted successfully.');

        return redirect(route('tingkatPendidikans.index'));
    }
}
