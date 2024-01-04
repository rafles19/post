<?php

namespace App\Http\Controllers;

use App\Models\Impression;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Slug;
use App\Models\Description;
use App\Models\Title;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::paginate(10);

        
        $comments = [];

        foreach ($posts as $post) {
            // Mengambil hanya kolom 'impression' dari hasil query
            $impressions = Impression::where('post_id', $post->id)->pluck('impression');

            // Menambahkan hasil ke array comments
            $comments[$post->id] = $impressions;
        }

        return view('homepage', compact('posts', 'comments'));
    }

    public function store(Request $request, $postId)
{
    $request->validate([
        'impression' => ['required', 'max:255'],
        // 'description' => ['required'],
        
    ]);

    // Membuat objek Impression dan mengisi nilai-nilainya
    $comment = new Impression();
    $comment->impression = $request->impression;
    $comment->user_id = auth()->user()->id;
    // $comment->title = 'testimonial';
    // $comment->description = $request->description;

    
    // Menyimpan komentar ke post yang sesuai melalui relasi
    // $post = Post::find($postId);
    // $post->impressions()->save($comment);
    
    
    
    // //
    // //slug
    // $slug = new Slug();
    // $slug->slug = Str::slug($request->description);
    // $slug->post_id = $post->id;
    // $slug->save();
    // //$post->author = auth()->name();

    // //description
    // $desc = new Description();
    // $desc->desc_name = $request->description;
    // $desc->post_id = $post->id;
    // $desc->save();

    // //title
    // $title = new Title();
    // $title->title_name = 'testimonial';
    // $title->post_id = $post->id;
    // $title->save();

    return redirect()->back();
}

}
