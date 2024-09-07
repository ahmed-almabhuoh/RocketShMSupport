<?php

use App\Models\CommonQuestion;
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
        Schema::create('common_questions', function (Blueprint $table) {
            $table->id();
            $table->string('question')->unique();
            $table->string('slug')->unique();
            $table->text('answer');

            $table->enum('status', CommonQuestion::STATUS);

            $table->foreignId('common_question_category_id')->nullable()->constrained('common_question_categories', 'id')->nullOnDelete();

            $table->timestamp('published_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('common_questions');
    }
};
