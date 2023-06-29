@extends('layouts/app')

@section('content')

    <div class="container my-3">
        <h1 class="text-white m-4 text-center">
            <div class="card-header text-center">Benvenuto {{ Auth::user()->name }}</div>
        </h1>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card border-2 border-warning rounded-5 background">
                    <div class="card-body text-center text-white">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <span class="label-bg p-2">
                            {{ __("Hai effettuato l'accesso all'area amministrativa.") }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="jumbo border-5 border-warning">
            <img class="rounded-0 rounded-top-5 pt-3" src="{{ asset('storage/' . $restaurants->cover_image) }}"
                alt="">
        </div>
        <div class="card text-center border-5 rounded-0 background text-white">
            <div class="card-body m-3 label-bg">
                <h2 class="card-title">{{ $restaurants->activity_name }}</h2>
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

                <a href="{{ route('admin.dishes.index') }}" class="btn btn-secondary mb-2">Vai al Menu</a>
            </div>
        </div>
    </div>
@endsection