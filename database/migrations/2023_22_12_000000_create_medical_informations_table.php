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
        Schema::create('medical_informations', function (Blueprint $table) {
            $table->id();
            $table->string('public_id')->unique();
            $table->unsignedBigInteger('user')->nullable();
            $table->string('blood_type')->nullable();
            $table->float('size')->nullable();
            $table->float('weight')->nullable();
            $table->json('allergies')->nullable();
            $table->json('health_problems')->nullable();
            $table->json('medications')->nullable();
            $table->json('diseases')->nullable();
            $table->json('vaccines')->nullable();
            $table->json('insurance')->nullable();
            $table->json('referring_doctor')->nullable();
            $table->json('referring_doctor_contact')->nullable();
            $table->json('emergency_contacts')->nullable();
            $table->softDeletes();
            $table->timestamps();


            $table->foreign('user')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_informations');
    }
};
