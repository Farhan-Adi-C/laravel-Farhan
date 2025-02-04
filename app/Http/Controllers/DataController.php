<?php

namespace App\Http\Controllers;

use App\Models\Nisn;
use App\Models\Hobby;
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
        $data = Siswa::with('phone', 'nisn', 'hobby')->get();
        $hobby = Hobby::all();
        return view('/siswa/index', compact('data', 'hobby'));
    }
    
    public function form()
    {
        $hobby = Hobby::all();
        return view('/siswa/post', compact('hobby'));
    }
    

   
    public function detail($id)
    {
        $data = Siswa::with('phone', 'nisn', 'hobby')->where('id', $id)->get();
        $siswa = Siswa::find($id);
        $hobby_siswa = $siswa->hobby;
        $hobby = Hobby::all();

        return view('/siswa/show', compact('data', 'hobby_siswa', 'hobby'));
        
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

        if($request->phone_number){
            $phoneNumber = $request->phone_number;
            foreach ($phoneNumber as $phone){
                if (empty($phone)){
                    continue;
                }
                $siswa->phone()->create([
                    'phone_number' => $phone
                ]);
            }
        }

        $hobby = $request->input('hobby');
        $siswa->hobby()->sync($hobby);

        return redirect()->route('data')->with('success', 'berhasil menambahkan data');
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
        $hobby_siswa = $siswa->hobby;
        $hobby = Hobby::all();

        return view('/siswa/update', compact('siswa', 'hobby_siswa', 'hobby'));
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
        $hobby = (array) $request->input('hobby');
        $siswa->hobby()->sync($hobby);

        return redirect()->route('data')->with('success', 'berhasil melakukan perubahan data');
    }
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Siswa::where('id', $id)->delete();
        return redirect()->route('data')->with('success', 'berhasil menghapus data');
    }


}
