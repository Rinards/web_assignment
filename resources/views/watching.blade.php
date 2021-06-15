@extends('layouts.app')
@section('content')
<h3 class="mb-4">{{ $movie['name'] }}</h3>
<div class="d-flex flex-row">
   <div class="w-1/3">
   <img src="{{ 'https://image.tmdb.org/t/p/w342/'.$movie['poster_path'] }}">
   </div>
   <div class="w-2/3 px-5 d-flex flex-col mb-5">
      <form action="{{ route('watching.edit', $listing->id) }}" method="POST">
         @csrf
         @foreach ($movie['seasons'] as $season)
            <div>
               <h4 class="pb-2">{{ $season['name'] }}</h4>
               <div>
               @for($i = 1; $i <= $season['episode_count']; $i++)
                  <button type="submit" name="s-e" value="{{ $season['season_number']."-"."$i" }}" class="mb-1 px-3 py-2 bg-blue-200 rounded">{{ $i }}</button>
               @endfor
               </div>
            </div>
         @endforeach
      </form>
   </div>
</div>

@endsection