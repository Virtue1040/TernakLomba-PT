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
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigInteger("id_notification", 1)->primary();
            $table->bigInteger("sender_id");
            $table->bigInteger("reciever_id");
            $table->string("message", 255);
            $table->string("json_data", 512);

            $table->foreign("sender_id")->references("id_user")->on("users")->onDelete("cascade");
            $table->foreign("reciever_id")->references("id_user")->on("users")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
