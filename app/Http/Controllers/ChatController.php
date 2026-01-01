<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $contacts = [];

        if ($user->role === 'student') {
            // Student sees doctors
            $contacts = User::where('role', 'doctor')->get();
        } elseif ($user->role === 'doctor') {
            // Doctor sees students
            $contacts = User::where('role', 'student')->get();
        }

        return view('chat.index', compact('contacts'));
    }

    public function show($id)
    {
        $user = Auth::user();
        $otherUser = User::findOrFail($id);

        $messages = Message::where(function($q) use ($user, $id) {
            $q->where('sender_id', $user->id)->where('receiver_id', $id);
        })->orWhere(function($q) use ($user, $id) {
            $q->where('sender_id', $id)->where('receiver_id', $user->id);
        })->orderBy('created_at', 'asc')->get();

        // Mark as read
        Message::where('receiver_id', $user->id)->where('sender_id', $id)->whereNull('read_at')->update(['read_at' => now()]);

        return view('chat.show', compact('messages', 'otherUser'));
    }

    public function store(Request $request, $id)
    {
        $request->validate(['content' => 'required']);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $id,
            'content' => $request->content,
        ]);

        return back();
    }
}
