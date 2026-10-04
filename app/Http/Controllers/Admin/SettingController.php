<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $wa_number = Setting::get('wa_number', '');
        $wa_message = Setting::get('wa_message', '');
        return view('admin.settings.index', compact('wa_number', 'wa_message'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'wa_number' => 'required|string',
            'wa_message' => 'required|string',
        ]);

        $wa_number = ltrim($request->wa_number, '0');
        if (!str_starts_with($wa_number, '62')) {
            $wa_number = '62' . $wa_number;
        }

        Setting::set('wa_number', $wa_number);
        Setting::set('wa_message', $request->wa_message);

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
