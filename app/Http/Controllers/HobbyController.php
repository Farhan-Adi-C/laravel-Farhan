<?php

namespace App\Http\Controllers;

use App\Models\Hobby;
use App\Models\Siswa;
use Illuminate\Http\Request;

class HobbyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function addhobby($id)
    {
        $data = Siswa::find($id);
       
        return view('hobby/addhobby', compact('data', 'id'));
    }

    // public function index($id){
    //     $siswa = Siswa::with('phone', 'nisn')->find($id);
    //     $hobby_siswa = $siswa->hobby;
      
    //     $data = Hobby::all();
    //     return view('hobby/hobby', compact('data', 'id', 'siswa', 'hobby_siswa'));
    // }

    public function index (){
        $data = Siswa::with('hobby')->get();
        return view('/hobby/index', compact('data'));
    }

    public function add (){
        return view('/hobby/add');
    }

    public function show($id){
        $data = Siswa::with('hobby')->where('id', $id)->get();
        
     
        return view('hobby/show', compact('data', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function editHobby($id){
        $data = Hobby::where('id', $id)->get();
        return view('/hobby/edit', compact('data', 'id'));
    }

    public function detail(){

        $data = Hobby::all();


        return view('/hobby/detail', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
   

    public function storeHobby(Request $request)
    {
        $hobby = Hobby::create([
            'hobby' => $request->input('hobby')
        ]);
       
        return redirect()->route('detail.hobby')->with('success', 'berhasil menambahkan opsi hobby');
    }



    public function store (Request $request, $id){
        $siswa = Siswa::find($id);
        $hobby = (array) $request->input('hobby');
        $siswa->hobby()->sync($hobby);
        return redirect()->route('detail', ['id' => $siswa->id])->with('success', 'berhasil menambahkan hobby');
    }


    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     $data = Siswa::with('hobby')->where('id', $id)->get(); 

    //     return view('/hobby/detail', compact('data', 'id'));

    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, $siswa_id)
    {
        $hobby = Hobby::find($id);
        $hobby->hobby = $request->hobby;
        $hobby->save();
        $siswa = Siswa::find($siswa_id);

        return redirect()->route('detail.hobby', ['id' => $siswa->id])->with('success', 'berhasil mengubah opsi hobby');


    }

    public function editHobbySiswa($id){
        $hobby = Hobby::all();
        $siswa = Siswa::find($id);
        $hobby_siswa = $siswa->hobby;

        return view('/hobby/update', compact('hobby', 'siswa', 'hobby_siswa'));
    }

    public function updateHobbySiswa(Request $request, string $id){
        $siswa = Siswa::find($id);
        $hobby = (array) $request->input('hobby');
        $siswa->hobby()->sync($hobby);
        return redirect()->route('show.hobby', ['id' => $siswa->id])->with('success', 'berhasil menambahkan hobby');
    }

    public function updateHobby(Request $request){
        $id = $request->id;
        $hobby = Hobby::find($id);

        $hobby->hobby = $request->hobby;
        $hobby->save();
        return redirect()->route('detail.hobby')->with('success', 'berhasil mengupdate hobby');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hobby = Hobby::where('id', $id)->delete();
        
        return redirect()->route('detail.hobby')->with('success', 'berhasil menghapus data');
    }
}
