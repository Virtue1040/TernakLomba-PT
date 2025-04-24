<?php

use App\Models\User;
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
        Schema::create('users_details', function (Blueprint $table) {
            $table->bigInteger("user_id")->primary();
            $table->string("first_name")->nullable();
            $table->string("last_name")->nullable();
            $table->string("tel")->nullable();
            $table->string("bio");
            $table->date("birth_date")->nullable();
            $table->string("birth_place")->nullable();
            $table->enum("gender", ["male", "female"])->default("male")->nullable();
            $table->string("social_id")->nullable();
            $table->string("social_type")->nullable();
            $table->string("social_avatar")->nullable();
            $table->integer("avatarPath")->nullable();
            $table->boolean("avatar_type")->default(0);

            $table->foreign("user_id")->references("id_user")->on("users")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_details');
    }
};
