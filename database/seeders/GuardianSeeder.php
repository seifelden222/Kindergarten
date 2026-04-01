<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GuardianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guardians = [
            [
                'name' => 'أحمد محمد',
                'email' => 'guardian1@example.com',
                'phone' => '01000000001',
                'relationship_to_child' => 'الأب',
            ],
            [
                'name' => 'سارة علي',
                'email' => 'guardian2@example.com',
                'phone' => '01000000002',
                'relationship_to_child' => 'الأم',
            ],
            [
                'name' => 'محمود حسن',
                'email' => 'guardian3@example.com',
                'phone' => '01000000003',
                'relationship_to_child' => 'الأب',
            ],
        ];

        foreach ($guardians as $guardianData) {
            User::query()->updateOrCreate([
                'email' => $guardianData['email'],
            ], [
                'name' => $guardianData['name'],
                'role' => 'guardian',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'phone' => $guardianData['phone'],
                'relationship_to_child' => $guardianData['relationship_to_child'],
                'registration_date' => now()->toDateString(),
            ]);
        }
    }
}
