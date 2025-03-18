<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('корзины', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('пользователь_id');
            $table->unsignedBigInteger('товар_id');
            $table->integer('количество')->default(1);
            $table->timestamps();

            $table->foreign('пользователь_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('товар_id')->references('id')->on('товары')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('корзины');
    }
};
