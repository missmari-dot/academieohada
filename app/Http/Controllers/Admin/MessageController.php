<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::whereNull('commande_id')->latest()->paginate(20);
        return view('admin.messages.index', compact('messages'));
    }

    public function show(Message $message)
    {
        $message->update(['lu' => true]);
        return view('admin.messages.show', compact('message'));
    }

    public function marquerLu(Message $message)
    {
        $message->update(['lu' => true]);
        return back()->with('success', 'Message marqué comme lu.');
    }
}
