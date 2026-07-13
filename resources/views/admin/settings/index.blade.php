@extends('layouts.dashboard')

@section('title', 'Settings - Dashboard')

@push('styles')
<style>
.cc-box{position:relative;display:flex;align-items:center;gap:8px;padding:7px 10px;border-radius:6px;cursor:pointer;font-size:13px;transition:background .15s;border:1px solid transparent;user-select:none;}
.cc-box:hover{background:#f5f5f5;}
.cc-box input{position:absolute;opacity:0;width:0;height:0;}
.cc-check{width:18px;height:18px;border:2px solid #ccc;border-radius:4px;display:flex;align-items:center;justify-content:center;transition:all .15s;flex-shrink:0;}
.cc-box input:checked~.cc-check{background:#4DA528;border-color:#4DA528;}
.cc-check::after{content:'';width:5px;height:9px;border:solid #fff;border-width:0 2px 2px 0;transform:rotate(45deg) translate(-1px,-1px);opacity:0;transition:opacity .15s;}
.cc-box input:checked~.cc-check::after{opacity:1;}
.cc-box input:checked~.cc-text{color:#081E2A;font-weight:600;}
</style>
@endpush

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

@php $visitedCountries = json_decode($settings['visited_countries'] ?? '[]', true) ?: []; @endphp

<div style="background:#fff;border:1px solid #eee;border-radius:12px;padding:25px;margin-bottom:20px;">
    <h4 style="font-size:16px;font-weight:700;color:#081E2A;margin:0 0 6px;">Map: Visited Countries</h4>
    <p style="margin:0 0 16px;color:#999;font-size:13px;">Select which countries to highlight on the homepage world map (green color).</p>

    <div style="margin-bottom:12px;">
        <input type="text" id="country-search" placeholder="Search country..." onkeyup="filterCountries()" style="width:100%;max-width:350px;padding:10px 14px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
    </div>

    <div style="margin-bottom:10px;">
        <button type="button" onclick="toggleAllCountries(true)" style="background:#e8f5e9;color:#2e7d32;padding:6px 14px;border:1px solid #c8e6c9;border-radius:6px;cursor:pointer;font-size:12px;font-weight:600;">Select All</button>
        <button type="button" onclick="toggleAllCountries(false)" style="background:#ffebee;color:#c62828;padding:6px 14px;border:1px solid #ffcdd2;border-radius:6px;cursor:pointer;font-size:12px;font-weight:600;margin-left:6px;">Deselect All</button>
    </div>

    <div id="country-list" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:6px;max-height:400px;overflow-y:auto;border:1px solid #eee;border-radius:8px;padding:12px;">
        @php
        $allCountries = [
            'Afghanistan','Albania','Algeria','Andorra','Angola','Antigua and Barbuda','Argentina','Armenia','Australia','Austria',
            'Azerbaijan','Bahamas','Bahrain','Bangladesh','Barbados','Belarus','Belgium','Belize','Benin','Bhutan',
            'Bolivia','Bosnia and Herzegovina','Botswana','Brazil','Brunei','Bulgaria','Burkina Faso','Burundi','Cambodia','Cameroon',
            'Canada','Cape Verde','Central African Republic','Chad','Chile','China','Colombia','Comoros','Congo','Costa Rica',
            'Croatia','Cuba','Cyprus','Czech Republic','Denmark','Djibouti','Dominica','Dominican Republic','East Timor','Ecuador',
            'Egypt','El Salvador','Equatorial Guinea','Eritrea','Estonia','Ethiopia','Fiji','Finland','France','Gabon',
            'Gambia','Georgia','Germany','Ghana','Greece','Grenada','Guatemala','Guinea','Guinea-Bissau','Guyana',
            'Haiti','Honduras','Hungary','Iceland','India','Indonesia','Iran','Iraq','Ireland','Israel',
            'Italy','Ivory Coast','Jamaica','Japan','Jordan','Kazakhstan','Kenya','Kiribati','Kosovo','Kuwait',
            'Kyrgyzstan','Laos','Latvia','Lebanon','Lesotho','Liberia','Libya','Liechtenstein','Lithuania','Luxembourg',
            'Madagascar','Malawi','Malaysia','Maldives','Mali','Malta','Marshall Islands','Mauritania','Mauritius','Mexico',
            'Micronesia','Moldova','Monaco','Mongolia','Montenegro','Morocco','Mozambique','Myanmar','Namibia','Nauru',
            'Nepal','Netherlands','New Zealand','Nicaragua','Niger','Nigeria','North Korea','North Macedonia','Norway','Oman',
            'Pakistan','Palau','Palestine','Panama','Papua New Guinea','Paraguay','Peru','Philippines','Poland','Portugal',
            'Qatar','Romania','Russia','Rwanda','Saint Kitts and Nevis','Saint Lucia','Saint Vincent and the Grenadines','Samoa','San Marino','Sao Tome and Principe',
            'Saudi Arabia','Senegal','Serbia','Seychelles','Sierra Leone','Singapore','Slovakia','Slovenia','Solomon Islands','Somalia',
            'South Africa','South Korea','Spain','Sri Lanka','Sudan','Suriname','Sweden','Switzerland','Syria','Taiwan',
            'Tajikistan','Tanzania','Thailand','Togo','Tonga','Trinidad and Tobago','Tunisia','Turkey','Turkmenistan','Tuvalu',
            'Uganda','Ukraine','United Arab Emirates','United Kingdom','United States','Uruguay','Uzbekistan','Vanuatu','Vatican City','Venezuela',
            'Vietnam','Yemen','Zambia','Zimbabwe'
        ];
        @endphp
        @foreach($allCountries as $country)
        <label class="cc-box">
            <input type="checkbox" name="visited_countries[]" value="{{ $country }}" {{ in_array($country, $visitedCountries) ? 'checked' : '' }}>
            <span class="cc-check"></span>
            <span class="cc-text">{{ $country }}</span>
        </label>
        @endforeach
    </div>
    <p id="country-count" style="margin:10px 0 0;color:#4DA528;font-size:13px;font-weight:600;"></p>
</div>

<button type="submit" style="background:#4DA528;color:#fff;padding:12px 30px;border-radius:8px;border:none;cursor:pointer;font-size:15px;font-weight:600;">Save Settings</button>
        </form>
    </div>
</section>

<script>
function filterCountries() {
    var search = document.getElementById('country-search').value.toLowerCase();
    var items = document.querySelectorAll('.cc-box');
    items.forEach(function(item) {
        var text = item.textContent.toLowerCase();
        item.style.display = text.indexOf(search) !== -1 ? '' : 'none';
    });
}

function toggleAllCountries(state) {
    var items = document.querySelectorAll('.cc-box input[type="checkbox"]');
    items.forEach(function(cb) {
        var item = cb.closest('.cc-box');
        if (item.style.display !== 'none') {
            cb.checked = state;
        }
    });
    updateCountryCount();
}

function updateCountryCount() {
    var checked = document.querySelectorAll('.cc-box input[type="checkbox"]:checked').length;
    document.getElementById('country-count').textContent = checked + ' countries selected for map highlighting';
}

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.cc-box input[type="checkbox"]').forEach(function(cb) {
        cb.addEventListener('change', updateCountryCount);
    });
    updateCountryCount();
});

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
