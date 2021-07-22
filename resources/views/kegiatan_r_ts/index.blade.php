@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kegiatan RT</h1>
                </div>
                @if(\Illuminate\Support\Facades\Auth::user()->roles_id==3)
                    <div class="col-sm-6">
                        <a class="btn btn-primary float-right"
                           href="{{ route('kegiatanRTs.create') }}">
                            Tambah Baru
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                @include('kegiatan_r_ts.table')

                <div class="card-footer clearfix float-right">
                    <div class="float-right">

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

