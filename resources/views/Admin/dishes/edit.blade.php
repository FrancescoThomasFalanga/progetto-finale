@extends('layouts/app')

@section('content')

    <div class="go-back-btn text-center d-flex justify-content-center align-items-center gap-4" style="margin-top:100px">

        <h2 class="mb-0 green text-uppercase">Modifica Piatto</h2>

    </div>

    <div class="container " style="padding-bottom: 100px">

        <form class="form" action="{{route('admin.dishes.update', $dish->slug)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
    
    
            <label class="pt-5" for="name">Nome:</label>
            <input name="name" id="name" type="text" class="form-control input @error('name') is-invalid @enderror" value="{{old('name') ?? $dish->name}}">
            @error('name')
            <div class="invalid-feedback mb-3 mt-0">
                {{$message}}
            </div>
            @enderror

            <label class="pt-5" for="description">Descrizione:</label>
            <input name="description" id="description" type="text" class="form-control input @error('description') is-invalid @enderror" value="{{old('description') ?? $dish->description}}">
            @error('description')
            <div class="invalid-feedback mb-3 mt-0">
                {{$message}}
            </div>
            @enderror
        
            <label for="price" class="pt-5">Prezzo:</label>
            <input name="price" id="price" type="text" class="form-control input @error('price') is-invalid @enderror" value="{{old('price') ?? $dish->price}}">
            @error('price')
            <div class="invalid-feedback mb-3 mt-0">
                {{$message}}
            </div>
            @enderror

            <label for="availability" class="pt-5">Disponibilità:</label>
            <input name="availability" id="availability" type="text" class="form-control input @error('availability') is-invalid @enderror" value="{{old('availability') ?? $dish->availability}}">
            @error('availability')
            <div class="invalid-feedback mb-3 mt-0">
                {{$message}}
            </div>
            @enderror
        
            <label for="intolerance" class="pt-5">Intolleranze:</label>
            <input name="intolerance" id="intolerance" type="text" class="form-control input @error('intolerance') is-invalid @enderror" value="{{old('intolerance') ?? $dish->intolerance}}">
            @error('intolerance')
            <div class="invalid-feedback mb-3 mt-0">
                {{$message}}
            </div>
            @enderror

            <label for="cover_image" class="pt-5">Immagine di copertina:</label>
            <input name="cover_image" id="cover_image" type="file" class="form-control @error('cover_image') is-invalid @enderror">
            @error('cover_image')
            <div class="invalid-feedback mb-3 mt-0">
                {{$message}}
            </div>
            @enderror
        
            <div class="buttons py-4 text-center">

                <button id="send" type="submit" class="btn btn-primary">Invia</button>
                <a class="btn btn-secondary" href="{{route('admin.dishes.index')}}">Torna indietro <span></span></a>

            </div>
            
        </form>

    </div>
    

@endsection