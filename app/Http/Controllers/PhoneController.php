<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Models\Siswa;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Siswa::with('phone', 'nisn', 'hobby')->get();
        return view('/phone/index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function add($id){


        return view('/phone/post', ['id' => $id]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'phone_number' => 'required'
        ]);

        $siswa = Siswa::find($id);

        Phone::create([
            'siswa_id' => $siswa->id,
            'phone_number' => $request->input('phone_number')
        ]);

        return redirect()->route('phone.edit', ['id' => $siswa->id])->with('success', 'berhasil menambahkan No.Telpon');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data =Siswa::with('phone')->where('id', $id)->get();
        $phone = Phone::with('siswa')->where('id', $id)->get();
        // dd($data);
        return view('/phone/detail', compact('data', 'id', 'phone'));
    }
    public function edit2(string $id)
    {
        $data =Siswa::with('phone')->where('id', $id)->get();
        $phone = Phone::with('siswa')->where('id', $id)->get();
        // dd($data);
        return view('/phone/update', compact('data', 'id', 'phone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'phone_number' => 'required'
        ]);

        $phone = Phone::find($id);
        
        $phone->phone_number = $request->input('phone_number');
        $phone->save();

        return redirect()->route('phone.edit', ['id' => $phone->siswa_id])->with('success', 'berhasil mengubah No.Telpon');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $phone = Phone::find($id);
        Phone::where('id', $id)->delete();
        return redirect()->route('phone.edit', ['id' => $phone->siswa_id])->with('success', 'berhasil menghapus no telepon');
    
    }
}
