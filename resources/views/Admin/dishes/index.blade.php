@extends('layouts/app')

@section('content')
    <div class="container d-flex justify-content-center align-items-center gap-4 py-4 flex-wrap">

        @foreach ($dishes as $dish)
            <div class="card cards border-5 rounded-5 background">
                @if ($dish->cover_image != 'https://static.vecteezy.com/ti/vettori-gratis/p1/5359703-cibo-icone-pixel-perfetto-illustrazione-vettoriale.jpg')
                    <img class="card-img-top rounded-0 rounded-top-5" src="{{ asset('storage/' . $dish->cover_image) }}" alt="...">
                @else
                    <img class="card-img-top rounded-0 rounded-top-5" src="{{ $dish->cover_image }}" alt="...">
                @endif
                <div class="card-body bg-dark text-white">
                    <h5 class="card-title label-bg text-white">{{ $dish->name }}</h5>
                    <p class="card-text">

                        @php
                            
                            echo mb_strimwidth($dish->description, 0, 60, "...");
                            
                        @endphp

                    </p>
                </div>
                <ul class="list-group list-group-flush bg-dark">
                    <li class="list-group-item bg-dark text-white">Prezzo: {{ $dish->price }}€</li>
                    <li class="list-group-item bg-dark text-white">Disponibilità: {{ $dish->availability ? 'Disponibile' : 'Non disponibile' }}</li>
                    <li class="list-group-item bg-dark text-white">Intolleranza: {{ $dish->intolerance == null ? 'Nessuna' : $dish->intolerance }}</li>
                </ul>
                <div class="card-body d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.dishes.edit', $dish->slug) }}" class="card-link btn btn-dark fw-bold">Modifica piatto</a>

                    <button class="btn btn-danger fw-bold" type="button" data-bs-toggle="modal" data-bs-target="#dishModal{{ $dish->id }}">
                        Elimina
                    </button>
                </div>
            </div>

            @if(isset($dish))
            <div class="modal fade text-white fw-bold" id="dishModal{{$dish->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content bg-dark">
                        <div class="modal-header">
                            <h1 class="modal-title fs-4" id="exampleModalLabel">Elimina piatto</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Sicuro di voler eliminare il piatto <span class="text-danger fw-bold">{{ $dish->name }}</span> ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary delete-btn"
                                data-bs-dismiss="modal">CHIUDI<span></span></button>
                            <form action="{{ route('admin.dishes.destroy', $dish) }}" method="POST">
                                @csrf
                                @method('DELETE')
    
                                <button type="submit" class="btn btn-danger text-dark">ELIMINA<span></span></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            
        @endforeach
    </div>
    <div class="container d-flex justify-content-center mb-5">
        <a class="btn btn-outline-warning" href="{{ route('admin.dishes.create') }}">Aggiungi un piatto</a>
    </div>
@endsection
