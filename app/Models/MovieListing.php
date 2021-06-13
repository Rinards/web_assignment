<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieListing extends Model
{
    use HasFactory;

    protected $fillable = [
        'movie_id',
        'name',
        'type',
        'poster_path'        
    ] ;

    public function movieLists(){
        return $this->hasOne(MovieList::class);
    }
}
