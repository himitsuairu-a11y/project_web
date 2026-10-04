<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'breed',
        'age_in_months',
        'condition',
        'photo_path',
        'photos',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'age_in_months' => 'integer',
            'status' => \App\Enums\CatStatus::class,
            'photos' => 'array',
        ];
    }

    public function adoptions()
    {
        return $this->hasMany(Adoption::class);
    }
}
