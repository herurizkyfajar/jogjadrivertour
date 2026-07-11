@extends('layouts.dashboard')

@section('title', 'Edit My Tour - Dashboard')

@section('content')
<section class="profile-dashboard">
    <div class="inner-header mb-40">
        <h3 class="title">Edit My Tour</h3>
        <p class="des">Edit riwayat perjalanan klien</p>
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

        <form action="{{ route('admin.my-tours.update', $myTour) }}" method="POST" enctype="multipart/form-data" id="tour-form">
            @csrf
            @method('PUT')
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Foto</label>
                    <div id="upload-area" style="border:2px dashed #ddd;border-radius:8px;padding:15px;text-align:center;cursor:pointer;position:relative;transition:all 0.3s;background:#fafafa;" onclick="document.getElementById('image-input').click();" onmouseover="this.style.borderColor='#4DA528'" onmouseout="this.style.borderColor='#ddd'">
                        <input type="file" name="image" id="image-input" accept="image/*" style="display:none;" onchange="handleImageSelect(this)">
                        <img id="image-preview" src="{{ str_starts_with($myTour->image, 'my-tours/') ? asset('storage/'.$myTour->image) : asset($myTour->image) }}" alt="Preview" style="max-width:100%;max-height:200px;border-radius:6px;">
                        <p id="change-text" style="margin:8px 0 0;color:#999;font-size:12px;">Click to change image</p>
                    </div>
                    <input type="hidden" name="cropped_image" id="cropped-image">
                    <button type="button" onclick="openGalleryPicker(function(selected){ document.getElementById('gallery-selected-path').value=selected[0].path; document.getElementById('image-preview').src=selected[0].url; }, 'single')" style="margin-top:8px;background:#f1f1f1;color:#666;padding:8px 16px;border-radius:8px;border:none;cursor:pointer;font-size:12px;font-weight:600;">Or pick from gallery</button>
                    <input type="hidden" name="gallery_selected_path" id="gallery-selected-path">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Negara Asal *</label>
                    <div class="searchable-select" style="position:relative;">
                        <input type="text" id="country-search-edit" placeholder="Search country..." value="{{ old('negara_asal', $myTour->negara_asal) }}" style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;" oninput="filterCountries('edit')">
                        <div id="country-list-edit" style="max-height:200px;overflow-y:auto;border:1px solid #ddd;border-top:none;border-radius:0 0 8px 8px;display:none;background:#fff;position:absolute;width:100%;z-index:100;"></div>
                    </div>
                    <input type="hidden" name="negara_asal" id="negara_asal_edit" value="{{ old('negara_asal', $myTour->negara_asal) }}">
                </div>
            </div>

            <div style="margin-top:30px;display:flex;gap:12px;">
                <button type="submit" style="background:#4DA528;color:#fff;padding:12px 30px;border-radius:8px;border:none;cursor:pointer;font-size:15px;font-weight:600;">Update My Tour</button>
                <a href="{{ route('admin.my-tours.index') }}" style="background:#eee;color:#666;padding:12px 30px;border-radius:8px;text-decoration:none;font-size:15px;font-weight:600;">Cancel</a>
            </div>
        </form>
    </div>
</section>

<div id="crop-modal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.7);z-index:10000;justify-content:center;align-items:center;">
    <div style="background:#fff;border-radius:16px;width:90%;max-width:600px;display:flex;flex-direction:column;overflow:hidden;">
        <div style="padding:16px 20px;border-bottom:1px solid #eee;display:flex;justify-content:space-between;align-items:center;">
            <h4 style="margin:0;font-size:16px;color:#081E2A;">Crop Image</h4>
            <p style="margin:0;font-size:12px;color:#999;">Aspect ratio 4:3</p>
        </div>
        <div style="padding:20px;background:#f5f5f5;">
            <div id="crop-container" style="position:relative;max-height:400px;overflow:hidden;background:#000;user-select:none;-webkit-user-select:none;">
                <img id="crop-image" src="" style="display:block;max-width:100%;pointer-events:none;" draggable="false">
            </div>
            <div style="margin-top:12px;display:flex;align-items:center;gap:12px;">
                <label style="font-size:12px;color:#666;">Zoom:</label>
                <input type="range" id="crop-zoom" min="1" max="3" step="0.1" value="1" style="flex:1;" oninput="zoomCrop(this.value)">
                <label style="font-size:12px;color:#666;">Rotate:</label>
                <input type="range" id="crop-rotate" min="-180" max="180" step="1" value="0" style="flex:1;" oninput="rotateCrop(this.value)">
            </div>
        </div>
        <div style="padding:16px 20px;border-top:1px solid #eee;display:flex;gap:10px;justify-content:flex-end;">
            <button onclick="cancelCrop()" style="background:#eee;color:#666;padding:10px 24px;border-radius:8px;border:none;cursor:pointer;font-size:14px;font-weight:600;">Cancel</button>
            <button onclick="applyCrop()" style="background:#4DA528;color:#fff;padding:10px 24px;border-radius:8px;border:none;cursor:pointer;font-size:14px;font-weight:600;">Apply Crop</button>
        </div>
    </div>
