<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->date('begin_at');
            $table->date('end_at');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('announce_id');
            $table->string('status');
            $table->decimal('price');
            $table->integer('total_days');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('announce_id')->references('id')->on('announces')->onDelete('cascade');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
