<!-- No Calon Field -->
<div class="form-group col-sm-6">
    {!! Form::label('no_calon', 'No Calon:') !!}
    {!! Form::number('no_calon', null, ['class' => 'form-control']) !!}
</div>

<!-- Nama Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama', 'Nama:') !!}
    {!! Form::text('nama', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Periode Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('periode_id', 'Periode:') !!}
    {!! Form::select('periode_id', $periode, null, ['class' => 'form-control']) !!}
</div>

<!-- Foto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('foto', 'Foto:') !!}
    {!! Form::file('foto', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Visi Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('visi', 'Visi:') !!}
    {!! Form::textarea('visi', null, ['class' => 'form-control']) !!}
</div>

