<?php

namespace App\Http\Controllers;

use App\Exports\MhsExport;
use App\Imports\MhsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade as PDF;

class MhsController extends Controller
{
    public function mhsexport()
    {
        return Excel::download(new MhsExport, 'data-mhs.xlsx');
    }

    public function mhsimport(Request $request)
    {
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $file->move('datamhs', $filename);
        
        Excel::import(new MhsImport, public_path('/datamhs/'.$filename));
        return redirect()->route('index')->with('success', 'Data mahasiswa telah diimport!');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ini adalah scrip untuk melakukan request data dari Rekweb API yang telah kita buat
        $username = 'user';
        $password = 'user';
        $credentials = base64_encode("$username:$password");

        $headers = [];
        $headers[] = "Authorization: Basic {$credentials}";
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        $headers[] = 'Cache-Control: no-cache';

            // Initializing curl
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL,"127.0.0.2:8001/datamahasiswa");
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST,'GET');
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            // Executing curl
            $response = curl_exec($curl);
            
            // Checking if any error occurs during request or not
            if($e = curl_error($curl)) {
                echo $e;
                
            } else {
                //var_dump($response); die;
                // Decoding JSON data
                $decodedData =
                    json_decode($response, true);
                    
                // Outputting JSON data in
                // Decoded form
                //var_dump($decodedData);
                $data = $decodedData;
            }

        // Closing curl
        curl_close($curl);
        return view('mhs.index', ["data"=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mhs.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_lengkap' => 'required',
            'tanggal_lahir' => 'required',
            'no_hp' => 'required',
            'email' => 'required',
            'agama' => 'required',
            'jenis_kelamin' => 'required',
            'nik' => 'required',
            'pendidikan_terakir' => 'required',
            'pilihan_programstudi1' => 'required',
            'pilihan_programstudi2' => 'required'
        ]);

        $postData = array(
            "nama_lengkap" => $request->input('nama_lengkap'),
            "tanggal_lahir" => $request->input('tanggal_lahir'),
            "no_hp" => $request->input('no_hp'),
            "email" => $request->input('email'),
            "agama" => $request->input('agama'),
            "jenis_kelamin" => $request->input('jenis_kelamin'),
            "nik" => $request->input('nik'),
            "pendidikan_terakir" => $request->input('pendidikan_terakir'),
            "pilihan_programstudi1" => $request->input('pilihan_programstudi1'),
            "pilihan_programstudi2" => $request->input('pilihan_programstudi2')
        );

        $data_string = json_encode($postData);


        // Ini adalah scrip untuk melakukan post data dari Rekweb API yang telah kita buat
        $username = 'user';
        $password = 'user';
        $credentials = base64_encode("$username:$password");

        $headers = [];
        $headers[] = "Authorization: Basic {$credentials}";
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Cache-Control: no-cache';
        $headers[] = 'Content-Length: ' . strlen($data_string);
        
        
            // Initializing curl
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL,"127.0.0.2:8001/datamahasiswa");
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
   
            // Executing curl
            $response = curl_exec($curl);
            
            //var_dump($response); die;
            // Checking if any error occurs during request or not
            if($e = curl_error($curl)) {
                echo $e;
            } 
        // Closing curl
        curl_close($curl);
        return redirect()->route('index')->with('success', 'Data telah dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    
    public function edit($id)
    {
        // Ini adalah scrip untuk melakukan post data dari Rekweb API yang telah kita buat
        $username = 'user';
        $password = 'user';
        $credentials = base64_encode("$username:$password");

        $headers = [];
        $headers[] = "Authorization: Basic {$credentials}";
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Cache-Control: no-cache';
        
        
            // Initializing curl
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL,"127.0.0.2:8001/detail/$id");
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
   
            // Executing curl
            $response = curl_exec($curl);
            
            //var_dump($response); die;
            // Checking if any error occurs during request or not
            if($e = curl_error($curl)) {
                echo $e;
            } else {
                // Decoding JSON data
                $decodedData =
                    json_decode($response, true);
                // Outputting JSON data in
                // Decoded form
                //var_dump($decodedData);
                $data = $decodedData;
            } 
        // Closing curl
        curl_close($curl);
        return view('mhs.edit', ["data" => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_lengkap' => 'required',
            'tanggal_lahir' => 'required',
            'no_hp' => 'required',
            'email' => 'required',
            'agama' => 'required',
            'jenis_kelamin' => 'required',
            'nik' => 'required',
            'pendidikan_terakir' => 'required',
            'pilihan_programstudi1' => 'required',
            'pilihan_programstudi2' => 'required'
        ]);

        $postData = array(
            "nama_lengkap" => $request->input('nama_lengkap'),
            "tanggal_lahir" => $request->input('tanggal_lahir'),
            "no_hp" => $request->input('no_hp'),
            "email" => $request->input('email'),
            "agama" => $request->input('agama'),
            "jenis_kelamin" => $request->input('jenis_kelamin'),
            "nik" => $request->input('nik'),
            "pendidikan_terakir" => $request->input('pendidikan_terakir'),
            "pilihan_programstudi1" => $request->input('pilihan_programstudi1'),
            "pilihan_programstudi2" => $request->input('pilihan_programstudi2')
        );

        $data_string = json_encode($postData);

        // Ini adalah scrip untuk melakukan post data dari Rekweb API yang telah kita buat
        $username = 'user';
        $password = 'user';
        $credentials = base64_encode("$username:$password");

        $headers = [];
        $headers[] = "Authorization: Basic {$credentials}";
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Cache-Control: no-cache';
        $headers[] = 'Content-Length: ' . strlen($data_string);
        
        
            // Initializing curl
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL,"127.0.0.2:8001/update/$id");
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
   
            // Executing curl
            $response = curl_exec($curl);
            
            // Checking if any error occurs during request or not
            if($e = curl_error($curl)) {
                echo $e;
            } 
        // Closing curl
        curl_close($curl);
        return redirect()->route('index')->with('success', 'Data telah diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id)
    {
        // Ini adalah scrip untuk melakukan post data dari Rekweb API yang telah kita buat
        $username = 'user';
        $password = 'user';
        $credentials = base64_encode("$username:$password");

        $headers = [];
        $headers[] = "Authorization: Basic {$credentials}";
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Cache-Control: no-cache';
        
        
            // Initializing curl
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL,"127.0.0.2:8001/delete/$id");
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
   
            // Executing curl
            $response = curl_exec($curl);
            
            // Checking if any error occurs during request or not
            //var_dump($response); die;
            if($e = curl_error($curl)) {
                echo $e;
            } 
        // Closing curl
        curl_close($curl);
        return redirect()->route('index')->with('success', 'Data telah dihapus!');
    }
}
