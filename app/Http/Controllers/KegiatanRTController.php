<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateKegiatanRTRequest;
use App\Http\Requests\UpdateKegiatanRTRequest;
use App\Models\KegiatanRT;
use App\Repositories\KegiatanRTRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Response;

class KegiatanRTController extends AppBaseController
{
    /** @var  KegiatanRTRepository */
    private $kegiatanRTRepository;

    public function __construct(KegiatanRTRepository $kegiatanRTRepo)
    {
        $this->kegiatanRTRepository = $kegiatanRTRepo;
    }

    /**
     * Display a listing of the KegiatanRT.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->roles_id==1){
            $kegiatanRTs = KegiatanRT::all();
        }else{
            $kegiatanRTs = KegiatanRT::where('rukun_tetangga_id',Auth::user()->rukun_tetangga_id)->get();
        }
        return view('kegiatan_r_ts.index')
            ->with('kegiatanRTs', $kegiatanRTs);
    }

    /**
     * Show the form for creating a new KegiatanRT.
     *
     * @return Response
     */
    public function create()
    {
        return view('kegiatan_r_ts.create');
    }

    /**
     * Store a newly created KegiatanRT in storage.
     *
     * @param CreateKegiatanRTRequest $request
     *
     * @return Response
     */
    public function store(CreateKegiatanRTRequest $request)
    {
        $input = $request->except('foto');
        try{
            DB::beginTransaction();
            $kegiatanRT = $this->kegiatanRTRepository->create($input);

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = $kegiatanRT->id . '.' . $file->getClientOriginalExtension();
                $path = $request->foto->storeAs('public/kegiatanRT', $filename, 'local');
                $kegiatanRT->foto = 'storage' . substr($path, strpos($path, '/'));
                $kegiatanRT->save();
            }
            DB::commit();
            Flash::success('Kegiatan RT saved successfully.');
            return redirect(route('kegiatanRTs.index'));

        }catch (\Exception $err){
            DB::rollBack();
            Flash::error('Error :'.$err);
            return redirect(route('kegiatanRTs.index'));
        }
    }

    /**
     * Display the specified KegiatanRT.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $kegiatanRT = $this->kegiatanRTRepository->find($id);

        if (empty($kegiatanRT)) {
            Flash::error('Kegiatan R T not found');

            return redirect(route('kegiatanRTs.index'));
        }

        return view('kegiatan_r_ts.show')->with('kegiatanRT', $kegiatanRT);
    }

    /**
     * Show the form for editing the specified KegiatanRT.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $kegiatanRT = $this->kegiatanRTRepository->find($id);

        if (empty($kegiatanRT)) {
            Flash::error('Kegiatan R T not found');

            return redirect(route('kegiatanRTs.index'));
        }

        return view('kegiatan_r_ts.edit')->with('kegiatanRT', $kegiatanRT);
    }

    /**
     * Update the specified KegiatanRT in storage.
     *
     * @param int $id
     * @param UpdateKegiatanRTRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateKegiatanRTRequest $request)
    {
        $input = $request->except('foto');
        $kegiatanRT = $this->kegiatanRTRepository->find($id);

        if (empty($kegiatanRT)) {
            Flash::error('Kegiatan R T not found');
            return redirect(route('kegiatanRTs.index'));
        }
        try{
            DB::beginTransaction();
            $kegiatanRT = $this->kegiatanRTRepository->update($input, $id);

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = $kegiatanRT->id . '.' . $file->getClientOriginalExtension();
                $path = $request->foto->storeAs('public/kegiatanRT', $filename, 'local');
                $kegiatanRT->foto = 'storage' . substr($path, strpos($path, '/'));
                $kegiatanRT->save();
            }
            DB::commit();
            Flash::success('Kegiatan RT updated successfully.');
            return redirect(route('kegiatanRTs.index'));

        }catch (\Exception $err){
            DB::rollBack();
            Flash::error('Error :'.$err);
            return redirect(route('kegiatanRTs.index'));
        }
    }

    /**
     * Remove the specified KegiatanRT from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $kegiatanRT = $this->kegiatanRTRepository->find($id);

        if (empty($kegiatanRT)) {
            Flash::error('Kegiatan R T not found');

            return redirect(route('kegiatanRTs.index'));
        }

        $this->kegiatanRTRepository->delete($id);

        Flash::success('Kegiatan R T deleted successfully.');

        return redirect(route('kegiatanRTs.index'));
    }
}
