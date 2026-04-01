<?php

namespace Database\Seeders;

use App\Models\Level;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = [
            [
                'name' => 'أ. سارة أحمد',
                'email' => 'teacher1@example.com',
                'specialization' => 'معلمة تمهيدي',
                'levels' => ['فصل الزهور 1', 'فصل الفراشات 1'],
            ],
            [
                'name' => 'أ. منى خالد',
                'email' => 'teacher2@example.com',
                'specialization' => 'معلمة أنشطة',
                'levels' => ['فصل النجوم 1', 'فصل الأبطال 1'],
            ],
            [
                'name' => 'أ. ريم علي',
                'email' => 'teacher3@example.com',
                'specialization' => 'معلمة حضانة',
                'levels' => ['فصل الطيور 1', 'فصل الزهور 2'],
            ],
        ];

        foreach ($teachers as $teacherData) {
            $teacher = User::query()->updateOrCreate([
                'email' => $teacherData['email'],
            ], [
                'name' => $teacherData['name'],
                'role' => 'teacher',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'specialization' => $teacherData['specialization'],
                'working_hours' => '8:00 AM - 2:00 PM',
                'registration_date' => now()->toDateString(),
            ]);

            foreach (Arr::get($teacherData, 'levels', []) as $levelName) {
                Level::query()->updateOrCreate([
                    'user_id' => $teacher->id,
                    'name' => $levelName,
                ], [
                    'children_count' => fake()->numberBetween(8, 20),
                    'status' => 'active',
                    'accent_color' => fake()->randomElement(['#0ea60e', '#3b82f6', '#a855f7', '#f97316']),
                    'notes' => fake()->optional()->sentence(),
                ]);
            }
        }
    }
}
