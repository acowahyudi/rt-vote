<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRukunTetanggaRequest;
use App\Http\Requests\UpdateRukunTetanggaRequest;
use App\Models\Kelurahan;
use App\Models\RukunTetangga;
use App\Repositories\RukunTetanggaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class RukunTetanggaController extends AppBaseController
{
    /** @var  RukunTetanggaRepository */
    private $rukunTetanggaRepository;

    public function __construct(RukunTetanggaRepository $rukunTetanggaRepo)
    {
        $this->rukunTetanggaRepository = $rukunTetanggaRepo;
    }

    /**
     * Display a listing of the RukunTetangga.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $rukunTetanggas = $this->rukunTetanggaRepository->all();

        return view('rukun_tetanggas.index')
            ->with('rukunTetanggas', $rukunTetanggas);
    }

    public function rtByKelurahan(Request $request)
    {
        $rt = RukunTetangga::where('kelurahan_id', $request->get('id'))
            ->pluck('rt', 'id');
        return response()->json($rt);
    }

    /**
     * Show the form for creating a new RukunTetangga.
     *
     * @return Response
     */
    public function create()
    {
        $kelurahan = Kelurahan::pluck('kelurahan','id');
        return view('rukun_tetanggas.create',compact('kelurahan'));
    }

    /**
     * Store a newly created RukunTetangga in storage.
     *
     * @param CreateRukunTetanggaRequest $request
     *
     * @return Response
     */
    public function store(CreateRukunTetanggaRequest $request)
    {
        $input = $request->all();

        $rukunTetangga = $this->rukunTetanggaRepository->create($input);

        Flash::success('Rukun Tetangga saved successfully.');

        return redirect(route('rukunTetanggas.index'));
    }

    /**
     * Display the specified RukunTetangga.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $rukunTetangga = $this->rukunTetanggaRepository->find($id);

        if (empty($rukunTetangga)) {
            Flash::error('Rukun Tetangga not found');

            return redirect(route('rukunTetanggas.index'));
        }

        return view('rukun_tetanggas.show')->with('rukunTetangga', $rukunTetangga);
    }

    /**
     * Show the form for editing the specified RukunTetangga.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $kelurahan = Kelurahan::pluck('kelurahan','id');
        $rukunTetangga = $this->rukunTetanggaRepository->find($id);

        if (empty($rukunTetangga)) {
            Flash::error('Rukun Tetangga not found');

            return redirect(route('rukunTetanggas.index'));
        }

        return view('rukun_tetanggas.edit',compact('kelurahan'))->with('rukunTetangga', $rukunTetangga);
    }

    /**
     * Update the specified RukunTetangga in storage.
     *
     * @param int $id
     * @param UpdateRukunTetanggaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRukunTetanggaRequest $request)
    {
        $rukunTetangga = $this->rukunTetanggaRepository->find($id);

        if (empty($rukunTetangga)) {
            Flash::error('Rukun Tetangga not found');

            return redirect(route('rukunTetanggas.index'));
        }

        $rukunTetangga = $this->rukunTetanggaRepository->update($request->all(), $id);

        Flash::success('Rukun Tetangga updated successfully.');

        return redirect(route('rukunTetanggas.index'));
    }

    /**
     * Remove the specified RukunTetangga from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $rukunTetangga = $this->rukunTetanggaRepository->find($id);

        if (empty($rukunTetangga)) {
            Flash::error('Rukun Tetangga not found');

            return redirect(route('rukunTetanggas.index'));
        }

        $this->rukunTetanggaRepository->delete($id);

        Flash::success('Rukun Tetangga deleted successfully.');

        return redirect(route('rukunTetanggas.index'));
    }
}
