{{-- VIEW FOR SHOWING ALL MOVIES / TV SHOWS --}}
@extends('layouts.app')
@section('content')

<div class="d-flex flex-wrap justify-content-between">
@foreach ($movieList as $movie)
    <div class="p-3 m-1 border rounded d-flex flex-col w-1/5 justify-content-between align-items-center">

        <div class="w-30">
            <a href="/{{ 'movie/'.$movie['id']}}">
                <img src="{{ 'https://image.tmdb.org/t/p/w154/'.$movie['poster_path'] }}" alt="poster" class="">
            </a>
        </div>


        
        <div class="py-2 d-flex flex-grow align-items-center">
            <h5 class="my-0 mx-auto text-center"><a href="/{{ 'movie/'.$movie['id']}}" class=" py-3 text-dark font-bold">{{ $movie['title'] }}</a></h5>
        </div>
        
    </div>
@endforeach
</div>

<x-paginator :type='$type' :page='$page'/>


@endsection