@extends('layouts.dashboard')

@section('title', 'FAQ Management - Dashboard')

@section('content')
<section class="profile-dashboard">
    <div class="inner-header mb-40">
        <h3 class="title">FAQ Management</h3>
        <p class="des">Kelola FAQ untuk chatbot</p>
    </div>

    @if(session('success'))
        <div style="background:#4DA528;color:#fff;padding:12px 20px;border-radius:8px;margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="wg-box">
        <div class="flex-two mb-30">
            <h5 style="margin:0;">FAQs ({{ App\Models\Faq::count() }})</h5>
            <a href="{{ route('admin.faqs.create') }}" style="background:#4DA528;color:#fff;padding:10px 24px;border-radius:8px;text-decoration:none;font-weight:600;font-size:14px;">+ Add New</a>
        </div>

        <div style="overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;font-size:14px;">
                <thead>
                    <tr style="border-bottom:2px solid #eee;text-align:left;">
                        <th style="padding:12px 10px;color:#666;">#</th>
                        <th style="padding:12px 10px;color:#666;">Question</th>
                        <th style="padding:12px 10px;color:#666;">Answer</th>
                        <th style="padding:12px 10px;color:#666;">Category</th>
                        <th style="padding:12px 10px;color:#666;">Status</th>
                        <th style="padding:12px 10px;color:#666;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($faqs as $faq)
                    <tr style="border-bottom:1px solid #eee;">
                        <td style="padding:12px 10px;">{{ $faq->id }}</td>
                        <td style="padding:12px 10px;font-weight:600;color:#081E2A;max-width:250px;">{{ Str::limit($faq->question, 50) }}</td>
                        <td style="padding:12px 10px;color:#666;max-width:300px;">{{ Str::limit($faq->answer, 60) }}</td>
                        <td style="padding:12px 10px;color:#666;">{{ $faq->category ?? '-' }}</td>
                        <td style="padding:12px 10px;">
                            @if($faq->is_active)
                                <span style="background:#e6f7e6;color:#4DA528;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;">Active</span>
                            @else
                                <span style="background:#fde8e8;color:#e74c3c;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;">Inactive</span>
                            @endif
                        </td>
                        <td style="padding:12px 10px;">
                            <div style="display:flex;gap:8px;">
                                <a href="{{ route('admin.faqs.edit', $faq) }}" style="background:#e6f7e6;color:#4DA528;padding:6px 14px;border-radius:6px;text-decoration:none;font-size:13px;font-weight:600;">Edit</a>
                                <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this FAQ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background:#fde8e8;color:#e74c3c;padding:6px 14px;border-radius:6px;border:none;cursor:pointer;font-size:13px;font-weight:600;">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="padding:40px;text-align:center;color:#999;">No FAQs found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top:20px;text-align:center;">
            {{ $faqs->links() }}
        </div>
    </div>
</section>
@endsection
