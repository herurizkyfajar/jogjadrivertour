@extends('layouts.dashboard')

@section('title', 'Settings - Dashboard')

@section('content')
<section class="profile-dashboard">
    <div class="inner-header mb-40">
        <h3 class="title">Settings</h3>
        <p class="des">Manage site settings</p>
    </div>

    @if(session('success'))
        <div style="background:#e8f5e9;color:#2e7d32;padding:12px 20px;border-radius:8px;margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="wg-box">
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="margin-bottom:20px;">
                <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Instagram Profile URL</label>
                <input type="url" name="instagram_url" value="{{ $settings['instagram_url'] }}" placeholder="https://www.instagram.com/username" style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                <p style="margin:6px 0 0;color:#999;font-size:12px;">Enter your Instagram profile URL. Footer will show a "Follow Instagram" button.</p>
            </div>

            <div style="margin-bottom:20px;">
                <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Instagram Gallery Images (max 6)</label>
                <p style="margin:6px 0 10px;color:#999;font-size:12px;">Upload images for the footer gallery. If no images are uploaded, the original gallery images will be shown. These images will display in a grid with a "Follow Instagram" button below.</p>

                @php $instagramImages = json_decode($settings['instagram_images'] ?? '[]', true) ?: []; @endphp
                <div id="instagram-images-list" style="display:flex;flex-wrap:wrap;gap:10px;margin-bottom:12px;">
                    @foreach($instagramImages as $index => $img)
                        <div class="ig-img-item" style="position:relative;width:120px;height:120px;border-radius:8px;overflow:hidden;border:1px solid #ddd;">
                            <img src="{{ asset('storage/' . $img) }}" style="width:100%;height:100%;object-fit:cover;" alt="">
                            <button type="button" onclick="removeIgImage({{ $index }}, this)" style="position:absolute;top:4px;right:4px;width:24px;height:24px;border-radius:50%;background:rgba(0,0,0,.6);color:#fff;border:none;cursor:pointer;font-size:14px;line-height:24px;text-align:center;">&times;</button>
                            <input type="hidden" name="existing_instagram_images[]" value="{{ $img }}">
                        </div>
                    @endforeach
                </div>

                <input type="file" name="instagram_images[]" id="ig-image-input" accept="image/*" multiple style="display:none;" onchange="previewIgImages(this)">
                <button type="button" onclick="document.getElementById('ig-image-input').click()" style="background:#f0f0f0;color:#333;padding:10px 20px;border:2px dashed #ccc;border-radius:8px;cursor:pointer;font-size:14px;">+ Add Images</button>
                <div id="ig-preview" style="display:flex;flex-wrap:wrap;gap:10px;margin-top:10px;"></div>
            </div>

            <button type="submit" style="background:#4DA528;color:#fff;padding:12px 30px;border-radius:8px;border:none;cursor:pointer;font-size:15px;font-weight:600;">Save Settings</button>
        </form>
    </div>
</section>

<script>
function previewIgImages(input) {
    var preview = document.getElementById('ig-preview');
    preview.innerHTML = '';
    Array.from(input.files).forEach(function(file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var div = document.createElement('div');
            div.style.cssText = 'width:120px;height:120px;border-radius:8px;overflow:hidden;border:1px solid #ddd;';
            div.innerHTML = '<img src="' + e.target.result + '" style="width:100%;height:100%;object-fit:cover;" alt="">';
            preview.appendChild(div);
        };
        reader.readAsDataURL(file);
    });
}

function removeIgImage(index, btn) {
    var item = btn.closest('.ig-img-item');
    var removedInput = document.createElement('input');
    removedInput.type = 'hidden';
    removedInput.name = 'removed_instagram_images[]';
    removedInput.value = item.querySelector('input').value;
    btn.closest('form').appendChild(removedInput);
    item.remove();
}
</script>
@endsection
