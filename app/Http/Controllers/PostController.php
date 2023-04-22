<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('home', [
            'posts' => Post::latest()
                    ->orderBy('published_at', 'desc')
                    ->paginate(10)
        ]);
    }

    public function details(Post $post)
    {
        return view('posts.details', [
            'post' => $post
        ]);
    }
}
