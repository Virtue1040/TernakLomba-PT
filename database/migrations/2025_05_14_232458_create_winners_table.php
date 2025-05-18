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
        Schema::create('winners', function (Blueprint $table) {
            $table->bigInteger('id_winner', 1)->primary();
            $table->bigInteger("user_id")->nullable();
            $table->char("user_alias", 50);
            $table->bigInteger("hadiah_id")->nullable();
            $table->string("juara");

            $table->foreign("user_id")->references("id_user")->on("users")->onDelete("cascade");
            $table->foreign("hadiah_id")->references("id_hadiah")->on("lomba_hadiahs")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('winners');
    }
};
