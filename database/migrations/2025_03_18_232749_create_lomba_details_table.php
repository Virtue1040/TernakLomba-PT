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
        Schema::create('lomba_details', function (Blueprint $table) {
            $table->bigInteger("lomba_id", 1)->primary();
            $table->string("title");
            $table->string("description");
            $table->string('penyelenggara_name');
            $table->string("pic_name");
            $table->string("pic_tel", 50);
            $table->string("pic_email");

            $table->foreign("lomba_id")->references("id_lomba")->on("lombas")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lomba_details');
    }
};
