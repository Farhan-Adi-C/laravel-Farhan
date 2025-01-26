<?php

namespace App\Http\Controllers\Api;

use App\Models\Hobby;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApiDataResource;
use Illuminate\Support\Facades\Validator;

class ApiHobbyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hobby = Hobby::with('siswa')->get();

        return response()->json(
            new ApiDataResource(true, 'berhasil menampilkan data Hobby', $hobby),);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'hobby' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'gagal menambahkan data',
                'data' => $validator->errors()
            ]);
        }

        $hobby = Hobby::create([
            'hobby' => $request->hobby,  
        ]);

        $hobby->save();

        return response()->json(
            new ApiDataResource(true, 'berhasil menginput data', $hobby)
        );


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $hobby = Hobby::find($id);
        
        if (isset($hobby)){
            $hobby = Hobby::with('siswa')->where('id', $id)->get();
            return response()->json(
                new ApiDataResource(true, 'data ditemukan', $hobby), 200
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
        $hobby = Hobby::find($id);

        if (empty($hobby)){
            return response()->json([
                'status' => false,
                'message' => 'data tidk ditemukan'
            ], 404);
        }

        $rules = [
            'hobby' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'gagal mengupdate data',
                'data' => $validator->errors()
            ]);
        }

        $hobby->hobby = $request->hobby;
        $hobby->save();

        return response()->json(
            new ApiDataResource(true, 'berhasil mengupdate data', $hobby)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hobby = Hobby::find($id);

        if (empty($hobby)){
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $hobby->delete();

        return response()->json(
            new ApiDataResource(true, 'berhasil menghapus data', $hobby)
        );
    }
}
