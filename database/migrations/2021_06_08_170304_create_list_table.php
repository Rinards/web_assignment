<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_lists', function (Blueprint $table) {
            $table->timestamps();
            $table->integer('user_id');
            $table->foreignId('movie_listing_id')->references('id')->on('movie_listings')->onDelete('cascade')->unique()->unsigned();
            $table->string('status')->default('watchlisted');
            
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movie_lists', function(Blueprint $table) {
            $table->dropForeign('movie_lists_movie_listing_id_foreign');
            $table->dropColumn('movie_listing_id');
        });
        Schema::dropIfExists('movie_lists');
    }
}
