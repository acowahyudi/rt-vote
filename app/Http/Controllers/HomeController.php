<?php

namespace App\Http\Controllers;

use App\Models\HasilVoting;
use App\Models\Kandidat;
use App\Models\Penduduk;
use App\Models\Periode;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        $endVote = Periode::whereDate('mulai_vote','<',Carbon::now()) ->whereDate('selesai_vote','>',Carbon::now())->get()->first();
        if (!empty($endVote)){
            $today = Carbon::now();
            $remainDay = $endVote->selesai_vote->diffInDays($today);
            $endVote['remainDay'] = $remainDay;
        }

        $kandidat = Kandidat::all()->count();
        $penduduk = Penduduk::all()->count();
        $voting = HasilVoting::all()->count();
        return view('home',compact('kandidat','penduduk','voting','endVote'));
    }
}
