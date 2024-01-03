<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Slug;
use App\Models\Description;
use App\Models\Title;
use App\Models\Impression;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->check()) {
            $posts = Post::all();
            return view('homepage', compact('posts'));
        } else {
            $posts = Post::where('user_id', auth()->id())->get();
            return view('index', compact('posts'));
        }
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keywords');

        // Cari postingan dengan kata kunci
        $posts = Post::where('keywords', 'like', "%$keyword%")->get();
        //dd($posts);

        // Arahkan kembali ke halaman utama
        if (!auth()->check()) {
            return view('homepage', compact('posts'));
        } else {
            return view('index', compact('posts'));
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'max:2078', 'image'],
            'title' => ['required', 'max:255'],
            'category_id' => ['required', 'integer'],
            'description' => ['required'],
            'keywords' => ['required']
        ]);

        $filename = time() . '_' . $request->image->getClientOriginalName();
        $filePath = $request->image->storeAs('uploads', $filename);
        

        $user = auth()->user();
        

        // admin input data -> masukdatabase post -> panggil database anak2nya -> masukkan datanya


        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->category_id = $request->category_id;
        $post->image = $filePath;
        // $post->thumbnail_image = $filePathThumbnail;
        //$post->thumbnail_image = $filePathThumbnail;
        $post->slug = Str::slug($request->title);
        //$post->slug()->associate($slug);
        $post->lead = Str::before($request->description, ' ');
        $post->user_id = $user->id;
        $post->author = $user->name;
        $post->keywords = $request->keywords;
        //$post->published_date = $post->created_at;
        $post->save();

        //slug
        $slug = new Slug();
        $slug->slug = Str::slug($request->title);
        $slug->post_id = $post->id;
        $slug->save();
        //$post->author = auth()->name();

        //description
        $desc = new Description();
        $desc->desc_name = $request->description;
        $desc->post_id = $post->id;
        $desc->save();

        //title
        $title = new Title();
        $title->title_name = $request->title;
        $title->post_id = $post->id;
        $title->save();

        //impressions
        // $impressions = new Impression();
        // $impressions->impression;

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
{
    // $post = Post::findOrFail($id);
    // $impressions = Impression::where('post_id', $id)->get();

    // return view('show', compact('post', 'impressions'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);

        $categories =  Category::all();
        return view('edit', compact('post', 'categories'));
        //test commit
        //test commit 2
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
            'category_id' => ['required', 'integer'],
            'description' => ['required'],
            'keywords' => ['required']
        ]);

        // Ambil slug dan post berdasarkan ID
        $slug = Slug::findOrFail($id);
        $post = Post::findOrFail($id);

        //dd($post->image);

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => ['required', 'max:2028', 'image'],
            ]);

            // Hapus gambar lama jika ada
            if ($post->image) {
                Storage::delete($post->image);
                //dd($post->image);
            }

            $filename = time() . '_' . $request->image->getClientOriginalName();
            $filePath = $request->image->storeAs('uploads', $filename);
            // $filePathThumbnail = $request->image->resize(150, 150)->storeAs('thumbnail', $filename);
            

            $post->image = $filePath;
            // $post->thumbnail_image = $filePathThumbnail;
        }

        $post->title = $request->title;
        $post->description = $request->description;
        $post->category_id = $request->category_id;
        $post->slug = Str::slug($request->title);
        $post->lead = Str::before($request->description, ' ');
        $post->keywords = $request->keywords;
        $post->author = auth()->user()->name;
        $post->save();

        // Update slug jika title berubah
        if ($slug->slug !== Str::slug($request->title)) {
            $slug->slug = Str::slug($request->title);
            $slug->save();
        }

        return redirect()->route('posts.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        // Hapus file gambar 
        Storage::delete([
            $post->image,
        ]);
    

        $post->delete();
        //dd($post);

        return redirect()->route('posts.index');
    }
}