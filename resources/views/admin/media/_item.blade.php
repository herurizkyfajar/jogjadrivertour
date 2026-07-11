<div class="media-item" data-path="{{ $img['path'] }}" style="border:2px solid #eee;border-radius:12px;overflow:hidden;transition:all 0.2s;background:#fff;position:relative;">
    <label class="media-checkbox" style="position:absolute;top:8px;left:8px;z-index:2;cursor:pointer;width:24px;height:24px;background:#fff;border:2px solid #ccc;border-radius:4px;display:flex;align-items:center;justify-content:center;transition:all 0.2s;" onclick="toggleMediaCheck(this)">
        <span class="media-check-icon" style="display:none;color:#fff;font-size:14px;font-weight:bold;line-height:1;">&#10003;</span>
        <input type="checkbox" class="media-check" value="{{ $img['path'] }}" onchange="updateBulkBtn()" style="display:none;">
    </label>
    <div style="aspect-ratio:1;overflow:hidden;background:#f5f5f5;">
        <img src="{{ $img['url'] }}" alt="{{ $img['name'] }}" style="width:100%;height:100%;object-fit:cover;" loading="lazy">
    </div>
    <div style="padding:10px;">
        <p style="margin:0;font-size:12px;font-weight:600;color:#081E2A;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="{{ $img['name'] }}">{{ $img['name'] }}</p>
        <p style="margin:4px 0 0;font-size:11px;color:#999;">{{ number_format($img['size'] / 1024, 1) }} KB &middot; {{ ucfirst(explode('/', $img['folder'])[0]) }}</p>
        <div style="margin-top:8px;display:flex;gap:6px;">
            <a href="{{ $img['url'] }}" target="_blank" style="flex:1;text-align:center;background:#e6f7e6;color:#4DA528;padding:6px;border-radius:6px;font-size:11px;font-weight:600;text-decoration:none;">View</a>
            <form action="{{ route('admin.media.destroy') }}" method="POST" style="flex:1;" onsubmit="return confirm('Delete this image?')">
                @csrf
                @method('DELETE')
                <input type="hidden" name="path" value="{{ $img['path'] }}">
                <input type="hidden" name="folder" value="{{ $folder ?? '' }}">
                <input type="hidden" name="search" value="{{ $search ?? '' }}">
                <button type="submit" style="width:100%;background:#fde8e8;color:#e74c3c;padding:6px;border-radius:6px;font-size:11px;font-weight:600;border:none;cursor:pointer;">Delete</button>
            </form>
        </div>
    </div>
</div>
