<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // role column
            $table->enum('role', ['admin', 'manager', 'user'])
                  ->default('user')
                  ->after('email');

            // manager_id (self reference)
            $table->unsignedBigInteger('manager_id')
                  ->nullable()
                  ->after('role');

            // manager id delete user's manager id null
            $table->foreign('manager_id')
                  ->references('id')
                  ->on('users')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropForeign(['manager_id']);
            $table->dropColumn(['role', 'manager_id']);
        });
    }
};
