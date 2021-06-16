<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MovieListing;
use App\Models\Watching;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class WatchingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $listing_id = $request->listing_id;
        $listing = MovieListing::find($listing_id);
        DB::table('movie_lists')->where('movie_listing_id', '=', $listing_id)->limit(1)->update(array('status' => 'watching'));
        $watching = new Watching();
        $watching->movie_listing_id = $listing_id;
        $listing->watching()->save($watching);
        return redirect(route('listing.show', $listing_id));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $listing = MovieListing::find($id);
        $movie = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/tv/' . $listing->movie_id)->json();
        return view('watching', compact('movie', 'listing'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $newData = explode('-', $request->input('s-e'));
        DB::table('watchings')->where('movie_listing_id', '=', $id)->limit(1)->update(array('season' => $newData[0],  'episode' => $newData[1]));
        return redirect(route('listing.show', $id));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Watching::where('movie_listing_id', '=', $id)->delete();
        return redirect(route('listing.show', $id));
    }
}
