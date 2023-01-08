<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataMahasiswa extends Model 
{
    protected $table = 'table_datamahasiswa';

    protected $fillable = ['nama_lengkap', 'tanggal_lahir', 'no_hp', 'email', 'agama', 'jenis_kelamin', 'nik', 'pendidikan_terakir', 'pilihan_programstudi1', 'pilihan_programstudi2' ];
}
