<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class postController extends Controller
{

    // protected function getPosts()
    // {


    //     $posts = Post::latest();

    //     if (request('search')) {
    //         $posts = $posts
    //             ->where('title', 'like', '%' . request('search') . '%')
    //             ->orWhere('body', 'like', '%' . request('search') . '%');
    //     }

    //     return $posts->get();
    // }

    public function index()
    {
        return view('posts.index', [
            // 'posts' => Post::latest()->with('category', 'author')->get()
            //we remove the with methode to make it eager loaded 
            'posts' => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(6)->withQueryString(),
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post,
        ]);
    }
}
