@extends('layouts/app')

@section('content')

    <div class="container">
        <div class="jumbo border-5 border-warning">
            <img class="rounded-0 rounded-top-5 pt-3" src="{{ asset('storage/' . $restaurants->cover_image) }}" alt="">
        </div>
        <div class="card text-center border-5 border-warning rounded-0">
            <div class="card-body">
                <h2 class="card-title ">{{ $restaurants->activity_name }}</h2>
                <p class="card-text d-flex gap-2 justify-content-center">
                    @if ($restaurants->types->isEmpty())
                        <span>Tipologia: Non selezionata</span>
                    @else
                        <div class="icons d-flex gap-2 justify-content-center">
                            <span>Tipologia:</span>
                            @foreach ($restaurants->types as $type)
                                <img class="icon-images" src="{{ Vite::asset('resources/img/') . $type->icon_path }}"
                                    alt="">
                            @endforeach
                        </div>
                    @endif
                </p>
                <p class="card-text">Numero di telefono: {{ $restaurants->phone_number }}</p>
                <p class="card-text">Indirizzo: {{ $restaurants->address }}</p>
                <p class="card-text">P.IVA: {{ $restaurants->vat }}</p>

                <a href="{{ route('admin.dishes.index') }}" class="btn btn-primary">Vai al Menu</a>
            </div>
        </div>
    @endsection
