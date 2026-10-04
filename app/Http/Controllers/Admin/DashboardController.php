<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdoptionService;
use App\Models\Cat;
use App\Models\Adoption;
use App\Enums\CatStatus;
use App\Enums\AdoptionStatus;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    public function __construct(private AdoptionService $adoptionService)
    {
    }

    public function index()
    {
        $totalCats = Cat::count();
        $availableCats = Cat::where('status', CatStatus::AVAILABLE->value)->count();
        $pendingAdoptions = Adoption::where('status', AdoptionStatus::PENDING->value)->count();

        return view('admin.dashboard', compact('totalCats', 'availableCats', 'pendingAdoptions'));
    }

    public function downloadReport()
    {
        $data = $this->adoptionService->getReportSummary();
        
        $pdf = Pdf::loadView('admin.reports.pdf', $data);
        return $pdf->download('laporan-adopsi-kucing.pdf');
    }
}
