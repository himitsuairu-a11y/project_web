<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
                'role' => UserRole::ADMIN->value,
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@user.com'],
            [
                'name' => 'Adopter User',
                'password' => bcrypt('password'),
                'role' => UserRole::ADOPTER->value,
            ]
        );

        \App\Models\Setting::updateOrCreate(['key' => 'wa_number'], ['value' => '6281234567890']);
        \App\Models\Setting::updateOrCreate(['key' => 'wa_message'], ['value' => 'Halo Admin, saya ingin bertanya tentang adopsi kucing.']);

        // Dummy Users
        for ($i = 1; $i <= 3; $i++) {
            User::updateOrCreate(
                ['email' => "adopter{$i}@user.com"],
                [
                    'name' => "Dummy Adopter {$i}",
                    'password' => bcrypt('password'),
                    'role' => UserRole::ADOPTER->value,
                    'phone_number' => '0812345678' . $i,
                    'address' => "Jl. Kebon Kucing No. {$i}, Jakarta",
                    'job' => 'Karyawan Swasta'
                ]
            );
        }

        // Dummy Cats
        $dummyCats = [
            [
                'name' => 'Garfield',
                'breed' => 'Persia',
                'age_in_months' => 24,
                'condition' => 'Sehat, sangat aktif, manja dan suka dielus. Sudah vaksin lengkap dan obat cacing.',
                'photo_path' => 'cats/dummy_cat_1.jpg',
                'photos' => ['cats/dummy_cat_1.jpg'],
                'status' => \App\Enums\CatStatus::AVAILABLE->value,
            ],
            [
                'name' => 'Snowball',
                'breed' => 'Anggora',
                'age_in_months' => 12,
                'condition' => 'Sedikit pemalu di awal, tapi sangat manis. Bulu putih bersih, butuh perawatan rutin.',
                'photo_path' => 'cats/dummy_cat_2.jpg',
                'photos' => ['cats/dummy_cat_2.jpg'],
                'status' => \App\Enums\CatStatus::AVAILABLE->value,
            ],
            [
                'name' => 'Milo',
                'breed' => 'British Shorthair',
                'age_in_months' => 8,
                'condition' => 'Sangat lincah dan suka bermain bola. Sehat, bebas kutu, dan sudah terbiasa pakai litter box.',
                'photo_path' => 'cats/dummy_cat_3.jpg',
                'photos' => ['cats/dummy_cat_3.jpg'],
                'status' => \App\Enums\CatStatus::AVAILABLE->value,
            ]
        ];

        foreach ($dummyCats as $cat) {
            \App\Models\Cat::firstOrCreate(
                ['name' => $cat['name']],
                $cat
            );
        }
    }
}
