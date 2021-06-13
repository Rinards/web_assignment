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
        dump($movieList);
        return view('movies_index', compact('page', 'type', 'movieList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        dump($movie);
        $isSaved = false;
        if(Auth::user()){
            $user_id = Auth::user()->id;

            $listings = MovieList::where('user_id', '=', $user_id)->get();
            foreach($listings as $listing){
                if(MovieListing::where('id','=', $listing->movie_listing_id)->where('movie_id', '=', $movie['id'])->exists())
                $isSaved = true;
            }

            dump($listings);
            dump($isSaved);
        } 
        return view('movies_show', compact('movie', 'isSaved'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
