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
        Schema::create('type_hadiahs', function (Blueprint $table) {
            $table->integer("id_typeHadiah")->primary();
            $table->integer("id_lomba")->nullable();
            $table->string("title");

            $table->foreignIdFor(Lomba::class)->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_hadiahs');
    }
};
