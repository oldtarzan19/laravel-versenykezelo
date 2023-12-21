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
        Schema::create('felhasznalok', function (Blueprint $table) {
            $table->id();
            $table->string('nev');
            $table->string('email')->unique();
            $table->string('telefonszam')->nullable();
            $table->string('lakcim')->nullable();
            $table->string('szuletesi_ev')->nullable();
            $table->string('jelszo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('felhasznalok');
    }
};
