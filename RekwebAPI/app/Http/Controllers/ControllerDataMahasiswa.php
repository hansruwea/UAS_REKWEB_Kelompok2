<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\DataMahasiswa;

class ControllerDataMahasiswa extends Controller
{
    public function create(Request $request)
    {
        $data = $request->all();
        $datamahasiswa = DataMahasiswa::create($data);

        return response()->json($datamahasiswa);
    }

    public function index()
    {
        $datamahasiswa = DataMahasiswa::all();
        return response()->json($datamahasiswa);
    }

    public function detail($id)
    {
        $datamahasiswa = DataMahasiswa::find($id);
        return response()->json($datamahasiswa);
    }

    public function delete($id)
    {
        $datamahasiswa = DataMahasiswa::whereId($id)->first();
        $datamahasiswa->delete();

        if($datamahasiswa)
        {
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ],200);
        }
    }

    public function update(Request $request, $id)
    {
        $datamahasiswa = DataMahasiswa::whereId($id)->update([
            'nama_lengkap'     => $request->input('nama_lengkap'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'no_hp' => $request->input('no_hp'),
            'email' => $request->input('email'),
            'agama' => $request->input('agama'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'nik' => $request->input('nik'),
            'pendidikan_terakir' => $request->input('pendidikan_terakir'),
            'pilihan_programstudi1'=> $request->input('pilihan_programstudi1'),
            'pilihan_programstudi2'=> $request->input('pilihan_programstudi2'),
        ]);
        
        if($datamahasiswa){
            return response()->json([
                'success'    => true,
                'message'    => 'Data Berhasil diupdate',
                'data'       => $datamahasiswa
            ],201);
        } else{
            return response()->json([
                'success'    => false,
                'message'    => 'Data Gagal diupdate',
            ],400);
        }
    }
}

