<?php

use App\Models\lombaTeam;
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
        Schema::create('lomba_members', function (Blueprint $table) {
            $table->bigInteger("id_member", 1)->primary();
            $table->bigInteger("team_id");
            $table->bigInteger("user_id");
            $table->string("role")->default('');
            $table->enum("member_status", ["pending", "approved", "rejected"])->default("pending");
            $table->boolean("isLeader")->default(0);

            $table->unique(["team_id", "user_id"]);
            $table->foreign("team_id")->references("id_team")->on("lomba_teams")->onDelete("cascade");
            $table->foreign("user_id")->references("id_user")->on("users")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lomba_members');
    }
};
