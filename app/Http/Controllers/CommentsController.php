<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;


class CommentsController extends Controller
{
    //
    public function index() {
        return \App\Comment::all();
    }

    public function store(Request $request, $id) {
        $comment = new Comment();

        $this->validate($request, [
          'body' => 'required|max:100'
        ]);

        $comment->comment_id = $id;
        $comment->body = $request->body;
        $comment->save();

        return redirect('/stadium/'.$id.'/comment');
      }
}
