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

<!-- Tempat Lahir Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tempat_lahir', 'Tempat Lahir:') !!}
    {!! Form::text('tempat_lahir', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Tgl Lahir Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tgl_lahir', 'Tgl Lahir:') !!}
    {!! Form::text('tgl_lahir', null, ['class' => 'form-control','id'=>'tgl_lahir']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#tgl_lahir').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Jenis Kelamin Field -->
<div class="form-group col-sm-6">
    {!! Form::label('jenis_kelamin', 'Jenis Kelamin:') !!}
    {!! Form::radio('jenis_kelamin', 'L', ['class' => 'form-control']) !!}
    {!! Form::label('Laki laki', 'Laki-Laki',['class'=> 'mr-3']) !!}
    {!! Form::radio('jenis_kelamin', 'P', ['class' => 'form-control']) !!}
    {!! Form::label('Perempuan', 'Perempuan') !!}

</div>

<!-- Agama Field -->
<div class="form-group col-sm-6">
    {!! Form::label('agama', 'Agama:') !!}
    {!! Form::text('agama', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Tingkat Pendidikan Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tingkat_pendidikan_id', 'Tingkat Pendidikan:') !!}
    {!! Form::select('tingkat_pendidikan_id', $pendidikan, null, ['class' => 'form-control']) !!}
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

