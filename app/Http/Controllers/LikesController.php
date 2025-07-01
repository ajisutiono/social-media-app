<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LikesController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'post_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ]);
        }

        $like = Like::create([
            'user_id' => $request->user_id,
            'post_id' => $request->post_id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'berhasil like',
            'data' => $like
        ], 201);
    }


    public function destroy(int $id)
    {
        Like::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'berhasil unlike'
        ]);
    }
}
