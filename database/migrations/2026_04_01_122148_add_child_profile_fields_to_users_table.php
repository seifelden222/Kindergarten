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
        Schema::table('users', function (Blueprint $table) {
            $table->string('gender', 20)->nullable()->after('guardian_id');
            $table->date('birth_date')->nullable()->after('age');
            $table->string('level_name')->nullable()->after('children_count');
            $table->string('classroom_name')->nullable()->after('level_name');
            $table->text('allergies')->nullable()->after('relationship_to_child');
            $table->text('chronic_diseases')->nullable()->after('allergies');
            $table->text('medications')->nullable()->after('chronic_diseases');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'gender',
                'birth_date',
                'level_name',
                'classroom_name',
                'allergies',
                'chronic_diseases',
                'medications',
            ]);
        });
    }
};
