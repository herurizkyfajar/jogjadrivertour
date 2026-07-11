@extends('layouts.dashboard')

@section('title', 'Add Blog Post - Dashboard')

@section('content')
<section class="profile-dashboard">
    <div class="inner-header mb-40">
        <h3 class="title">Add New Blog Post</h3>
        <p class="des">Create a new blog article</p>
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

        <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Title *</label>
                    <input type="text" name="title" value="{{ old('title') }}" required style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Category *</label>
                    <select name="category" required style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                        <option value="Travel" {{ old('category') == 'Travel' ? 'selected' : '' }}>Travel</option>
                        <option value="Adventure" {{ old('category') == 'Adventure' ? 'selected' : '' }}>Adventure</option>
                        <option value="Culture" {{ old('category') == 'Culture' ? 'selected' : '' }}>Culture</option>
                        <option value="Food" {{ old('category') == 'Food' ? 'selected' : '' }}>Food</option>
                        <option value="Tips" {{ old('category') == 'Tips' ? 'selected' : '' }}>Tips</option>
                        <option value="News" {{ old('category') == 'News' ? 'selected' : '' }}>News</option>
                    </select>
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Image *</label>
                    <div id="upload-area" style="border:2px dashed #ddd;border-radius:8px;padding:20px;text-align:center;cursor:pointer;transition:all 0.3s;" onclick="document.getElementById('image-input').click();" onmouseover="this.style.borderColor='#4DA528'" onmouseout="this.style.borderColor='#ddd'">
                        <input type="file" name="image" id="image-input" accept="image/*" required style="display:none;" onchange="previewImage(this, 'image-preview', 'upload-placeholder')">
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
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Author Name</label>
                    <input type="text" name="author_name" value="{{ old('author_name', 'Admin') }}" style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Author Avatar</label>
                    <div style="border:2px dashed #ddd;border-radius:8px;padding:15px;text-align:center;cursor:pointer;transition:all 0.3s;background:#fafafa;" onclick="document.getElementById('avatar-input').click();" onmouseover="this.style.borderColor='#4DA528'" onmouseout="this.style.borderColor='#ddd'">
                        <input type="file" name="author_avatar" id="avatar-input" accept="image/*" style="display:none;" onchange="previewImage(this, 'avatar-preview', 'avatar-placeholder')">
                        <div id="avatar-placeholder">
                            <i class="icon-Group-81" style="font-size:24px;color:#999;display:block;margin-bottom:6px;"></i>
                            <p style="margin:0;color:#999;font-size:12px;">Upload avatar (optional)</p>
                        </div>
                        <img id="avatar-preview" src="#" alt="Preview" style="display:none;width:80px;height:80px;object-fit:cover;border-radius:50%;">
                    </div>
                </div>
            </div>

            <div style="margin-top:20px;">
                <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Excerpt</label>
                <textarea name="excerpt" class="wysiwyg">{{ old('excerpt') }}</textarea>
            </div>

            <div style="margin-top:20px;">
                <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Content *</label>
                <textarea name="content" class="wysiwyg" required>{{ old('content') }}</textarea>
            </div>

            <div style="margin-top:20px;display:flex;gap:30px;">
                <label style="display:flex;align-items:center;gap:8px;font-size:14px;font-weight:600;color:#081E2A;cursor:pointer;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} style="width:18px;height:18px;accent-color:#4DA528;">
                    Active
                </label>
            </div>

            <div style="margin-top:30px;display:flex;gap:12px;">
                <button type="submit" style="background:#4DA528;color:#fff;padding:12px 30px;border-radius:8px;border:none;cursor:pointer;font-size:15px;font-weight:600;">Create Blog Post</button>
                <a href="{{ route('admin.blog.index') }}" style="background:#eee;color:#666;padding:12px 30px;border-radius:8px;text-decoration:none;font-size:15px;font-weight:600;">Cancel</a>
            </div>
        </form>
    </div>
</section>

@include('admin._gallery_picker')

<script>
function previewImage(input, previewId, placeholderId) {
    var preview = document.getElementById(previewId);
    var placeholder = document.getElementById(placeholderId);
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
