<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::simplePaginate(3);
        return view('pages.index', compact('posts'));
    }
}
