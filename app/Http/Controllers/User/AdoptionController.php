<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdoptionRequest;
use App\Services\AdoptionService;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Adoption;

class AdoptionController extends Controller
{
    public function __construct(private AdoptionService $adoptionService)
    {
    }

    public function index()
    {
        $adoptions = Auth::user()->adoptions()->with('cat')->latest()->get();
        return view('user.adoptions.index', compact('adoptions'));
    }

    public function store(StoreAdoptionRequest $request)
    {
        $this->adoptionService->submitAdoption(
            Auth::id(),
            $request->validated()
        );

        return redirect()->route('user.adoptions.index')->with('success', 'Adoption request submitted successfully.');
    }

    public function downloadProof(Adoption $adoption)
    {
        // Ensure user can only download their own approved adoptions
        if ($adoption->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($adoption->status->value !== \App\Enums\AdoptionStatus::APPROVED->value) {
            abort(403, 'Surat adopsi hanya tersedia untuk pengajuan yang telah disetujui.');
        }

        $pdf = Pdf::loadView('pdf.adoption_proof', compact('adoption'));
        
        return $pdf->download('Surat_Adopsi_' . $adoption->cat->name . '_' . time() . '.pdf');
    }
}
