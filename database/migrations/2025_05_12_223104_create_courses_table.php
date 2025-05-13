<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->enum('exam_type', ['form', 'drawing', 'hall']);
            $table->date('exam_date');
            $table->string('code')->unique();
            $table->string('title')->unique();
            $table->integer('total_students');
            $table->string('duration');
            $table->boolean('answer_papers_status');
            $table->boolean('year_work_status');
            $table->boolean('model_answers_status');
            $table->integer('incomplete_students');
            $table->integer('withdraw_students');
            $table->integer('total_absent_students');
            $table->integer('total_present_students');
            $table->integer('total_deprived_students');
            $table->integer('cheating_students');
            $table->integer('misconduct_students');
            $table->enum('correction_status', ['in_progress', 'completed', 'not_started']);
            $table->enum('review_status', ['in_progress', 'completed', 'not_started']);
            $table->enum('final_grades_status', ['in_progress', 'completed', 'not_started']);
            $table->enum('final_grades_review_status', ['in_progress', 'completed', 'not_started']);
            $table->text('notes');
            $table->enum('course_level', ['level_0', 'level_1', 'level_2', 'level_3', 'level_4']);
            $table->timestamps();
        });

        Schema::create('course_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->cascadeOnUpdate()->nullableOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->nullableOnDelete();
            $table->unique(['course_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_user');
        Schema::dropIfExists('courses');
    }
};
