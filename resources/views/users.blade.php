@extends('layouts.app')
@section('content')
<div>
   <form action="{{ route('users.destroy') }}" method="GET">
      @csrf
      <table class="w-full table-auto">
         <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
               <th class="py-3 px-6 text-left">ID</th>
               <th class="py-3 px-6 text-left">Name</th>
               <th class="py-3 px-6 text-left">Email</th>
               <th class="py-3 px-6 text-left">Delete</th>
            </tr>
         </thead>
         <tbody class="text-gray-600 text-sm font-light">
            @foreach ($users as $user)
            @if ($user->role == 1)
               @continue
            @endif
            <tr class="border-b border-gray-200 hover:bg-gray-100">
               <td class="py-3 px-6 text-left whitespace-nowrap">{{ $user->id }}</td>
               <td class="py-3 px-6 text-left whitespace-nowrap">{{ $user->name }}</td>
               <td class="py-3 px-6 text-left whitespace-nowrap">{{ $user->email }}</td>
               <td class="py-3 px-6 text-left whitespace-nowrap">
                  <button type="submit" name="id" value="{{ $user->id }}" class="bg-red-400 text-white font-bold py-2 px-3 rounded-md">Delete</button>
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </form>
</div>


@endsection