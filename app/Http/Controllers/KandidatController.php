<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateKandidatRequest;
use App\Http\Requests\UpdateKandidatRequest;
use App\Models\Periode;
use App\Models\TingkatPendidikan;
use App\Repositories\KandidatRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\DB;
use Response;

class KandidatController extends AppBaseController
{
    /** @var  KandidatRepository */
    private $kandidatRepository;

    public function __construct(KandidatRepository $kandidatRepo)
    {
        $this->kandidatRepository = $kandidatRepo;
    }

    /**
     * Display a listing of the Kandidat.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $kandidats = $this->kandidatRepository->all();

        return view('kandidats.index')
            ->with('kandidats', $kandidats);
    }

    /**
     * Show the form for creating a new Kandidat.
     *
     * @return Response
     */
    public function create()
    {
        $periode = Periode::pluck('keterangan','id');
        return view('kandidats.create',compact('pendidikan','periode'));
    }

    /**
     * Store a newly created Kandidat in storage.
     *
     * @param CreateKandidatRequest $request
     *
     * @return Response
     */
    public function store(CreateKandidatRequest $request)
    {
        $input = $request->except('foto');
        try{
            DB::beginTransaction();
            $kandidat = $this->kandidatRepository->create($input);
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = $kandidat->id . '.' . $file->getClientOriginalExtension();
                $path = $request->foto->storeAs('public/kandidat', $filename, 'local');
                $kandidat->foto = 'storage' . substr($path, strpos($path, '/'));
                $kandidat->save();
            }
            DB::commit();
            Flash::success('Kandidat saved successfully.');
            return redirect(route('kandidats.index'));

        }catch (\Exception $err){
            DB::rollBack();
            Flash::error('Error :'.$err);
            return redirect(route('kandidats.index'));
        }
    }

    /**
     * Display the specified Kandidat.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $kandidat = $this->kandidatRepository->find($id);

        if (empty($kandidat)) {
            Flash::error('Kandidat not found');

            return redirect(route('kandidats.index'));
        }

        return view('kandidats.show')->with('kandidat', $kandidat);
    }

    /**
     * Show the form for editing the specified Kandidat.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $periode = Periode::pluck('keterangan','id');
        $kandidat = $this->kandidatRepository->find($id);

        if (empty($kandidat)) {
            Flash::error('Kandidat not found');
            return redirect(route('kandidats.index'));
        }
        return view('kandidats.edit',compact('periode','pendidikan'))->with('kandidat', $kandidat);
    }

    /**
     * Update the specified Kandidat in storage.
     *
     * @param int $id
     * @param UpdateKandidatRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateKandidatRequest $request)
    {
        $input = $request->except('foto');
        $kandidat = $this->kandidatRepository->find($id);

        if (empty($kandidat)) {
            Flash::error('Kandidat not found');
            return redirect(route('kandidats.index'));
        }

        try{
            DB::beginTransaction();
            $kandidat = $this->kandidatRepository->update($input, $id);
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = $kandidat->id . '.' . $file->getClientOriginalExtension();
                $path = $request->foto->storeAs('public/kandidat', $filename, 'local');
                $kandidat->foto = 'storage' . substr($path, strpos($path, '/'));
                $kandidat->save();
            }
            DB::commit();
            Flash::success('Kandidat updated successfully.');
            return redirect(route('kandidats.index'));
        }catch (\Exception $err){
            DB::rollBack();
            Flash::error('Error :'.$err);
            return redirect(route('kandidats.index'));
        }
    }

    /**
     * Remove the specified Kandidat from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $kandidat = $this->kandidatRepository->find($id);

        if (empty($kandidat)) {
            Flash::error('Kandidat not found');

            return redirect(route('kandidats.index'));
        }

        $this->kandidatRepository->delete($id);

        Flash::success('Kandidat deleted successfully.');

        return redirect(route('kandidats.index'));
    }
}
