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
        Schema::create('detail_battery', function (Blueprint $table) {
            $table->id();
            $table->integer('battery_quantity')->default(1);
            $table->enum('battery_status', ['Good', 'Degraded'])->default('Good');
            $table->unsignedBigInteger('rectifier_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('rectifier_id')->references('id')->on('rectifiers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_battery');
    }
};
