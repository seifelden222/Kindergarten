<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ChildSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guardians = User::query()
            ->where('role', 'guardian')
            ->orderBy('id')
            ->get();

        if ($guardians->isEmpty()) {
            return;
        }

        $children = [
            [
                'name' => 'ليلى أحمد',
                'email' => 'child1@example.com',
                'gender' => 'female',
                'birth_date' => now()->subYears(5)->subMonths(2)->toDateString(),
                'level_name' => 'تمهيدي أول (أ)',
                'classroom_name' => 'الفصل أ',
                'allergies' => 'حساسية من الفول السوداني',
                'guardian_index' => 0,
            ],
            [
                'name' => 'عمر أحمد',
                'email' => 'child2@example.com',
                'gender' => 'male',
                'birth_date' => now()->subYears(4)->subMonths(8)->toDateString(),
                'level_name' => 'حضانة (ب)',
                'classroom_name' => 'الفصل ب',
                'medications' => 'فيتامين يومي',
                'guardian_index' => 0,
            ],
            [
                'name' => 'جنى محمد',
                'email' => 'child3@example.com',
                'gender' => 'female',
                'birth_date' => now()->subYears(5)->toDateString(),
                'level_name' => 'تمهيدي أول (ب)',
                'classroom_name' => 'الفصل أ',
                'guardian_index' => 1,
            ],
            [
                'name' => 'يوسف حسن',
                'email' => 'child4@example.com',
                'gender' => 'male',
                'birth_date' => now()->subYears(3)->subMonths(10)->toDateString(),
                'level_name' => 'حضانة (أ)',
                'classroom_name' => 'الفصل ج',
                'chronic_diseases' => 'الربو',
                'guardian_index' => 2,
            ],
        ];

        foreach ($children as $childData) {
            $guardian = $guardians[$childData['guardian_index']] ?? $guardians->first();
            $birthDate = now()->parse($childData['birth_date']);

            User::query()->updateOrCreate([
                'email' => $childData['email'],
            ], [
                'name' => $childData['name'],
                'role' => 'child',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'guardian_id' => $guardian?->id,
                'gender' => $childData['gender'],
                'birth_date' => $birthDate->toDateString(),
                'age' => $birthDate->age,
                'level_name' => $childData['level_name'],
                'classroom_name' => $childData['classroom_name'],
                'allergies' => $childData['allergies'] ?? null,
                'chronic_diseases' => $childData['chronic_diseases'] ?? null,
                'medications' => $childData['medications'] ?? null,
                'registration_date' => now()->toDateString(),
            ]);
        }
    }
}
