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
        Schema::create('kawasans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('direktorat_id')->constrained('direktorats')->onDelete('cascade');
            $table->string('nama_kawasan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kawasans');
    }
};
