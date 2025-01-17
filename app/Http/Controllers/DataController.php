<?php

namespace App\Http\Controllers;

use App\Models\Nisn;
use App\Models\Phone;
use App\Models\Siswa;
use Illuminate\Http\Request;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() 
    {

        $data = Siswa::with('phone', 'nisn')->get();
        return view('data', compact('data'));
    }
    
    public function index2()
    {
        return view('form');
    }
    
    public function index3($id)
    {
        $data = Siswa::with('phone')->get();
        return view('phone', compact('id'));
    }
   
    public function index4($id)
    {
        $data = Siswa::with('phone', 'nisn')->where('id', $id)->get();
        return view('detail', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        $nisn = Nisn::create([
            'nisn' => $request->input('nisn')
        ]);

        $siswa = Siswa::create([
            'nama' => $request->input('nama'),
            'nisn_id' => $nisn->id
        ]);


        Phone::create([
            'siswa_id' => $siswa->id,
            'phone_number' => $request->input('phone_number')
        ]);


        return redirect()->route('data')->with('success', 'berhasil menambahkan data');
    }
    


    public function store_phone(Request $request, $id)
    {

        $request->validate([
            'phone_number' => 'required'
        ]);

        $siswa = Siswa::find($id);

        Phone::create([
            'siswa_id' => $siswa->id,
            'phone_number' => $request->input('phone_number')
        ]);

        return redirect()->route('detail', ['id' => $siswa->id])->with('success', 'berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $siswa = Siswa::find($id);

        return view('dataedit', compact('siswa'));
    }
   
    public function edit2(string $id)
    {
        $phone = Phone::find($id);
        return view('editphone', compact('phone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $siswa = Siswa::find($id);

        $siswa->nama = $request->input('nama');
           
        $siswa->nisn->nisn = $request->input('nisn');
        // Nisn::create(['nisn' => $request->input('nisn'), 'siswa_id' => $siswa->id]);
        Nisn::where('id', $siswa->nisn_id)->update(['nisn' => $request->input('nisn')]);
        $siswa->save();

        return redirect()->route('data')->with('success', 'berhasil melakukan perubahan data');
    }
    
    public function update2(Request $request, string $id)
    {
        $request->validate([
            'phone_number' => 'required'
        ]);

        $phone = Phone::find($id);
        
        $phone->phone_number = $request->input('phone_number');
        $phone->save();

        return redirect()->route('detail', ['id' => $phone->siswa_id])->with('success', 'berhasil mengubah No.Telpon');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Siswa::where('id', $id)->delete();
        return redirect()->route('data')->with('success', 'berhasil menghapus data');
    }


    public function destroy2(string $id)
    {
        $phone = Phone::find($id);
        Phone::where('id', $id)->delete();
        return redirect()->route('detail', ['id' => $phone->siswa_id])->with('success', 'berhasil menghapus no telepon');
    }
}
