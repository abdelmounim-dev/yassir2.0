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
        Schema::rename("users", "old_users");
        Schema::create('users', function (Blueprint $table) {
            $table->string('first_name');
            $table->string('last_name')->after('first_name');
            $table->string('phone_number')->nullable()->after('last_name');
            $table->string('email')->after('phone_number');
            $table->string('student_id')->unique()->after('email');
            $table->string('password')->after('student_id');
            $table->boolean('is_admin')->default(false)->after('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
