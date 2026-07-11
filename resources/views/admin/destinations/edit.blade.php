@extends('layouts.dashboard')

@section('title', 'Edit Destination - Dashboard')

@section('content')
<section class="profile-dashboard">
    <div class="inner-header mb-40">
        <h3 class="title">Edit Destination</h3>
        <p class="des">Update destination: {{ $destination->name }}</p>
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

        <form action="{{ route('admin.destinations.update', $destination) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Name *</label>
                    <input type="text" name="name" value="{{ old('name', $destination->name) }}" required style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Image</label>
                    <div id="upload-area" style="border:2px dashed #ddd;border-radius:8px;padding:15px;text-align:center;cursor:pointer;transition:all 0.3s;background:#fafafa;" onclick="document.getElementById('image-input').click();" onmouseover="this.style.borderColor='#4DA528'" onmouseout="this.style.borderColor='#ddd'">
                        <input type="file" name="image" id="image-input" accept="image/*" style="display:none;" onchange="previewImage(this)">
                        <img id="image-preview" src="{{ str_starts_with($destination->image, 'destinations/') ? asset('storage/'.$destination->image) : asset($destination->image) }}" alt="Preview" style="max-width:100%;max-height:200px;border-radius:6px;">
                        <p style="margin:8px 0 0;color:#999;font-size:12px;">Click to change image</p>
                    </div>
                    <button type="button" onclick="openGalleryPicker(function(selected){ document.getElementById('gallery-selected-path').value=selected[0].path; document.getElementById('image-preview').src=selected[0].url; document.getElementById('image-preview').style.display='block'; }, 'single')" style="margin-top:8px;background:#f1f1f1;color:#666;padding:8px 16px;border-radius:8px;border:none;cursor:pointer;font-size:12px;font-weight:600;">Or pick from gallery</button>
                    <input type="hidden" name="gallery_selected_path" id="gallery-selected-path">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Location *</label>
                    <input type="text" name="location" value="{{ old('location', $destination->location) }}" required style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">City *</label>
                    <select name="city" required style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;background:#fff;">
                        <option value="">Select City</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->name }}" {{ old('city', $destination->city) == $city->name ? 'selected' : '' }}>{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Rating</label>
                    <input type="number" name="rating" value="{{ old('rating', $destination->rating) }}" step="0.01" min="0" max="5" style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Tour Count</label>
                    <input type="number" name="tour_count" value="{{ old('tour_count', $destination->tour_count) }}" min="0" style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
            </div>

            <div style="margin-top:20px;">
                <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Short Description</label>
                <textarea name="short_description" class="wysiwyg">{{ old('short_description', $destination->short_description) }}</textarea>
            </div>

            <div style="margin-top:20px;">
                <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Description *</label>
                <textarea name="description" class="wysiwyg" required>{{ old('description', $destination->description) }}</textarea>
            </div>

            <div style="margin-top:20px;">
                <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Google Maps Embed Code</label>
                <textarea name="maps_embed" rows="4" placeholder="Paste Google Maps iframe embed code here..." style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;resize:vertical;font-family:monospace;">{{ old('maps_embed', $destination->maps_embed) }}</textarea>
                <p style="margin:5px 0 0;color:#999;font-size:12px;">Go to Google Maps > Share > Embed a map > Copy the iframe code</p>
                @if($destination->maps_embed)
                    <div style="margin-top:10px;border:1px solid #ddd;border-radius:8px;overflow:hidden;">
                        {!! $destination->maps_embed !!}
                    </div>
                @endif
            </div>

            <div style="margin-top:20px;">
                <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Google Maps Link (for Get Directions button)</label>
                <input type="url" name="maps_link" value="{{ old('maps_link', $destination->maps_link) }}" placeholder="https://www.google.com/maps/..." style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                <p style="margin:5px 0 0;color:#999;font-size:12px;">Go to Google Maps > Share > Copy link. This link will be used for the "Get Directions" button.</p>
            </div>

            <div style="margin-top:20px;">
                <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Gallery Images (Shot Gallery)</label>
                @if($destination->gallery_images && count($destination->gallery_images) > 0)
                    <div id="existing-gallery" style="display:flex;flex-wrap:wrap;gap:10px;margin-bottom:15px;">
                        @foreach($destination->gallery_images as $index => $galleryPath)
                            <div id="gallery-item-{{ $index }}" style="position:relative;width:120px;height:120px;border-radius:8px;overflow:hidden;border:2px solid #ddd;">
                                <img src="{{ str_starts_with($galleryPath, 'destinations/') ? asset('storage/'.$galleryPath) : asset($galleryPath) }}" alt="Gallery" style="width:100%;height:100%;object-fit:cover;">
                                <label style="position:absolute;top:5px;right:5px;cursor:pointer;">
                                    <input type="checkbox" name="delete_gallery[]" value="{{ $index }}" style="display:none;" onchange="toggleDeleteGallery(this)">
                                    <span class="delete-btn" style="display:block;width:24px;height:24px;background:#e74c3c;color:#fff;border-radius:50%;text-align:center;line-height:24px;font-size:14px;">×</span>
                                </label>
                                <span style="position:absolute;bottom:5px;left:5px;background:#4DA528;color:#fff;font-size:10px;padding:2px 6px;border-radius:4px;">WebP</span>
                            </div>
                        @endforeach
                    </div>
                @endif
                <div id="gallery-upload-area" style="border:2px dashed #ddd;border-radius:8px;padding:30px;text-align:center;cursor:pointer;transition:all 0.3s;" onclick="document.getElementById('gallery-input').click();" onmouseover="this.style.borderColor='#4DA528'" onmouseout="this.style.borderColor='#ddd'">
                    <input type="file" name="gallery_images[]" id="gallery-input" accept="image/*" multiple style="display:none;" onchange="previewGallery(this)">
                    <i class="icon-image-gallery-1" style="font-size:40px;color:#999;display:block;margin-bottom:10px;"></i>
                    <p style="margin:0;color:#999;font-size:14px;">Click to add more gallery images</p>
                    <p style="margin:5px 0 0;color:#bbb;font-size:12px;">Select multiple images at once (JPG, PNG, max 5MB each). Images will be converted to WebP automatically.</p>
                </div>
                <button type="button" onclick="openGalleryPickerGallery()" style="margin-top:8px;background:#f1f1f1;color:#666;padding:8px 16px;border-radius:8px;border:none;cursor:pointer;font-size:12px;font-weight:600;">Or pick from gallery</button>
                <div id="gallery-preview" style="display:flex;flex-wrap:wrap;gap:10px;margin-top:15px;"></div>
                <div id="gallery-selected-items" style="display:flex;flex-wrap:wrap;gap:10px;margin-top:10px;"></div>
            </div>

            <div style="margin-top:20px;display:flex;gap:30px;">
                <label style="display:flex;align-items:center;gap:8px;font-size:14px;font-weight:600;color:#081E2A;cursor:pointer;">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $destination->is_featured) ? 'checked' : '' }} style="width:18px;height:18px;accent-color:#4DA528;">
                    Featured
                </label>
                <label style="display:flex;align-items:center;gap:8px;font-size:14px;font-weight:600;color:#081E2A;cursor:pointer;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $destination->is_active) ? 'checked' : '' }} style="width:18px;height:18px;accent-color:#4DA528;">
                    Active
                </label>
            </div>

            <div style="margin-top:30px;display:flex;gap:12px;">
                <button type="submit" style="background:#4DA528;color:#fff;padding:12px 30px;border-radius:8px;border:none;cursor:pointer;font-size:15px;font-weight:600;">Update Destination</button>
                <a href="{{ route('admin.destinations.index') }}" style="background:#eee;color:#666;padding:12px 30px;border-radius:8px;text-decoration:none;font-size:15px;font-weight:600;">Cancel</a>
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

