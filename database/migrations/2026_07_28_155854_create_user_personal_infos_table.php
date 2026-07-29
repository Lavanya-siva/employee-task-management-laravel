<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {
        Schema::create('user_personal_infos', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();


            $table->date('dob')
                ->nullable();


            $table->string('phone')
                ->nullable();


            $table->enum('gender',
                [
                    'Male',
                    'Female',
                    'Other'
                ])
                ->nullable();


            $table->text('address')
                ->nullable();


            $table->string('profile_photo')
                ->nullable();


            $table->timestamps();

        });
    }



    public function down(): void
    {
        Schema::dropIfExists('user_personal_infos');
    }

};