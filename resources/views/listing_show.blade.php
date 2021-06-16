@extends('layouts.app')
@section('content')
@if ($listing->type === 'tv')
   <h3 class="mb-4">{{ $movie['name'] }}</h3>
@elseif($listing->type === 'movie')
   <h3 class="mb-4">{{ $movie['title'] }}</h3>
@endif
<div class="d-flex flex-row">
   <div class="w-1/3">
   <img src="{{ 'https://image.tmdb.org/t/p/w342/'.$movie['poster_path'] }}">
   </div>
   <div class="w-2/3 px-5 d-flex flex-col justify-content-between">
      <div class="mb-3">
         <p class="text-justify">{{ $movie['overview'] }}</p>
         @if ($listing->type === 'tv')
             <p>First air date: {{ \Carbon\Carbon::parse($movie['first_air_date'])->format('M d, Y') }}</p>
         @elseif ($listing->type === 'movie')
             <p>Release date: {{ \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y') }}</p>
         @endif
         <p>Average score: {{ $movie['vote_average']*10}}%</p>
         @if ($listing->type === 'tv')
            <p>Seasons: {{ sizeof($movie['seasons']) }}</p>
         @endif
         @if ($status === 'watchlisted')
            <p class="mb-1 font-bold">
               Status: Watchlisted
            </p>
         @elseif ($status === 'watched')
            <p class="mb-1 font-bold">
               Status: Watched
            </p>
         @elseif ($status == 'watching')
            <h5>Currently watching:</h5>
            <p class="ml-3">
               @if ($listing->watching->season == 0)
                  Season: {{ $movie['seasons'][0]['name']}} <br>
               @else
                  Season: {{ $listing->watching->season }} <br>
               @endif
               Episode: {{ $listing->watching->episode }}
            </p>
         @endif
      </div>
      <div class="mb-5 mr-3 self-end d-flex">
         @if ($status === 'watchlisted' && $listing->type === 'tv')
            <form action="{{ route('watching.create', $listing->id) }}" method='post' class="ml-3">
                  @csrf
               <button class="p-3 bg-green-400 rounded-md text-dark"name="add" value="{{ $movie['id'] }}">Start Watching</button>
            </form>
         @endif

         @if ($listing->type === 'tv' && $status === 'watching')
            <form action="{{ route('watching.show', $listing->id) }}" method='post' class="ml-3">
                  @csrf
               <button class="p-3 bg-green-400 rounded-md text-dark"name="change" value="{{ $movie['id'] }}">Change current episode</button>
            </form>
         @endif
         @if(($listing->type =='movie' && $status != 'watched') || ($listing->type=='tv' && $status == 'watching'))
            <form action="{{ route('list.edit', $listing->id) }}" method='post' class="ml-3">
                  @csrf
               <button class="p-3 bg-blue-400 rounded-md text-dark"name="watched" value="{{ $movie['id'] }}">Watched</button>
            </form>
         @endif
            <form action="{{ route('listing.destroy', $listing->id) }}" method='post' class="ml-3">
               @csrf
               <button class="p-3 bg-red-400 rounded-md text-dark" name="remove" value="{{ $movie['id'] }}">Remove</button>
            </form>
      </div>
   </div>
</div>
@endsection