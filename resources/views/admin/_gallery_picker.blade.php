<!-- Gallery Picker Modal -->
<div id="gallery-picker-modal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.6);z-index:10000;overflow-y:auto;">
    <div style="background:#fff;border-radius:16px;max-width:900px;margin:40px auto;padding:0;overflow:hidden;">
        <div style="display:flex;justify-content:space-between;align-items:center;padding:20px 24px;border-bottom:1px solid #eee;">
            <h3 style="margin:0;font-size:18px;color:#081E2A;">Image Gallery</h3>
            <button onclick="closeGalleryPicker()" style="background:none;border:none;font-size:24px;cursor:pointer;color:#999;">&times;</button>
        </div>
        <div style="padding:16px 24px;border-bottom:1px solid #eee;display:flex;gap:12px;align-items:center;">
            <input type="text" id="gallery-search" placeholder="Search images..." oninput="filterGallery()" style="flex:1;padding:10px 14px;border:1px solid #ddd;border-radius:8px;font-size:14px;">
            <select id="gallery-folder" onchange="filterGallery()" style="padding:10px 14px;border:1px solid #ddd;border-radius:8px;font-size:14px;background:#fff;">
                <option value="">All Folders</option>
                <option value="destinations">Destinations</option>
                <option value="tours">Tours</option>
                <option value="blogs">Blogs</option>
                <option value="template">Template</option>
            </select>
        </div>
        <div id="gallery-grid" style="display:grid;grid-template-columns:repeat(4,1fr);gap:10px;padding:20px 24px;max-height:500px;overflow-y:auto;">
            <p style="grid-column:span 4;text-align:center;color:#999;padding:30px;">Loading images...</p>
        </div>
        <div id="gallery-selected-info" style="padding:16px 24px;border-top:1px solid #eee;display:none;background:#f9f9f9;">
            <div style="display:flex;justify-content:space-between;align-items:center;">
                <span id="gallery-selected-text" style="font-size:14px;color:#666;"></span>
                <button onclick="confirmGallerySelection()" style="background:#4DA528;color:#fff;padding:10px 24px;border-radius:8px;border:none;cursor:pointer;font-weight:600;font-size:14px;">Use Selected</button>
            </div>
        </div>
    </div>
</div>

<style>
.gallery-item { position:relative; cursor:pointer; border-radius:8px; overflow:hidden; border:3px solid transparent; transition:all 0.2s; aspect-ratio:1; }
.gallery-item:hover { border-color:#4DA528; transform:scale(1.03); }
.gallery-item.selected { border-color:#4DA528; box-shadow:0 0 0 3px rgba(77,165,40,0.3); }
.gallery-item img { width:100%; height:100%; object-fit:cover; }
.gallery-item .gallery-check { display:none; position:absolute; top:6px; right:6px; background:#4DA528; color:#fff; width:24px; height:24px; border-radius:50%; align-items:center; justify-content:center; font-size:14px; font-weight:bold; }
.gallery-item.selected .gallery-check { display:flex; }
.gallery-item .gallery-name { position:absolute; bottom:0; left:0; right:0; background:linear-gradient(transparent,rgba(0,0,0,0.7)); color:#fff; padding:6px 8px; font-size:10px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
</style>

<script>
var galleryPickerData = [];
var galleryPickerCallback = null;
var galleryPickerMode = 'single'; // 'single' or 'multi'
var galleryPickerSelected = [];

function openGalleryPicker(callback, mode) {
    galleryPickerCallback = callback;
    galleryPickerMode = mode || 'single';
    galleryPickerSelected = [];
    document.getElementById('gallery-picker-modal').style.display = 'block';
    document.getElementById('gallery-selected-info').style.display = 'none';
    document.body.style.overflow = 'hidden';

    if (galleryPickerData.length === 0) {
        fetch('{{ route("admin.gallery-picker") }}')
            .then(function(r) { return r.json(); })
            .then(function(data) {
                galleryPickerData = data;
                renderGallery(data);
            });
    } else {
        renderGallery(galleryPickerData);
    }
}

function closeGalleryPicker() {
    document.getElementById('gallery-picker-modal').style.display = 'none';
    document.body.style.overflow = '';
}

function renderGallery(images) {
    var grid = document.getElementById('gallery-grid');
    if (images.length === 0) {
        grid.innerHTML = '<p style="grid-column:span 4;text-align:center;color:#999;padding:30px;">No images found.</p>';
        return;
    }
    var html = '';
    images.forEach(function(img, i) {
        html += '<div class="gallery-item" data-index="' + i + '" onclick="toggleGalleryItem(this)" data-path="' + img.path + '" data-url="' + img.url + '" data-name="' + img.name + '">';
        html += '<img src="' + img.url + '" alt="' + img.name + '" loading="lazy">';
        html += '<div class="gallery-check">&#10003;</div>';
        html += '<div class="gallery-name">' + img.name + '</div>';
        html += '</div>';
    });
    grid.innerHTML = html;
}

function filterGallery() {
    var search = document.getElementById('gallery-search').value.toLowerCase();
    var folder = document.getElementById('gallery-folder').value;
    var filtered = galleryPickerData.filter(function(img) {
        var matchSearch = !search || img.name.toLowerCase().indexOf(search) > -1 || img.path.toLowerCase().indexOf(search) > -1;
        var matchFolder = !folder || img.folder.indexOf(folder) > -1;
        return matchSearch && matchFolder;
    });
    renderGallery(filtered);
}

function toggleGalleryItem(el) {
    if (galleryPickerMode === 'single') {
        document.querySelectorAll('.gallery-item.selected').forEach(function(item) {
            item.classList.remove('selected');
        });
        el.classList.add('selected');
        galleryPickerSelected = [{ path: el.dataset.path, url: el.dataset.url, name: el.dataset.name }];
    } else {
        el.classList.toggle('selected');
        galleryPickerSelected = [];
        document.querySelectorAll('.gallery-item.selected').forEach(function(item) {
            galleryPickerSelected.push({ path: item.dataset.path, url: item.dataset.url, name: item.dataset.name });
        });
    }
    var info = document.getElementById('gallery-selected-info');
    var text = document.getElementById('gallery-selected-text');
    if (galleryPickerSelected.length > 0) {
        info.style.display = 'block';
        text.textContent = galleryPickerSelected.length + ' image(s) selected';
    } else {
        info.style.display = 'none';
    }
}

function confirmGallerySelection() {
    if (galleryPickerCallback && galleryPickerSelected.length > 0) {
        galleryPickerCallback(galleryPickerSelected);
    }
    closeGalleryPicker();
}
</script>
