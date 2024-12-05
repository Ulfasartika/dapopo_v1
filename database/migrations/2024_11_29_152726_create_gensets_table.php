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
        Schema::create('gensets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('genset_brand');
            $table->integer('capacity');
            $table->string('genset_condition');
            $table->string('ats');
            $table->string('foto_genset');
            $table->string('foto_ats');
            $table->unsignedBigInteger('id_site');
            $table->foreign('id_site')->references('id')->on('sites')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gensets');
    }
};
