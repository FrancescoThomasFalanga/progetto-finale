@extends('layouts/app')
 
@section('content')
<div class="container p-3">
    {{-- {{dd($dishes)}} --}}

    <h1>
        Ordine N. {{$order->id}}
    </h1>
    <ul>
        @foreach ($dishes as $item)
        <li>
            {{$item->name}} 
        </li>
        @endforeach
    </ul>
</div>
@endsection