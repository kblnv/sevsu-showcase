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
        Schema::create('users_teams', function (Blueprint $table) {
            $table->uuid('user_id');
            $table->uuid('team_id');
            $table->primary(['user_id', 'team_id']);
            $table->boolean('is_moderator')->default(0);
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('team_id')->references('id')->on('teams')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_teams');
    }
};
