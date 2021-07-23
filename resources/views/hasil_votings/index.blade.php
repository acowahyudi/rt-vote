@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="font-weight-light">Hasil Voting RT <b>{{$rt->rt}}</b> Kelurahan <b>{{$kelurahan->kelurahan}}</b></h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card col-md-12">
            <div class="card-body">
                <div class="badge-primary rounded p-0-1 mb-2 text-center font-weight-bold">
                    Periode {{$periode->keterangan}}
                    @if($periode->remainDay>0)
                        <p class="font-weight-light">Pemilihan Berakhir: {{$periode->remainDay}} Hari lagi</p>
                    @else
                        <p class="font-weight-light">Hasil Akhir Voting</p>
                    @endif
                </div>
                <div class="row">
                    @if(!empty($kandidatAktif))
                        @foreach($kandidatAktif as $item)
                            <div class="col-4 container-fluid">
                                <div class="card bg-dark">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="row m-0">
                                                <img class="rounded" style="width: 100px;background-size: auto" src="{{asset($item->foto)}}">
                                                <div class="ml-2">
                                                    <h5 class="text-white font-weight-bold mb-2"> {{$item->user->name}}</h5>
                                                    <h6 class="text-white">Jumlah Suara : <b>{{$item->vote_count}}</b></h6>
                                                    <div class="progress">
                                                        @if($hasilVotings->count()>0)
                                                            <div class="progress-bar <strong>progress-bar-animated</strong> progress-bar-striped bg-primary" role="progressbar" style="width:{{$item->vote_count/$hasilVotings->count()*100}}%" aria-valuenow="{{$item->vote_count}}" aria-valuemin="0" aria-valuemax="{{$hasilVotings->count()}}">{{number_format($item->vote_count/$hasilVotings->count()*100,1,',','.')}}%</div>
                                                        @else
                                                            <div class="progress-bar <strong>progress-bar-animated</strong> progress-bar-striped bg-primary" role="progressbar" style="width:0%" aria-valuenow="{{$item->vote_count}}" aria-valuemin="0" aria-valuemax="{{$hasilVotings->count()}}">{{number_format(0,1,',','.')}}%</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div>Tidak ada Pemilihan</div>
                    @endif
                </div>
            </div>
        </div>
        @if(\Illuminate\Support\Facades\Auth::user()->roles_id==1)
            <div class="card">
                <div class="card-body p-0">
                    <h4 class="ml-2 mt-2">Detail Hasil Voting</h4>
                    @include('hasil_votings.table')
                    <div class="card-footer clearfix float-right">
                        <div class="float-right">

                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection

