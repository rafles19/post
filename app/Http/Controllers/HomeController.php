<?php

namespace App\Http\Controllers;

use App\Models\Impression;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::paginate(10);

        // Inisialisasi array untuk menampung komentar
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
        ]);

        $comment = new Impression();
        $comment->impression = $request->impression;
        $comment->user_id = auth()->user()->id;
        $comment->post_id = $postId;
        $comment->save();
        //dd($comment);

        return redirect()->back();
    }
}
