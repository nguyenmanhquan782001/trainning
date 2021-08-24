<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\PostException;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostStore;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\callback;


class PostController extends Controller
{
    public function index(Post $post)
    {
        $user = auth()->user();
        if ($user) {
            $posts = $post->all();
            return response()->json(['data' => $posts], 200);
        }

    }

    public function store(PostStore $request)
    {
        try {
            $user = auth()->user();
            if ($user) {
                $post = new  Post();
                $post->title = $request->input('title');
                $post->content = $request->input('content');
                $post->user_id = $user->id;
                $post->slug = $request->input('slug');
                $post->save();
                return response()->json(['data' => $post], 200);
            }
        }catch (\Exception $exception){
            dd($exception);
        }

    }

    public function show(Post $post)
    {
        return $post;
    }
    public function update(PostStore $request, $id)
    {
        $user = auth()->user();
        if ($user) {
            $post = Post::find($id);
            $post->update($request->all());
            return response()->json([
                'messageSuccess' => "Cập nhật thành công",
            ]);
        }
    }
    public function delete($id)
    {
        $post = Post::find($id);
        $user = \auth()->user();
        if ($user) {
            if ($post) {
                $post->delete();
                return response()->json(['messageSuccess' => "Xóa bài viết này thành công"], 200);
            }
            return response()->json(['messageError' => "Không tìm thấy bài viết nào như này"], 422);
        }
        return response()->json(['messageError' => "Chưa đăng nhập"], 400);
    }
}
