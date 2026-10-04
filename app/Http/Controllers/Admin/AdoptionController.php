<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Adoption;
use App\Services\AdoptionService;
use Illuminate\Http\Request;

class AdoptionController extends Controller
{
    public function __construct(private AdoptionService $adoptionService)
    {
    }

    public function index()
    {
        $adoptions = Adoption::with(['user', 'cat'])->latest()->get();
        return view('admin.adoptions.index', compact('adoptions'));
    }

    public function approve(Request $request, Adoption $adoption)
    {
        $request->validate([
            'pickup_datetime' => ['required', 'date'],
        ]);

        $this->adoptionService->approveAdoption($adoption->id, $request->pickup_datetime);

        return back()->with('success', 'Adoption approved successfully.');
    }

    public function reject(Adoption $adoption)
    {
        $this->adoptionService->rejectAdoption($adoption->id);

        return back()->with('success', 'Adoption rejected.');
    }
}
