<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePeriodeRequest;
use App\Http\Requests\UpdatePeriodeRequest;
use App\Models\Periode;
use App\Repositories\PeriodeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Response;

class PeriodeController extends AppBaseController
{
    /** @var  PeriodeRepository */
    private $periodeRepository;

    public function __construct(PeriodeRepository $periodeRepo)
    {
        $this->periodeRepository = $periodeRepo;
    }

    /**
     * Display a listing of the Periode.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->roles_id==1){
            $periodes = Periode::all();
        }else{
            $periodes = Periode::where('rukun_tetangga_id',Auth::user()->rukun_tetangga_id)->get();
        }

        return view('periodes.index')
            ->with('periodes', $periodes);
    }

    public function periodeByRT(Request $request)
    {
        $rt = Periode::where('rukun_tetangga_id', $request->get('id'))
            ->pluck('keterangan', 'id');
        return response()->json($rt);
    }

    /**
     * Show the form for creating a new Periode.
     *
     * @return Response
     */
    public function create()
    {
        return view('periodes.create');
    }

    /**
     * Store a newly created Periode in storage.
     *
     * @param CreatePeriodeRequest $request
     *
     * @return Response
     */
    public function store(CreatePeriodeRequest $request)
    {
        $input = $request->all();

        $periode = $this->periodeRepository->create($input);

        Flash::success('Periode saved successfully.');

        return redirect(route('periodes.index'));
    }

    /**
     * Display the specified Periode.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $periode = $this->periodeRepository->find($id);

        if (empty($periode)) {
            Flash::error('Periode not found');

            return redirect(route('periodes.index'));
        }

        return view('periodes.show')->with('periode', $periode);
    }

    /**
     * Show the form for editing the specified Periode.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $periode = $this->periodeRepository->find($id);

        if (empty($periode)) {
            Flash::error('Periode not found');

            return redirect(route('periodes.index'));
        }

        return view('periodes.edit')->with('periode', $periode);
    }

    /**
     * Update the specified Periode in storage.
     *
     * @param int $id
     * @param UpdatePeriodeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePeriodeRequest $request)
    {
        $periode = $this->periodeRepository->find($id);

        if (empty($periode)) {
            Flash::error('Periode not found');

            return redirect(route('periodes.index'));
        }

        $periode = $this->periodeRepository->update($request->all(), $id);

        Flash::success('Periode updated successfully.');

        return redirect(route('periodes.index'));
    }

    /**
     * Remove the specified Periode from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $periode = $this->periodeRepository->find($id);

        if (empty($periode)) {
            Flash::error('Periode not found');

            return redirect(route('periodes.index'));
        }

        $this->periodeRepository->delete($id);

        Flash::success('Periode deleted successfully.');

        return redirect(route('periodes.index'));
    }
}
