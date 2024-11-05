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
        Schema::create('rectifier_batteries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rectifier_id')->constrained()->onDelete('cascade');
            $table->integer('battery_quantity')->default(1);
            $table->enum('battery_status', ['Good', 'Degraded'])->default('Good');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rectifier_batteries');
    }
};
