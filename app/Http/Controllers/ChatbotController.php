<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Tour;
use App\Models\Destination;
use App\Models\Blog;
use App\Models\ChatSession;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        $message = trim($request->input('message', ''));
        $step = $request->input('step', 'greeting');
        $sessionData = $request->input('session_data', []);
        $sessionId = $request->input('session_id', null);
        $chatHistory = $request->input('chat_history', []);

        if (empty($message) && $step === 'greeting') {
            return response()->json([
                'replies' => [
                    'Hello! Welcome to Joga Driver Tour 👋',
                    'Before we start, may I know your name?'
                ],
                'next_step' => 'ask_name',
                'session_data' => $sessionData
            ]);
        }

        switch ($step) {
            case 'ask_name':
                $sessionData['name'] = $message;

                $chatHistory[] = ['type' => 'user', 'text' => $message];
                $replies = [
                    'Nice to meet you, ' . htmlspecialchars($message) . '! 😊',
                    'What is your email or phone number? So we can reach you if needed.'
                ];
                foreach ($replies as $reply) {
                    $chatHistory[] = ['type' => 'bot', 'text' => $reply];
                }

                $chatSession = ChatSession::create([
                    'name' => $message,
                    'contact' => '-',
                    'ip_address' => $request->ip(),
                    'chat_history' => $chatHistory,
                ]);
                $sessionData['session_id'] = $chatSession->id;

                return response()->json([
                    'replies' => $replies,
                    'next_step' => 'ask_contact',
                    'session_data' => $sessionData
                ]);

            case 'ask_contact':
                $sessionData['contact'] = $message;

                $chatHistory[] = ['type' => 'user', 'text' => $message];
                $name = htmlspecialchars($sessionData['name'] ?? 'there');
                $replies = [
                    'Thank you, ' . $name . '! 😊',
                    'How can I help you today? You can ask about our tours, destinations, booking, payment, or anything else!'
                ];
                foreach ($replies as $reply) {
                    $chatHistory[] = ['type' => 'bot', 'text' => $reply];
                }

                if (!empty($sessionData['session_id'])) {
                    ChatSession::where('id', $sessionData['session_id'])->update([
                        'contact' => $message,
                        'chat_history' => $chatHistory,
                    ]);
                }

                return response()->json([
                    'replies' => $replies,
                    'next_step' => 'chat',
                    'session_data' => $sessionData
                ]);

            case 'ask_rating':
                $rating = (int) $message;
                if ($rating < 1 || $rating > 5) {
                    return response()->json([
                        'replies' => ['Please enter a number between 1 and 5.'],
                        'next_step' => 'ask_rating',
                        'session_data' => $sessionData,
                        'show_rating' => true
                    ]);
                }
                $sessionData['rating'] = $rating;

                $chatHistory[] = ['type' => 'user', 'text' => str_repeat('⭐', $rating) . ' (' . $rating . '/5)'];
                $stars = str_repeat('⭐', $rating);
                $name = htmlspecialchars($sessionData['name'] ?? 'there');

                $replies = ['Thank you, ' . $name . '! ' . $stars];
                if ($rating >= 4) {
                    $replies[] = 'We\'re so glad you loved it! 😊';
                    $replies[] = 'Feel free to come back anytime. Have a wonderful day! 🌴';
                } elseif ($rating === 3) {
                    $replies[] = 'Thanks for your feedback! We\'ll keep improving. 💪';
                    $replies[] = 'Hope to see you again soon! 🌴';
                } else {
                    $replies[] = 'We\'re sorry to hear that. Your feedback helps us improve. 🙏';
                    $replies[] = 'We\'ll do better next time. Have a great day! 🌴';
                }
                foreach ($replies as $reply) {
                    $chatHistory[] = ['type' => 'bot', 'text' => $reply];
                }

                if (!empty($sessionData['session_id'])) {
                    ChatSession::where('id', $sessionData['session_id'])->update([
                        'rating' => $rating,
                        'chat_history' => $chatHistory,
                    ]);
                }

                return response()->json([
                    'replies' => $replies,
                    'next_step' => 'chat',
                    'session_data' => $sessionData,
                    'data_saved' => true
                ]);

            case 'chat':
            default:
                $originalMessage = $message;
                $message = strtolower($message);

                $chatHistory[] = ['type' => 'user', 'text' => $originalMessage];

                $greetings = ['hello', 'hi', 'hey', 'halo', 'hai', 'selamat', 'pagi', 'siang', 'sore', 'malam'];
                foreach ($greetings as $greeting) {
                    if (str_contains($message, $greeting)) {
                        $name = htmlspecialchars($sessionData['name'] ?? 'there');
                        $replies = ['Hello ' . $name . '! 😊'];
                        if (str_contains($message, 'pagi')) {
                            $replies[] = 'Good morning! What can I help you with today?';
                        } elseif (str_contains($message, 'siang')) {
                            $replies[] = 'Good afternoon! What can I help you with today?';
                        } elseif (str_contains($message, 'sore') || str_contains($message, 'malam')) {
                            $replies[] = 'Good evening! What can I help you with today?';
                        } else {
                            $replies[] = 'How can I help you today? Feel free to ask about our tours, destinations, booking, or payment.';
                        }
                        $this->saveChatHistory($sessionId, $chatHistory, $replies);
                        return response()->json([
                            'replies' => $replies,
                            'next_step' => 'chat',
                            'session_data' => $sessionData
                        ]);
                    }
                }

                if (str_contains($message, 'terima kasih') || str_contains($message, 'thank')) {
                    $name = htmlspecialchars($sessionData['name'] ?? 'there');
                    $replies = [
                        'You\'re welcome, ' . $name . '! 😊',
                        'Before you go, how would you rate your experience with us?',
                        'Please rate from 1 to 5 stars ⭐'
                    ];
                    $this->saveChatHistory($sessionId, $chatHistory, $replies);
                    return response()->json([
                        'replies' => $replies,
                        'next_step' => 'ask_rating',
                        'session_data' => $sessionData,
                        'show_rating' => true
                    ]);
                }

                $goodbyes = ['bye', 'goodbye', 'selamat tinggal', 'selesai', 'done', 'finished', 'sampai jumpa', 'dadah', 'dah'];
                foreach ($goodbyes as $goodbye) {
                    if (str_contains($message, strtolower(trim($goodbye)))) {
                        $name = htmlspecialchars($sessionData['name'] ?? 'there');
                        $replies = [
                            'Thank you for chatting with us, ' . $name . '! 👋',
                            'Before you leave, how would you rate your experience?',
                            'Please rate from 1 to 5 stars ⭐'
                        ];
                        $this->saveChatHistory($sessionId, $chatHistory, $replies);
                        return response()->json([
                            'replies' => $replies,
                            'next_step' => 'ask_rating',
                            'session_data' => $sessionData,
                            'show_rating' => true
                        ]);
                    }
                }

                if (str_contains($message, 'rating') || str_contains($message, 'rate') || str_contains($message, 'bintang') || str_contains($message, 'ulasan') || str_contains($message, 'review')) {
                    $replies = ['Sure! Please rate your experience from 1 to 5 stars.'];
                    $this->saveChatHistory($sessionId, $chatHistory, $replies);
                    return response()->json([
                        'replies' => $replies,
                        'next_step' => 'ask_rating',
                        'session_data' => $sessionData,
                        'show_rating' => true
                    ]);
                }

                $searchResult = $this->searchWebsiteContent($message);

                if ($searchResult) {
                    $this->saveChatHistory($sessionId, $chatHistory, $searchResult);
                    return response()->json([
                        'replies' => $searchResult,
                        'next_step' => 'chat',
                        'session_data' => $sessionData
                    ]);
                }

                $replies = [
                    "I'm sorry, I don't quite understand that. 🤔",
                    "Could you rephrase your question? You can ask about our tours, destinations, booking, payment, or contact us at info@jogadrivertour.com"
                ];
                $this->saveChatHistory($sessionId, $chatHistory, $replies);
                return response()->json([
                    'replies' => $replies,
                    'next_step' => 'chat',
                    'session_data' => $sessionData
                ]);
        }
    }

    private function searchWebsiteContent($message)
    {
        $words = array_filter(explode(' ', $message), fn($w) => strlen($w) > 2);

        $faqs = Faq::where('is_active', true)->get();
        foreach ($faqs as $faq) {
            $question = strtolower($faq->question);
            $score = 0;
            foreach ($words as $word) {
                if (str_contains($question, $word)) $score++;
            }
            if (str_contains($question, $message) || str_contains($message, $question)) $score += 10;
            similar_text($message, $question, $percent);
            $score += $percent / 10;
            if ($score >= 2) {
                return [$faq->answer];
            }
        }

        $tours = Tour::where('is_active', true)->get();
        $tourMatches = [];
        foreach ($tours as $tour) {
            $searchable = strtolower($tour->name . ' ' . $tour->location . ' ' . ($tour->description ?? '') . ' ' . ($tour->itinerary ?? ''));
            $score = 0;
            foreach ($words as $word) {
                if (str_contains($searchable, $word)) $score++;
            }
            if ($score >= 2) {
                $tourMatches[] = ['tour' => $tour, 'score' => $score];
            }
        }
        if (!empty($tourMatches)) {
            usort($tourMatches, fn($a, $b) => $b['score'] <=> $a['score']);
            $best = $tourMatches[0]['tour'];
            $replies = ['🎯 I found a tour that might match your question:'];
            $replies[] = '📍 ' . $best->name;
            $replies[] = '• Location: ' . $best->location;
            $replies[] = '• Price: Rp ' . number_format($best->price, 0, ',', '.');
            if ($best->duration_days) $replies[] = '• Duration: ' . $best->duration_days . 'D' . ($best->duration_nights ? $best->duration_nights . 'N' : '');
            if ($best->description) {
                $desc = strip_tags($best->description);
                $replies[] = '• ' . substr($desc, 0, 150) . (strlen($desc) > 150 ? '...' : '');
            }
            $replies[] = 'View more: ' . route('tours.show', $best->slug);
            return $replies;
        }

        $destinations = Destination::where('is_featured', true)->get();
        $destMatches = [];
        foreach ($destinations as $dest) {
            $searchable = strtolower($dest->name . ' ' . $dest->city . ' ' . ($dest->description ?? '') . ' ' . ($dest->short_description ?? ''));
            $score = 0;
            foreach ($words as $word) {
                if (str_contains($searchable, $word)) $score++;
            }
            if ($score >= 2) {
                $destMatches[] = ['dest' => $dest, 'score' => $score];
            }
        }
        if (!empty($destMatches)) {
            usort($destMatches, fn($a, $b) => $b['score'] <=> $a['score']);
            $best = $destMatches[0]['dest'];
            $replies = ['📍 I found a destination that might interest you:'];
            $replies[] = '🏷️ ' . $best->name;
            if ($best->city) $replies[] = '• City: ' . $best->city;
            if ($best->short_description) {
                $desc = strip_tags($best->short_description);
                $replies[] = '• ' . substr($desc, 0, 150) . (strlen($desc) > 150 ? '...' : '');
            }
            $replies[] = 'View more: ' . route('destinations.show', $best->slug);
            return $replies;
        }

        $blogs = Blog::where('is_active', true)->get();
        $blogMatches = [];
        foreach ($blogs as $blog) {
            $searchable = strtolower($blog->title . ' ' . ($blog->content ?? '') . ' ' . ($blog->excerpt ?? ''));
            $score = 0;
            foreach ($words as $word) {
                if (str_contains($searchable, $word)) $score++;
            }
            if ($score >= 2) {
                $blogMatches[] = ['blog' => $blog, 'score' => $score];
            }
        }
        if (!empty($blogMatches)) {
            usort($blogMatches, fn($a, $b) => $b['score'] <=> $a['score']);
            $best = $blogMatches[0]['blog'];
            $replies = ['📝 Here\'s a blog post that might help:'];
            $replies[] = '📰 ' . $best->title;
            if ($best->excerpt) {
                $desc = strip_tags($best->excerpt);
                $replies[] = '• ' . substr($desc, 0, 150) . (strlen($desc) > 150 ? '...' : '');
            }
            $replies[] = 'Read more: ' . route('blog.show', $best->slug);
            return $replies;
        }

        if (str_contains($message, 'tour') || str_contains($message, 'paket') || str_contains($message, 'trip')) {
            $tours = Tour::where('is_active', true)->take(3)->get(['name', 'price', 'location', 'slug']);
            if ($tours->count()) {
                $replies = ['We have some amazing tours! Here are some of our popular ones:'];
                foreach ($tours as $tour) {
                    $replies[] = '• ' . $tour->name . ' - Rp ' . number_format($tour->price, 0, ',', '.') . ' (' . $tour->location . ')';
                }
                $replies[] = 'View all tours: ' . route('tours.index');
                return $replies;
            }
        }

        if (str_contains($message, 'destination') || str_contains($message, 'wisata') || str_contains($message, 'tempat')) {
            $dests = Destination::where('is_featured', true)->take(3)->get(['name', 'slug']);
            if ($dests->count()) {
                $replies = ['Here are some popular destinations:'];
                foreach ($dests as $dest) {
                    $replies[] = '• ' . $dest->name;
                }
                $replies[] = 'View all destinations: ' . route('destinations.index');
                return $replies;
            }
        }

        if (str_contains($message, 'blog') || str_contains($message, 'article') || str_contains($message, 'artikel') || str_contains($message, 'news')) {
            $blogs = Blog::where('is_active', true)->take(3)->get(['title', 'slug']);
            if ($blogs->count()) {
                $replies = ['Here are our latest blog posts:'];
                foreach ($blogs as $blog) {
                    $replies[] = '• ' . $blog->title;
                }
                $replies[] = 'View all posts: ' . route('blog.index');
                return $replies;
            }
        }

        if (str_contains($message, 'kontak') || str_contains($message, 'contact') || str_contains($message, 'hubungi') || str_contains($message, 'telepon') || str_contains($message, 'phone') || str_contains($message, 'wa') || str_contains($message, 'whatsapp') || str_contains($message, 'email')) {
            return [
                'Here\'s how to reach us:',
                '📧 Email: info@jogadrivertour.com',
                '📱 WhatsApp: +62 812 3456 7890',
                '🌐 Website: ' . url('/'),
                '📍 We are based in Yogyakarta, Indonesia',
                'Feel free to contact us anytime!'
            ];
        }

        if (str_contains($message, 'harga') || str_contains($message, 'price') || str_contains($message, 'biaya') || str_contains($message, 'cost') || str_contains($message, 'bayar') || str_contains($message, 'payment')) {
            $tours = Tour::where('is_active', true)->orderBy('price', 'asc')->take(3)->get(['name', 'price', 'slug']);
            if ($tours->count()) {
                $replies = ['Here are our tour prices (starting from):'];
                foreach ($tours as $tour) {
                    $replies[] = '• ' . $tour->name . ': Rp ' . number_format($tour->price, 0, ',', '.');
                }
                $replies[] = 'Payment methods: Bank Transfer, Cash, E-Wallet';
                $replies[] = 'View all tours: ' . route('tours.index');
                return $replies;
            }
        }

        if (str_contains($message, 'jadwal') || str_contains($message, 'schedule') || str_contains($message, 'kapan') || str_contains($message, 'when') || str_contains($message, 'time') || str_contains($message, 'waktu')) {
            return [
                'Our tours are available daily!',
                '• Morning tours: 08:00 AM',
                '• Full day tours: 08:00 AM - 05:00 PM',
                '• Custom schedules available upon request',
                'Book now: ' . route('tours.index'),
                'For specific schedules, please contact us via WhatsApp!'
            ];
        }

        if (str_contains($message, 'about') || str_contains($message, 'tentang') || str_contains($message, 'profil') || str_contains($message, 'profile') || str_contains($message, 'siapa')) {
            return [
                'We are Joga Driver Tour, a trusted tour operator in Yogyakarta! 🌴',
                '• Experienced local guides',
                '• Custom tour packages',
                '• Best price guarantee',
                '• 24/7 customer support',
                'Learn more: ' . route('about'),
                'Ready to book? Contact us now!'
            ];
        }

        return null;
    }

    private function saveChatHistory($sessionId, $chatHistory, $replies)
    {
        if (empty($sessionId)) return;

        foreach ($replies as $reply) {
            $chatHistory[] = ['type' => 'bot', 'text' => $reply];
        }

        ChatSession::where('id', $sessionId)->update([
            'chat_history' => $chatHistory,
        ]);
    }
}
