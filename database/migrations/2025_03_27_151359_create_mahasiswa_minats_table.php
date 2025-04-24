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
        Schema::create('mahasiswa_minats', function (Blueprint $table) {
            $table->bigInteger("id_mahasiswa_minat", 1)->primary();
            $table->bigInteger("bidang_id");
            $table->bigInteger("user_id");

            $table->unique(["bidang_id", "user_id"]);
            $table->foreign('bidang_id')->references('id_bidang')->on('bidang_minats');
            $table->foreign('user_id')->references('id_user')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa_minats');
    }
};
