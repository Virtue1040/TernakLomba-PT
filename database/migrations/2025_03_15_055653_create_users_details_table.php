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
            $table->integer("id_user")->primary();
            $table->string("first_name");
            $table->string("last_name");
            $table->string("bio");
            $table->date("born_date");
            $table->enum("gender", ["male", "female"])->default("male");
            $table->string("social_id")->nullable();
            $table->string("social_type")->nullable();
            $table->string("social_avatar")->nullable();
            $table->integer("avatarPath")->nullable();
            $table->boolean("avatar_type");

            $table->foreignIdFor(User::class)->onDelete("cascade");
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
