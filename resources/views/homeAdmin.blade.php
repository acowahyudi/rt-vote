@extends('layouts.app')

@section('content')
<div class="container pt-3">
    <div class="card col-md-12">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    @if(!empty($endVote))
                        <div class="card bg-blue">
                            <div class="card-content">
                                <div class="card-body">
                                    <h4 class="text-white font-large-1 mb-2"><i class="fa fa-calendar"></i> Pemilihan Aktif:</h4>
                                        <h5 class="text-white">Periode : {{$endVote->keterangan}}</h5>
                                        <h5>Pemilihan Berakhir: {{$endVote->remainDay}} Hari lagi</h5>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card bg-secondary">
                            <div class="card-content">
                                <div class="card-body">
                                    <h4 class="text-white font-large-1 mb-2"><i class="fa fa-calendar"></i> Pemilu Aktif</h4>
                                    <h5 class="text-white">Tidak Ada Pemilihan yang berlangsung Tahun Ini</h5>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-4">
                    <div class="card bg-green">
                        <div class="card-content">
                            <div class="card-body">
                                <h4 class="text-white font-large-1 mb-2"><i class="fa fa-users"></i> Penduduk</h4>
                                <h5 class="text-white">{{$penduduk->count()}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card bg-orange">
                        <div class="card-content">
                            <div class="card-body">
                                <h4 class="text-white font-large-1 mb-2"><i class="fa fa-address-book"></i> Data RT</h4>
                                <h5 class="text-white">{{$rt->count()}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card bg-warning">
                        <div class="card-content">
                            <div class="card-body">
                                <h4 class="text-white font-large-1 mb-2"><i class="fa fa-chart-bar"></i> Jumlah Calon Ketua RT</h4>
                                <h5 class="text-white">{{$kandidat->count()}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
