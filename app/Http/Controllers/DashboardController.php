<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Hobby;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $totalBlog = Blog::whereNotNull('title')->count();
        $totalUser = User::whereNotNull('id')->count();
        return view('dashboard.index', compact('totalBlog','totalUser'));
    }
}
