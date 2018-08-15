<?php

namespace App\Http\Controllers;

use App\Comment;
use Pusher\Laravel\Facades\Pusher;

class HomeController extends Controller
{
    public function home()
    {
        $comments = Comment::orderBy('id desc')->get();
        return view('home', ['comments' => $comments]);
    }

    public function addComment()
    {
        $data = request()->post();
        Comment::moderate($data['text']);
        $comment = Comment::create($data);
        Pusher::trigger('comments', 'new-comment', $comment, request()->header('X-Socket-Id'));
        return $comment;
    }
}
