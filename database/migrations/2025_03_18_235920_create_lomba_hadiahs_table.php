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
        Schema::create('lomba_hadiahs', function (Blueprint $table) {
            $table->integer("id_hadiah")->primary();
            $table->integer("id_lomba");
            $table->integer("id_typeHadiah");
            $table->integer("quantity");

            $table->foreignIdFor(Lomba::class)->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lomba_hadiahs');
    }
};
