<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomepageController extends Controller
{
    public function index()
    {
        $posts = Post::all(); // Mengambil semua post
        return view('homepage', compact('posts'));
    }
}
