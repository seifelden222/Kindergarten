<?php

namespace Database\Seeders;

use App\Models\WeeklySchedule;
use Illuminate\Database\Seeder;

class WeeklyScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = [
            [
                'day_order' => 1,
                'day_name' => 'الأحد',
                'morning_subject' => 'لغة عربية',
                'morning_teacher' => 'أ. نورة',
                'second_subject' => 'رياضيات ممتعة',
                'second_teacher' => 'أ. سارة',
                'daily_activity' => 'رياضة وحركة',
                'activity_location' => 'الملعب الخارجي',
            ],
            [
                'day_order' => 2,
                'day_name' => 'الإثنين',
                'morning_subject' => 'الفنون والرسم',
                'morning_teacher' => 'أ. ليلى',
                'second_subject' => 'قراءة قصصية',
                'second_teacher' => 'أ. نورة',
                'daily_activity' => 'موسيقى ورقص',
                'activity_location' => 'قاعة الموسيقى',
            ],
            [
                'day_order' => 3,
                'day_name' => 'الثلاثاء',
                'morning_subject' => 'علوم وتجارب',
                'morning_teacher' => 'أ. محمد',
                'second_subject' => 'مهارات حياتية',
                'second_teacher' => 'أ. فاطمة',
                'daily_activity' => 'مسرح وألعاب تمثيل',
                'activity_location' => 'قاعة النشاط',
            ],
            [
                'day_order' => 4,
                'day_name' => 'الأربعاء',
                'morning_subject' => 'لغة إنجليزية',
                'morning_teacher' => 'أ. سارة',
                'second_subject' => 'حساب ممتع',
                'second_teacher' => 'أ. نورة',
                'daily_activity' => 'ألعاب حركية',
                'activity_location' => 'حديقة الألعاب',
            ],
            [
                'day_order' => 5,
                'day_name' => 'الخميس',
                'morning_subject' => 'فنون تشكيلية',
                'morning_teacher' => 'أ. ليلى',
                'second_subject' => 'قصة ومسرح',
                'second_teacher' => 'أ. نورة',
                'daily_activity' => 'نشاط مائي/سباحة',
                'activity_location' => 'حمام السباحة الصغير',
            ],
        ];

        foreach ($rows as $row) {
            WeeklySchedule::query()->updateOrCreate([
                'semester' => 'الفصل الدراسي الأول 2025-2026',
                'group_name' => 'مجموعة الفراشات',
                'day_order' => $row['day_order'],
            ], [
                'academic_year' => '2025-2026',
                'age_range' => '4-5 سنوات',
                'day_name' => $row['day_name'],
                'morning_subject' => $row['morning_subject'],
                'morning_teacher' => $row['morning_teacher'],
                'second_subject' => $row['second_subject'],
                'second_teacher' => $row['second_teacher'],
                'afternoon_period' => 'الراحة والغداء',
                'daily_activity' => $row['daily_activity'],
                'activity_location' => $row['activity_location'],
            ]);
        }
    }
}
