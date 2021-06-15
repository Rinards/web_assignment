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
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade')->unsigned();
            $table->foreignId('movie_listing_id')->references('id')->on('movie_listings')->onDelete('cascade')->unsigned();
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
            $table->dropForeign('movie_lists_user_id_foreign');
            $table->dropColumn('user_id');
        });
        Schema::dropIfExists('movie_lists');
    }
}
