<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function tampilRegistrasi(){
        return view('registrasi');
    }

    function submitRegistrasi(Request $request){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->route('login')->with('success', 'berhasil registrasi akun. silahkan login untuk masuk ke halaman utama');
    }

    function tampilLogin (){
        return view('login');
    }

    function submitLogin (Request $request){
        $data = $request->only('email', 'password');

        if (Auth::attempt($data)){
            $request->session()->regenerate();
            return redirect()->route('data');
        }else{
            return redirect()->back()->with('gagal', 'email atau password anda salah');
        }
    }

    function logout(){
        Auth::logout();

        return redirect()->route('login');
    }
}