function previewGallery(input) {
    var preview = document.getElementById('gallery-preview');
    preview.innerHTML = '';
    if (input.files) {
        Array.from(input.files).forEach(function(file, index) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var div = document.createElement('div');
                div.style.cssText = 'position:relative;width:120px;height:120px;border-radius:8px;overflow:hidden;';
                var img = document.createElement('img');
                img.src = e.target.result;
                img.style.cssText = 'width:100%;height:100%;object-fit:cover;';
                div.appendChild(img);
                var badge = document.createElement('span');
                badge.style.cssText = 'position:absolute;top:5px;right:5px;background:#4DA528;color:#fff;font-size:10px;padding:2px 6px;border-radius:4px;';
                badge.textContent = 'New';
                div.appendChild(badge);
                preview.appendChild(div);
            }
            reader.readAsDataURL(file);
        });
    }
}

function toggleDeleteGallery(checkbox) {
    var item = document.getElementById('gallery-item-' + checkbox.value);
    if (checkbox.checked) {
        item.style.opacity = '0.3';
        item.style.border = '2px solid #e74c3c';
    } else {
        item.style.opacity = '1';
        item.style.border = '2px solid #ddd';
    }
}

var galleryPickerPaths = [];
function openGalleryPickerGallery() {
    openGalleryPicker(function(selected) {
        var container = document.getElementById('gallery-selected-items');
        selected.forEach(function(img) {
            if (galleryPickerPaths.indexOf(img.path) !== -1) return;
            galleryPickerPaths.push(img.path);
            var div = document.createElement('div');
            div.style.cssText = 'position:relative;width:120px;height:120px;border-radius:8px;overflow:hidden;';
            var imgEl = document.createElement('img');
            imgEl.src = img.url;
            imgEl.style.cssText = 'width:100%;height:100%;object-fit:cover;';
            div.appendChild(imgEl);
            var badge = document.createElement('span');
            badge.style.cssText = 'position:absolute;top:5px;right:5px;background:#f5a623;color:#fff;font-size:10px;padding:2px 6px;border-radius:4px;';
            badge.textContent = 'Gallery';
            div.appendChild(badge);
            var removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.textContent = 'x';
            removeBtn.style.cssText = 'position:absolute;top:5px;left:5px;background:#e74c3c;color:#fff;border:none;width:20px;height:20px;border-radius:50%;cursor:pointer;font-size:12px;display:flex;align-items:center;justify-content:center;';
            removeBtn.onclick = function() {
                var idx = galleryPickerPaths.indexOf(img.path);
                if (idx > -1) galleryPickerPaths.splice(idx, 1);
                div.remove();
            };
            div.appendChild(removeBtn);
            container.appendChild(div);
            var hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'gallery_paths[]';
            hiddenInput.value = img.path;
            container.appendChild(hiddenInput);
        });
    }, 'multi');
}
</script>
@endsection
