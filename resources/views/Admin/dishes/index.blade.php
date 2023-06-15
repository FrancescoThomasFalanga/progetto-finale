@extends('layouts/app')

@section('content')
    <div class="container d-flex gap-4 py-4 ">

        @foreach ($dishes as $dish)
            <div class="card" style="width: 18rem;">
                @if ($dish->cover_image != 'https://static.vecteezy.com/ti/vettori-gratis/p1/5359703-cibo-icone-pixel-perfetto-illustrazione-vettoriale.jpg')
                    <img src="{{ asset('storage/' . $dish->cover_image) }}" class="card-img-top" alt="...">
                @else
                    <img src="{{ $dish->cover_image }}" class="card-img-top" alt="...">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $dish->name }}</h5>
                    <p class="card-text">{{ $dish->description }}</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Prezzo: {{ $dish->price }}€</li>
                    <li class="list-group-item">Disponibilità: {{ $dish->availability ? 'Disponibile' : 'Non disponibile' }}
                    </li>
                    <li class="list-group-item">Intolleranza: {{ $dish->intolerance == null ? 'Nessuna' : $dish->intolerance }}
                    </li>
                </ul>
                <div class="card-body d-flex gap-3 align-items-center ">
                    <a href="{{ route('admin.dishes.edit', $dish->slug) }}"
                        class="card-link btn btn-primary fw-bold">Modifica piatto</a>

                    <button class="btn btn-danger fw-bold" type="button" data-bs-toggle="modal" data-bs-target="#dishModal{{ $dish->id }}">
                        Elimina
                    </button>
                </div>
            </div>

            @if(isset($dish))
            <div class="modal fade text-primary" id="dishModal{{$dish->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-4" id="exampleModalLabel">Elimina piatto</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Sicuro di voler eliminare il piatto?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary delete-btn"
                                data-bs-dismiss="modal">CHIUDI<span></span></button>
                            <form action="{{ route('admin.dishes.destroy', $dish) }}" method="POST">
                                @csrf
                                @method('DELETE')
    
                                <button type="submit" class="btn btn-secondary">ELIMINA<span></span></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            
        @endforeach



    </div>
    <div class="container">
        <a class="btn btn-primary" href="{{ route('admin.dishes.create') }}">Aggiungi un piatto</a>
    </div>
@endsection
