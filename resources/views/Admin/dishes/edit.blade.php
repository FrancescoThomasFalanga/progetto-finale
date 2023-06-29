@extends('layouts/app')

@section('content')

@php
$intolerances = ['Glutine',
    'Lattosio',
    'Uova',
    'Crostacei',
    'Frutta-secca',
    'Soia',
    'Pesce',
    'Nichel',]
@endphp

    <div class="go-back-btn text-center d-flex justify-content-center align-items-center gap-4" style="margin-top:100px">
        <h2 class="mb-4 green text-uppercase text-white">Modifica Piatto</h2>
    </div>

    <div class="container" style="padding-bottom: 100px">

        <form class="background form-control border-5 rounded-5" action="{{route('admin.dishes.update', $dish->slug)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
    
    
            <label class="mt-5 mb-2 label-bg text-white" for="name">*Nome:</label>
            <input name="name" id="name" type="text" class="form-control input @error('name') is-invalid @enderror" value="{{old('name') ?? $dish->name}}" required>
            @error('name')
            <div class="invalid-feedback mb-3 mt-0">
                {{$message}}
            </div>
            @enderror

            <label class="mt-5 mb-2 label-bg text-white" for="description">Descrizione:</label>
            <input name="description" id="description" type="text" class="form-control input @error('description') is-invalid @enderror" value="{{old('description') ?? $dish->description}}">
            @error('description')
            <div class="invalid-feedback mb-3 mt-0">
                {{$message}}
            </div>
            @enderror
        
            <label for="price" class="mt-5 mb-2 label-bg text-white">*Prezzo:</label>
            <input min="0" max="999.99" step=".01" name="price" id="price" type="number" class="form-control input @error('price') is-invalid @enderror" value="{{old('price') ?? $dish->price}}" required>
            @error('price')
            <div class="invalid-feedback mb-3 mt-0">
                {{$message}}
            </div>
            @enderror

            <label for="availability" class="mt-5 mb-2 label-bg text-white">*Disponibilità:</label>
            <select name="availability" id="availability" class="form-select @error('availability') is-invalid @enderror"
                aria-label="Default select example" required>
                <option selected>Seleziona</option>
                <option value="1" @if (old('availability', $dish->availability) == '1') selected @endif>Disponibile</option>
                <option value="0" @if (old('availability', $dish->availability) == '0') selected @endif>Non Disponibile</option>
            </select>
            @error('availability')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            <h6 class="mt-5 mb-2 label-bg text-white">Intolleranze:</h6>
            <div class="d-flex flex-column gap-2 align-items-start label-bg text-white" style="width: fit-content">
                @foreach ($intolerances as $item)
                <div>
                    <label for="{{$item}}">{{$item}}</label>
                    @if ($errors->any())
                        <input type="checkbox" name="intolerance[]" id="{{$item}}" value="{{$item}}" @checked(in_array($item, old('intolerance',[]))) >
                    @else
                    @php
                    $intoleranceArray = explode(',', $dish->intolerance);
                    $intoleranceArray = array_map('trim', $intoleranceArray);
                    @endphp
                        <input type="checkbox" name="intolerance[]" id="{{$item}}" value="{{$item}}" {{ in_array($item, $intoleranceArray) ? 'checked' : '' }}>
                    @endif
                </div>
                @endforeach
            </div>

            <label for="cover_image" class="mt-5 mb-2 label-bg text-white">Immagine di copertina:</label>
            <input onchange="previewImage()" name="cover_image" id="cover_image" type="file" class="form-control @error('cover_image') is-invalid @enderror">
            @error('cover_image')
            <div class="invalid-feedback mb-3 mt-0">
                {{$message}}
            </div>
            @enderror

            <hr>

            <span class="mt-2 mb-3 text-center label-bg text-white">Anteprima Immagine:</span>
            <img id="preview">
        
            <div class="buttons py-4 text-center">

                <button id="send" type="submit" class="btn btn-dark">Invia</button>
                <a class="btn btn-danger" href="{{route('admin.dishes.index')}}">Torna indietro <span></span></a>

            </div>
            
        </form>

    </div>
    

@endsection