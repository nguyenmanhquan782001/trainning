<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $comment = Comment::with(['getParentId'])->where('parent_id', 0)->get();
        $comment->load('info');
        return response()->json([
            'data' => $comment
        ], 200);
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $comment = new  Comment();
            $comment->content = $request->input('content');
            $comment->post_id = $request->input('post_id');
            $comment->user_id = $user->id;
            $comment->parent_id = 0;
            $comment->save();
            return response()->json([
                'content' => $comment
            ], 201);
        }
    }

    public function update(Request $request , Comment $comment)
    {
        $user = auth()->user();
        if ($user) {
           $comment->update($request->all());
           return response()->json(['message' => "Cập nhật ok"], 200);
        }
        return  false ;
    }
    public  function  delete(Comment  $comment){
        if (auth()->user()) {
            $comment->delete();
            return response()->json(['message' => "Xóa ok"], 200);
        }

    }


}
