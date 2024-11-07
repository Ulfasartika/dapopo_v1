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
        Schema::create('equipment_rectifier', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rectifier_id');
            $table->unsignedBigInteger('equipment_id');
            $table->timestamps();
            $table->foreign('rectifier_id')->references('id')->on('rectifiers')->onDelete('cascade');
            $table->foreign('equipment_id')->references('id')->on('equipments')->onDelete('cascade');
            $table->unique(['rectifier_id', 'equipment_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment_rectifier');
    }
};
