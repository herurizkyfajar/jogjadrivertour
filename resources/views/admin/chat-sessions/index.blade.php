@extends('layouts.dashboard')

@section('title', 'Chat Sessions - Dashboard')

@section('content')
<section class="profile-dashboard">
    <div class="inner-header mb-40">
        <h3 class="title">Chat Sessions</h3>
        <p class="des">Customer chat history from chatbot</p>
    </div>

    @if(session('success'))
        <div style="background:#4DA528;color:#fff;padding:12px 20px;border-radius:8px;margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="wg-box">
        <div class="flex-two mb-30">
            <h5 style="margin:0;">Chat Sessions ({{ App\Models\ChatSession::count() }})</h5>
            <button onclick="bulkDelete()" style="background:#fde8e8;color:#e74c3c;padding:10px 24px;border-radius:8px;border:none;cursor:pointer;font-weight:600;font-size:14px;">Delete Selected</button>
        </div>

        <div style="overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;font-size:14px;">
                <thead>
                    <tr style="border-bottom:2px solid #eee;text-align:left;">
                        <th style="padding:12px 10px;color:#666;"><input type="checkbox" id="select-all" onchange="toggleSelectAll()"></th>
                        <th style="padding:12px 10px;color:#666;">#</th>
                        <th style="padding:12px 10px;color:#666;">Name</th>
                        <th style="padding:12px 10px;color:#666;">Contact</th>
                        <th style="padding:12px 10px;color:#666;">Rating</th>
                        <th style="padding:12px 10px;color:#666;">Messages</th>
                        <th style="padding:12px 10px;color:#666;">IP Address</th>
                        <th style="padding:12px 10px;color:#666;">Date</th>
                        <th style="padding:12px 10px;color:#666;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($chatSessions as $session)
                    <tr style="border-bottom:1px solid #eee;">
                        <td style="padding:12px 10px;"><input type="checkbox" class="session-checkbox" value="{{ $session->id }}"></td>
                        <td style="padding:12px 10px;">{{ $session->id }}</td>
                        <td style="padding:12px 10px;font-weight:600;color:#081E2A;">{{ $session->name }}</td>
                        <td style="padding:12px 10px;color:#666;">{{ $session->contact }}</td>
                        <td style="padding:12px 10px;">
                            @if($session->rating)
                                <span style="color:#f5a623;font-size:16px;">{{ str_repeat('⭐', $session->rating) }}</span>
                            @else
                                <span style="color:#999;">-</span>
                            @endif
                        </td>
                        <td style="padding:12px 10px;color:#666;">{{ $session->chat_history ? count($session->chat_history) : 0 }} msgs</td>
                        <td style="padding:12px 10px;color:#666;font-size:12px;">{{ $session->ip_address ?? '-' }}</td>
                        <td style="padding:12px 10px;color:#666;">{{ $session->created_at->format('d M Y H:i') }}</td>
                        <td style="padding:12px 10px;">
                            <div style="display:flex;gap:6px;">
                                <button onclick="viewChat({{ $session->id }}, '{{ addslashes($session->name) }}')" style="background:#e8f5e9;color:#4DA528;padding:6px 14px;border-radius:6px;border:none;cursor:pointer;font-size:13px;font-weight:600;">View Chat</button>
                                <form action="{{ route('admin.chat-sessions.destroy', $session) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this?')" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background:#fde8e8;color:#e74c3c;padding:6px 14px;border-radius:6px;border:none;cursor:pointer;font-size:13px;font-weight:600;">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" style="padding:40px;text-align:center;color:#999;">No chat sessions found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top:20px;text-align:center;">
            {{ $chatSessions->links() }}
        </div>
    </div>
</section>

<div id="chatModal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:9999;justify-content:center;align-items:center;">
    <div style="background:#fff;border-radius:16px;width:90%;max-width:500px;max-height:80vh;display:flex;flex-direction:column;overflow:hidden;">
        <div style="background:linear-gradient(135deg,#4DA528,#3d8a1f);color:#fff;padding:16px 20px;display:flex;justify-content:space-between;align-items:center;">
            <div>
                <h4 style="margin:0;font-size:16px;" id="chatModalTitle">Chat History</h4>
                <p style="margin:4px 0 0;font-size:12px;opacity:0.9;" id="chatModalSubtitle"></p>
            </div>
            <button onclick="closeChatModal()" style="background:none;border:none;color:#fff;font-size:20px;cursor:pointer;">✕</button>
        </div>
        <div id="chatModalBody" style="flex:1;overflow-y:auto;padding:16px;display:flex;flex-direction:column;gap:10px;"></div>
        <div style="padding:12px 16px;border-top:1px solid #eee;text-align:right;">
            <button onclick="closeChatModal()" style="background:#f5f5f5;color:#333;padding:8px 20px;border-radius:8px;border:none;cursor:pointer;font-size:14px;">Close</button>
        </div>
    </div>
</div>

<script>
var allSessions = @json($chatSessions->keyBy('id'));

function toggleSelectAll() {
    var checked = document.getElementById('select-all').checked;
    document.querySelectorAll('.session-checkbox').forEach(function(cb) {
        cb.checked = checked;
    });
}

function viewChat(id, name) {
    var session = allSessions[id];
    if (!session || !session.chat_history) {
        alert('No chat history available.');
        return;
    }

    document.getElementById('chatModalTitle').textContent = 'Chat with ' + name;
    document.getElementById('chatModalSubtitle').textContent = session.contact + ' | ' + (session.rating ? str_repeat('⭐', session.rating) : 'No rating');

    var body = document.getElementById('chatModalBody');
    body.innerHTML = '';

    session.chat_history.forEach(function(msg) {
        var div = document.createElement('div');
        div.style.cssText = 'max-width:80%;padding:10px 14px;border-radius:12px;font-size:14px;line-height:1.5;word-wrap:break-word;';
        if (msg.type === 'bot') {
            div.style.background = '#f5f5f5';
            div.style.color = '#333';
            div.style.alignSelf = 'flex-start';
            div.style.borderBottomLeftRadius = '4px';
        } else {
            div.style.background = 'linear-gradient(135deg,#4DA528,#3d8a1f)';
            div.style.color = '#fff';
            div.style.alignSelf = 'flex-end';
            div.style.borderBottomRightRadius = '4px';
        }
        var linkedText = msg.text.replace(/(https?:\/\/[^\s]+)/g, '<a href="$1" target="_blank" style="color:' + (msg.type === 'bot' ? '#4DA528' : '#fff') + ';text-decoration:underline;">$1</a>');
        div.innerHTML = linkedText;
        body.appendChild(div);
    });

    body.scrollTop = body.scrollHeight;
    document.getElementById('chatModal').style.display = 'flex';
}

function closeChatModal() {
    document.getElementById('chatModal').style.display = 'none';
}

function str_repeat(str, n) {
    var result = '';
    for (var i = 0; i < n; i++) result += str;
    return result;
}

function bulkDelete() {
    var ids = [];
    document.querySelectorAll('.session-checkbox:checked').forEach(function(cb) {
        ids.push(cb.value);
    });

    if (ids.length === 0) {
        alert('Please select at least one chat session.');
        return;
    }

    if (!confirm('Are you sure you want to delete ' + ids.length + ' chat sessions?')) {
        return;
    }

    fetch('{{ route("admin.chat-sessions.bulkDestroy") }}', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ ids: ids })
    })
    .then(function(response) { return response.json(); })
    .then(function(data) {
        if (data.success) {
            location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    });
}
</script>
@endsection
