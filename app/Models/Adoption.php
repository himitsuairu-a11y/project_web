<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adoption extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cat_id',
        'applicant_name',
        'applicant_address',
        'salary_slip_path',
        'identity_card_path',
        'adoption_reason',
        'status',
        'order_code',
        'pickup_datetime',
    ];

    protected function casts(): array
    {
        return [
            'status' => \App\Enums\AdoptionStatus::class,
            'pickup_datetime' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cat()
    {
        return $this->belongsTo(Cat::class);
    }
}
