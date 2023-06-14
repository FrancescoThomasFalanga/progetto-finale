@extends('layouts/app')

@section('content')
    <div class="jumbo">
        <img class="py-4" src="{{ asset('storage/' . $restaurants->cover_image) }}" alt="">
    </div>
    <div class="container">
        <div class="card text-center border-0">
            <div class="card-body ">
                <h5 class="card-title ">{{ $restaurants->activity_name }}</h5>
                <p class="card-text">Numero di telefono: {{ $restaurants->phone_number }}</p>
                <p class="card-text">Indirizzo: {{ $restaurants->address }}</p>
                <p class="card-text">P.IVA: {{ $restaurants->vat }}</p>
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
               
                <a href="{{ route('admin.dishes.index', 'id=' . $restaurants) }}" class="btn btn-primary">Vai al Menu</a>
            </div>
        </div>
    @endsection
