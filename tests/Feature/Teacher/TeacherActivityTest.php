<?php

use App\Models\Activity;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

it('allows a teacher to store a daily activity', function () {
    Storage::fake('public');

    $teacher = User::factory()->create([
        'role' => 'teacher',
    ]);

    $this->actingAs($teacher)
        ->post(route('teacher.activities.store'), [
            'name' => 'الرسم بالألوان المائية',
            'activity_type' => 'art',
            'description' => 'نشاط فني لتطوير المهارات الحركية الدقيقة.',
            'activity_time' => '09:30',
            'duration_minutes' => 45,
            'activity_image' => UploadedFile::fake()->image('activity.jpg'),
        ])
        ->assertRedirect(route('teacher.teacherdashboard'));

    $activity = Activity::query()->firstOrFail();

    $this->assertDatabaseHas('activities', [
        'name' => 'الرسم بالألوان المائية',
        'activity_type' => 'نشاط فني',
        'description' => 'نشاط فني لتطوير المهارات الحركية الدقيقة.',
        'activity_time' => '09:30',
        'duration_minutes' => 45,
        'user_id' => $teacher->id,
    ]);

    expect($activity->image_path)->not->toBeNull();
    Storage::disk('public')->assertExists($activity->image_path);
});

it('shows validation errors when teacher activity data is invalid', function () {
    $teacher = User::factory()->create([
        'role' => 'teacher',
    ]);

    $this->actingAs($teacher)
        ->postJson(route('teacher.activities.store'), [
            'name' => '',
            'activity_type' => 'invalid',
            'description' => '',
            'activity_time' => 'invalid-time',
            'duration_minutes' => 0,
        ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors([
            'name',
            'activity_type',
            'description',
            'activity_time',
            'duration_minutes',
        ]);
});
