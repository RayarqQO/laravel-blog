<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class AdminCommentsController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return view('admin.comments.index', compact('comments'));
    }

    public function toggle($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->toggleCommentStatus();

        return redirect()->back();
    }

    public function destroy($id)
    {
        Comment::findOrFail($id)->remove();
        return redirect()->back();
    }
}
