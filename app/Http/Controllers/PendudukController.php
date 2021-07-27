<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePendudukRequest;
use App\Http\Requests\UpdatePendudukRequest;
use App\Models\Kelurahan;
use App\Models\Roles;
use App\Models\RukunTetangga;
use App\Models\User;
use App\Repositories\PendudukRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Response;

class PendudukController extends AppBaseController
{
    /** @var  PendudukRepository */
    private $pendudukRepository;

    public function __construct(PendudukRepository $pendudukRepo)
    {
        $this->pendudukRepository = $pendudukRepo;
    }

    /**
     * Display a listing of the Penduduk.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->roles_id==1){
            $penduduks = User::where('roles_id',3)->get();
        }else{
            $penduduks = User::where('rukun_tetangga_id',Auth::user()->rukun_tetangga_id)
                ->where('roles_id',2)
                ->get();
        }
        return view('penduduks.index')
            ->with('penduduks', $penduduks);
    }

    /**
     * Show the form for creating a new Penduduk.
     *
     * @return Response
     */
    public function create()
    {
        $roles = Roles::where('id',3)->pluck('role','id');
        if (Auth::user()->roles_id==3){
            $kelurahan = Kelurahan::whereHas('rukunTetanggas',function ($q){
                $q->where('id',Auth::user()->rukun_tetangga_id);
            })->pluck('kelurahan','id');
        }else{
            $kelurahan = Kelurahan::pluck('kelurahan','id');
        }
        return view('penduduks.create',compact('roles','kelurahan'));
    }

    /**
     * Store a newly created Penduduk in storage.
     *
     * @param CreatePendudukRequest $request
     *
     * @return Response
     */
    public function store(CreatePendudukRequest $request)
    {
        $input = $request->all();
//        return $input;
        $input['password'] = Hash::make('1234567890');

        $penduduk = $this->pendudukRepository->create($input);

        Flash::success('Penduduk saved successfully.');

        return redirect(route('penduduks.index'));
    }

    /**
     * Display the specified Penduduk.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $penduduk = $this->pendudukRepository->find($id);

        if (empty($penduduk)) {
            Flash::error('Penduduk not found');

            return redirect(route('penduduks.index'));
        }

        return view('penduduks.show')->with('penduduk', $penduduk);
    }

    /**
     * Show the form for editing the specified Penduduk.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $roles = Roles::where('id','!=',1)->pluck('role','id');
        $kelurahan = Kelurahan::pluck('kelurahan','id');

        $penduduk = $this->pendudukRepository->find($id);

        if (empty($penduduk)) {
            Flash::error('Penduduk not found');

            return redirect(route('penduduks.index'));
        }

        return view('penduduks.edit',compact('roles','kelurahan'))->with('penduduk', $penduduk);
    }

    /**
     * Update the specified Penduduk in storage.
     *
     * @param int $id
     * @param UpdatePendudukRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePendudukRequest $request)
    {
        $penduduk = $this->pendudukRepository->find($id);

        if (empty($penduduk)) {
            Flash::error('Penduduk not found');

            return redirect(route('penduduks.index'));
        }

        $penduduk = $this->pendudukRepository->update($request->all(), $id);

        Flash::success('Penduduk updated successfully.');

        return redirect(route('penduduks.index'));
    }

    /**
     * Remove the specified Penduduk from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $penduduk = $this->pendudukRepository->find($id);

        if (empty($penduduk)) {
            Flash::error('Penduduk not found');

            return redirect(route('penduduks.index'));
        }

        $this->pendudukRepository->delete($id);

        Flash::success('Penduduk deleted successfully.');

        return redirect(route('penduduks.index'));
    }

    public function changePassword()
    {
        return view('auth.change_password');
    }

    public function storePassword(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->update([
            'password'=> Hash::make($request->password)
        ]);
        $user->save();
        Flash::success('Password berhasil dirubah.');
        return redirect(route('home'));
    }
}
