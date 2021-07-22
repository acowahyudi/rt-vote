<?php

namespace App\Http\Controllers;

use App\Models\HasilVoting;
use App\Models\Kandidat;
use App\Models\KegiatanRT;
use App\Models\Penduduk;
use App\Models\Periode;
use App\Models\RukunTetangga;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //TODO home untuk admin RT
        if (Auth::user()->roles_id==3){
            $endVote = Periode::where('rukun_tetangga_id',Auth::user()->rukun_tetangga_id)
                ->whereDate('mulai_vote','<',Carbon::now())
                ->whereDate('selesai_vote','>',Carbon::now())
                ->get()->first();
            if (!empty($endVote)){
                $today = Carbon::now();
                $remainDay = $endVote->selesai_vote->diffInDays($today);
                $endVote['remainDay'] = $remainDay;

                $penduduk = User::where('rukun_tetangga_id', Auth::user()->rukun_tetangga_id)->get();

                $kandidat = Kandidat::whereHas('user',function ($q){
                    $q->where('rukun_tetangga_id', Auth::user()->rukun_tetangga_id);
                })->where('periode_id',$endVote->id)->get();
                $idKandidat=[];
                foreach ($kandidat as $item){
                    array_push($idKandidat,$item->id);
                }

                $voting = HasilVoting::where('periode_id',$endVote->id)
                    ->whereIn('kandidat_id',$idKandidat)
                    ->get();
            }else{
                $penduduk = User::where('rukun_tetangga_id', Auth::user()->rukun_tetangga_id)->get();
                $endVote=[];
                $kandidat = [];
                $voting = [];
            }

            return view('homeAdminRT',compact('kandidat','penduduk','voting','endVote'));
        }
        //TODO home untuk penduduk
        elseif (Auth::user()->roles_id==2){
            $kegiatan = KegiatanRT::limit(3)->orderBy('created_at','desc')->get();
            $endVote = Periode::where('rukun_tetangga_id',Auth::user()->rukun_tetangga_id)
                ->whereDate('mulai_vote','<',Carbon::now())
                ->whereDate('selesai_vote','>',Carbon::now())
                ->get()->first();
            if (!empty($endVote)){
                $today = Carbon::now();
                $remainDay = $endVote->selesai_vote->diffInDays($today);
                $endVote['remainDay'] = $remainDay;
                //TODO pengecekan apakah user sudah pernah voting atau belum
                $voteAktif = HasilVoting::where('users_id',Auth::user()->id)
                    ->where('periode_id',$endVote->id)->get()->count();

                $pilihKandidat = Kandidat::where('periode_id',$endVote->id)
                    ->whereHas('user',function ($q){
                        $q->where('rukun_tetangga_id',Auth::user()->rukun_tetangga_id);
                    })
                    ->get();
            }
            return view('home',compact('endVote','pilihKandidat','voteAktif','kegiatan'));
        }
        elseif (Auth::user()->roles_id==1){
            $kegiatan = KegiatanRT::all();
            $endVote = Periode::whereDate('mulai_vote','<',Carbon::now()) ->whereDate('selesai_vote','>',Carbon::now())->get()->first();
            if (!empty($endVote)){
                $today = Carbon::now();
                $remainDay = $endVote->selesai_vote->diffInDays($today);
                $endVote['remainDay'] = $remainDay;
            }
            $rt = RukunTetangga::all();
            $kandidat = Kandidat::all();
            $penduduk = User::where('name','!=','admin')->get();
            return view('homeAdmin',compact('rt','penduduk','kandidat','endVote','kegiatan'));
        }
    }
}
