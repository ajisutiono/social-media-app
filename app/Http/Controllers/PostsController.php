<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::get();

        return response()->json([
            'success' => true,
            'data' => $posts
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());

        // validasi
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'content_post' => 'required|max:255',
            'img_url' => 'nullable'
        ]);


        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $post = Post::create([
            'user_id' => $request->user_id,
            'content_post' => $request->content_post,
            'img_url' => $request->img_url
        ]);

        return response()->json([
            'success' => true,
            'message' => 'success poting',
            'data' => $post
        ], 201);
    }

    public function show($id) 
    {
        $post = Post::find($id);

        return response()->json([
            'success' => true,
            'data' => $post
        ]);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content_post' => 'required|max:255',
            'img_url' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $post = Post::find($id);
        
        $post->content_post = $request->content_post;
        $post->img_url = $request->img_url;

        $post->save();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diupdate',
            'data' => $post
        ], 201);
    }

    public function destroy(int $id)
    {
        Post::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
