@extends('layouts.app')
@section('content')
<div class="block w-100 relative">
    <x-label for="search" value="Search"></x-label>
    <x-input id="search" type="text" name="search" class="block mt-1 mb-5 w-full" placeholder="Search TV Shows..."></x-input>
    <div id="search-result" class="absolute bg-gray-300 w-100 block rounded-md shadow-xl top-20"></div>
</div>
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
<script>
    $(document).ready(function () {
        function getResults(e){
            if (e.keyCode == 8 && $('#search').val().length <= 2) $('#search-result').html('');
            if ($('#search').val().length > 2) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var url = "{{ action([App\Http\Controllers\TvController::class, 'search']) }}";
                $.post(url, { search: $('#search').val(), _token: CSRF_TOKEN }, function(data) {
                    $('#search-result').html('');
                    $.each(data, function (i, tv) {
                        if (i == 10) return false
                        let p = document.createElement("p");
                        p.classList.add("m-2", "p-2", "rounded-md", "bg-gray-100",)
                        let a = document.createElement("a");
                        a.classList.add("text-lg", "text-dark", "w-100")
                        a.innerHTML = tv['name'];
                        a.href = "/tv_show/" + tv['id'];
                        p.append(a);
                        $('#search-result').append(p);
                    })
                })
            }
        }
        $('#search').keyup(function (e) {
            getResults(e);
        })
        $('#search').focus(function (e) {
            getResults(e);
        })
        $('#search').focusout(function () {
            setTimeout(function(){
                    $('#search-result').html('');
            }, 500)
        });
    });
</script>
@endsection