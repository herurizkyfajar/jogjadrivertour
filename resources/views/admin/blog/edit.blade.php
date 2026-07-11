@extends('layouts.dashboard')

@section('title', 'Edit Blog Post - Dashboard')

@section('content')
<section class="profile-dashboard">
    <div class="inner-header mb-40">
        <h3 class="title">Edit Blog Post</h3>
        <p class="des">Update blog post: {{ $blog->title }}</p>
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

        <form action="{{ route('admin.blog.update', $blog) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Title *</label>
                    <input type="text" name="title" value="{{ old('title', $blog->title) }}" required style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Category *</label>
                    <select name="category" required style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                        @foreach(['Travel','Adventure','Culture','Food','Tips','News'] as $cat)
                            <option value="{{ $cat }}" {{ old('category', $blog->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Image</label>
                    <div id="upload-area" style="border:2px dashed #ddd;border-radius:8px;padding:15px;text-align:center;cursor:pointer;transition:all 0.3s;background:#fafafa;" onclick="document.getElementById('image-input').click();" onmouseover="this.style.borderColor='#4DA528'" onmouseout="this.style.borderColor='#ddd'">
                        <input type="file" name="image" id="image-input" accept="image/*" style="display:none;" onchange="previewImage(this, 'image-preview')">
                        @if(str_starts_with($blog->image, 'blogs/'))
                            <img id="image-preview" src="{{ asset('storage/'.$blog->image) }}" alt="Preview" style="max-width:100%;max-height:200px;border-radius:6px;">
                        @else
                            <img id="image-preview" src="{{ asset($blog->image) }}" alt="Preview" style="max-width:100%;max-height:200px;border-radius:6px;">
                        @endif
                        <p style="margin:8px 0 0;color:#999;font-size:12px;">Click to change image</p>
                    </div>
                    <button type="button" onclick="openGalleryPicker(function(selected){ document.getElementById('gallery-selected-path').value=selected[0].path; document.getElementById('image-preview').src=selected[0].url; document.getElementById('image-preview').style.display='block'; }, 'single')" style="margin-top:8px;background:#f1f1f1;color:#666;padding:8px 16px;border-radius:8px;border:none;cursor:pointer;font-size:12px;font-weight:600;">Or pick from gallery</button>
                    <input type="hidden" name="gallery_selected_path" id="gallery-selected-path">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Author Name</label>
                    <input type="text" name="author_name" value="{{ old('author_name', $blog->author_name) }}" style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Author Avatar</label>
                    <div style="border:2px dashed #ddd;border-radius:8px;padding:15px;text-align:center;cursor:pointer;transition:all 0.3s;background:#fafafa;" onclick="document.getElementById('avatar-input').click();" onmouseover="this.style.borderColor='#4DA528'" onmouseout="this.style.borderColor='#ddd'">
                        <input type="file" name="author_avatar" id="avatar-input" accept="image/*" style="display:none;" onchange="previewImage(this, 'avatar-preview')">
                        @if($blog->author_avatar)
                            @if(str_starts_with($blog->author_avatar, 'blogs/'))
                                <img id="avatar-preview" src="{{ asset('storage/'.$blog->author_avatar) }}" alt="Preview" style="width:80px;height:80px;object-fit:cover;border-radius:50%;">
                            @else
                                <img id="avatar-preview" src="{{ asset($blog->author_avatar) }}" alt="Preview" style="width:80px;height:80px;object-fit:cover;border-radius:50%;">
                            @endif
                        @else
                            <div id="avatar-placeholder">
                                <i class="icon-Group-81" style="font-size:24px;color:#999;display:block;margin-bottom:6px;"></i>
                                <p style="margin:0;color:#999;font-size:12px;">Upload avatar (optional)</p>
                            </div>
                            <img id="avatar-preview" src="#" alt="Preview" style="display:none;width:80px;height:80px;object-fit:cover;border-radius:50%;">
                        @endif
                    </div>
                </div>
            </div>

            <div style="margin-top:20px;">
                <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Excerpt</label>
                <textarea name="excerpt" class="wysiwyg">{{ old('excerpt', $blog->excerpt) }}</textarea>
            </div>

            <div style="margin-top:20px;">
                <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Content *</label>
                <textarea name="content" class="wysiwyg" required>{{ old('content', $blog->content) }}</textarea>
            </div>

            <div style="margin-top:20px;display:flex;gap:30px;">
                <label style="display:flex;align-items:center;gap:8px;font-size:14px;font-weight:600;color:#081E2A;cursor:pointer;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $blog->is_active) ? 'checked' : '' }} style="width:18px;height:18px;accent-color:#4DA528;">
                    Active
                </label>
            </div>

            <div style="margin-top:30px;display:flex;gap:12px;">
                <button type="submit" style="background:#4DA528;color:#fff;padding:12px 30px;border-radius:8px;border:none;cursor:pointer;font-size:15px;font-weight:600;">Update Blog Post</button>
                <a href="{{ route('admin.blog.index') }}" style="background:#eee;color:#666;padding:12px 30px;border-radius:8px;text-decoration:none;font-size:15px;font-weight:600;">Cancel</a>
            </div>
        </form>
    </div>
</section>

@include('admin._gallery_picker')

<script>
function previewImage(input, previewId) {
    var preview = document.getElementById(previewId);
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
