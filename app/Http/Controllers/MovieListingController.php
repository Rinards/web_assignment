<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MovieListing;
use App\Models\MovieList;
use App\Http\Controllers\MovieListController;
use Illuminate\Support\Facades\Http;
use PhpParser\NodeVisitor\FirstFindingVisitor;

class MovieListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $type = $request->type;
        $movie_id = $request->input('add');
        $movie = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/' . $type .'/' . $movie_id)->json();
        $poster_path = $movie['poster_path'];
        if($type === 'tv') $name = $movie['name'];
        if($type === 'movie') $name = $movie['title'];
        $listing = MovieListing::create([
            'type' => $type,
            'name' => $name,
            'movie_id' => $movie_id,
            'poster_path' => $poster_path
        ]);
        // return redirect()->action('MovieListController@create', ['listing_id' => $listing->id]);

        // TODO IF TYPE === TV REDIRECT TO WATCHIING.CREATE WHICH REDIRECTS TO LIST.CREATE

        return redirect(route('list.create', $listing->id));
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
        $listing = MovieListing::where('id','=', $id)->first();
        $type = $listing->type;
        $movie_id = $listing->movie_id;
        $movie = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/' . $type . '/' . $movie_id)->json();
        $status = MovieList::select('status')->where('movie_listing_id', '=', $id)->first()->status;
        return view('listing_show', compact('listing', 'movie', 'status'));
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
        MovieList::where('movie_listing_id', '=', $id)->delete();
        MovieListing::find($id)->delete();
        return redirect()->action([MovieListController::class, 'index']);
    }
}
