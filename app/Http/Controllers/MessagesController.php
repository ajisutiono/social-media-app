<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessagesController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sender_id' => 'required',
            'receiver_id' => 'required',
            'content_message' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ]);
        }

        $message = Message::create([
            'sender_id' => $request->sender_id,
            'receiver_id' => $request->receiver_id,
            'content_message' => $request->content_message
        ]);

        return response()->json([
            'success' => true,
            'message' => 'pesan berhasil dikirim',
            'data' => $message
        ], 201);
    }

    public function getMessage(int $id)
    {
        $message = Message::find($id);

        return response()->json([
            'success' => true,
            'message' => 'satu pesan berhasil diambil',
            'data' => $message
        ]);
    }

    public function getAllMessages(int $user_id)
    {
        $messages = Message::where('receiver_id', $user_id)->get();

        return response()->json([
            'success' => true,
            'message' => 'pesan berhasil diambil berdasarkan penerima pesan',
            'data' => $messages
        ]);
    }

    public function destroy(int $id) 
    {
        Message::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'pesan berhasil dihapus'
        ]);
    }
}
