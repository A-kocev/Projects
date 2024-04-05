<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'country' => 'required|string',
            'rate' => 'required|integer|min:1|max:5', 
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::id(); 
        $comment->content = $request->content;
        $comment->country = $request->country;
        $comment->rate = $request->rate;
        $comment->save();

        return redirect()->back()->with('success', 'Comment added successfully.');
    }
}
