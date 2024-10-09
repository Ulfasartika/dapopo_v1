<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rectifiers', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('id_site');
            $table->string('recti_name');
            $table->string('recti_brand'); 
            $table->integer('apr_quantity'); 
            $table->integer('bus_voltage'); 
            $table->integer('load'); 
            $table->unsignedBigInteger('id_battery');
            $table->unsignedBigInteger('id_bat_type'); 
            $table->integer('battery_quantity'); 
            $table->string('battery_status'); 
            $table->integer('backup_time');
            $table->unsignedBigInteger('id_equipment');
            $table->timestamps();
            $table->softDeletes(); 
            $table->foreign('id_site')->references('id')->on('sites')->onDelete('cascade');
            $table->foreign('id_battery')->references('id')->on('batteries')->onDelete('cascade');
            $table->foreign('id_bat_type')->references('id')->on('battery_types')->onDelete('cascade');
            $table->foreign('id_equipment')->references('id')->on('equipment')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rectifiers');
    }
};
