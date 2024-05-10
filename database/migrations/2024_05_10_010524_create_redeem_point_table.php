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
        Schema::create('redeem_point', function (Blueprint $table) {
            $table->id('redeem_id');
            $table->string('name_rewarder');
            $table->string('logo_rewarder');
            $table->string('title_rewarder');
            $table->integer('point_rewarder');
            $table->string('description_rewarder');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('redeem_point');
    }
};
