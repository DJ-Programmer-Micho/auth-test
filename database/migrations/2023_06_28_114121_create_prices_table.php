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
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('exp')->nullable();
            $table->string('price')->nullable();
            $table->json('info')->nullable();
            $table->string('btn_txt')->nullable();
            $table->string('btn_url')->nullable();
            $table->string('priority')->nullable();
            $table->timestamps();
        });

        Schema::create('price_infos', function (Blueprint $table) {
            $table->id();
            $table->json('properties')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};
