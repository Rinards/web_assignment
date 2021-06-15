<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWatchingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('watchings', function (Blueprint $table) {
            $table->timestamps();
            $table->foreignId('movie_listing_id')->references('id')->on('movie_listings')->onDelete('cascade')->unique()->unsigned();
            $table->integer('season')->default(1)->unsigned();
            $table->integer('episode')->default(1)->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('watchings', function (Blueprint $table) {
            $table->dropForeign('watchings_movie_listing_id_foreign');
            $table->dropColumn('movie_listing_id');
        });
        Schema::dropIfExists('watchings');
    }
}
