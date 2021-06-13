{{-- VIEW FOR SHOWING USERS LIST OF LISTINGS --}}
@extends('layouts.app')
@section('content')
<h1>List</h1>
<p>This is the list page</p>
<?php
//dump($list);
   //echo $list->user_id . "<br>" . $list->listing_id;
   //dump($results[1]);
   dump($data['list']);

   
?>
   <div class="d-flex flex-row flex-wrap self-center">
      @foreach($data['list'] as $listing)
      <div class="shadow-md w-1/4 border rounded-xl p-2 my-3 mx-4 cursor-pointer hover:shadow-xl">
         <a class="text-dark" href="/listing/{{ $listing['id'] }}">
            <img class="mx-auto my-0"src="{{ 'https://image.tmdb.org/t/p/w185/'.$listing['poster_path'] }}">
            <div class="d-flex flex-col flex-grow justify-content-between">
               <h6 class="text-center px-2 font-bold pt-2">{{ $listing['name'] }}</h6>
               @if ($listing['status'] === 'watchlisted')
               <h6 class="text-center">Watchlisted</h6>
               @elseif ($listing['status'] === 'watched')
               <h6 class="text-center">Watched</h6>
               @elseif ($listing['status'] === 'watching')
               <h6 class="text-center">Watching</h6>
               @endif
            </div>
         </a>
      </div>
      @endforeach
   </div>



@endsection