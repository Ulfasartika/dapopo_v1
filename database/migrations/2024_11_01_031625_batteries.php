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
        Schema::create('batteries', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('rectifier_id');
            $table->integer('battery_quantity');
            $table->string('battery_status');
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
        Schema::dropIfExists('batteries');
    }
};
