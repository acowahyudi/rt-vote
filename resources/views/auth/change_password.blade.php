@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Ganti Password</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'storePassword']) !!}

            <div class="card-body">

                <div class="row">
                    <div class="form-group col-sm-6">
                        {!! Form::label('password', 'Password Baru:') !!}
                        {!! Form::password('password', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
                    </div>
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('home') }}" class="btn btn-default">Cancel</a>
            </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection
