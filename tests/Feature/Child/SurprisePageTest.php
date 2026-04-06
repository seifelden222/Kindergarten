<?php

use App\Models\Activity;
use App\Models\Attendance;
use App\Models\Level;
use App\Models\TeacherReport;
use App\Models\User;
use App\Models\WeeklySchedule;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows unique surprise card content for the child', function () {
    $teacher = User::factory()->create([
        'role' => 'teacher',
        'name' => 'أ. ريم علي',
    ]);

    $level = Level::factory()->for($teacher)->create([
        'name' => 'فصل الزهور',
    ]);

    $child = User::factory()->create([
        'role' => 'child',
        'name' => 'أ. ريـم علي',
        'level_name' => 'فصل الزهور',
    ]);

    TeacherReport::query()->create([
        'teacher_id' => $teacher->id,
        'level_id' => $level->id,
        'report_type' => 'daily',
        'title' => 'تقرير يومي - الرسم',
        'report_date' => now()->toDateString(),
        'content' => 'شاركت بحماس في النشاط الفني وابتكرت لوحة جميلة.',
        'status' => 'sent',
    ]);

    Activity::query()->create([
        'name' => 'الرسم بالألوان',
        'activity_date' => now()->toDateString(),
        'activity_type' => 'نشاط فني',
        'description' => 'نشاط فني مميز بالألوان المائية.',
        'activity_time' => '09:30',
        'duration_minutes' => 30,
        'user_id' => $teacher->id,
    ]);

    Attendance::query()->create([
        'user_id' => $child->id,
        'check_in' => now(),
        'check_out' => now(),
        'absence_count' => 0,
    ]);

    WeeklySchedule::query()->create([
        'academic_year' => '2025-2026',
        'semester' => 'الأول',
        'group_name' => 'Group A',
        'age_range' => '4-5',
        'day_order' => 1,
        'day_name' => 'الأحد',
        'morning_subject' => 'ألعاب لغوية',
        'morning_teacher' => 'أ. ريم علي',
        'second_subject' => 'أنشطة حركية',
        'second_teacher' => 'أ. ريم علي',
        'afternoon_period' => 'الظهيرة',
        'daily_activity' => 'وقت الوجبة',
        'activity_location' => 'قاعة الطعام',
    ]);

    $this->actingAs($child)
        ->get(route('child.surprise'))
        ->assertSuccessful()
        ->assertSee('وسام الحضور المميز')
        ->assertSee('تقرير يومي - الرسم')
        ->assertSee('الرسم بالألوان')
        ->assertSee('وقت الوجبة');
});
