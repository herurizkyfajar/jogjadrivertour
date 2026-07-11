@extends('layouts.dashboard')

@section('title', 'Moderasi Komentar - Dashboard')

@section('content')
<section class="profile-dashboard">
    <div class="inner-header mb-40">
        <h3 class="title">Moderasi Komentar Blog</h3>
        <p class="des">Kelola, setujui, tolak, atau hapus komentar dari artikel blog Anda</p>
    </div>

    @if(session('success'))
        <div style="background:#4DA528;color:#fff;padding:12px 20px;border-radius:8px;margin-bottom:20px;font-weight:600;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Status Filter Tabs -->
    <div style="display:flex;gap:10px;margin-bottom:25px;border-bottom:1px solid #eee;padding-bottom:15px;flex-wrap:wrap;">
        <a href="{{ route('admin.blog.comments.index') }}" 
           style="padding:8px 18px;border-radius:20px;text-decoration:none;font-weight:600;font-size:14px;transition:all 0.3s;
                  background:{{ is_null($status) ? '#4DA528' : '#f5f5f5' }};
                  color:{{ is_null($status) ? '#fff' : '#666' }};">
            Semua ({{ App\Models\BlogComment::count() }})
        </a>
        <a href="{{ route('admin.blog.comments.index', ['status' => 'pending']) }}" 
           style="padding:8px 18px;border-radius:20px;text-decoration:none;font-weight:600;font-size:14px;transition:all 0.3s;
                  background:{{ $status === 'pending' ? '#e67e22' : '#f5f5f5' }};
                  color:{{ $status === 'pending' ? '#fff' : '#666' }};">
            Pending ({{ App\Models\BlogComment::pending()->count() }})
        </a>
        <a href="{{ route('admin.blog.comments.index', ['status' => 'approved']) }}" 
           style="padding:8px 18px;border-radius:20px;text-decoration:none;font-weight:600;font-size:14px;transition:all 0.3s;
                  background:{{ $status === 'approved' ? '#4DA528' : '#f5f5f5' }};
                  color:{{ $status === 'approved' ? '#fff' : '#666' }};">
            Disetujui ({{ App\Models\BlogComment::approved()->count() }})
        </a>
        <a href="{{ route('admin.blog.comments.index', ['status' => 'rejected']) }}" 
           style="padding:8px 18px;border-radius:20px;text-decoration:none;font-weight:600;font-size:14px;transition:all 0.3s;
                  background:{{ $status === 'rejected' ? '#e74c3c' : '#f5f5f5' }};
                  color:{{ $status === 'rejected' ? '#fff' : '#666' }};">
            Ditolak ({{ App\Models\BlogComment::rejected()->count() }})
        </a>
    </div>

    <div class="wg-box">
        <div style="overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;font-size:14px;min-width:800px;">
                <thead>
                    <tr style="border-bottom:2px solid #eee;text-align:left;">
                        <th style="padding:15px 10px;color:#666;width:50px;">#</th>
                        <th style="padding:15px 10px;color:#666;width:180px;">Pengirim</th>
                        <th style="padding:15px 10px;color:#666;width:250px;">Komentar</th>
                        <th style="padding:15px 10px;color:#666;width:200px;">Artikel Blog</th>
                        <th style="padding:15px 10px;color:#666;width:100px;">Status</th>
                        <th style="padding:15px 10px;color:#666;width:100px;">Tanggal</th>
                        <th style="padding:15px 10px;color:#666;width:220px;text-align:right;">Aksi Moderasi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($comments as $comment)
                    <tr style="border-bottom:1px solid #eee;vertical-align:top;transition:background 0.2s;" onmouseover="this.style.background='#fafafa'" onmouseout="this.style.background='transparent'">
                        <td style="padding:15px 10px;">{{ ($comments->currentPage() - 1) * $comments->perPage() + $loop->iteration }}</td>
                        <td style="padding:15px 10px;">
                            <strong style="color:#081E2A;display:block;font-size:14px;">{{ $comment->author_name }}</strong>
                            <span style="color:#888;font-size:12px;display:block;">{{ $comment->author_email }}</span>
                            @if($comment->author_ip)
                                <span style="background:#f1f1f1;color:#666;font-size:10px;padding:1px 6px;border-radius:4px;display:inline-block;margin-top:4px;">IP: {{ $comment->author_ip }}</span>
                            @endif
                        </td>
                        <td style="padding:15px 10px;">
                            <div style="color:#4F545A;line-height:1.6;white-space:pre-line;max-height:150px;overflow-y:auto;font-size:13px;padding-right:10px;">{{ $comment->content }}</div>
                        </td>
                        <td style="padding:15px 10px;">
                            @if($comment->blog)
                                <a href="{{ route('blog.show', $comment->blog->slug) }}" target="_blank" style="color:#4DA528;font-weight:600;text-decoration:none;display:inline-block;">
                                    {{ Str::limit($comment->blog->title, 45) }} <i class="icon-Vector-32" style="font-size:10px;margin-left:4px;"></i>
                                </a>
                            @else
                                <span style="color:#999;font-style:italic;">Artikel Terhapus</span>
                            @endif
                        </td>
                        <td style="padding:15px 10px;vertical-align:middle;">
                            @if($comment->isPending())
                                <span style="background:#fff3cd;color:#856404;padding:4px 12px;border-radius:20px;font-size:11px;font-weight:700;border:1px solid #ffeeba;display:inline-block;">Pending</span>
                            @elseif($comment->isApproved())
                                <span style="background:#d4edda;color:#155724;padding:4px 12px;border-radius:20px;font-size:11px;font-weight:700;border:1px solid #c3e6cb;display:inline-block;">Disetujui</span>
                            @else
                                <span style="background:#f8d7da;color:#721c24;padding:4px 12px;border-radius:20px;font-size:11px;font-weight:700;border:1px solid #f5c6cb;display:inline-block;">Ditolak</span>
                            @endif
                        </td>
                        <td style="padding:15px 10px;color:#666;font-size:12px;">
                            {{ $comment->created_at->format('d M Y') }}
                        </td>
                        <td style="padding:15px 10px;text-align:right;vertical-align:middle;">
                            <div style="display:flex;gap:6px;justify-content:flex-end;align-items:center;">
                                @if(!$comment->isApproved())
                                    <form action="{{ route('admin.blog.comments.approve', $comment) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" title="Setujui komentar agar tampil di blog" style="background:#e6f7e6;color:#4DA528;padding:6px 10px;border-radius:6px;border:none;cursor:pointer;font-size:12px;font-weight:700;transition:all 0.2s;" onmouseover="this.style.background='#4DA528';this.style.color='#fff';" onmouseout="this.style.background='#e6f7e6';this.style.color='#4DA528';">Setujui</button>
                                    </form>
                                @endif

                                @if(!$comment->isRejected())
                                    <form action="{{ route('admin.blog.comments.reject', $comment) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" title="Tolak komentar" style="background:#fff3cd;color:#856404;padding:6px 10px;border-radius:6px;border:none;cursor:pointer;font-size:12px;font-weight:700;transition:all 0.2s;" onmouseover="this.style.background='#e67e22';this.style.color='#fff';" onmouseout="this.style.background='#fff3cd';this.style.color='#856404';">Tolak</button>
                                    </form>
                                @endif

                                <form action="{{ route('admin.blog.comments.destroy', $comment) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus komentar ini secara permanen?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Hapus komentar" style="background:#fde8e8;color:#e74c3c;padding:6px 10px;border-radius:6px;border:none;cursor:pointer;font-size:12px;font-weight:700;transition:all 0.2s;" onmouseover="this.style.background='#e74c3c';this.style.color='#fff';" onmouseout="this.style.background='#fde8e8';this.style.color='#e74c3c';">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="padding:50px;text-align:center;color:#999;font-size:15px;font-style:italic;">Tidak ada komentar ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top:20px;text-align:center;">
            {{ $comments->links() }}
        </div>
    </div>
</section>
@endsection
