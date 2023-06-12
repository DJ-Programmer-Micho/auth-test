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
        Schema::create('home_slides', function (Blueprint $table) {
            $table->id();
            $table->json('properties')->nullable();
            // $table->text('value')->nullable();
            // $table->longText('properties')->nullable();
            $table->timestamps();
        });
        // Schema::create('home_slides', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('short_title')->nullable();
        //     $table->string('title')->nullable();
        //     $table->string('btn1_action')->nullable();
        //     $table->string('btn1_action_url')->nullable();
        //     $table->string('btn2_action')->nullable();
        //     $table->string('btn2_action_url')->nullable();
        //     $table->string('image_slide')->nullable();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_slides');
    }
};
