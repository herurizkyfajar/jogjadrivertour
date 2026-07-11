<style>
.chatbot-widget {
    position: fixed;
    bottom: 90px;
    right: 24px;
    z-index: 9999;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

.chatbot-toggle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #4DA528 0%, #2d7a0f 100%);
    color: #fff;
    border: none;
    cursor: pointer;
    box-shadow: 0 4px 20px rgba(77, 165, 40, 0.4);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    padding: 0;
    position: relative;
}

.chatbot-toggle::before {
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: linear-gradient(135deg, #4DA528 0%, #2d7a0f 100%);
    animation: pulse-ring 2s ease-out infinite;
    z-index: -1;
}

@keyframes pulse-ring {
    0% { transform: scale(1); opacity: 0.6; }
    100% { transform: scale(1.4); opacity: 0; }
}

.chatbot-toggle:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 28px rgba(77, 165, 40, 0.5);
}

.chatbot-toggle svg {
    width: 28px;
    height: 28px;
    fill: #fff;
}

.chatbot-box {
    position: absolute;
    bottom: 72px;
    right: 0;
    width: 380px;
    height: 520px;
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 12px 48px rgba(0,0,0,0.15), 0 0 0 1px rgba(0,0,0,0.05);
    display: none;
    flex-direction: column;
    overflow: hidden;
    animation: slideUp 0.3s ease-out;
}

