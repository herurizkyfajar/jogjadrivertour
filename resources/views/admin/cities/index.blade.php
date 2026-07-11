@extends('layouts.dashboard')

@section('title', 'Manage Cities - Dashboard')

@section('content')
<section class="profile-dashboard">
    <div class="inner-header mb-40">
        <h3 class="title">Manage Cities</h3>
        <p class="des">Create, edit, and delete cities for destination filtering</p>
    </div>

    @if(session('success'))
        <div style="background:#4DA528;color:#fff;padding:12px 20px;border-radius:8px;margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="wg-box">
        <form id="bulk-form" method="POST" action="{{ route('admin.cities.bulkDestroy') }}">
            @csrf
        </form>

        <div class="flex-two mb-30">
            <h5 style="margin:0;">Cities ({{ App\Models\City::count() }})</h5>
            <div style="display:flex;gap:10px;align-items:center;">
                <button type="button" id="bulk-delete-btn" onclick="submitBulkDelete()" style="background:#e74c3c;color:#fff;padding:10px 20px;border-radius:8px;border:none;cursor:pointer;font-weight:600;font-size:14px;display:none;">Delete Selected</button>
                <a href="{{ route('admin.cities.create') }}" style="background:#4DA528;color:#fff;padding:10px 24px;border-radius:8px;text-decoration:none;font-weight:600;font-size:14px;">+ Add New</a>
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
                        <th style="padding:12px 10px;color:#666;">Name</th>
                        <th style="padding:12px 10px;color:#666;">Status</th>
                        <th style="padding:12px 10px;color:#666;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cities as $city)
                    <tr style="border-bottom:1px solid #eee;">
                        <td style="padding:12px 10px;">
                            <input type="checkbox" class="row-check" value="{{ $city->id }}" onchange="updateBulkBtn()" style="width:18px;height:18px;accent-color:#4DA528;">
                        </td>
                        <td style="padding:12px 10px;">{{ $city->id }}</td>
                        <td style="padding:12px 10px;font-weight:600;color:#081E2A;">{{ $city->name }}</td>
                        <td style="padding:12px 10px;">
                            @if($city->is_active)
                                <span style="background:#e6f7e6;color:#4DA528;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;">Active</span>
                            @else
                                <span style="background:#fde8e8;color:#e74c3c;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;">Inactive</span>
                            @endif
                        </td>
                        <td style="padding:12px 10px;">
                            <div style="display:flex;gap:8px;">
                                <a href="{{ route('admin.cities.edit', $city) }}" style="background:#e6f7e6;color:#4DA528;padding:6px 14px;border-radius:6px;text-decoration:none;font-size:13px;font-weight:600;">Edit</a>
                                <form action="{{ route('admin.cities.destroy', $city) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this city?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background:#fde8e8;color:#e74c3c;padding:6px 14px;border-radius:6px;border:none;cursor:pointer;font-size:13px;font-weight:600;">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="padding:40px;text-align:center;color:#999;">No cities found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top:20px;text-align:center;">
            {{ $cities->links() }}
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
            if (!confirm('Are you sure you want to delete ' + checked.length + ' selected city(ies)?')) return;
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
