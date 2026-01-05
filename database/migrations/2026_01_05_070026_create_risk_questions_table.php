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
        Schema::create('risk_questions', function (Blueprint $table) {
    $table->id();
    $table->string('question_text');
    $table->string('option1_text');
    $table->integer('option1_risk_score');
    $table->string('option2_text');
    $table->integer('option2_risk_score');
    $table->string('option3_text');
    $table->integer('option3_risk_score');
    $table->string('option4_text');
    $table->integer('option4_risk_score');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('risk_questions');
    }
};
