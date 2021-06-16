<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\MovieList;
use App\Models\MovieListing;

class TvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page=1)
    {
        $type = 'movies';
        $tvList = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/tv/popular?page=' . ($page))->json()['results'];
        return view('tv_index', compact('page', 'type', 'tvList'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tvShow = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/tv/' . $id)->json();
        $isSaved = false;
        if (Auth::user()) {
            $user_id = Auth::user()->id;

            $listings = MovieList::where('user_id', '=', $user_id)->get();
            foreach ($listings as $listing) {
                if (MovieListing::where('id', '=', $listing->movie_listing_id)->where('movie_id', '=', $tvShow['id'])->exists()) $isSaved = true;
            }
        } 
        return view('tv_show', compact('tvShow', 'isSaved'));
    }

    public function search(Request $request)
    {
        return Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/search/tv?query=' . $request->get('search'))->json()['results'];
    }
}
