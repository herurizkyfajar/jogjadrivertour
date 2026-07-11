@extends('layouts.dashboard')

@section('title', 'Add Package - Dashboard')

@section('content')
<section class="profile-dashboard">
    <div class="inner-header mb-40">
        <h3 class="title">Add New Package</h3>
        <p class="des">Create a new tour package</p>
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

        <form action="{{ route('admin.packages.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Package Name *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Image *</label>
                    <div id="upload-area" style="border:2px dashed #ddd;border-radius:8px;padding:20px;text-align:center;cursor:pointer;position:relative;transition:all 0.3s;" onclick="document.getElementById('image-input').click();" onmouseover="this.style.borderColor='#4DA528'" onmouseout="this.style.borderColor='#ddd'">
                        <input type="file" name="image" id="image-input" accept="image/*" required style="display:none;" onchange="previewImage(this)">
                        <div id="upload-placeholder">
                            <i class="icon-Group-81" style="font-size:30px;color:#999;display:block;margin-bottom:8px;"></i>
                            <p style="margin:0;color:#999;font-size:13px;">Click to upload image</p>
                            <p style="margin:4px 0 0;color:#bbb;font-size:11px;">JPG, PNG, WebP (max 2MB)</p>
                        </div>
                        <img id="image-preview" src="#" alt="Preview" style="display:none;max-width:100%;max-height:200px;border-radius:6px;">
                    </div>
                    <button type="button" onclick="openGalleryPicker(function(selected){ document.getElementById('gallery-selected-path').value=selected[0].path; document.getElementById('image-preview').src=selected[0].url; document.getElementById('image-preview').style.display='block'; document.getElementById('upload-placeholder').style.display='none'; }, 'single')" style="margin-top:8px;background:#f1f1f1;color:#666;padding:8px 16px;border-radius:8px;border:none;cursor:pointer;font-size:12px;font-weight:600;">Or pick from gallery</button>
                    <input type="hidden" name="gallery_selected_path" id="gallery-selected-path">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Price (Rp) *</label>
                    <input type="number" name="price" value="{{ old('price') }}" min="0" required style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Discount Price (Rp)</label>
                    <input type="number" name="discount_price" value="{{ old('discount_price') }}" min="0" style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Duration Days *</label>
                    <input type="number" name="duration_days" value="{{ old('duration_days', 1) }}" min="1" required style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Duration Nights *</label>
                    <input type="number" name="duration_nights" value="{{ old('duration_nights', 0) }}" min="0" required style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Max Participants *</label>
                    <input type="number" name="max_participants" value="{{ old('max_participants', 10) }}" min="1" required style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Location *</label>
                    <input type="text" name="location" value="{{ old('location') }}" required style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">City *</label>
                    <input type="text" name="city" value="{{ old('city', 'Yogyakarta') }}" required style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Asal Negara</label>
                    <input type="text" name="asal_negara" value="{{ old('asal_negara') }}" placeholder="e.g. Indonesia, Japan, Singapore" style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Category *</label>
                    <select name="category" required style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                        <option value="Adventure" {{ old('category') == 'Adventure' ? 'selected' : '' }}>Adventure</option>
                        <option value="Cultural" {{ old('category') == 'Cultural' ? 'selected' : '' }}>Cultural</option>
                        <option value="Nature" {{ old('category') == 'Nature' ? 'selected' : '' }}>Nature</option>
                        <option value="City Tour" {{ old('category') == 'City Tour' ? 'selected' : '' }}>City Tour</option>
                        <option value="Beach" {{ old('category') == 'Beach' ? 'selected' : '' }}>Beach</option>
                        <option value="Spiritual" {{ old('category') == 'Spiritual' ? 'selected' : '' }}>Spiritual</option>
                    </select>
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Tag</label>
                    <input type="text" name="tag" value="{{ old('tag') }}" placeholder="e.g. Bestseller, Popular" style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Rating</label>
                    <input type="number" name="rating" value="{{ old('rating', 5.00) }}" step="0.01" min="0" max="5" style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Review Count</label>
                    <input type="number" name="review_count" value="{{ old('review_count', 0) }}" min="0" style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
            </div>

            <div style="margin-top:20px;">
                <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Short Description</label>
                <textarea name="short_description" class="wysiwyg">{{ old('short_description') }}</textarea>
            </div>

            <div style="margin-top:20px;">
                <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Description *</label>
                <textarea name="description" class="wysiwyg" required>{{ old('description') }}</textarea>
            </div>

            <div style="margin-top:20px;display:flex;gap:30px;">
                <label style="display:flex;align-items:center;gap:8px;font-size:14px;font-weight:600;color:#081E2A;cursor:pointer;">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} style="width:18px;height:18px;accent-color:#4DA528;">
                    Featured
                </label>
                <label style="display:flex;align-items:center;gap:8px;font-size:14px;font-weight:600;color:#081E2A;cursor:pointer;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} style="width:18px;height:18px;accent-color:#4DA528;">
                    Active
                </label>
            </div>

            <div style="margin-top:30px;display:flex;gap:12px;">
                <button type="submit" style="background:#4DA528;color:#fff;padding:12px 30px;border-radius:8px;border:none;cursor:pointer;font-size:15px;font-weight:600;">Create Package</button>
                <a href="{{ route('admin.packages.index') }}" style="background:#eee;color:#666;padding:12px 30px;border-radius:8px;text-decoration:none;font-size:15px;font-weight:600;">Cancel</a>
            </div>
        </form>
    </div>
</section>

@include('admin._gallery_picker')

<script>
function previewImage(input) {
    var preview = document.getElementById('image-preview');
    var placeholder = document.getElementById('upload-placeholder');
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            if (placeholder) placeholder.style.display = 'none';
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
