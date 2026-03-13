<?php

namespace Database\Seeders;

use App\Models\Level;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $teacher = User::factory()->create([
            'name' => 'أ. سارة أحمد',
            'email' => 'teacher@example.com',
            'role' => 'teacher',
            'specialization' => 'معلمة',
        ]);

        Level::factory()->count(3)->for($teacher)->create();
    }
}
