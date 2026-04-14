<?php

namespace App\Http\Controllers;
 
use App\Models\Bug;
use App\Models\Comment;
use Illuminate\Http\Request;
 
class CommentController extends Controller
{
    public function store(Request $request, Bug $bug)
    {
        $request->validate([
            'content' => 'required|string|min:3|max:2000',
        ]);
 
        $bug->comments()->create([
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);
 
        return back()->with('success', 'Comment added.');
    }
 
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();
 
        return back()->with('success', 'Comment deleted.');
    }
}
 