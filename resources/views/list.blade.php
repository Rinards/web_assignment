{{-- VIEW FOR SHOWING USERS LIST OF LISTINGS --}}
@extends('layouts.app')
@section('content')
<h1>My List</h1>   
   <div class="d-flex flex-row flex-wrap self-center">
      @if ($data['result'])
      @foreach($data['list'] as $listing)
      <div class="shadow-md w-1/4 border rounded-xl p-2 my-3 mx-4 cursor-pointer hover:shadow-xl">
         <a class="text-dark hover:no-underline" href="{{ route('listing.show', $listing['id'])}}">
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
      @else
          <h4 class="pt-4">You have no listings.</h4>
      @endif
   </div>
@endsection