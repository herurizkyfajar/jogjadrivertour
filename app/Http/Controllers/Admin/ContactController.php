<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contact = [
            'phone1' => Setting::get('contact_phone1', ''),
            'phone2' => Setting::get('contact_phone2', ''),
            'email1' => Setting::get('contact_email1', ''),
            'email2' => Setting::get('contact_email2', ''),
            'address' => Setting::get('contact_address', ''),
            'whatsapp' => Setting::get('contact_whatsapp', ''),
        ];
        return view('admin.contact.index', compact('contact'));
    }

    public function update(Request $request)
    {
        Setting::set('contact_phone1', $request->phone1);
        Setting::set('contact_phone2', $request->phone2);
        Setting::set('contact_email1', $request->email1);
        Setting::set('contact_email2', $request->email2);
        Setting::set('contact_address', $request->address);
        Setting::set('contact_whatsapp', $request->whatsapp);

        return redirect()->route('admin.contact.index')->with('success', 'Contact information updated successfully.');
    }
}
