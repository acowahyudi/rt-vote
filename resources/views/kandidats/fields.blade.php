
<!-- No Calon Field -->
<div class="form-group col-sm-6">
    {!! Form::label('no_calon', 'No Calon:') !!}
    {!! Form::number('no_calon', null, ['class' => 'form-control']) !!}
</div>

<!-- Nama Field -->
<div class="form-group col-sm-6">
    {!! Form::label('users_id', 'Nama:') !!}
    {!! Form::select('users_id',$penduduk, null, ['class' => 'form-control', 'id'=>'users_id']) !!}
</div>
@push('page_scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#users_id').select2();
        });
    </script>
@endpush

<!-- Periode Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('periode_id', 'Periode:') !!}
    {!! Form::select('periode_id', $periode, null, ['class' => 'form-control']) !!}
</div>

<!-- Foto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('foto', 'Foto:') !!}<br>
    {!! Form::file('foto', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Visi Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('visi', 'Visi:') !!}
    {!! Form::textarea('visi', null, ['class' => 'form-control']) !!}
</div>
