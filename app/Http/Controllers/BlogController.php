<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Blog::with('image')->get();
        return view('blog.index', compact('data'));
    }

    public function blog()
    {
        $data = Blog::with('image')->get();
        return view('blog.blog', compact('data'));
    }

    public function write()
    {
        return view('blog.store');
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
            'title' => 'required|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:9048',
            'image' => 'nullable|array',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:9048',
        ]);

        $slug = Str::slug($request->input('title'));

        if ($request->hasFile('featured_image')) {
            $featuredImagePath = $request->file('featured_image')->store('blog_images', 'public');
        }

        $blog = new Blog();
        $blog->user_id = $request->user_id;
        $blog->writer = $request->name;
        $blog->title = $request->input('title');
        $blog->slug = $slug;
        $blog->content = $request->input('content');
        $blog->featured_image = $featuredImagePath ?? null;
        $blog->save();

        if ($request->has('image')) {
            foreach ($request->file('image') as $image) {
                if (empty($image)) {
                    continue;
                }
                $imagePath = $image->store('blog_images', 'public');
                $blog->image()->create([
                    'image' => $imagePath,
                ]);
            }
        }

        return redirect()->route('table.blog')->with('success', 'Blog berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        // Cari blog berdasarkan slug
        $data = Blog::with('image')->where('slug', $slug)->firstOrFail();
        return view('blog.show_blog', compact('data'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Blog::with('image')->where('id', $id)->get();
        return view('blog.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    // Pada method update
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:9048',
            'image' => 'nullable|array',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:9048',
        ]);

        $blog = Blog::findOrFail($id);

        // Update slug jika judul berubah
        $blog->slug = Str::slug($request->input('title'));

        if ($request->hasFile('featured_image')) {
            if ($blog->featured_image) {
                Storage::disk('public')->delete($blog->featured_image);
            }

            $featuredImagePath = $request->file('featured_image')->store('blog_images', 'public');
            $blog->featured_image = $featuredImagePath;
        }

        $blog->title = $request->input('title');
        $blog->content = $request->input('content');
        $blog->save();

        if ($request->has('image')) {
            foreach ($request->file('image') as $image) {
                if (empty($image)) {
                    continue;
                }

                $imagePath = $image->store('blog_images', 'public');
                $blog->image()->create([
                    'image' => $imagePath,
                ]);
            }
        }

        return redirect()->route('table.blog')->with('success', 'Blog berhasil diperbarui!');
    }



    /**
     * Remove the specified resource from storage.
     */
    //     public function hapusImage(string $id)
    // {
    //     // dd($id);
    //     $image = Image::find($id);

    //     if (!$image) {
    //         return redirect()->back()->with('success', 'Image not found');
    //     }

    //     Storage::delete('public/' . $image->image); 
    //     $image->delete();

    //     return redirect()->back()->with('success', 'Gambar berhasil dihapus');
    // }

}
