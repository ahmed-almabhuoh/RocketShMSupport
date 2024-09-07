<?php

use App\Models\CommonQuestionCategory;
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
        Schema::create('common_question_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar', 50);
            $table->string('name_en', 50);
            $table->enum('status', CommonQuestionCategory::STATUS);
            $table->unique(['name_ar', 'name_en']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('common_question_categories');
    }
};
