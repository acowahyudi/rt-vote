<!-- Mulai Vote Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mulai_vote', 'Mulai Vote:') !!}
    {!! Form::text('mulai_vote', null, ['class' => 'form-control','id'=>'mulai_vote']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#mulai_vote').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Selesai Vote Field -->
<div class="form-group col-sm-6">
    {!! Form::label('selesai_vote', 'Selesai Vote:') !!}
    {!! Form::text('selesai_vote', null, ['class' => 'form-control','id'=>'selesai_vote']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#selesai_vote').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Keterangan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('keterangan', 'Periode:') !!}
    {!! Form::text('keterangan', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- RT id -->
{!! Form::hidden('rukun_tetangga_id', \Illuminate\Support\Facades\Auth::user()->rukun_tetangga_id, null, ['class' => 'form-control']) !!}
