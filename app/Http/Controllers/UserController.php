<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('is-admin')){
            $users = User::all();
            return view('users', compact('users'));
        }
        else return redirect('movies');
        // ->withErrors('Access Denied!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $user = User::find($id);
        $lists = $user->movieLists()->get();
        foreach($lists as $list){
            $listing = $list->movieListings()->first();
            $listing->watching()->delete();
            $listing->delete();
        }
        $user->delete();
        return redirect(route('users'));
    }
}
