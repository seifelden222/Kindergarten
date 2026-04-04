<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('weekly_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('academic_year');
            $table->string('semester');
            $table->string('group_name');
            $table->string('age_range')->nullable();
            $table->unsignedTinyInteger('day_order');
            $table->string('day_name');
            $table->string('morning_subject');
            $table->string('morning_teacher')->nullable();
            $table->string('second_subject');
            $table->string('second_teacher')->nullable();
            $table->string('afternoon_period')->default('الراحة والغداء');
            $table->string('daily_activity');
            $table->string('activity_location')->nullable();
            $table->timestamps();

            $table->index(['semester', 'group_name', 'day_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weekly_schedules');
    }
};
