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
        Schema::create('announces', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('address');
            $table->decimal('price_per_night', 8, 2);
            $table->string('type');
            $table->boolean('is_disponible')->default(true);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announces');
    }
};
