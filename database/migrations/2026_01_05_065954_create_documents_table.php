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
    Schema::create('documents', function (Blueprint $table) {
    $table->id();
    $table->string('users_id');
    $table->string('document_category');
    $table->string('document_name');
    $table->string('file_type');
    $table->string('file_path');
    $table->enum('current_status', ['pending','approved','rejected'])->default('pending');
    $table->timestamp('uploaded_at');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
