<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print - DataMhs</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <center>
        <h3 class="mb-3">Data Pendaftaran Mahasiswa</h3>
    </center>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Lengkap</th>
                <th>Tanggal Lahir</th>
                <th>No Handphone</th>
                <th>Email</th>
                <th>Agama</th>
                <th>Jenis Kelamin</th>
                <th>NIK</th>
                <th>Pendidikan Terakir</th>
                <th>Pilihan Program Studi 1</th>
                <th>Pilihan Program Studi 2</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mhs as $mahasiswa)
            <tr>
                <td>{{ $value['id'] }}</td>
                <td>{{ $value['nama_lengkap'] }}</td>
                <td>{{ $value['tanggal_lahir'] }}</td>
                <td>{{ $value['no_hp'] }}</td>
                <td>{{ $value['email'] }}</td>
                <td>{{ $value['agama' }}</td>
                <td>{{ $value['jenis_kelamin'] }}</td>
                <td>{{ $value['nik'] }}</td>
                <td>{{ $value['pendidikan_terakir'] }}</td>
                <td>{{ $value['pilihan_programstudi1'] }}</td>
                <td>{{ $value['pilihan_programstudi2'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>