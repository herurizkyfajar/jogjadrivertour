<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MyTour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MyTourController extends Controller
{
    private static $countryCodes = [
        'Afghanistan'=>'AF','Albania'=>'AL','Algeria'=>'DZ','Andorra'=>'AD','Angola'=>'AO',
        'Antigua and Barbuda'=>'AG','Argentina'=>'AR','Armenia'=>'AM','Australia'=>'AU','Austria'=>'AT',
        'Azerbaijan'=>'AZ','Bahamas'=>'BS','Bahrain'=>'BH','Bangladesh'=>'BD','Barbados'=>'BB',
        'Belarus'=>'BY','Belgium'=>'BE','Belize'=>'BZ','Benin'=>'BJ','Bhutan'=>'BT',
        'Bolivia'=>'BO','Bosnia and Herzegovina'=>'BA','Botswana'=>'BW','Brazil'=>'BR','Brunei'=>'BN',
        'Bulgaria'=>'BG','Burkina Faso'=>'BF','Burundi'=>'BI','Cambodia'=>'KH','Cameroon'=>'CM',
        'Canada'=>'CA','Cape Verde'=>'CV','Central African Republic'=>'CF','Chad'=>'TD','Chile'=>'CL',
        'China'=>'CN','Colombia'=>'CO','Comoros'=>'KM','Congo'=>'CG','Costa Rica'=>'CR',
        'Croatia'=>'HR','Cuba'=>'CU','Cyprus'=>'CY','Czech Republic'=>'CZ','Denmark'=>'DK',
        'Djibouti'=>'DJ','Dominica'=>'DM','Dominican Republic'=>'DO','East Timor'=>'TL','Ecuador'=>'EC',
        'Egypt'=>'EG','El Salvador'=>'SV','Equatorial Guinea'=>'GQ','Eritrea'=>'ER','Estonia'=>'EE',
        'Ethiopia'=>'ET','Fiji'=>'FJ','Finland'=>'FI','France'=>'FR','Gabon'=>'GA',
        'Gambia'=>'GM','Georgia'=>'GE','Germany'=>'DE','Ghana'=>'GH','Greece'=>'GR',
        'Grenada'=>'GD','Guatemala'=>'GT','Guinea'=>'GN','Guinea-Bissau'=>'GW','Guyana'=>'GY',
        'Haiti'=>'HT','Honduras'=>'HN','Hungary'=>'HU','Iceland'=>'IS','India'=>'IN',
        'Indonesia'=>'ID','Iran'=>'IR','Iraq'=>'IQ','Ireland'=>'IE','Israel'=>'IL',
        'Italy'=>'IT','Ivory Coast'=>'CI','Jamaica'=>'JM','Japan'=>'JP','Jordan'=>'JO',
        'Kazakhstan'=>'KZ','Kenya'=>'KE','Kiribati'=>'KI','Kosovo'=>'XK','Kuwait'=>'KW',
        'Kyrgyzstan'=>'KG','Laos'=>'LA','Latvia'=>'LV','Lebanon'=>'LB','Lesotho'=>'LS',
        'Liberia'=>'LR','Libya'=>'LY','Liechtenstein'=>'LI','Lithuania'=>'LT','Luxembourg'=>'LU',
        'Madagascar'=>'MG','Malawi'=>'MW','Malaysia'=>'MY','Maldives'=>'MV','Mali'=>'ML',
        'Malta'=>'MT','Marshall Islands'=>'MH','Mauritania'=>'MR','Mauritius'=>'MU','Mexico'=>'MX',
        'Micronesia'=>'FM','Moldova'=>'MD','Monaco'=>'MC','Mongolia'=>'MN','Montenegro'=>'ME',
        'Morocco'=>'MA','Mozambique'=>'MZ','Myanmar'=>'MM','Namibia'=>'NA','Nauru'=>'NR',
        'Nepal'=>'NP','Netherlands'=>'NL','New Zealand'=>'NZ','Nicaragua'=>'NI','Niger'=>'NE',
        'Nigeria'=>'NG','North Korea'=>'KP','North Macedonia'=>'MK','Norway'=>'NO','Oman'=>'OM',
        'Pakistan'=>'PK','Palau'=>'PW','Palestine'=>'PS','Panama'=>'PA','Papua New Guinea'=>'PG',
        'Paraguay'=>'PY','Peru'=>'PE','Philippines'=>'PH','Poland'=>'PL','Portugal'=>'PT',
        'Qatar'=>'QA','Romania'=>'RO','Russia'=>'RU','Rwanda'=>'RW','Saint Kitts and Nevis'=>'KN',
        'Saint Lucia'=>'LC','Saint Vincent and the Grenadines'=>'VC','Samoa'=>'WS','San Marino'=>'SM',
        'Sao Tome and Principe'=>'ST','Saudi Arabia'=>'SA','Senegal'=>'SN','Serbia'=>'RS',
        'Seychelles'=>'SC','Sierra Leone'=>'SL','Singapore'=>'SG','Slovakia'=>'SK','Slovenia'=>'SI',
        'Solomon Islands'=>'SB','Somalia'=>'SO','South Africa'=>'ZA','South Korea'=>'KR',
        'South Sudan'=>'SS','Spain'=>'ES','Sri Lanka'=>'LK','Sudan'=>'SD','Suriname'=>'SR',
        'Sweden'=>'SE','Switzerland'=>'CH','Syria'=>'SY','Taiwan'=>'TW','Tajikistan'=>'TJ',
        'Tanzania'=>'TZ','Thailand'=>'TH','Togo'=>'TG','Tonga'=>'TO','Trinidad and Tobago'=>'TT',
        'Tunisia'=>'TN','Turkey'=>'TR','Turkmenistan'=>'TM','Tuvalu'=>'TV','Uganda'=>'UG',
        'Ukraine'=>'UA','United Arab Emirates'=>'AE','United Kingdom'=>'GB','United States'=>'US',
        'Uruguay'=>'UY','Uzbekistan'=>'UZ','Vanuatu'=>'VU','Vatican City'=>'VA','Venezuela'=>'VE',
        'Vietnam'=>'VN','Yemen'=>'YE','Zambia'=>'ZM','Zimbabwe'=>'ZW',
    ];

    public static function countryFlag($country)
    {
        $code = self::$countryCodes[$country] ?? null;
        if (!$code) return '🏳';
        $a = ord('A');
        return mb_chr(0x1F1E6 + ord($code[0]) - $a) . mb_chr(0x1F1E6 + ord($code[1]) - $a);
    }

    public static function countryCode($country)
    {
        return self::$countryCodes[$country] ?? null;
    }

    public function index()
    {
        $myTours = MyTour::latest()->paginate(10);
        return view('admin.my-tours.index', compact('myTours'));
    }

    public function create()
    {
        return view('admin.my-tours.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'negara_asal' => 'required|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('my-tours', 'public');
        }

        MyTour::create($validated);

        return redirect()->route('admin.my-tours.index')->with('success', 'My Tour created successfully.');
    }

    public function edit(MyTour $myTour)
    {
        return view('admin.my-tours.edit', compact('myTour'));
    }

    public function update(Request $request, MyTour $myTour)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'negara_asal' => 'required|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            if ($myTour->image && Storage::disk('public')->exists($myTour->image)) {
                Storage::disk('public')->delete($myTour->image);
            }
            $validated['image'] = $request->file('image')->store('my-tours', 'public');
        } else {
            unset($validated['image']);
        }

        $myTour->update($validated);

        return redirect()->route('admin.my-tours.index')->with('success', 'My Tour updated successfully.');
    }

    public function destroy(MyTour $myTour)
    {
        if ($myTour->image && Storage::disk('public')->exists($myTour->image)) {
            Storage::disk('public')->delete($myTour->image);
        }
        $myTour->delete();
        return redirect()->route('admin.my-tours.index')->with('success', 'My Tour deleted successfully.');
    }
}
