@extends('layouts.dashboard')

@section('title', 'Add Car - Dashboard')

@section('content')
<section class="profile-dashboard">
    <div class="inner-header mb-40">
        <h3 class="title">Add New Car</h3>
        <p class="des">Add a new fleet vehicle</p>
    </div>

    <div class="wg-box">
        @if($errors->any())
            <div style="background:#fde8e8;color:#e74c3c;padding:12px 20px;border-radius:8px;margin-bottom:20px;">
                <ul style="margin:0;padding-left:20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Nama Mobil *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="e.g. Avanza TSS" style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Tipe *</label>
                    <select name="type" required style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;background:#fff;">
                        <option value="Regular Car" {{ old('type') === 'Regular Car' ? 'selected' : '' }}>Regular Car</option>
                        <option value="Premium Car" {{ old('type') === 'Premium Car' ? 'selected' : '' }}>Premium Car</option>
                    </select>
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Kapasitas Penumpang *</label>
                    <input type="number" name="passengers" value="{{ old('passengers', 7) }}" min="1" max="50" required style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Kapasitas Bagasi *</label>
                    <input type="number" name="luggage" value="{{ old('luggage', 3) }}" min="0" max="50" required style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Urutan Tampil</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0" style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Foto Mobil</label>
                    <div id="upload-area" style="border:2px dashed #ddd;border-radius:8px;padding:20px;text-align:center;cursor:pointer;transition:all 0.3s;" onclick="document.getElementById('image-input').click();" onmouseover="this.style.borderColor='#4DA528'" onmouseout="this.style.borderColor='#ddd'">
                        <input type="file" name="image" id="image-input" accept="image/*" style="display:none;" onchange="handlePreview(this)">
                        <div id="upload-placeholder">
                            <p style="margin:0;color:#999;font-size:13px;">Click to upload image</p>
                            <p style="margin:4px 0 0;color:#bbb;font-size:11px;">JPG, PNG, WebP (max 2MB)</p>
                        </div>
                        <img id="image-preview" src="#" alt="Preview" style="display:none;max-width:100%;max-height:200px;border-radius:6px;">
                    </div>
                </div>
            </div>

            <div style="margin-top:20px;">
                <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Deskripsi</label>
                <textarea name="description" rows="3" placeholder="Description of the vehicle..." style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;resize:vertical;">{{ old('description') }}</textarea>
            </div>

            <div style="margin-top:20px;display:flex;gap:20px;align-items:center;">
                <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-weight:600;font-size:14px;color:#081E2A;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }} style="width:18px;height:18px;accent-color:#4DA528;">
                    Active (tampilkan di website)
                </label>
            </div>

            <div style="margin-top:30px;display:flex;gap:12px;">
                <button type="submit" style="background:#4DA528;color:#fff;padding:12px 30px;border-radius:8px;border:none;cursor:pointer;font-size:15px;font-weight:600;">Create Car</button>
                <a href="{{ route('admin.cars.index') }}" style="background:#eee;color:#666;padding:12px 30px;border-radius:8px;text-decoration:none;font-size:15px;font-weight:600;">Cancel</a>
            </div>
        </form>
    </div>
</section>
@endsection

@push('scripts')
<script>
function handlePreview(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('image-preview').src = e.target.result;
            document.getElementById('image-preview').style.display = 'block';
            document.getElementById('upload-placeholder').style.display = 'none';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
