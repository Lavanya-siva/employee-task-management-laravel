<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // AUTO-INCREMENT PRIMARY KEY
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('surname');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone_no');
            $table->boolean('terms_cond')->default(false);
            $table->enum('registration_status', [
                'started',
                'otp_verified',
                'personal_info',
                'documents_uploaded',
                'documents_reuploaded',
                'risk_done',
                'completed'
            ])->default('started');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
