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
            $table->double('bus_voltage',8,1);
            $table->double('load',8,1);
            $table->unsignedBigInteger('id_battery_brand');
            $table->unsignedBigInteger('id_battery_type');
            $table->integer('backup_time');
            $table->integer('total_battery');
            $table->integer('good_battery')->nullable();
            $table->integer('degraded_battery')->nullable();
            $table->integer('stolen_battery')->nullable();
            $table->string('image');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_site')->references('id')->on('sites')->onDelete('cascade');
            $table->foreign('id_battery_brand')->references('id')->on('battery_brands')->onDelete('cascade');
            $table->foreign('id_battery_type')->references('id')->on('battery_types')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');


        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rectifiers');
    }
};
