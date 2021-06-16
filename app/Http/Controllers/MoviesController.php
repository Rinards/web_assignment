<?php

namespace App\Http\Controllers;

use App\Models\MovieList;
use App\Models\MovieListing;
use Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page=1)
    {   
        $type = 'movies';
        $movieList = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/popular?page='.($page))->json()['results'];
        return view('movies_index', compact('page', 'type', 'movieList'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/'.$id)->json();
        $isSaved = false;
        if(Auth::user()){
            $user_id = Auth::user()->id;
            $listings = MovieList::where('user_id', '=', $user_id)->get();
            foreach($listings as $listing){
                if(MovieListing::where('id','=', $listing->movie_listing_id)->where('movie_id', '=', $movie['id'])->exists())
                $isSaved = true;
            }
        } 
        return view('movies_show', compact('movie', 'isSaved'));
    }

    public function search(Request $request)
    {
        return Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/search/movie?query=' . $request->get('search'))->json()['results'];
    }
}
