@extends('layouts/app')

@section('content')
    <div class="jumbo">
        <img src="{{ asset('storage/' . $restaurants->cover_image) }}" alt="">
    </div>
    <div class="container">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">{{ $restaurants->activity_name }}</h5>
                <p class="card-text">Numero di telefono: {{ $restaurants->phone_number }}</p>
                <p class="card-text">Indirizzo: {{ $restaurants->address }}</p>
                <p class="card-text">P.IVA: {{ $restaurants->vat }}</p>
                <p class="card-text">Tipologia:
                    @if ($restaurants->types->isEmpty())
                    <span>Non selezionata</span>
                    @endif
                    @foreach ($restaurants->types as $type)
                        <span>{{ $type->name }}</span>
                    @endforeach

                </p>
                <a href="#" class="btn btn-primary">Button</a>
            </div>
        </div>
    @endsection
