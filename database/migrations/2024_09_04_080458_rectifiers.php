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
            $table->string('id_pelanggan');
            $table->double('daya',8,1);
            $table->string('recti_name');
            $table->string('recti_brand');
            $table->integer('apr_quantity');
            $table->double('bus_voltage',8,1);
            $table->double('load',8,1);
            $table->string('battery_brand');
            $table->string('battery_type');
            $table->integer('backup_time');
            $table->string('image');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_site')->references('id')->on('sites')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rectifiers');
    }
};
