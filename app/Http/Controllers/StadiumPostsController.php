<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StadiumPost;

class StadiumPostsController extends Controller
{
    public function index() {
        $posts = StadiumPost::all();
        // dd($posts->toArray());
        return view('index')->with('stadium_posts', $posts);
    }
}
