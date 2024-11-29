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
            if (Schema::hasColumn('rectifiers', 'id_pelanggan')) {
                $table->dropColumn('id_pelanggan');
            }
            if (Schema::hasColumn('rectifiers', 'daya')) {
                $table->dropColumn('daya');
            }
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
