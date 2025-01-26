<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiDataResource;
use App\Models\Nisn;
use App\Models\Phone;
use App\Models\Siswa;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::with('nisn', 'phone', 'hobby')->get();

        $siswa = $siswa->map(function ($item) {
            return [
                'id' => $item->id,
                'nama' => $item->nama,
                'nisn' => $item->nisn->nisn,
                'hobby' => $item->hobby->map(function ($hobby){
                    return $hobby->hobby;
                }),
                'phone' => $item->phone->map(function ($phone) {
                    return $phone->phone_number;
                }),
            ];
        });

        return response()->json(
            new ApiDataResource(true, 'berhasil menampilkan data', $siswa
        ), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $rules = [
            'nama' => 'required',
            'nisn' => 'required',
            // 'phone' => 'required'
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

        // $phone = Phone::create([
        //     'phone_number' => $request->phone,
        //     'siswa_id' => $data->id
        // ]);

        if ($request->has('hobby')){
            $hobby = explode(',', $request->hobby);
            $data->hobby()->attach($hobby);
        }

        return response()->json(
            new ApiDataResource(true, 'berhasil menginput data', $post)
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $siswa = Siswa::with('nisn', 'phone', 'hobby')->where('id', $id)->get();

        $siswa = $siswa->map(function ($item) {
            return [
                'id' => $item->id,
                'nama' => $item->nama,
                'nisn' => $item->nisn->nisn,
                // 'phone' => $item->phone->map(function ($phone) {
                //     return $phone->phone_number;
                // })
            ];
        });
        if ($siswa){
            return response()->json(
                new ApiDataResource(true, 'data ditemukan', $siswa), 200
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

        $data = Siswa::find($id);

        if (empty($data)){
            return response()->json([
                'status' => false,
                'message' => 'data tidk ditemukan'
            ], 404);
        }
        $rules = [
            'nama' => 'required',
            'nisn' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'gagal mengupdate data',
                'data' => $validator->errors()
            ], 400);
        }

        $nisn = NISN::create([
            'nisn' => $request->nisn,  
        ]);

        
        $data->nama = $request->nama;
        $data->nisn_id = $nisn->id;

        $post = $data->save();

        // $phone = Phone::create([
        //     'phone_number' => $request->phone,
        //     'siswa_id' => $data->id
        // ]);

        if ($request->has('hobby')){
            $hobby = explode(',', $request->hobby);
            $data->hobby()->sync($hobby);
        }


        return response()->json(
            new ApiDataResource(true, 'berhasil mengupdate data', $post)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $siswa = Siswa::find($id);
       
        if (empty($siswa)){
            return response()->json([
                'status' => false,
                'message' => 'gagal menghapus data',
            ], 404);
        }

        $siswa->delete();
        return response()->json(
            new ApiDataResource(true, 'berhasil menghapus data', $siswa)
        );
    }
}
