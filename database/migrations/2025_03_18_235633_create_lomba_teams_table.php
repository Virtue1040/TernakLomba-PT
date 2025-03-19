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
            $table->integer("id_team")->primary();
            $table->integer("id_lomba");
            $table->boolean("isVerified")->default(0);

            $table->foreignIdFor(Lomba::class)->onDelete("cascade");
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
