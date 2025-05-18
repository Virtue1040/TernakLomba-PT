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
        Schema::create('history_prestasis', function (Blueprint $table) {
            $table->bigInteger("id_prestasi", 1)->primary();
            $table->bigInteger("user_id");
            $table->string("title");
            $table->char("juara", 20);
            $table->char("tingkatan", 20);

            $table->foreign('user_id')->references('id_user')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_prestasis');
    }
};
