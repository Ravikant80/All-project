<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{

public function create()
{
    return view('post');
}

public function store(Request $request)
{
     $post = new Post;
     $post->title = $request->get('title');
     $post->body = $request->get('body');

     $post->save();

     return response($post);
}


}
