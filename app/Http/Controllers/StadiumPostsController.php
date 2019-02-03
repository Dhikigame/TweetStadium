<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StadiumPost;

class StadiumPostsController extends Controller
{
    public function index() {
        $posts = StadiumPost::all();
        return view('index')->with('stadium_posts', $posts);
    }

    public function show($id) {
        $post = StadiumPost::findOrFail($id);
        return view('show')->with('stadium_post', $post);
    }
}
