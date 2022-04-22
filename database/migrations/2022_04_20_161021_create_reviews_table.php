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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('good_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('title')->nullable();
            $table->text('review')->nullable();

            $table->foreign('good_id')->on('goods')->references('id');
            $table->foreign('company_id')->on('companies')->references('id');

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
        Schema::dropIfExists('reviews');
    }
};
