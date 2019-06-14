<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StadiumPost;
use App\Http\Controllers\Ajax\GameNewsController;

class StadiumPostsController extends Controller
{
    public function index() {
        $posts = StadiumPost::all();
        return view('index')->with('stadium_posts', $posts);
    }

    public function show($id) {
        $gameparse = new GameNewsController();
        $gamepost = $gameparse->baseball();
        // var_dump($gamepost);
        $post[0] = StadiumPost::findOrFail($id);
        $post[1] = $gamepost;

        return view('show')->with('stadium_post', $post);
    }

    public function edit($id) {
        $post = StadiumPost::findOrFail($id);
        return view('edit')->with('stadium_post', $post);
    }

    public function create() {
        return view('create');
    }

    public function update(Request $request, $id) {
        $post = StadiumPost::findOrFail($id);
        $this->validate($request, [
          'latitude' => 'required|numeric',
          'longitude' => 'required|numeric'
        ]);
        $post->stadium = $request->stadium;
        $post->latitude = $request->latitude;
        $post->longitude = $request->longitude;
        $post->league = $request->league;
        $post->address = $request->address;
        $post->country = $request->country;
        $post->save();
        return redirect('/');
    }

    public function store(Request $request) {
        $post = new StadiumPost();
        $this->validate($request, [
            'stadium' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric'
        ]);
        $post->stadium = $request->stadium;
        $post->latitude = $request->latitude;
        $post->longitude = $request->longitude;
        $post->league = $request->league;
        $post->address = $request->address;
        $post->country = $request->country;
        $post->save();
        return redirect('/');
    }

    public function destroy($id) {
        $post = StadiumPost::findOrFail($id);
        $post->delete();
        return redirect('/');
    }
}
