<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Comment;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $user = auth()->user();
        $data = $request->all();
        $this->validate($request, Comment::$rules);


        $comment = new Comment;
        $comment->commentStore($user->id, $data);
        
        return back();
    }
}
