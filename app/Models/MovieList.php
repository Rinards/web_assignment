<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieList extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'movie_listing_id'];

    public function movieListings() {
        return $this->belongsTo(MovieListing::class, 'movie_listing_id');
    }
}
