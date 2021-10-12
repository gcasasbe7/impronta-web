<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function addComment(Request $request){
        $product_id = $request->input('product_id');
        $comment = $request->input('comment');
        $user = Auth::user();
        info($product_id);
        Comment::create($request->all() +
            ['user_id' => $user->id] +
            ['user_name' => $user->name] +
            ['user_photo' => $user->photo]
        );

        return "OK";
    }

    public function deleteComment(Request $request){
        $comment_id = $request->input('comment_id');
        $comment = Comment::find($comment_id);
        $comment->delete();
        return "OK";
    }
}
