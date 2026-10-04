<?php

namespace App\Services;

use App\Models\Adoption;
use App\Enums\AdoptionStatus;
use Illuminate\Support\Str;

class AdoptionService
{
    public function submitAdoption(int $userId, array $data)
    {
        $identityCardPath = $data['identity_card']->store('documents', 'public');
        $salarySlipPath = $data['salary_slip']->store('documents', 'public');

        return Adoption::create([
            'user_id' => $userId,
            'cat_id' => $data['cat_id'],
            'applicant_name' => $data['applicant_name'],
            'applicant_address' => $data['applicant_address'],
            'salary_slip_path' => $salarySlipPath,
            'identity_card_path' => $identityCardPath,
            'adoption_reason' => $data['reason'],
            'status' => AdoptionStatus::PENDING->value,
            // order_code and pickup_datetime are left null
        ]);
    }

    public function approveAdoption(int $adoptionId, string $pickupDatetime)
    {
        $adoption = Adoption::findOrFail($adoptionId);
        
        $adoption->update([
            'status' => AdoptionStatus::APPROVED->value,
            'order_code' => 'ADPT-' . strtoupper(Str::random(8)),
            'pickup_datetime' => $pickupDatetime,
        ]);

        return $adoption;
    }

    public function rejectAdoption(int $adoptionId)
    {
        $adoption = Adoption::findOrFail($adoptionId);

        $adoption->update([
            'status' => AdoptionStatus::REJECTED->value,
        ]);

        return $adoption;
    }

    public function verifyOrderCode(string $orderCode)
    {
        $adoption = Adoption::where('order_code', $orderCode)
            ->where('status', AdoptionStatus::APPROVED->value)
            ->first();

        if (!$adoption) {
            return false;
        }

        // Ubah status adopsi jadi completed
        $adoption->update([
            'status' => AdoptionStatus::COMPLETED->value,
        ]);

        // Ubah status kucing jadi adopted
        $adoption->cat->update([
            'status' => \App\Enums\CatStatus::ADOPTED->value,
        ]);

        return true;
    }

    public function getReportSummary()
    {
        $totalCats = \App\Models\Cat::count();
        $adoptedCats = \App\Models\Cat::where('status', \App\Enums\CatStatus::ADOPTED->value)->count();
        $completedAdoptions = Adoption::with(['user', 'cat'])
            ->where('status', AdoptionStatus::COMPLETED->value)
            ->latest()
            ->get();

        return compact('totalCats', 'adoptedCats', 'completedAdoptions');
    }
}
