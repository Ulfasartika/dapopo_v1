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
        Schema::table('kwh_meters', function (Blueprint $table) {
            $table->integer('phasa_1')->nullable()->change();
            $table->integer('phasa_2')->nullable()->change();
            $table->integer('phasa_3')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kwh_meters', function (Blueprint $table) {
            $table->integer('phasa_1')->nullable(false)->change();
            $table->integer('phasa_2')->nullable(false)->change();
            $table->integer('phasa_3')->nullable(false)->change();
        });
    }
};
