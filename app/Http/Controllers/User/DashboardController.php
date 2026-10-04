<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $adoptions = $user->adoptions()->with('cat')->latest()->get();
        
        $totalAdoptions = $adoptions->count();
        $approvedAdoptions = $adoptions->where('status', \App\Enums\AdoptionStatus::APPROVED)->count();
        $pendingAdoptions = $adoptions->where('status', \App\Enums\AdoptionStatus::PENDING)->count();

        return view('user.dashboard.index', compact(
            'user', 
            'adoptions', 
            'totalAdoptions', 
            'approvedAdoptions', 
            'pendingAdoptions'
        ));
    }
}
