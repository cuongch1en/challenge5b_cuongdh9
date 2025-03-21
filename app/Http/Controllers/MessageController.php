<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // Hiển thị form gửi tin nhắn
    public function create()
    {
        $users = User::where('id', '!=', Auth::id())->get(); // Lấy danh sách user (trừ chính mình)
        return view('messages.create', compact('users'));
    }

    // Lưu tin nhắn vào database
    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000',
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        return redirect()->route('messages.inbox')->with('success', 'Tin nhắn đã được gửi!');
    }

    // Xem tin nhắn đã nhận
    public function inbox()
    {
        $messages = Message::where('receiver_id', Auth::id())->latest()->get();
        return view('messages.inbox', compact('messages'));
    }
}

