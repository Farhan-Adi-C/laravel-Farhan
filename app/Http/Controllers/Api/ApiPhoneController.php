<?php

namespace App\Http\Controllers\Api;

use App\Models\Nisn;
use App\Models\Phone;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApiDataResource;
use Illuminate\Support\Facades\Validator;

class ApiPhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $phone = Phone::with('siswa')->get();

        return response()->json(
            new ApiDataResource(true, 'berhasil menampilkan data', $phone)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'phone' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'gagal menambahkan data',
                'data' => $validator->errors()
            ]);
        }

        $nisn = Nisn::create([
            'nisn' => $request->nisn,  
        ]);
        
        $data = new Siswa;
        $data->nama = $request->nama;
        $data->nisn_id = $nisn->id;

        $post = $data->save();

        $phone = Phone::create([
            'phone_number' => $request->phone,
            'siswa_id' => $data->id
        ]);

        return response()->json(
            new ApiDataResource(true, 'berhasil menginput data', $phone)
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $phone = Phone::with('siswa')->where('id', $id)->get();

        if ($phone){
            return response()->json(
                new ApiDataResource(true, 'data ditemukan', $phone), 200
            );
        }else{
            return response()->json([
                'status' => false,
                'message' => 'data tidak ditemukan'
            ]);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $phone = Phone::find($id);

        if (empty($phone)){
            return response()->json([
                'status' => false,
                'message' => 'data tidk ditemukan'
            ], 404);
        }

        $rules = [
            'nama' => 'required',
            'nisn' => 'required',
            'phone' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'gagal mengupdate data',
                'data' => $validator->errors()
            ]);
        }

        $siswa = $phone->siswa;
        if (empty($siswa)) {
            return response()->json([
                'status' => false,
                'message' => 'Siswa tidak ditemukan'
            ], 404);
        }


        $nisn = $siswa->nisn;
        $nisn->nisn = $request->nisn;
        $nisn->save();

        $siswa->nama = $request->nama;
        $siswa->save();
    
        $phone->phone_number = $request->phone;
        $phone->save();

        return response()->json(true, 'Berhasil mengupdate data', $phone)
        ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $phone = Phone::find($id);

        if (empty($phone)){
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $phone->delete();
        return response()->json(
            new ApiDataResource(true, 'berhasil menghapus data', $phone)
        );
    }
}
