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
        $adminUserId = 1;

        $posts = Post::with('impressions')
            ->where('user_id', $adminUserId)
            ->get();



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
            'description' => ['required'],

        ]);

        // Membuat objek Impression dan mengisi nilai-nilainya
        $comment = new Impression();
        $comment->impression = $request->impression;
        $comment->user_id = auth()->user()->id;
        // $comment->title = 'testimonial';

        $user = auth()->user();

        // Menyimpan komentar ke post yang sesuai melalui relasi
        $post = Post::find($postId);
        $post->impressions()->save($comment);
        $post = new Post();
        $post->title = 'testimoni';
        $post->description = $request->description;
        $post->impression = $request->impression;
        // $post->category_id = $request->category_id;
        //$post->thumbnail_image = $filePathThumbnail;
        $post->slug = Str::slug('testimoni '. $request->description);
        //$post->slug()->associate($slug);
        // $post->lead = Str::before($request->description, ' ');
        $post->user_id = $user->id;
        $post->author = $user->name;
        $post->published_at = now();
        // $post->keywords = $request->keywords;
        //$post->published_date = $post->created_at;
        $post->save();
        //$post->author = auth()->name();

        //description
        $desc = new Description();
        $desc->desc_name = $request->description;
        $desc->post_id = $post->id;
        $desc->save();

        //title
        $title = new Title();
        $title->title_name = 'testimoni';
        $title->post_id = $post->id;
        $title->save();

        //slug
        $slug = new Slug();
        $slug->slug = Str::slug('testimoni ' . $request->impression); // Menambahkan spasi setelah kata 'testimoni'
        $slug->post_id = $post->id;
        $slug->save();

        return redirect()->back();
    }
}