<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageCrudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::paginate(20);
        return view('admin.messages.index', compact('messages'));
    }


    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        return view('admin.messages.show', compact('message'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        $message->deleteOrFail();

        return redirect()->route('admin.messages')->with('success', 'Message deleted successfully.');
    }
}
