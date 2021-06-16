@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Hasil Voting</h1>
                </div>
{{--                <div class="col-sm-6">--}}
{{--                    <a class="btn btn-primary float-right"--}}
{{--                       href="{{ route('hasilVotings.create') }}">--}}
{{--                        Add New--}}
{{--                    </a>--}}
{{--                </div>--}}
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card col-md-12">
            <div class="card-body">
                <div class="row">
                    @foreach($kandidatAktif as $item)
                    <div class="col-4 container-fluid">
                        <div class="card bg-dark">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row m-0">
                                        <img class="rounded" style="width: 50px;background-size: auto" src="{{asset($item->foto)}}">
                                        <div class="ml-2">
                                            <h5 class="text-white font-large-1 mb-2"> {{$item->nama}}</h5>
                                            <h6 class="text-white">Jumlah Suara : <b>{{$item->vote_count}}</b></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

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
    </div>

@endsection

