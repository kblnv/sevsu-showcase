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
        Schema::create('groups_flows', function (Blueprint $table) {
            $table->unsignedBigInteger('flow_id');
            $table->unsignedBigInteger('group_id');
            $table->primary(['flow_id', 'group_id']);
            $table->foreign('flow_id')->references('id')->on('flows');
            $table->foreign('group_id')->references('id')->on('groups');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_flows');
    }
};
