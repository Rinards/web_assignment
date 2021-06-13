<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_listings', function (Blueprint $table) {
            $table->id('id');
            $table->timestamps();
            $table->integer('movie_id');
            $table->string('name');
            $table->string('type');
            $table->string('poster_path');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie_listings');
    }
}
