@extends('layouts.dashboard')

@section('title', 'Edit City - Dashboard')

@section('content')
<section class="profile-dashboard">
    <div class="inner-header mb-40">
        <h3 class="title">Edit City</h3>
        <p class="des">Update city information</p>
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

        <form action="{{ route('admin.cities.update', $city) }}" method="POST">
            @csrf
            @method('PUT')
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">City Name *</label>
                    <input type="text" name="name" value="{{ old('name', $city->name) }}" required style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Status</label>
                    <label style="display:flex;align-items:center;gap:8px;font-size:14px;font-weight:600;color:#081E2A;cursor:pointer;height:42px;">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $city->is_active) ? 'checked' : '' }} style="width:18px;height:18px;accent-color:#4DA528;">
                        Active
                    </label>
                </div>
            </div>

            <div style="margin-top:30px;display:flex;gap:12px;">
                <button type="submit" style="background:#4DA528;color:#fff;padding:12px 30px;border-radius:8px;border:none;cursor:pointer;font-size:15px;font-weight:600;">Update City</button>
                <a href="{{ route('admin.cities.index') }}" style="background:#eee;color:#666;padding:12px 30px;border-radius:8px;text-decoration:none;font-size:15px;font-weight:600;">Cancel</a>
            </div>
        </form>
    </div>
</section>
@endsection
