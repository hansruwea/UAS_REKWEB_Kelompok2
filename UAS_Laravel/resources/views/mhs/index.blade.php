@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h1>Data Pendaftaran Mahasiswa</h1>
            </div>
        </div>
        <div class="col-lg-12 margin-tb mb-3">
            <div class="float-left">
                <a href="{{ route('mhsexport') }}" class="btn btn-primary">Export</a>
            </div>
            <div class="float-right">
                <a href="{{ route('create') }}" class="btn btn-primary">Add Data</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered mb-3" cellpadding=3>
        <thead>
            <tr>
                <th col width="50">ID</th>
                <th col width="220">Nama Lengkap</th>
                <th col width="220">Tanggal Lahir</th>
                <th col width="220">No Handphone</th>
                <th col width="220">Email</th>
                <th col width="220">Agama</th>
                <th col width="220">Jenis Kelamin</th>
                <th col width="220">NIK</th>
                <th col width="220">Pendidikan Terakir</th>
                <th col width="220">Pilihan Program Studi 1</th>
                <th col width="220">Pilihan Program Studi 2</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $value)
            <tr>
                <td>{{ $value['id'] }}</td>
                <td>{{ $value['nama_lengkap'] }}</td>
                <td>{{ $value['tanggal_lahir'] }}</td>
                <td>{{ $value['no_hp'] }}</td>
                <td>{{ $value['email'] }}</td>
                <td>{{ $value['agama']}}</td>
                <td>{{ $value['jenis_kelamin'] }}</td>
                <td>{{ $value['nik'] }}</td>
                <td>{{ $value['pendidikan_terakir'] }}</td>
                <td>{{ $value['pilihan_programstudi1'] }}</td>
                <td>{{ $value['pilihan_programstudi2'] }}</td>

                <td>
                    <form action="{{ route('destroy', $value['id']) }}" method="post">
                    @csrf
                        {{-- <a href="{{ route('show', $value['id']) }}" class="btn btn-info">Show</a> --}}
                        <a href="{{ route('edit', $value['id']) }}" class="btn btn-success" 
                            role="button">Edit</a>
                        <a href="{{ route('destroy', $value['id']) }}" class="btn btn-danger" role="button" 
                            onclick="return confirm('Yakin akan menghapus {{ $value['nama_lengkap'] }}')">Delete</a>
                    </form>                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection

