@extends('layouts.dashboard')

@section('title', 'Media Library - Dashboard')

@section('content')
<section class="profile-dashboard">
    <div class="inner-header mb-40">
        <h3 class="title">Media Library</h3>
        <p class="des">Manage all uploaded images across the website</p>
    </div>

    @if(session('success'))
        <div style="background:#4DA528;color:#fff;padding:12px 20px;border-radius:8px;margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div style="background:#e74c3c;color:#fff;padding:12px 20px;border-radius:8px;margin-bottom:20px;">
            {{ session('error') }}
        </div>
    @endif

    <div class="wg-box">
        <!-- Toolbar -->
        <div style="display:flex;gap:12px;margin-bottom:20px;flex-wrap:wrap;align-items:center;">
            <form method="GET" action="{{ route('admin.media.index') }}" style="display:flex;gap:8px;flex:1;align-items:center;">
                <input type="text" name="search" value="{{ $search }}" placeholder="Search images..." style="flex:1;padding:10px 14px;border:1px solid #ddd;border-radius:8px;font-size:14px;">
                @if($folder)
                    <input type="hidden" name="folder" value="{{ $folder }}">
                @endif
                <button type="submit" style="background:#4DA528;color:#fff;padding:10px 20px;border-radius:8px;border:none;cursor:pointer;font-weight:600;font-size:14px;">Search</button>
                @if($search || $folder)
                    <a href="{{ route('admin.media.index') }}" style="background:#eee;color:#666;padding:10px 16px;border-radius:8px;text-decoration:none;font-weight:600;font-size:14px;">Clear</a>
                @endif
            </form>
            <div style="display:flex;gap:8px;align-items:center;">
                <span id="image-count" style="font-size:14px;color:#666;">{{ count($images) }} / {{ $total }} images</span>
                <button type="button" id="bulk-delete-btn" onclick="submitBulkDelete()" style="background:#e74c3c;color:#fff;padding:10px 20px;border-radius:8px;border:none;cursor:pointer;font-weight:600;font-size:14px;display:none;">Delete Selected (<span id="selected-count">0</span>)</button>
            </div>
        </div>

        <!-- Folder Tabs -->
        <div style="display:flex;gap:8px;margin-bottom:20px;flex-wrap:wrap;">
            <a href="{{ route('admin.media.index', ['search' => $search]) }}" style="padding:6px 16px;border-radius:20px;font-size:13px;font-weight:600;text-decoration:none;{{ !$folder ? 'background:#4DA528;color:#fff;' : 'background:#f1f1f1;color:#666;' }}">All ({{ array_sum($folders) }})</a>
            @foreach($folders as $name => $count)
                <a href="{{ route('admin.media.index', ['folder' => $name, 'search' => $search]) }}" style="padding:6px 16px;border-radius:20px;font-size:13px;font-weight:600;text-decoration:none;{{ $folder === $name ? 'background:#4DA528;color:#fff;' : 'background:#f1f1f1;color:#666;' }}">{{ ucfirst($name) }} ({{ $count }})</a>
            @endforeach
        </div>

        <!-- Bulk Delete Form -->
        <form id="bulk-form" method="POST" action="{{ route('admin.media.bulkDelete') }}">
            @csrf
            @method('DELETE')
        </form>

        <!-- Image Grid -->
        @if(count($images) > 0)
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;padding:0 4px;">
            <input type="checkbox" id="select-all" onchange="toggleAll(this)" style="width:18px;height:18px;accent-color:#4DA528;">
            <label for="select-all" style="font-size:13px;color:#666;cursor:pointer;">Select all</label>
        </div>
        @endif

        <div id="media-grid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:16px;">
            @foreach($images as $img)
                @include('admin.media._item', ['img' => $img, 'folder' => $folder, 'search' => $search])
            @endforeach
        </div>

        @if(count($images) === 0)
            <div style="text-align:center;padding:60px;color:#999;">
                <p style="font-size:16px;">No images found.</p>
            </div>
        @endif

        <!-- Load More -->
        @if($hasMore)
        <div id="load-more-wrap" style="text-align:center;padding:30px 0;">
            <button id="load-more-btn" onclick="loadMore()" style="background:#4DA528;color:#fff;padding:12px 36px;border-radius:8px;border:none;cursor:pointer;font-size:14px;font-weight:600;">Load More</button>
            <p id="loading-text" style="display:none;margin:10px 0 0;color:#999;font-size:13px;">Loading...</p>
        </div>
        @endif
    </div>
</section>

<script>
var currentPage = {{ $page }};
var hasMore = {{ $hasMore ? 'true' : 'false' }};
var folderFilter = '{{ $folder }}';
var searchFilter = '{{ $search }}';

function toggleMediaCheck(label) {
    var cb = label.querySelector('.media-check');
    var icon = label.querySelector('.media-check-icon');
    cb.checked = !cb.checked;
    if (cb.checked) {
        icon.style.display = 'flex';
        label.style.background = '#4DA528';
        label.style.borderColor = '#4DA528';
    } else {
        icon.style.display = 'none';
        label.style.background = '#fff';
        label.style.borderColor = '#ccc';
    }
    updateBulkBtn();
}

function syncCheckboxVisuals() {
    document.querySelectorAll('.media-checkbox').forEach(function(label) {
        var cb = label.querySelector('.media-check');
        var icon = label.querySelector('.media-check-icon');
        if (cb.checked) {
            icon.style.display = 'flex';
            label.style.background = '#4DA528';
            label.style.borderColor = '#4DA528';
        } else {
            icon.style.display = 'none';
            label.style.background = '#fff';
            label.style.borderColor = '#ccc';
        }
    });
}

function toggleAll(source) {
    document.querySelectorAll('.media-check').forEach(function(cb) {
        cb.checked = source.checked;
    });
    syncCheckboxVisuals();
    updateBulkBtn();
}

function updateBulkBtn() {
    var checked = document.querySelectorAll('.media-check:checked').length;
    var btn = document.getElementById('bulk-delete-btn');
    var count = document.getElementById('selected-count');
    btn.style.display = checked > 0 ? 'inline-block' : 'none';
    count.textContent = checked;
    var all = document.querySelectorAll('.media-check').length;
    var selectAll = document.getElementById('select-all');
    if (selectAll) selectAll.checked = (all > 0 && checked === all);
}

function loadMore() {
    var btn = document.getElementById('load-more-btn');
    var txt = document.getElementById('loading-text');
    btn.style.display = 'none';
    txt.style.display = 'block';

    currentPage++;
    var url = '{{ route("admin.media.index") }}?page=' + currentPage;
    if (folderFilter) url += '&folder=' + encodeURIComponent(folderFilter);
    if (searchFilter) url += '&search=' + encodeURIComponent(searchFilter);

    fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            var grid = document.getElementById('media-grid');
            data.images.forEach(function(img) {
                grid.insertAdjacentHTML('beforeend', buildItem(img));
            });

            var shown = document.querySelectorAll('.media-item').length;
            document.getElementById('image-count').textContent = shown + ' / ' + data.total + ' images';

            if (data.hasMore) {
                btn.style.display = 'inline-block';
                txt.style.display = 'none';
            } else {
                var wrap = document.getElementById('load-more-wrap');
                if (wrap) wrap.style.display = 'none';
            }
        });
}

function buildItem(img) {
    var folderParam = folderFilter ? '&folder=' + encodeURIComponent(folderFilter) : '';
    var searchParam = searchFilter ? '&search=' + encodeURIComponent(searchFilter) : '';
    var sizeKb = (img.size / 1024).toFixed(1);
    var folderName = img.folder.split('/')[0];
    return '<div class="media-item" data-path="' + img.path + '" style="border:2px solid #eee;border-radius:12px;overflow:hidden;transition:all 0.2s;background:#fff;position:relative;">' +
        '<label class="media-checkbox" style="position:absolute;top:8px;left:8px;z-index:2;cursor:pointer;width:24px;height:24px;background:#fff;border:2px solid #ccc;border-radius:4px;display:flex;align-items:center;justify-content:center;transition:all 0.2s;" onclick="toggleMediaCheck(this)">' +
            '<span class="media-check-icon" style="display:none;color:#fff;font-size:14px;font-weight:bold;line-height:1;">&#10003;</span>' +
            '<input type="checkbox" class="media-check" value="' + img.path + '" onchange="updateBulkBtn()" style="display:none;">' +
        '</label>' +
        '<div style="aspect-ratio:1;overflow:hidden;background:#f5f5f5;">' +
            '<img src="' + img.url + '" alt="' + img.name + '" style="width:100%;height:100%;object-fit:cover;" loading="lazy">' +
        '</div>' +
        '<div style="padding:10px;">' +
            '<p style="margin:0;font-size:12px;font-weight:600;color:#081E2A;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="' + img.name + '">' + img.name + '</p>' +
            '<p style="margin:4px 0 0;font-size:11px;color:#999;">' + sizeKb + ' KB &middot; ' + folderName.charAt(0).toUpperCase() + folderName.slice(1) + '</p>' +
            '<div style="margin-top:8px;display:flex;gap:6px;">' +
                '<a href="' + img.url + '" target="_blank" style="flex:1;text-align:center;background:#e6f7e6;color:#4DA528;padding:6px;border-radius:6px;font-size:11px;font-weight:600;text-decoration:none;">View</a>' +
                '<form action="{{ route("admin.media.destroy") }}" method="POST" style="flex:1;" onsubmit="return confirm(\'Delete this image?\')">' +
                    '@csrf' +
                    '@method("DELETE")' +
                    '<input type="hidden" name="path" value="' + img.path + '">' +
                    '<button type="submit" style="width:100%;background:#fde8e8;color:#e74c3c;padding:6px;border-radius:6px;font-size:11px;font-weight:600;border:none;cursor:pointer;">Delete</button>' +
                '</form>' +
            '</div>' +
        '</div>' +
    '</div>';
}

function submitBulkDelete() {
    var checked = document.querySelectorAll('.media-check:checked');
    if (checked.length === 0) return;
    if (!confirm('Delete ' + checked.length + ' selected image(s)?')) return;
    var form = document.getElementById('bulk-form');
    checked.forEach(function(cb) {
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'paths[]';
        input.value = cb.value;
        form.appendChild(input);
    });
    @if($folder)
    var f = document.createElement('input');
    f.type = 'hidden'; f.name = 'folder'; f.value = '{{ $folder }}';
    form.appendChild(f);
    @endif
    @if($search)
    var s = document.createElement('input');
    s.type = 'hidden'; s.name = 'search'; s.value = '{{ $search }}';
    form.appendChild(s);
    @endif
    form.submit();
}
</script>

<style>
.media-item:hover { border-color:#4DA528; box-shadow:0 4px 12px rgba(0,0,0,0.1); }
</style>
@endsection