</div>

@include('admin._gallery_picker')

<script>
const countries = ["Afghanistan","Albania","Algeria","Andorra","Angola","Antigua and Barbuda","Argentina","Armenia","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bhutan","Bolivia","Bosnia and Herzegovina","Botswana","Brazil","Brunei","Bulgaria","Burkina Faso","Burundi","Cabo Verde","Cambodia","Cameroon","Canada","Central African Republic","Chad","Chile","China","Colombia","Comoros","Congo","Costa Rica","Croatia","Cuba","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","East Timor","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Eswatini","Ethiopia","Fiji","Finland","France","Gabon","Gambia","Georgia","Germany","Ghana","Greece","Grenada","Guatemala","Guinea","Guinea-Bissau","Guyana","Haiti","Honduras","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Israel","Italy","Ivory Coast","Jamaica","Japan","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Morocco","Mozambique","Myanmar","Namibia","Nauru","Nepal","Netherlands","New Zealand","Nicaragua","Niger","Nigeria","North Korea","North Macedonia","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Qatar","Romania","Russia","Rwanda","Saint Kitts and Nevis","Saint Lucia","Saint Vincent and the Grenadines","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","Sudan","Suriname","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Togo","Tonga","Trinidad and Tobago","Tunisia","Turkey","Turkmenistan","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Yemen","Zambia","Zimbabwe"];

let cropZoom = 1;
let cropRotate = 0;
let cropTranslateX = 0;
let cropTranslateY = 0;
let isDragging = false;
let startX, startY;

