<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class GuestController extends Controller
{
    //
    public function index()
    {
        $adminUserId = 1;

        $posts = Post::with('impressions')
            ->where('user_id', $adminUserId)
            ->get();

        return view('homepage', compact('posts'));
    }
}
