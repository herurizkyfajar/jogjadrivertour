@extends('layouts.dashboard')

@section('title', 'Contact Info - Dashboard')

@section('content')
<section class="profile-dashboard">
    <div class="inner-header mb-40">
        <h3 class="title">Contact Information</h3>
        <p class="des">Manage phone, email, and address displayed on the website</p>
    </div>

    @if(session('success'))
        <div style="background:#e8f5e9;color:#2e7d32;padding:12px 20px;border-radius:8px;margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="wg-box">
        <form action="{{ route('admin.contact.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid-input-2" style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Phone Number 1</label>
                    <input type="text" name="phone1" value="{{ $contact['phone1'] }}" placeholder="+62 812 3456 7890" style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Phone Number 2</label>
                    <input type="text" name="phone2" value="{{ $contact['phone2'] }}" placeholder="+62 856 1234 5678" style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
            </div>

            <div class="grid-input-2" style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-top:20px;">
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Email Address 1</label>
                    <input type="email" name="email1" value="{{ $contact['email1'] }}" placeholder="info@jogadrivertour.com" style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Email Address 2</label>
                    <input type="email" name="email2" value="{{ $contact['email2'] }}" placeholder="booking@jogadrivertour.com" style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
            </div>

            <div style="margin-top:20px;">
                <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">WhatsApp Number</label>
                <input type="text" name="whatsapp" value="{{ $contact['whatsapp'] }}" placeholder="6281234567890 (without + or spaces)" style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                <p style="margin:6px 0 0;color:#999;font-size:12px;">Used for WhatsApp chat button. Format: country code + number (e.g. 6281234567890)</p>
            </div>

            <div style="margin-top:20px;">
                <label style="display:block;font-weight:600;font-size:14px;color:#081E2A;margin-bottom:8px;">Address</label>
                <textarea name="address" rows="3" placeholder="Jl. Malioboro No. 123, Yogyakarta, Indonesia" style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;resize:vertical;">{{ $contact['address'] }}</textarea>
            </div>

            <button type="submit" style="background:#4DA528;color:#fff;padding:12px 30px;border-radius:8px;border:none;cursor:pointer;font-size:15px;font-weight:600;margin-top:24px;">Save Contact Info</button>
        </form>
    </div>
</section>
@endsection
