<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watching extends Model
{
    use HasFactory;
    protected $fillable = ['listing_id'];
    public function movieListing(){
        return $this->belongsTo(MovieListing::class, 'listing_id');
    }
}
