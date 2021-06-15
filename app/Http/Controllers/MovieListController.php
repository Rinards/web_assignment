<?php

namespace App\Http\Controllers;

use App\Models\MovieList;
use App\Models\MovieListing;
use App\Http\Controllers\MovieListingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MovieListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $data['result'] = false;
        $results = MovieList::where('user_id', '=', $user_id)->get();
        if (count($results) > 0){
            $data['result'] = true;
            $i = 0;
            foreach ($results as $result) {
                $listing_id = $result->movie_listing_id;
                $movie = DB::table('movie_listings')->select('movie_id', 'name', 'poster_path')->where('id', '=', $listing_id)->first();
                $data['list'][$i]['movie_id'] = $movie->movie_id;
                $data['list'][$i]['name'] = $movie->name;
                $data['list'][$i]['status'] = $result->status;
                $data['list'][$i]['poster_path'] = $movie->poster_path;
                $data['list'][$i]['id'] = $listing_id;
                $i++;
            }

        }
        return view('list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($listing_id)
    {
        $listing = MovieListing::find($listing_id);
        $list = new MovieList();
        $list->user_id = Auth::id();
        $listing->movieLists()->save($list);

        $type = $listing->type;
        if($type === 'movie') return redirect()->action([MoviesController::class, 'show'], ['id' => $listing->movie_id]);
        else return redirect()->action([TvController::class, 'show'], ['id' => $listing->movie_id]);
        
        //return view('list', compact('list', 'movie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        DB::table('movie_lists')->where('movie_listing_id', '=', $id)->limit(1)->update(array('status' => 'watched'));
        $type = MovieListing::select('type')->where('id', '=', $id)->first()->type;
        if ($type == 'tv') return redirect(route('watching.destroy', $id));
        return redirect()->action([MovieListingController::class, 'show'], $id);
    }
}
