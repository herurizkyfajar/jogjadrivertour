@extends('layouts.dashboard')

@section('title', 'Manage Destinations - Dashboard')

@section('content')
<section class="profile-dashboard">
    <div class="inner-header mb-40">
        <h3 class="title">Manage Destinations</h3>
        <p class="des">Create, edit, and delete destinations</p>
    </div>

    @if(session('success'))
        <div style="background:#4DA528;color:#fff;padding:12px 20px;border-radius:8px;margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="wg-box">
        <form id="bulk-form" method="POST" action="{{ route('admin.destinations.bulkDestroy') }}">
            @csrf
        </form>

        <div class="flex-two mb-30">
            <h5 style="margin:0;">Destinations ({{ App\Models\Destination::count() }})</h5>
            <div style="display:flex;gap:10px;align-items:center;">
                <button type="button" id="bulk-delete-btn" onclick="submitBulkDelete()" style="background:#e74c3c;color:#fff;padding:10px 20px;border-radius:8px;border:none;cursor:pointer;font-weight:600;font-size:14px;display:none;">Delete Selected</button>
                <a href="{{ route('admin.destinations.create') }}" style="background:#4DA528;color:#fff;padding:10px 24px;border-radius:8px;text-decoration:none;font-weight:600;font-size:14px;">+ Add New</a>
            </div>
        </div>

        <div style="overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;font-size:14px;">
                <thead>
                    <tr style="border-bottom:2px solid #eee;text-align:left;">
                        <th style="padding:12px 10px;color:#666;width:40px;">
                            <input type="checkbox" id="select-all" onchange="toggleAll(this)" style="width:18px;height:18px;accent-color:#4DA528;">
                        </th>
                        <th style="padding:12px 10px;color:#666;">#</th>
                        <th style="padding:12px 10px;color:#666;">Image</th>
                        <th style="padding:12px 10px;color:#666;">Name</th>
                        <th style="padding:12px 10px;color:#666;">Location</th>
                        <th style="padding:12px 10px;color:#666;">Tours</th>
                        <th style="padding:12px 10px;color:#666;">Status</th>
                        <th style="padding:12px 10px;color:#666;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($destinations as $dest)
                    <tr style="border-bottom:1px solid #eee;">
                        <td style="padding:12px 10px;">
                            <input type="checkbox" class="row-check" value="{{ $dest->id }}" onchange="updateBulkBtn()" style="width:18px;height:18px;accent-color:#4DA528;">
                        </td>
                        <td style="padding:12px 10px;">{{ $dest->id }}</td>
                        <td style="padding:12px 10px;">
                            @if(str_starts_with($dest->image, 'destinations/'))
                                <img src="{{ asset('storage/'.$dest->image) }}" alt="{{ $dest->name }}" style="width:80px;height:55px;object-fit:cover;border-radius:6px;">
                            @else
                                <img src="{{ asset($dest->image) }}" alt="{{ $dest->name }}" style="width:80px;height:55px;object-fit:cover;border-radius:6px;">
                            @endif
                        </td>
                        <td style="padding:12px 10px;font-weight:600;color:#081E2A;">{{ $dest->name }}</td>
                        <td style="padding:12px 10px;color:#666;">{{ $dest->location }}</td>
                        <td style="padding:12px 10px;color:#666;">{{ $dest->tour_count }}</td>
                        <td style="padding:12px 10px;">
                            @if($dest->is_active)
                                <span style="background:#e6f7e6;color:#4DA528;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;">Active</span>
                            @else
                                <span style="background:#fde8e8;color:#e74c3c;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;">Inactive</span>
                            @endif
                            @if($dest->is_featured)
                                <span style="background:#fff3e0;color:#f5a623;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;margin-left:4px;">Featured</span>
                            @endif
                        </td>
                        <td style="padding:12px 10px;">
                            <div style="display:flex;gap:8px;">
                                <a href="{{ route('admin.destinations.edit', $dest) }}" style="background:#e6f7e6;color:#4DA528;padding:6px 14px;border-radius:6px;text-decoration:none;font-size:13px;font-weight:600;">Edit</a>
                                <form action="{{ route('admin.destinations.destroy', $dest) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this destination?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background:#fde8e8;color:#e74c3c;padding:6px 14px;border-radius:6px;border:none;cursor:pointer;font-size:13px;font-weight:600;">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="padding:40px;text-align:center;color:#999;">No destinations found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top:20px;text-align:center;">
            {{ $destinations->links() }}
        </div>
    </div>

    <script>
        function toggleAll(source) {
            document.querySelectorAll('.row-check').forEach(function(cb) {
                cb.checked = source.checked;
            });
            updateBulkBtn();
        }
        function updateBulkBtn() {
            var checked = document.querySelectorAll('.row-check:checked').length;
            document.getElementById('bulk-delete-btn').style.display = checked > 0 ? 'inline-block' : 'none';
        }
        function submitBulkDelete() {
            var checked = document.querySelectorAll('.row-check:checked');
            if (checked.length === 0) return;
            if (!confirm('Are you sure you want to delete ' + checked.length + ' selected destination(s)? This will also remove their images.')) return;
            var form = document.getElementById('bulk-form');
            checked.forEach(function(cb) {
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'ids[]';
                input.value = cb.value;
                form.appendChild(input);
            });
            form.submit();
        }
    </script>
</section>
@endsection
