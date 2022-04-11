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
        Schema::create('goods', function (Blueprint $table) {
            $table->id();
            $table->string('title', 20)->nullable();
            $table->string('short_description')->nullable();
            $table->string('forma')->nullable();
            $table->text('description')->nullable();
            $table->string('nutritional_value')->nullable();
            $table->string('energy_value')->nullable();
            $table->string('shelf_life')->nullable();
            $table->json('images')->nullable();

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
        Schema::dropIfExists('goods');
    }
};
