<?php

use App\Enums\ExamType;
use App\Enums\ProgressStatus;
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
        $progressStatus = collect(ProgressStatus::cases())->pluck('value')->toArray();
        
        Schema::create('courses', function (Blueprint $table) use ($progressStatus) {
            $table->id();
            $table->enum('exam_type', collect(ExamType::cases())->pluck('value')->toArray())->default('form');
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
            $table->enum('correction_status', $progressStatus)->default('not_started');
            $table->enum('review_status', $progressStatus)->default('not_started');
            $table->enum('final_grades_status', $progressStatus)->default('not_started');
            $table->enum('final_grades_review_status', $progressStatus)->default('not_started');
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
