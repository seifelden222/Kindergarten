<?php

use App\Models\Level;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('allows a teacher to create a level', function () {
    $teacher = User::factory()->create([
        'role' => 'teacher',
    ]);

    $this->actingAs($teacher)
        ->post(route('teacher.levels.store'), [
            'name' => 'فصل البراعم',
            'children_count' => 18,
            'status' => 'active',
            'accent_color' => '#0ea60e',
            'notes' => 'فصل مخصص للأطفال الجدد.',
        ])
        ->assertRedirect(route('teacher.levels.index'));

    $this->assertDatabaseHas('levels', [
        'name' => 'فصل البراعم',
        'children_count' => 18,
        'status' => 'active',
        'user_id' => $teacher->id,
    ]);
});

it('shows only the authenticated teachers levels', function () {
    $teacher = User::factory()->create([
        'role' => 'teacher',
    ]);

    $otherTeacher = User::factory()->create([
        'role' => 'teacher',
    ]);

    $visibleLevel = Level::factory()->for($teacher)->create([
        'name' => 'فصل المعلمة الحالية',
    ]);

    Level::factory()->for($otherTeacher)->create([
        'name' => 'فصل معلمة أخرى',
    ]);

    $this->actingAs($teacher)
        ->get(route('teacher.levels.index'))
        ->assertSuccessful()
        ->assertSee($visibleLevel->name)
        ->assertDontSee('فصل معلمة أخرى');
});

it('allows a teacher to update one of their levels', function () {
    $teacher = User::factory()->create([
        'role' => 'teacher',
    ]);

    $level = Level::factory()->for($teacher)->create([
        'name' => 'فصل قديم',
        'status' => 'inactive',
    ]);

    $this->actingAs($teacher)
        ->put(route('teacher.levels.update', $level), [
            'name' => 'فصل محدّث',
            'children_count' => 20,
            'status' => 'active',
            'accent_color' => '#3b82f6',
            'notes' => 'تم تحديث بيانات الفصل.',
        ])
        ->assertRedirect(route('teacher.levels.index', [
            'selected' => $level->id,
        ]));

    $this->assertDatabaseHas('levels', [
        'id' => $level->id,
        'name' => 'فصل محدّث',
        'status' => 'active',
        'accent_color' => '#3b82f6',
    ]);
});

it('prevents a teacher from updating another teachers level', function () {
    $teacher = User::factory()->create([
        'role' => 'teacher',
    ]);

    $otherTeacher = User::factory()->create([
        'role' => 'teacher',
    ]);

    $level = Level::factory()->for($otherTeacher)->create();

    $this->actingAs($teacher)
        ->put(route('teacher.levels.update', $level), [
            'name' => 'فصل غير مسموح',
            'children_count' => 11,
            'status' => 'active',
            'accent_color' => '#0ea60e',
            'notes' => null,
        ])
        ->assertNotFound();
});

it('allows a teacher to delete one of their levels', function () {
    $teacher = User::factory()->create([
        'role' => 'teacher',
    ]);

    $level = Level::factory()->for($teacher)->create();

    $this->actingAs($teacher)
        ->delete(route('teacher.levels.destroy', $level))
        ->assertRedirect(route('teacher.levels.index'));

    $this->assertDatabaseMissing('levels', [
        'id' => $level->id,
    ]);
});
