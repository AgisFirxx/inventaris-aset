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
    Schema::create('assets', function (Blueprint $table) {
        $table->id();
        $table->string('kode_aset')->unique();
        $table->string('nama_aset');
        $table->foreignId('category_id')->constrained()->onDelete('cascade');
        $table->string('kondisi')->default('baik');
        $table->string('status')->default('available');
        $table->string('lokasi')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
