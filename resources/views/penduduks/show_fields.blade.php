<!-- Nama Field -->
<div class="col-sm-12">
    {!! Form::label('nama', 'Nama:') !!}
    <p>{{ $penduduk->nama }}</p>
</div>

<!-- Nik Field -->
<div class="col-sm-12">
    {!! Form::label('nik', 'Nik:') !!}
    <p>{{ $penduduk->nik }}</p>
</div>

<!-- Jenis Kelamin Field -->
<div class="col-sm-12">
    {!! Form::label('jenis_kelamin', 'Jenis Kelamin:') !!}
    <p>{{ $penduduk->jenis_kelamin }}</p>
</div>

<!-- Tgl Lahir Field -->
<div class="col-sm-12">
    {!! Form::label('tgl_lahir', 'Tgl Lahir:') !!}
    <p>{{ $penduduk->tgl_lahir }}</p>
</div>

<!-- Tempat Lahir Field -->
<div class="col-sm-12">
    {!! Form::label('tempat_lahir', 'Tempat Lahir:') !!}
    <p>{{ $penduduk->tempat_lahir }}</p>
</div>

<!-- Agama Field -->
<div class="col-sm-12">
    {!! Form::label('agama', 'Agama:') !!}
    <p>{{ $penduduk->agama }}</p>
</div>

