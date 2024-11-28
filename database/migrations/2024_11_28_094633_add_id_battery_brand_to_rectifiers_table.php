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
        Schema::table('rectifiers', function (Blueprint $table) {
            $table->unsignedBigInteger('id_battery_brand');
            $table->unsignedBigInteger('id_battery_type');
            $table->foreign('id_battery_brand')->references('id')->on('battery_brands')->onDelete('cascade');
            $table->foreign('id_battery_type')->references('id')->on('battery_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rectifiers', function (Blueprint $table) {
            //
        });
    }
};
