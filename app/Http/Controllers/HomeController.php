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
        $posts = Post::all();

        foreach ($posts as $post) {
            // Mengambil semua kolom post dan hasil komentar (impression) yang sesuai
            $postWithComments = Post::select('id', 'title', 'description', 'category_id', 'image', 'thumbnail_image', 'slug', 'lead', 'user_id', 'author', 'keywords')
                ->with(['impressions' => function ($query) use ($post) {
                    $query->select('user_id', 'impression')->where('post_id', $post->id);
                }])
                ->find($post->id);

            // Mengganti $comments[$post->id] dengan $postWithComments->impressions
            $comments[] = $postWithComments;
        }

        return view('homepage', compact('comments'));
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
