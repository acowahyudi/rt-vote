<!-- Title Field -->
<div class="form-group col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Foto Field -->
<div class="form-group col-sm-12">
    {!! Form::label('foto', 'Foto:') !!}
    {!! Form::file('foto', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Rukun Tetangga Id Field -->
{!! Form::hidden('rukun_tetangga_id', \Illuminate\Support\Facades\Auth::user()->rukun_tetangga_id, null, ['class' => 'form-control']) !!}
