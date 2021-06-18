<!-- No Calon Field -->
<div class="col-sm-12">
    {!! Form::label('no_calon', 'No Calon:') !!}
    <p>0{{ $kandidat->no_calon }}</p>
</div>

<!-- Nama Field -->
<div class="col-sm-12">
    {!! Form::label('nama', 'Nama:') !!}
    <p>{{ $kandidat->penduduk->nama }}</p>
</div>

<!-- NIK Field -->
<div class="col-sm-12">
    {!! Form::label('nik', 'NIK:') !!}
    <p>{{ $kandidat->penduduk->nik }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $kandidat->penduduk->email }}</p>
</div>

<!-- Foto Field -->
<div class="col-sm-12">
    {!! Form::label('foto', 'Foto:') !!}<br>
    <img style="width: 120px" src="{{asset($kandidat->foto)}}"/>
</div>

<!-- Visi Field -->
<div class="col-sm-12">
    {!! Form::label('visi', 'Visi:') !!}
    <p>{{ $kandidat->visi }}</p>
</div>

