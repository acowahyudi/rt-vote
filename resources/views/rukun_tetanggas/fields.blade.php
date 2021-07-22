<!-- Rt Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rt', 'RT:') !!}
    {!! Form::text('rt', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45,'maxlength' => 45]) !!}
</div>

<!-- Kelurahan Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('kelurahan_id', 'Kelurahan:') !!}
    {!! Form::select('kelurahan_id', $kelurahan, null, ['class' => 'form-control']) !!}
</div>
