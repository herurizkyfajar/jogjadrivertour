@extends('layouts.dashboard')

@section('title', 'Cars - Dashboard')

@section('content')
<section class="profile-dashboard">
    <div class="inner-header mb-40">
        <h3 class="title">Cars</h3>
        <p class="des">Manage fleet vehicles</p>
    </div>

    @if(session('success'))
        <div style="background:#4DA528;color:#fff;padding:12px 20px;border-radius:8px;margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="wg-box">
        <div class="flex-two mb-30">
            <div style="display:flex;gap:12px;align-items:center;">
                <h5 style="margin:0;">Cars ({{ App\Models\Car::count() }})</h5>
                <form method="GET" style="display:flex;gap:8px;">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search cars..." style="padding:8px 14px;border:1px solid #ddd;border-radius:6px;font-size:13px;width:200px;">
                    <button type="submit" style="background:#4DA528;color:#fff;padding:8px 16px;border:none;border-radius:6px;cursor:pointer;font-size:13px;font-weight:600;">Search</button>
                </form>
            </div>
            <div style="display:flex;gap:8px;">
                <button onclick="bulkDelete()" style="background:#fde8e8;color:#e74c3c;padding:8px 16px;border:none;border-radius:6px;cursor:pointer;font-size:13px;font-weight:600;display:none;" id="bulkDeleteBtn">Delete Selected</button>
                <a href="{{ route('admin.cars.create') }}" style="background:#4DA528;color:#fff;padding:10px 24px;border-radius:8px;text-decoration:none;font-weight:600;font-size:14px;">+ Add New</a>
            </div>
        </div>

        <div style="overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;font-size:14px;">
                <thead>
                    <tr style="border-bottom:2px solid #eee;text-align:left;">
                        <th style="padding:12px 10px;color:#666;width:40px;"><input type="checkbox" id="selectAll" onclick="toggleSelectAll(this)"></th>
                        <th style="padding:12px 10px;color:#666;">#</th>
                        <th style="padding:12px 10px;color:#666;">Foto</th>
                        <th style="padding:12px 10px;color:#666;">Nama</th>
                        <th style="padding:12px 10px;color:#666;">Penumpang</th>
                        <th style="padding:12px 10px;color:#666;">Bagasi</th>
                        <th style="padding:12px 10px;color:#666;">Tipe</th>
                        <th style="padding:12px 10px;color:#666;">Status</th>
                        <th style="padding:12px 10px;color:#666;">Urutan</th>
                        <th style="padding:12px 10px;color:#666;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cars as $car)
                    <tr style="border-bottom:1px solid #eee;">
                        <td style="padding:12px 10px;"><input type="checkbox" class="row-check" value="{{ $car->id }}" onchange="updateBulkBtn()"></td>
                        <td style="padding:12px 10px;">{{ $car->id }}</td>
                        <td style="padding:12px 10px;">
                            @if($car->image && str_starts_with($car->image, 'cars/'))
                                <img src="{{ asset('storage/'.$car->image) }}" alt="{{ $car->name }}" style="width:100px;height:60px;object-fit:cover;border-radius:6px;">
                            @elseif($car->image)
                                <img src="{{ asset($car->image) }}" alt="{{ $car->name }}" style="width:100px;height:60px;object-fit:cover;border-radius:6px;">
                            @else
                                <div style="width:100px;height:60px;background:#f0f0f0;border-radius:6px;display:flex;align-items:center;justify-content:center;color:#999;font-size:12px;">No Image</div>
                            @endif
                        </td>
                        <td style="padding:12px 10px;font-weight:600;">{{ $car->name }}</td>
                        <td style="padding:12px 10px;color:#666;">{{ $car->passengers }}</td>
                        <td style="padding:12px 10px;color:#666;">{{ $car->luggage }}</td>
                        <td style="padding:12px 10px;">
                            <span style="background:{{ $car->type === 'Premium Car' ? '#f3e8ff;color:#7c3aed' : '#e6f7e6;color:#4DA528' }};padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;">
                                {{ $car->type }}
                            </span>
                        </td>
                        <td style="padding:12px 10px;">
                            @if($car->is_active)
                                <span style="background:#e6f7e6;color:#4DA528;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;">Active</span>
                            @else
                                <span style="background:#fde8e8;color:#e74c3c;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;">Inactive</span>
                            @endif
                        </td>
                        <td style="padding:12px 10px;color:#666;">{{ $car->sort_order }}</td>
                        <td style="padding:12px 10px;">
                            <div style="display:flex;gap:8px;">
                                <a href="{{ route('admin.cars.edit', $car) }}" style="background:#e6f7e6;color:#4DA528;padding:6px 14px;border-radius:6px;text-decoration:none;font-size:13px;font-weight:600;">Edit</a>
                                <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background:#fde8e8;color:#e74c3c;padding:6px 14px;border-radius:6px;border:none;cursor:pointer;font-size:13px;font-weight:600;">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" style="padding:40px;text-align:center;color:#999;">No cars found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top:20px;text-align:center;">
            {{ $cars->withQueryString()->links() }}
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
function toggleSelectAll(el) {
    document.querySelectorAll('.row-check').forEach(cb => cb.checked = el.checked);
    updateBulkBtn();
}
function updateBulkBtn() {
    const checked = document.querySelectorAll('.row-check:checked').length;
    document.getElementById('bulkDeleteBtn').style.display = checked > 0 ? 'inline-block' : 'none';
}
function bulkDelete() {
    const ids = Array.from(document.querySelectorAll('.row-check:checked')).map(cb => parseInt(cb.value));
    if (!ids.length || !confirm('Delete selected cars?')) return;
    fetch('{{ route("admin.cars.bulkDestroy") }}', {
        method: 'DELETE',
        headers: {'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'},
        body: JSON.stringify({ids})
    }).then(r => r.json()).then(() => location.reload());
}
</script>
@endpush
