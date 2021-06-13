@extends('layouts.app')
@section('content')

<div class="d-flex flex-wrap justify-content-between">
@foreach ($tvList as $tvShow)
    <div class="p-3 m-1 border rounded d-flex flex-col w-1/5 justify-content-between align-items-center shadow-md hover:shadow-xl">

        <div class="w-30 d-flex">
            <a href="/{{ 'tv_show/'.$tvShow['id']}}">
                <img src="{{ 'https://image.tmdb.org/t/p/w154/'.$tvShow['poster_path'] }}" alt="poster" class="">
            </a>
        </div>
        <div class="py-2 d-flex flex-grow align-items-center">
            <h5 class="my-0 mx-auto text-center"><a href="/{{ 'tv_show/'.$tvShow['id']}}" class=" py-3 text-dark font-bold">{{ $tvShow['name'] }}</a></h5>
        </div>
        
    </div>
@endforeach
</div>

<x-paginator :type='$type' :page='$page'/>

@endsection