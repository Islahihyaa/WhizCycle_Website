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
        Schema::create('schedule_pickup', function (Blueprint $table) {
            $table->id('schedule_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('user');
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->foreign('driver_id')->references('driver_id')->on('driver');
            $table->date('pickup_date');
            $table->time('pickup_time');
            $table->string('category_trash');
            $table->integer('amount');
            $table->string('notes');
            $table->string('file_payment');
            $table->string('status')->default('Menunggu Proses Verifikasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_pickup');
    }
};
