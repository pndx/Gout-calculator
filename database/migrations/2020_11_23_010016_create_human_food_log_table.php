<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHumanFoodLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('human_food_log', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('human_id');
            $table->foreign('human_id')->references('id')->on('humans');
            $table->unsignedBigInteger('food_id');
            $table->foreign('food_id')->references('id')->on('food');
            $table->unsignedDecimal('weight');
            $table->unsignedDecimal('purine');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('human_food_log');
    }
}
