<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * 显示第一篇文章
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $post = Post::first();
        $collections = $post->getComments();
        $collections['root'] = $collections[''];
        unset($collections['']);
        return $collections;
        return view('welcome', compact('post','collections'));
    }
}
