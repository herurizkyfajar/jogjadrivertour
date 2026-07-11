@extends('layouts.dashboard')

@section('title', 'My Tours - Dashboard')

@section('content')
<section class="profile-dashboard">
    <div class="inner-header mb-40">
        <h3 class="title">My Tours</h3>
        <p class="des">Riwayat perjalanan klien</p>
    </div>

    @if(session('success'))
        <div style="background:#4DA528;color:#fff;padding:12px 20px;border-radius:8px;margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="wg-box">
        <div class="flex-two mb-30">
            <h5 style="margin:0;">My Tours ({{ App\Models\MyTour::count() }})</h5>
            <a href="{{ route('admin.my-tours.create') }}" style="background:#4DA528;color:#fff;padding:10px 24px;border-radius:8px;text-decoration:none;font-weight:600;font-size:14px;">+ Add New</a>
        </div>

        <div style="overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;font-size:14px;">
                <thead>
                    <tr style="border-bottom:2px solid #eee;text-align:left;">
                        <th style="padding:12px 10px;color:#666;">#</th>
                        <th style="padding:12px 10px;color:#666;">Foto</th>
                        <th style="padding:12px 10px;color:#666;">Negara Asal</th>
                        <th style="padding:12px 10px;color:#666;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($myTours as $myTour)
                    <tr style="border-bottom:1px solid #eee;">
                        <td style="padding:12px 10px;">{{ $myTour->id }}</td>
                        <td style="padding:12px 10px;">
                            @if(str_starts_with($myTour->image, 'my-tours/'))
                                <img src="{{ asset('storage/'.$myTour->image) }}" alt="My Tour" style="width:80px;height:55px;object-fit:cover;border-radius:6px;">
                            @else
                                <img src="{{ asset($myTour->image) }}" alt="My Tour" style="width:80px;height:55px;object-fit:cover;border-radius:6px;">
                            @endif
                        </td>
                        <td style="padding:12px 10px;color:#666;">{{ $myTour->negara_asal }}</td>
                        <td style="padding:12px 10px;">
                            <div style="display:flex;gap:8px;">
                                <a href="{{ route('admin.my-tours.edit', $myTour) }}" style="background:#e6f7e6;color:#4DA528;padding:6px 14px;border-radius:6px;text-decoration:none;font-size:13px;font-weight:600;">Edit</a>
                                <form action="{{ route('admin.my-tours.destroy', $myTour) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background:#fde8e8;color:#e74c3c;padding:6px 14px;border-radius:6px;border:none;cursor:pointer;font-size:13px;font-weight:600;">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="padding:40px;text-align:center;color:#999;">No my tours found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top:20px;text-align:center;">
            {{ $myTours->links() }}
        </div>
    </div>
</section>
@endsection
