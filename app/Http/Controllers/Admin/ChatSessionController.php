<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatSession;
use Illuminate\Http\Request;

class ChatSessionController extends Controller
{
    public function index()
    {
        $chatSessions = ChatSession::latest()->paginate(15);
        return view('admin.chat-sessions.index', compact('chatSessions'));
    }

    public function destroy(ChatSession $chatSession)
    {
        $chatSession->delete();
        return redirect()->route('admin.chat-sessions.index')->with('success', 'Chat session deleted successfully.');
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids', []);
        if (!empty($ids)) {
            ChatSession::whereIn('id', $ids)->delete();
            return response()->json(['success' => true, 'message' => count($ids) . ' chat sessions deleted.']);
        }
        return response()->json(['success' => false, 'message' => 'No chat sessions selected.'], 400);
    }
}
