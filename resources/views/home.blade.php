@extends('layouts.app')

@section('content')
<div class="container pt-3">
    @include('flash::message')

    <div class="clearfix"></div>
    <div class="card col-md-12">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <h4>Seputar Kegiatan RT</h4>
                </div>
                <hr class="col-12">
                @if(\Illuminate\Support\Facades\Auth::user()->roles_id=2)
                    @foreach($kegiatan as $item)
                        <div class="col-4">
                            <div class="card bg-dark">
                                <div class="card-content">
                                    <div class="card-body">
                                        <img style="width: 300px; height: 200px" src="{{asset($item->foto)}}">
                                        <h6 class="text-white">{{$item->title}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="col-12 text-right">
                    <a href="{{route('kegiatanRTs.index')}}" class="badge bg-light small text-black-50">lihat semua <i class="fa fa-angle-double-right"></i></a>
                </div>
                <hr class="col-12">

                <div class="col-12">
                    @if(!empty($endVote))
                        <div class="card bg-blue">
                            <div class="card-content">
                                <div class="card-body">
                                    <h4 class="text-white font-large-1 mb-2"><i class="fa fa-calendar"></i> Pemilihan Aktif</h4>
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
            </div>
        </div>
    </div>
    @if(!empty($endVote) && $voteAktif==0)
        <div class="card col-md-12">
            <div class="card-body">
                <h3 class="rounded p-1 mb-3 font-weight-bold text-center">Silahkan Vote Calon Ketua RT </h3>
                {!! Form::open(['route' => 'hasilVotings.store']) !!}
                {!! Form::hidden('users_id', \Illuminate\Support\Facades\Auth::user()->id, null, ['class' => 'form-control']) !!}
                {!! Form::hidden('kandidat_id', $item->id, null, ['class' => 'form-control']) !!}
                {!! Form::hidden('periode_id', $endVote->id, null, ['class' => 'form-control']) !!}
                <div class="row justify-content-center container-fluid">
                    @foreach($pilihKandidat as $item)
                        <div class="col-4 d-flex">
                            <div class="card shadow">
                                <img src="{{asset($item->foto)}}" class="m-3 rounded rounded-1" alt="Kandidat Image">
                                {!! Form::submit('Vote', ['class' => 'align-self-center btn btn-block bg-warning text-center font-weight-bold rounded mt-1 mb-2 p-2', 'onclick' => "return confirm('Peringatan, Anda hanya bisa sekali vote. Apakah Anda yakin ingin vote kandidat ini?')"]) !!}
                                <div class="text-center bg-primary font-weight-bold p-1"><span class="badge badge-pill badge-light p-2 m-1">0{{$item->no_calon}}</span> {{$item->user->name}}</div>
                                <div class="text-center mt-2 p-1"><b>Visi: </b>{{$item->visi}}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    @elseif(!empty($endVote) && $voteAktif>0)
        <div class="card-body text-center m-0">
            <img src="{{asset("vote-image.png")}}" style="width: 50%" alt="Vote Image">
            <h1 class="font-weight-bold">Terima Kasih Telah Memilih Untuk Tidak Golput</h1>
        </div>
    @endif
</div>
@endsection
