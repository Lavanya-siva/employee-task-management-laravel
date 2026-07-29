<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {

        Schema::create('tasks', function (Blueprint $table) {

            $table->id();


            // task creator
            $table->unsignedBigInteger('created_by');


            // assigned employee
            $table->unsignedBigInteger('assigned_to')
                  ->nullable();



            $table->string('title');


            $table->text('description')
                  ->nullable();



            $table->enum('priority',
            [
                'low',
                'medium',
                'high'
            ])
            ->default('medium');



            $table->enum('status',
            [
                'pending',
                'in_progress',
                'completed'
            ])
            ->default('pending');



            $table->date('due_date')
                  ->nullable();



            $table->timestamps();



            $table->foreign('created_by')
                  ->references('id')
                  ->on('users')
                  ->cascadeOnDelete();



            $table->foreign('assigned_to')
                  ->references('id')
                  ->on('users')
                  ->nullOnDelete();


        });

    }



    public function down(): void
    {

        Schema::dropIfExists('tasks');

    }

};