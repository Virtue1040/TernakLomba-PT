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
        Schema::create('history_prestasi_minats', function (Blueprint $table) {
            $table->bigInteger("id_prestasi_minat", 1)->primary();
            $table->bigInteger("prestasi_id");
            $table->bigInteger("bidang_id");

            $table->unique(["bidang_id", "prestasi_id"]);
            $table->foreign('bidang_id')->references('id_bidang')->on('bidang_minats');
            $table->foreign('prestasi_id')->references('id_prestasi')->on('history_prestasis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_prestasi_minats');
    }
};
