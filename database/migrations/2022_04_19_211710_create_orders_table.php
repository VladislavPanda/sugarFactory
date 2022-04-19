<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('good_id')->nullable();
            $table->unsignedBigInteger('pack_id')->nullable();
            $table->integer('quantity')->nullable();

            $table->foreign('user_id')->on('users')->references('id');
            $table->foreign('good_id')->on('goods')->references('id');
            $table->foreign('pack_id')->on('packs')->references('id');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