function renderCountryList(type) {
    var list = document.getElementById('country-list-' + type);
    var search = document.getElementById('country-search-' + type).value.toLowerCase();
    var selected = document.getElementById('negara_asal_' + type).value;
    var filtered = countries.filter(function(c) { return c.toLowerCase().indexOf(search) > -1; });
    var html = '';
    filtered.forEach(function(c) {
        var bg = c === selected ? '#e6f7e6' : '#fff';
        html += '<div style="padding:10px 16px;cursor:pointer;background:' + bg + ';border-bottom:1px solid #f5f5f5;" onmouseover="this.style.background=\'#f5f5f5\'" onmouseout="this.style.background=\'' + bg + '\'" onclick="selectCountry(\'' + type + '\', \'' + c.replace(/'/g, "\\'") + '\')">' + c + '</div>';
    });
    list.innerHTML = html || '<div style="padding:10px 16px;color:#999;">No results found</div>';
    list.style.display = 'block';
}

function filterCountries(type) {
    renderCountryList(type);
}

function selectCountry(type, country) {
    document.getElementById('negara_asal_' + type).value = country;
    document.getElementById('country-search-' + type).value = country;
    document.getElementById('country-list-' + type).style.display = 'none';
}

document.addEventListener('click', function(e) {
    if (!e.target.closest('.searchable-select')) {
        document.getElementById('country-list-edit').style.display = 'none';
    }
});

document.getElementById('country-search-edit').addEventListener('focus', function() {
    renderCountryList('edit');
});

function handleImageSelect(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            openCropModal(e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function openCropModal(imageSrc) {
    var modal = document.getElementById('crop-modal');
    var cropImg = document.getElementById('crop-image');
    cropImg.src = imageSrc;
    modal.style.display = 'flex';

    cropZoom = 1;
    cropRotate = 0;
    cropTranslateX = 0;
    cropTranslateY = 0;
    document.getElementById('crop-zoom').value = 1;
    document.getElementById('crop-rotate').value = 0;

    updateCropTransform();

    var container = document.getElementById('crop-container');

    container.onmousedown = function(e) {
        e.preventDefault();
        isDragging = true;
        startX = e.clientX - cropTranslateX;
        startY = e.clientY - cropTranslateY;
        container.style.cursor = 'grabbing';
    };

    document.onmousemove = function(e) {
        if (!isDragging) return;
        e.preventDefault();
        cropTranslateX = e.clientX - startX;
        cropTranslateY = e.clientY - startY;
        updateCropTransform();
    };

    document.onmouseup = function() {
        if (isDragging) {
            isDragging = false;
            container.style.cursor = 'grab';
        }
    };

    container.ontouchstart = function(e) {
        e.preventDefault();
        isDragging = true;
        startX = e.touches[0].clientX - cropTranslateX;
        startY = e.touches[0].clientY - cropTranslateY;
    };

    document.ontouchmove = function(e) {
        if (!isDragging) return;
        e.preventDefault();
        cropTranslateX = e.touches[0].clientX - startX;
        cropTranslateY = e.touches[0].clientY - startY;
        updateCropTransform();
    };

    document.ontouchend = function() {
        isDragging = false;
    };

    container.style.cursor = 'grab';
}

function updateCropTransform() {
    var cropImg = document.getElementById('crop-image');
    cropImg.style.transform = 'translate(' + cropTranslateX + 'px, ' + cropTranslateY + 'px) scale(' + cropZoom + ') rotate(' + cropRotate + 'deg)';
    cropImg.style.transformOrigin = 'center center';
}

function zoomCrop(value) {
    cropZoom = parseFloat(value);
    updateCropTransform();
}

function rotateCrop(value) {
    cropRotate = parseFloat(value);
    updateCropTransform();
}

function applyCrop() {
    var cropImg = document.getElementById('crop-image');
    var container = document.getElementById('crop-container');
    var cw = container.clientWidth;
    var ch = container.clientHeight;
    var ow = 800, oh = 600;

    var canvas = document.createElement('canvas');
    canvas.width = ow;
    canvas.height = oh;
    var ctx = canvas.getContext('2d');
    ctx.fillStyle = '#000';
    ctx.fillRect(0, 0, ow, oh);

    var imgAspect = cropImg.naturalWidth / cropImg.naturalHeight;
    var outAspect = ow / oh;
    var drawW, drawH;
    if (imgAspect > outAspect) {
        drawH = oh;
        drawW = oh * imgAspect;
    } else {
        drawW = ow;
        drawH = ow / imgAspect;
    }

    ctx.save();
    ctx.translate(ow / 2 + cropTranslateX * (ow / cw), oh / 2 + cropTranslateY * (oh / ch));
    ctx.rotate(cropRotate * Math.PI / 180);
    ctx.scale(cropZoom, cropZoom);
    ctx.drawImage(cropImg, -drawW / 2, -drawH / 2, drawW, drawH);
    ctx.restore();

    var dataUrl = canvas.toDataURL('image/jpeg', 0.9);
    var preview = document.getElementById('image-preview');
    if (preview) { preview.src = dataUrl; preview.style.display = 'block'; }
    var placeholder = document.getElementById('upload-placeholder');
    if (placeholder) placeholder.style.display = 'none';
    var changeText = document.getElementById('change-text');
    if (changeText) changeText.style.display = 'none';
    document.getElementById('cropped-image').value = dataUrl;

    canvas.toBlob(function(blob) {
        if (blob) {
            var dt = new DataTransfer();
            var file = new File([blob], 'cropped-image.jpg', { type: 'image/jpeg' });
            dt.items.add(file);
            document.getElementById('image-input').files = dt.files;
        }
        closeCropModal();
    }, 'image/jpeg', 0.9);
}

function cancelCrop() {
    document.getElementById('image-input').value = '';
    closeCropModal();
}

function closeCropModal() {
    document.getElementById('crop-modal').style.display = 'none';
}
</script>
@endsection
