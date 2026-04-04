<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->updateOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'مدير النظام',
            'role' => 'admin',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'phone' => '01000000000',
            'registration_date' => now()->toDateString(),
        ]);
    }
}
