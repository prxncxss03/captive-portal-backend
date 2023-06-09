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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('operating_system_id')->constrained('operating_systems')->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('user_type', ['admin', 'student', 'faculty'])->default('student');
            $table->string('email')->unique();
            //$table->timestamp('email_verified_at')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('password');
            $table->boolean('is_approved')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });


    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
