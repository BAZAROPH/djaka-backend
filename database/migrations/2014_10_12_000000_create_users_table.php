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
            $table->string('public_id')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->string('area_code');
            $table->enum('gender', ['Masculin', 'Féminin']);
            $table->json('nationality')->nullable();
            $table->string('otp')->nullable();
            $table->string('otp_expiration')->nullable();
            $table->timestamp('birth_date')->nullable();
            $table->string('district')->nullable();
            $table->timestamp('phone_number_verified_at')->nullable();
            $table->timestamp('password_reset_at')->nullable();
            $table->unsignedBigInteger('role')->nullable();
            $table->unsignedBigInteger('country')->nullable();
            $table->unsignedBigInteger('city')->nullable();
            $table->unsignedBigInteger('town')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('role')->references('id')->on('roles')->onDelete('set null');
            $table->foreign('country')->references('id')->on('countries')->onDelete('set null')->nullable();
            $table->foreign('city')->references('id')->on('cities')->onDelete('set null')->nullable();
            $table->foreign('town')->references('id')->on('towns')->onDelete('set null')->nullable();
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
