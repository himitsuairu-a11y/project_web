<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdoptionService;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function __construct(private AdoptionService $adoptionService)
    {
    }

    public function index()
    {
        return view('admin.verifications.index');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'order_code' => ['required', 'string'],
        ]);

        $success = $this->adoptionService->verifyOrderCode($request->order_code);

        if ($success) {
            return back()->with('success', 'Verifikasi berhasil. Kucing telah resmi diadopsi!');
        }

        return back()->withErrors(['order_code' => 'Kode pesanan tidak ditemukan atau adopsi belum disetujui.']);
    }
}
