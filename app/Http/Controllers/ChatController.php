<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class ChatController extends Controller
{

    use AuthorizesRequests;


    public function index(): View
    {
        $chats = Chat::with('user')->latest()->get();

        return view('Home', compact('chats'));
    }



    public function store(Request $request): RedirectResponse
    {

        $validated = $request->validate([
            'message' => ['required', 'string', 'max:255'],
        ]);

        $chat = Chat::create(['message' => $validated['message']]);
        $chat->user()->associate($request->user());
        $chat->save();

        return redirect('/')->with('success', 'Message sent successfully.');
    }



    public function edit(Chat $chat): View
    {
        $this->authorize('update', $chat);
        return view('Chats.edit', compact('chat'));
    }



    public function update(Request $request, Chat $chat): RedirectResponse
    {
        $this->authorize('update', $chat);
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:255'],
        ]);

        $chat->update(['message' => $validated['message']]);

        return redirect('/')->with('success', 'Message updated successfully.');
    }



    public function destroy(Chat $chat): RedirectResponse
    {
        $this->authorize('delete', $chat);
        $chat->delete();

        return redirect('/')->with('success', 'Message deleted successfully.');
    }
}
