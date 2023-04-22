<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store()
    {
        $postFormValues = request()->validate([
            'title' => ['required', 'string', 'max:50', Rule::unique('posts', 'title')],
            'body' => 'required|string|max:5000',
        ]);

        $sanitizedBody = preg_replace('/[\r\n]+/', '\n', $postFormValues['body']);
        $paragraphCounter = 0;
        $exerpt = '';
        $fullBody = '';

        foreach(explode('\n', $sanitizedBody) as $paragraph) {
            if($paragraphCounter < 5) {
                $exerpt .= '<p>'.$paragraph.'</p>';
            }

            $fullBody .= '<p>'.$paragraph.'</p>';
            $paragraphCounter ++;
        }


        $postFormValues['body'] = $fullBody;
        $postFormValues['exerpt'] = $exerpt;
        $postFormValues['published_at'] = date('Y-m-d');
        $postFormValues['slug'] = preg_replace('/[^A-Za-z0-9-]+/', '-', $postFormValues['title']);

        Post::create($postFormValues);

        return back()
                ->withInput()
                ->with(['success' => 'Post je uspješno kreiran!']);
    }
}
