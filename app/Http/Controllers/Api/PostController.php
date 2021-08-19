<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStore;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index(Request $request)
    {
        if ($request->get("email")) {
            $email = $request->get("email");
            $info_user = User::where("email", $email)->first();
            if ($info_user) {
                $post = Post::with("getInfoUser")->get();
                return response()->json([
                    "data" => $post
                ], 200);
            }
        }
        return response()->json(['message' => "Chưa đăng nhập"]);
    }

    public function store(PostStore $request)
    {
        if ($request->get("email")) {
            $email = $request->get("email");
            $info_user = User::where("email", $email)->first();
            $user_id = $info_user->id;
            $post = new  Post();
            $post->title = $request->input("title");
            $post->user_id = $user_id;
            $post->content = $request->input("content");
            $post->slug = $request->input("slug");
            $post->save();
            return response()->json([
                'message' => "OK",
                'data' => $post
            ], 201);
        }
        return response()->json(['message' => "Chưa đăng nhập"]);
    }

    public function show(Request $request, $id)
    {
        if ($request->get('email')) {
            $post = Post::find($id);
            return response()->json($post);
        }
        return response("Chưa đăng nhập");
    }

    public function update(PostStore $request, $id)
    {
        if ($request->get("email")) {
            $post = Post::find($id);
            $post->update($request->all());
            return response('ok');
        }
        return response("Chưa đăng nhập");
    }
}
