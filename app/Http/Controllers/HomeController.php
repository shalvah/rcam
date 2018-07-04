<?php

namespace App\Http\Controllers;

use App\Comment;

class HomeController extends Controller
{
    public function home()
    {
        $comments = Comment::all();
        return view('home', ['comments' => $comments]);
    }

}
