@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Hasil Voting</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card col-md-12">
            <div class="card-body">
                {{--<div class="badge-primary rounded p-0-1 mb-2 text-center font-weight-bold">
                    --}}{{--info--}}{{--
                </div>--}}

                {!! Form::open(['route' => 'hasilVotingByRT']) !!}
                    <div class="row">
                        <div class="form-group col-sm-4">
                            {!! Form::label('kelurahan', 'Kelurahan:') !!}
                            {!! Form::select('kelurahan_id', $kelurahan, null ,['placeholder'=>'Pilih Kelurahan', 'class' => 'form-control', 'id'=>'kelurahan_id']) !!}
                        </div>
                        <div class="form-group col-sm-4">
                            {!! Form::label('rukun_tetangga_id', 'RT:') !!}
                            @if(!empty($rt))
                                {!! Form::select('rt_id', [], null, ['placeholder'=>'Pilih RT', 'class' => 'form-control', 'id'=>'rt_id', 'required']) !!}
                            @else
                                {!! Form::select('rt_id', $rt, null, ['placeholder'=>'Pilih RT', 'class' => 'form-control', 'id'=>'rt_id', 'required']) !!}
                            @endif
                        </div>
                        <div class="form-group col-sm-4">
                            {!! Form::label('periode', 'Periode:') !!}
                            {!! Form::select('periode_id', [], null ,['placeholder'=>'Pilih Periode', 'class' => 'form-control', 'id'=>'periode_id', 'required']) !!}
                        </div>
                    </div>
                    <div class="form">
                        {!! Form::submit('Lihat Voting', ['class' => 'btn btn-primary']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection

@push('page_scripts')
    <script>
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
        $('#kelurahan_id').on('change', function () {
            $.ajax({
                url: '{{ route('rtByKelurahan') }}',
                method: 'get',
                data: {id: $(this).val()},
                success: function (response) {
                    if (!$.trim(response)){
                        $('#rt_id').empty().append(new Option("Tidak ada data", null)).attr('disabled','disabled');
                        $('#periode_id').empty().append(new Option("Tidak ada data", null)).attr('disabled','disabled');
                        $(':input[type="submit"]').prop('disabled',true);
                    }else{
                        $.each(response, function (id, name) {
                            $('#rt_id').empty().removeAttr('disabled').append(new Option(name, id)).focus();
                            $('#periode_id').empty().attr('disabled');
                            $(':input[type="submit"]').prop('disabled',false);
                        })
                    }
                },
                error: function (error) {
                    console.log(error);
                    alert("Error: "+error);
                }
            })
        });
        $('#rt_id').on('focus', function () {
            $.ajax({
                url: '{{ route('periodeByRT') }}',
                method: 'get',
                data: {id: $(this).val()},
                success: function (response) {
                    if (!$.trim(response)){
                        $('#periode_id').empty().append(new Option("Tidak ada data", null)).attr('disabled','disabled');
                        $(':input[type="submit"]').prop('disabled',true);
                    }else{
                        $.each(response, function (id, name) {
                            $('#periode_id').removeAttr('disabled').empty().append(new Option(name, id))
                            $(':input[type="submit"]').prop('disabled',false);
                        })
                    }
                },
                error: function (error) {
                    console.log(error);
                    alert("Error: "+error);
                }
            })
        });
    </script>
@endpush

