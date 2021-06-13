@extends('layouts.app')
@section('content')
<h3 class="mb-4">{{ $tvShow['name'] }}</h3>
<div class="d-flex flex-row">
   <div class="w-1/3">
   <img src="{{ 'https://image.tmdb.org/t/p/w342/'.$tvShow['poster_path'] }}">
   </div>
   <div class="w-2/3 px-5 d-flex flex-col justify-content-between">
      <div>
         <p class="text-justify">{{ $tvShow['overview'] }}</p>
         <p>First air date: {{ \Carbon\Carbon::parse($tvShow['first_air_date'])->format('M d, Y') }}</p>
         <p>Average score: {{ $tvShow['vote_average']*10}}%</p>
         <p>Seasons: {{ sizeof($tvShow['seasons']) }}</p>
      </div>
      <div class="mb-5 mr-3 self-end">
         @if (Auth::user())
         <a href="#" class="p-3 bg-green-400 rounded-md text-dark">Add to list</a>
         <a href="#" class="p-3 bg-red-400 rounded-md text-dark">Remove</a>
         @else
         <p>Log in or register to add to your list.</p>
         @endif
      </div>

   </div>
</div>

@endsection