<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class WeeklySchedule extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'academic_year',
        'semester',
        'group_name',
        'age_range',
        'day_order',
        'day_name',
        'morning_subject',
        'morning_teacher',
        'second_subject',
        'second_teacher',
        'afternoon_period',
        'daily_activity',
        'activity_location',
    ];

    public function scopeOrdered(Builder $query): Builder
    {
        return $query
            ->orderBy('academic_year')
            ->orderBy('semester')
            ->orderBy('group_name')
            ->orderBy('day_order');
    }
}
