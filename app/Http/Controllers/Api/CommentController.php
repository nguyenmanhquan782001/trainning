<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->get('email')) {
            $email = $request->get("email");
            $info_user = User::where("email", $email)->first();
            if ($info_user) {
                $comment = Comment::with("getParentId")->where('parent_id', 0)->get();
                return response()->json($comment);
            }
        }
        return response('Chưa đăng nhập');
    }

}
