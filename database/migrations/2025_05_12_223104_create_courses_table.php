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
            $table->enum('exam_type', ['form', 'drawing', 'hall'])->default('form');
            $table->string('exam_date')->nullable();
            $table->string('code')->unique();
            $table->string('title')->unique();
            $table->integer('total_students')->nullable();
            $table->string('duration')->nullable();
            $table->boolean('answer_papers_status')->nullable();
            $table->boolean('year_work_status')->nullable();
            $table->boolean('model_answers_status')->nullable();
            $table->integer('incomplete_students')->nullable();
            $table->integer('withdraw_students')->nullable();
            $table->integer('total_absent_students')->nullable();
            $table->integer('total_present_students')->nullable();
            $table->integer('total_deprived_students')->nullable();
            $table->integer('cheating_students')->nullable();
            $table->integer('misconduct_students')->nullable();
            $table->integer('success_students')->nullable();
            $table->integer('failed_students')->nullable();
            $table->enum('correction_status', ['in_progress', 'completed', 'not_started'])->default('not_started');
            $table->enum('review_status', ['in_progress', 'completed', 'not_started'])->default('not_started');
            $table->enum('final_grades_status', ['in_progress', 'completed', 'not_started'])->default('not_started');
            $table->enum('final_grades_review_status', ['in_progress', 'completed', 'not_started'])->default('not_started');
            $table->text('notes')->nullable();
            $table->string('course_level')->nullable();
            $table->boolean('is_published')->default(false);
            $table->boolean('is_checked_by_dean')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
