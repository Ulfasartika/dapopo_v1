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
            $table->dropColumn('battery_brand');
            $table->dropColumn('battery_type');
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
