{{-- VIEW FOR SHOWING MOVIE / TV SHOW WITH FUNCTIONALITY TO ADD IT TO LIST --}}
@extends('layouts.app')
@section('content')
<h3 class="mb-4">{{ $movie['title'] }}</h3>
<div class="d-flex flex-row">
   <div class="w-1/3">
   <img src="{{ 'https://image.tmdb.org/t/p/w342/'.$movie['poster_path'] }}">
   </div>
   <div class="w-2/3 px-5 d-flex flex-col justify-content-between">
      <div>
         <p class="text-justify">{{ $movie['overview'] }}</p>
         <p>Release date: {{ \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y') }}</p>
         <p>Average score: {{ $movie['vote_average']*10}}%</p>
      </div>
      <div class="mb-5 mr-3 self-end">
         @if (Auth::user())
         
         <form action="{{ route('listing.create', 'movie') }}" method='post'>
            @csrf
            <button class="p-3 bg-green-400 rounded-md text-dark"name="add" value="{{ $movie['id'] }}">Add to list</button>
         </form>

         <form action="/" method='post'>
            @csrf
            <button class="p-3 bg-red-400 rounded-md text-dark" name="add" value="{{ $movie['id'] }}">Remove</button>
         </form>
         @else
         <p>Log in or register to add to your list.</p>
         @endif
      </div>

   </div>
</div>

@endsection