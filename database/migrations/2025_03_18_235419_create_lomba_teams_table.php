<?php

use App\Models\Lomba;
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
        Schema::create('lomba_teams', function (Blueprint $table) {
            $table->bigInteger("id_team", 1)->primary();
            $table->bigInteger("lomba_id");
            $table->boolean("isApproved")->default(0);

            $table->foreign("lomba_id")->references("id_lomba")->on("lombas")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lomba_teams');
    }
};
