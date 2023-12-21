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
        Schema::create('competitions', function (Blueprint $table) {
            $table->id();
            $table->string('nev');
            $table->integer('ev');
            $table->string('elerheto_nyelvek')->nullable();
            $table->integer('pontok_jo');
            $table->integer('pontok_rossz');
            $table->integer('pontok_ures');
            $table->timestamps();
            $table->unique(['nev', 'ev']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competitions');
    }
};
