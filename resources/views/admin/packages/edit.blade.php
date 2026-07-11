@extends('layouts.dashboard')

@section('title', 'Edit Package - Dashboard')

@section('content')
<section class="profile-dashboard">
    <div class="inner-header mb-40">
        <h3 class="title">Edit Package</h3>
        <p class="des">Update tour package: {{ $tour->name }}</p>
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

        <form action="{{ route('admin.packages.update', $tour) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Package Name *</label>
                    <input type="text" name="name" value="{{ old('name', $tour->name) }}" required style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Image</label>
                    <div id="upload-area" style="border:2px dashed #ddd;border-radius:8px;padding:15px;text-align:center;cursor:pointer;position:relative;transition:all 0.3s;background:#fafafa;" onclick="document.getElementById('image-input').click();" onmouseover="this.style.borderColor='#4DA528'" onmouseout="this.style.borderColor='#ddd'">
                        <input type="file" name="image" id="image-input" accept="image/*" style="display:none;" onchange="previewImage(this)">
                        <img id="image-preview" src="{{ str_starts_with($tour->image, 'tours/') ? asset('storage/'.$tour->image) : asset($tour->image) }}" alt="Preview" style="max-width:100%;max-height:200px;border-radius:6px;">
                        <p id="change-text" style="margin:8px 0 0;color:#999;font-size:12px;">Click to change image</p>
                    </div>
                    <button type="button" onclick="openGalleryPicker(function(selected){ document.getElementById('gallery-selected-path').value=selected[0].path; document.getElementById('image-preview').src=selected[0].url; document.getElementById('image-preview').style.display='block'; }, 'single')" style="margin-top:8px;background:#f1f1f1;color:#666;padding:8px 16px;border-radius:8px;border:none;cursor:pointer;font-size:12px;font-weight:600;">Or pick from gallery</button>
                    <input type="hidden" name="gallery_selected_path" id="gallery-selected-path">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Price (Rp) *</label>
                    <input type="number" name="price" value="{{ old('price', $tour->price) }}" min="0" required style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Discount Price (Rp)</label>
                    <input type="number" name="discount_price" value="{{ old('discount_price', $tour->discount_price) }}" min="0" style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Duration Days *</label>
                    <input type="number" name="duration_days" value="{{ old('duration_days', $tour->duration_days) }}" min="1" required style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Duration Nights *</label>
                    <input type="number" name="duration_nights" value="{{ old('duration_nights', $tour->duration_nights) }}" min="0" required style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Max Participants *</label>
                    <input type="number" name="max_participants" value="{{ old('max_participants', $tour->max_participants) }}" min="1" required style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Location *</label>
                    <input type="text" name="location" value="{{ old('location', $tour->location) }}" required style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">City *</label>
                    <input type="text" name="city" value="{{ old('city', $tour->city) }}" required style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Asal Negara</label>
                    <input type="text" name="asal_negara" value="{{ old('asal_negara', $tour->asal_negara) }}" placeholder="e.g. Indonesia, Japan, Singapore" style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Category *</label>
                    <select name="category" required style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                        @foreach(['Adventure','Cultural','Nature','City Tour','Beach','Spiritual'] as $cat)
                            <option value="{{ $cat }}" {{ old('category', $tour->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Tag</label>
                    <input type="text" name="tag" value="{{ old('tag', $tour->tag) }}" style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Rating</label>
                    <input type="number" name="rating" value="{{ old('rating', $tour->rating) }}" step="0.01" min="0" max="5" style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Review Count</label>
                    <input type="number" name="review_count" value="{{ old('review_count', $tour->review_count) }}" min="0" style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
            </div>

            <div style="margin-top:20px;">
                <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Short Description</label>
                <textarea name="short_description" class="wysiwyg">{{ old('short_description', $tour->short_description) }}</textarea>
            </div>

            <div style="margin-top:20px;">
                <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Description *</label>
                <textarea name="description" class="wysiwyg" required>{{ old('description', $tour->description) }}</textarea>
            </div>

            <div style="margin-top:20px;display:flex;gap:30px;">
                <label style="display:flex;align-items:center;gap:8px;font-size:14px;font-weight:600;color:#081E2A;cursor:pointer;">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $tour->is_featured) ? 'checked' : '' }} style="width:18px;height:18px;accent-color:#4DA528;">
                    Featured
                </label>
                <label style="display:flex;align-items:center;gap:8px;font-size:14px;font-weight:600;color:#081E2A;cursor:pointer;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $tour->is_active) ? 'checked' : '' }} style="width:18px;height:18px;accent-color:#4DA528;">
                    Active
                </label>
            </div>

            <div style="margin-top:30px;display:flex;gap:12px;">
                <button type="submit" style="background:#4DA528;color:#fff;padding:12px 30px;border-radius:8px;border:none;cursor:pointer;font-size:15px;font-weight:600;">Update Package</button>
                <a href="{{ route('admin.packages.index') }}" style="background:#eee;color:#666;padding:12px 30px;border-radius:8px;text-decoration:none;font-size:15px;font-weight:600;">Cancel</a>
            </div>
        </form>
    </div>
</section>

@include('admin._gallery_picker')

<script>
function previewImage(input) {
    var preview = document.getElementById('image-preview');
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
