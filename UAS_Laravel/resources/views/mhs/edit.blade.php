@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-2">
            <div class="float-left">
                <h1><strong>Edit Data Pendaftaran</strong></h1>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> terjadi kesalahan!
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('update', $data['id']) }}" class="form-group" method="POST">
        @csrf
        @method("put")
        <input type="text" class="form-control mb-3" name="nama_lengkap" id="" placeholder="Nama Lengkap">
        <input type="text" class="form-control mb-3" name="tanggal_lahir" id="" placeholder="Tanggal Lahir">
        <input type="text" class="form-control mb-3" name="no_hp" id="" placeholder="No Handphone">
        <input type="text" class="form-control mb-3" name="email" id="" placeholder="Email">
        <input type="text" class="form-control mb-3" name="agama" id="" placeholder="Agama">
        <input type="text" class="form-control mb-3" name="jenis_kelamin" id="" placeholder="Jenis Kelamin">
        <input type="text" class="form-control mb-3" name="nik" id="" placeholder="NIK">
        <input type="text" class="form-control mb-3" name="pendidikan_terakir" id="" placeholder="Pendidikan Terakir">
        <input type="text" class="form-control mb-3" name="pilihan_programstudi1" id="" placeholder="Pilihan Program Studi 1">
        <input type="text" class="form-control mb-3" name="pilihan_programstudi2" id="" placeholder="Pilihan Program Studi 2">
        <button class="btn btn-primary" type="submit">Update</button>
    </form>
@endsection
