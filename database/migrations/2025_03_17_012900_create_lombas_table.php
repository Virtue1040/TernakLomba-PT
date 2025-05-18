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
        Schema::create('lombas', function (Blueprint $table) {
            $table->bigInteger("id_lomba", 1)->primary();
            $table->integer("max_member")->default(1);
            $table->integer("min_member")->default(1);
            $table->bigInteger("lombaCategory_id");
            $table->string("roleList")->default("");
            $table->bigInteger("created_by");
            $table->date("start_date");
            $table->date("end_date");
            $table->date("decide_date");
            $table->boolean("isApproved")->default(0);

            $table->foreign("lombaCategory_id")->references("id_lombaCategory")->on("lomba_categories")->onDelete("cascade");
            $table->foreign("created_by")->references("id_user")->on("users")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lombas');
    }
};