@keyframes slideUp {
    from { opacity: 0; transform: translateY(20px) scale(0.95); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}

.chatbot-box.active {
    display: flex;
}

.chatbot-header {
    background: linear-gradient(135deg, #4DA528 0%, #2d7a0f 100%);
    color: #fff;
    padding: 18px 20px;
    display: flex;
    align-items: center;
    gap: 12px;
    position: relative;
    overflow: hidden;
}

.chatbot-header::after {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 120px;
    height: 120px;
    background: rgba(255,255,255,0.08);
    border-radius: 50%;
}

.chatbot-header-avatar {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, rgba(255,255,255,0.3) 0%, rgba(255,255,255,0.1) 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    backdrop-filter: blur(8px);
    border: 2px solid rgba(255,255,255,0.4);
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.chatbot-header-info {
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.chatbot-header-info h4 {
    margin: 0;
    font-size: 18px;
    font-weight: 700;
    letter-spacing: 0.5px;
    color: #fff;
    text-shadow: 0 1px 3px rgba(0,0,0,0.15);
}

.chatbot-header-info p {
    margin: 4px 0 0;
    font-size: 12px;
    opacity: 0.9;
    font-weight: 400;
    letter-spacing: 0.2px;
}

.chatbot-close {
    margin-left: auto;
    background: rgba(255,255,255,0.15);
    border: none;
    color: #fff;
    font-size: 18px;
    cursor: pointer;
    padding: 6px;
    border-radius: 8px;
    transition: all 0.2s;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.chatbot-close:hover {
    background: rgba(255,255,255,0.25);
}

.chatbot-messages {
    flex: 1;
    overflow-y: auto;
    padding: 20px 16px;
    display: flex;
    flex-direction: column;
    gap: 12px;
    background: #f8faf8;
    scrollbar-width: thin;
    scrollbar-color: #ddd transparent;
}

.chatbot-messages::-webkit-scrollbar {
    width: 5px;
}

.chatbot-messages::-webkit-scrollbar-thumb {
    background: #ddd;
    border-radius: 10px;
}

.chatbot-message {
    max-width: 82%;
    padding: 12px 16px;
    border-radius: 18px;
    font-size: 14px;
    line-height: 1.55;
    animation: fadeIn 0.3s ease;
    word-wrap: break-word;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(8px); }
    to { opacity: 1; transform: translateY(0); }
}

.chatbot-message.bot {
    background: #fff;
    color: #1a1a1a;
    align-self: flex-start;
    border-bottom-left-radius: 6px;
    box-shadow: 0 1px 4px rgba(0,0,0,0.06);
}

.chatbot-message.bot a {
    color: #4DA528;
    text-decoration: none;
    word-break: break-all;
    font-weight: 500;
    border-bottom: 1px solid rgba(77, 165, 40, 0.3);
    transition: all 0.2s;
}

.chatbot-message.bot a:hover {
    color: #2d7a0f;
    border-bottom-color: #2d7a0f;
}

.chatbot-message.user {
    background: linear-gradient(135deg, #4DA528 0%, #2d7a0f 100%);
    color: #fff;
    align-self: flex-end;
    border-bottom-right-radius: 6px;
    box-shadow: 0 2px 8px rgba(77, 165, 40, 0.25);
}

.chatbot-typing {
    align-self: flex-start;
    padding: 14px 18px;
    background: #fff;
    border-radius: 18px;
    border-bottom-left-radius: 6px;
    box-shadow: 0 1px 4px rgba(0,0,0,0.06);
    display: flex;
    align-items: center;
    gap: 4px;
}

.chatbot-typing span {
    display: inline-block;
    width: 7px;
    height: 7px;
    background: #4DA528;
    border-radius: 50%;
    animation: typing 1.4s infinite ease-in-out;
}

.chatbot-typing span:nth-child(2) { animation-delay: 0.2s; }
.chatbot-typing span:nth-child(3) { animation-delay: 0.4s; }

@keyframes typing {
    0%, 60%, 100% { transform: translateY(0); opacity: 0.4; }
    30% { transform: translateY(-6px); opacity: 1; }
}

.chatbot-suggestions {
    padding: 10px 16px;
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    background: #f8faf8;
    border-top: 1px solid #f0f0f0;
}

.chatbot-suggestion {
    background: #fff;
    border: 1.5px solid #e0e0e0;
    border-radius: 20px;
    padding: 7px 14px;
    font-size: 12.5px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    color: #444;
}

.chatbot-suggestion:hover {
    background: #f0f9f0;
    border-color: #4DA528;
    color: #4DA528;
    transform: translateY(-1px);
}

.chatbot-suggestion[style*="background:#4DA528"]:hover {
    background: #2d7a0f !important;
    border-color: #2d7a0f !important;
    color: #fff !important;
}

.chatbot-input {
    display: flex;
    padding: 14px 16px;
    gap: 10px;
    background: #fff;
    border-top: 1px solid #f0f0f0;
    align-items: center;
}

.chatbot-input input {
    flex: 1;
    border: 1.5px solid #e8e8e8;
    border-radius: 24px;
    padding: 12px 18px;
    font-size: 14px;
    outline: none;
    transition: all 0.2s;
    background: #fafafa;
    font-family: inherit;
}

.chatbot-input input::placeholder {
    color: #aaa;
}

.chatbot-input input:focus {
    border-color: #4DA528;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(77, 165, 40, 0.1);
}

.chatbot-input .chatbot-send-btn {
    width: 46px !important;
    height: 46px !important;
    min-width: 46px !important;
    max-width: 46px !important;
    border-radius: 50% !important;
    background: linear-gradient(135deg, #4DA528 0%, #2d7a0f 100%) !important;
    color: #fff !important;
    border: none !important;
    cursor: pointer !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    transition: all 0.25s ease !important;
    box-shadow: 0 4px 14px rgba(77, 165, 40, 0.4) !important;
    padding: 0 !important;
    flex-shrink: 0 !important;
    overflow: hidden !important;
    font-size: 20px !important;
    line-height: 1 !important;
    text-align: center !important;
    -webkit-appearance: none !important;
    -moz-appearance: none !important;
    appearance: none !important;
    float: none !important;
    margin: 0 !important;
}

.chatbot-input .chatbot-send-btn:hover {
    transform: scale(1.1) !important;
    box-shadow: 0 6px 20px rgba(77, 165, 40, 0.5) !important;
}

.chatbot-input .chatbot-send-btn:active {
    transform: scale(0.92) !important;
}

.chatbot-input .chatbot-send-btn svg {
    width: 20px !important;
    height: 20px !important;
    fill: #fff !important;
    flex-shrink: 0 !important;
    pointer-events: none !important;
}
</style>

<div class="chatbot-widget">
    <div class="chatbot-box" id="chatbot-box">
        <div class="chatbot-header">
            <div class="chatbot-header-avatar">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="#fff"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
            </div>
            <div class="chatbot-header-info">
                <h4>Qeila</h4>
                <p>Ask me anything about our tours</p>
            </div>
            <button class="chatbot-close" onclick="toggleChatbot()">✕</button>
        </div>
        <div class="chatbot-messages" id="chatbot-messages"></div>
        <div class="chatbot-suggestions" id="chatbot-suggestions"></div>
        <div class="chatbot-input">
            <input type="text" id="chatbot-input" placeholder="Type your message..." onkeypress="if(event.key==='Enter')sendMessage()">
            <button class="chatbot-send-btn" onclick="sendMessage()" type="button" style="width:46px;height:46px;min-width:46px;max-width:46px;border-radius:50%;background:linear-gradient(135deg,#4DA528,#2d7a0f);color:#fff;border:none;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;box-shadow:0 4px 14px rgba(77,165,40,0.4);padding:0;flex-shrink:0;overflow:hidden;font-size:20px;line-height:1;text-align:center;-webkit-appearance:none;-moz-appearance:none;appearance:none;float:none;margin:0;">&#10148;</button>
        </div>
    </div>
    <button class="chatbot-toggle" onclick="toggleChatbot()" id="chatbot-toggle">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H6l-2 2V4h16v12z"/></svg>
    </button>
</div>

<script>
(function() {
    var STORAGE_KEY = 'joga_chatbot';
    var chatStep = 'greeting';
    var sessionData = {};
    var chatHistory = [];

    function loadState() {
        try {
            var saved = localStorage.getItem(STORAGE_KEY);
            if (saved) {
                var parsed = JSON.parse(saved);
                chatStep = parsed.chatStep || 'greeting';
                sessionData = parsed.sessionData || {};
                chatHistory = parsed.chatHistory || [];
            }
        } catch(e) {}
    }

    function saveState() {
        try {
            localStorage.setItem(STORAGE_KEY, JSON.stringify({
                chatStep: chatStep,
                sessionData: sessionData,
                chatHistory: chatHistory
            }));
        } catch(e) {}
    }

    function renderHistory() {
        var messagesDiv = document.getElementById('chatbot-messages');
        messagesDiv.innerHTML = '';
        chatHistory.forEach(function(msg) {
            if (msg.type === 'bot') {
                var linkedText = msg.text.replace(/(https?:\/\/[^\s]+)/g, '<a href="$1" target="_blank" style="color:#4DA528;text-decoration:underline;">$1</a>');
                messagesDiv.innerHTML += '<div class="chatbot-message bot">' + linkedText + '</div>';
            } else {
                messagesDiv.innerHTML += '<div class="chatbot-message user">' + escapeHtml(msg.text) + '</div>';
            }
        });
        messagesDiv.scrollTop = messagesDiv.scrollHeight;

        var suggestionsDiv = document.getElementById('chatbot-suggestions');
        suggestionsDiv.innerHTML = '';
        suggestionsDiv.style.display = 'none';

        if (chatStep === 'ask_rating') {
            showRatingButtons();
        } else if (chatStep === 'chat') {
            showChatSuggestions();
        }
    }

    loadState();

    window.toggleChatbot = function() {
        var box = document.getElementById('chatbot-box');
        var toggle = document.getElementById('chatbot-toggle');
        box.classList.toggle('active');
        toggle.style.display = box.classList.contains('active') ? 'none' : 'flex';

        if (box.classList.contains('active') && chatHistory.length === 0) {
            showTyping();
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '{{ route("chatbot.chat") }}', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            xhr.setRequestHeader('Accept', 'application/json');
            xhr.timeout = 10000;
            xhr.onload = function() {
                hideTyping();
                if (xhr.status === 200) {
                    try {
                        var data = JSON.parse(xhr.responseText);
                        chatStep = data.next_step || 'ask_name';
                        sessionData = data.session_data || {};
                        var replies = data.replies || ['Hello! Welcome to Joga Driver Tour 👋', 'Before we start, may I know your name?'];
                        showBotReplies(replies, false, false);
                    } catch(e) {
                        addBotMsg('Hello! Welcome to Joga Driver Tour 👋<br><br>Before we start, may I know your name?');
                        chatStep = 'ask_name';
                    }
                } else {
                    addBotMsg('Hello! Welcome to Joga Driver Tour 👋<br><br>Before we start, may I know your name?');
                    chatStep = 'ask_name';
                }
            };
            xhr.onerror = function() {
                hideTyping();
                addBotMsg('Hello! Welcome to Joga Driver Tour 👋<br><br>Before we start, may I know your name?');
                chatStep = 'ask_name';
            };
            xhr.ontimeout = function() {
                hideTyping();
                addBotMsg('Hello! Welcome to Joga Driver Tour 👋<br><br>Before we start, may I know your name?');
                chatStep = 'ask_name';
            };
            xhr.send(JSON.stringify({ message: '', step: 'greeting', session_data: {} }));
        }
    };

    window.sendSuggestion = function(text) {
        document.getElementById('chatbot-input').value = text;
        sendMessage();
    };

    window.sendRating = function(rating) {
        document.getElementById('chatbot-input').value = rating;
        sendMessage();
    };

    function addBotMsg(text) {
        var messagesDiv = document.getElementById('chatbot-messages');
        var linkedText = text.replace(/(https?:\/\/[^\s]+)/g, '<a href="$1" target="_blank" style="color:#4DA528;text-decoration:underline;">$1</a>');
        messagesDiv.innerHTML += '<div class="chatbot-message bot">' + linkedText + '</div>';
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
        chatHistory.push({ type: 'bot', text: text });
        saveState();
    }

    function addUserMsg(text) {
        var messagesDiv = document.getElementById('chatbot-messages');
        messagesDiv.innerHTML += '<div class="chatbot-message user">' + escapeHtml(text) + '</div>';
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
        chatHistory.push({ type: 'user', text: text });
        saveState();
    }

    function showTyping() {
        var messagesDiv = document.getElementById('chatbot-messages');
        messagesDiv.innerHTML += '<div class="chatbot-typing" id="chatbot-typing"><span></span><span></span><span></span></div>';
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
    }

    function hideTyping() {
        var typing = document.getElementById('chatbot-typing');
        if (typing) typing.remove();
    }

    function showRatingButtons() {
        var suggestionsDiv = document.getElementById('chatbot-suggestions');
        suggestionsDiv.innerHTML = '';
        for (var i = 1; i <= 5; i++) {
            suggestionsDiv.innerHTML += '<div class="chatbot-suggestion" onclick="sendRating(' + i + ')">' + i + ' ⭐</div>';
        }
        suggestionsDiv.innerHTML += '<div class="chatbot-suggestion" onclick="skipRating()">Skip</div>';
        suggestionsDiv.style.display = 'flex';
    }

    window.skipRating = function() {
        document.getElementById('chatbot-input').value = '3';
        sendMessage();
    };

    function showChatSuggestions() {
        var suggestionsDiv = document.getElementById('chatbot-suggestions');
        suggestionsDiv.innerHTML = '<div class="chatbot-suggestion" onclick="sendSuggestion(\'What tours are available?\')"> Tours</div>' +
            '<div class="chatbot-suggestion" onclick="sendSuggestion(\'What destinations can I visit?\')"> Destinations</div>' +
            '<div class="chatbot-suggestion" onclick="sendSuggestion(\'How do I book a tour?\')">Booking</div>' +
            '<div class="chatbot-suggestion" onclick="sendSuggestion(\'What payment methods are accepted?\')">Payment</div>' +
            '<div class="chatbot-suggestion" onclick="sendSuggestion(\'What are the tour prices?\')">Prices</div>' +
            '<div class="chatbot-suggestion" onclick="sendSuggestion(\'What is your contact information?\')">Contact</div>';
        suggestionsDiv.style.display = 'flex';
    }

    function showCloseChat() {
        var suggestionsDiv = document.getElementById('chatbot-suggestions');
        suggestionsDiv.innerHTML = '<div class="chatbot-suggestion" onclick="closeChatbot()" style="background:#4DA528;color:#fff;border-color:#4DA528;">✕ Close Chat</div>' +
            '<div class="chatbot-suggestion" onclick="restartChat()">💬 Start New Chat</div>';
        suggestionsDiv.style.display = 'flex';
    }

    window.closeChatbot = function() {
        var box = document.getElementById('chatbot-box');
        var toggle = document.getElementById('chatbot-toggle');
        box.classList.remove('active');
        toggle.style.display = 'flex';
    };

    window.restartChat = function() {
        chatStep = 'greeting';
        sessionData = {};
        chatHistory = [];
        saveState();
        document.getElementById('chatbot-messages').innerHTML = '';
        document.getElementById('chatbot-suggestions').innerHTML = '';
        toggleChatbot();
    };

    function escapeHtml(text) {
        var div = document.createElement('div');
        div.appendChild(document.createTextNode(text));
        return div.innerHTML;
    }

    function showBotReplies(replies, showRating, isChatMode, dataSaved) {
        var index = 0;
        function showNext() {
            if (index < replies.length) {
                showTyping();
                setTimeout(function() {
                    hideTyping();
                    addBotMsg(replies[index]);
                    index++;
                    setTimeout(showNext, 400);
                }, 600);
            } else {
                if (showRating) {
                    setTimeout(function() { showRatingButtons(); }, 300);
                } else if (dataSaved) {
                    setTimeout(function() { showCloseChat(); }, 500);
                } else if (isChatMode) {
                    showChatSuggestions();
                }
            }
        }
        showNext();
    }

    window.sendMessage = function() {
        var input = document.getElementById('chatbot-input');
        var message = input.value.trim();
        if (!message) return;

        var suggestionsDiv = document.getElementById('chatbot-suggestions');
        suggestionsDiv.style.display = 'none';

        addUserMsg(message);
        input.value = '';
        showTyping();

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '{{ route("chatbot.chat") }}', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        xhr.setRequestHeader('Accept', 'application/json');
        xhr.timeout = 10000;

        xhr.onload = function() {
            hideTyping();
            if (xhr.status === 200) {
                try {
                    var data = JSON.parse(xhr.responseText);
                    chatStep = data.next_step || 'chat';
                    sessionData = data.session_data || sessionData;
                    var replies = data.replies || (data.reply ? [data.reply] : ['Sorry, no reply received.']);
                    showBotReplies(replies, data.show_rating, chatStep === 'chat', data.data_saved);
                } catch(e) {
                    addBotMsg('Sorry, something went wrong. Please try again.');
                }
            } else {
                addBotMsg('Sorry, something went wrong. Please try again.');
            }
        };

        xhr.onerror = function() {
            hideTyping();
            addBotMsg('Sorry, I cannot connect to the server. Please check your connection.');
        };

        xhr.ontimeout = function() {
            hideTyping();
            addBotMsg('Sorry, the request timed out. Please try again.');
        };

        xhr.send(JSON.stringify({
            message: message,
            step: chatStep,
            session_data: sessionData,
            session_id: sessionData.session_id || null,
            chat_history: chatHistory
        }));
    };

    renderHistory();
})();
</script>
