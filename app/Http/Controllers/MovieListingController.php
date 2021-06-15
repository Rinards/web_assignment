<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MovieListing;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\MovieListController;
use Illuminate\Support\Facades\Http;
use PhpParser\NodeVisitor\FirstFindingVisitor;

class MovieListingController extends Controller
{
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
        return redirect(route('list.create', $listing->id));
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
        if($type == 'tv'){
            $watching = DB::table('watchings')->select('episode', 'season')->where('movie_listing_id', '=', $id)->first();
            $listing->watching = $watching;
        }

        $status = $listing->movieLists()->select('status')->where('movie_listing_id', '=', $id)->first()->status;
        return view('listing_show', compact('listing', 'movie', 'status'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $listing = MovieListing::find($id);
        $type = $listing->type;
        if($type == 'tv'){
            $listing->watching()->delete();
        }
        $listing->movieLists()->delete();
        $listing->delete();
        return redirect()->action([MovieListController::class, 'index']);
    }
}
