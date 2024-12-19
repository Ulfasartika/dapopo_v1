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
        Schema::create('kwh_meters', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('id_pelanggan');
            $table->integer('daya');
            $table->string('kondisi_kwh');
            $table->string('kondisi_segel');
            $table->integer('arus_r')->nullable();
            $table->integer('arus_s')->nullable();
            $table->integer('arus_t')->nullable();
            $table->integer('phasa_r')->nullable();
            $table->integer('phasa_s')->nullable();
            $table->integer('phasa_t')->nullable();
            $table->string('foto_kwh');
            $table->unsignedBigInteger('id_site');
            $table->foreign('id_site')->references('id')->on('sites')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kwh_meters');
    }
};
