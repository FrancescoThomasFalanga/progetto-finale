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

    <div class="container " style="padding-bottom: 100px">

        <form class="form-control border-5 border-warning rounded-5" action="{{route('admin.dishes.update', $dish->slug)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
    
    
            <label class="pt-5" for="name">*Nome:</label>
            <input name="name" id="name" type="text" class="form-control input @error('name') is-invalid @enderror" value="{{old('name') ?? $dish->name}}" required>
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
        
            <label for="price" class="pt-5">*Prezzo:</label>
            <input name="price" id="price" type="text" class="form-control input @error('price') is-invalid @enderror" value="{{old('price') ?? $dish->price}}" required>
            @error('price')
            <div class="invalid-feedback mb-3 mt-0">
                {{$message}}
            </div>
            @enderror

            <label for="availability" class="pt-5">*Disponibilità:</label>
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

            <h6 class="pt-5">Intolleranze:</h6>
            <div class="d-flex flex-column gap-2 align-items-start">
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

            <label for="cover_image" class="pt-5">Immagine di copertina:</label>
            <input name="cover_image" id="cover_image" type="file" class="form-control @error('cover_image') is-invalid @enderror">
            @error('cover_image')
            <div class="invalid-feedback mb-3 mt-0">
                {{$message}}
            </div>
            @enderror

            <hr>

            <span class="my-5 text-center">Anteprima Immagine:</span>
            @if ($dish->cover_image != 'https://static.vecteezy.com/ti/vettori-gratis/p1/5359703-cibo-icone-pixel-perfetto-illustrazione-vettoriale.jpg')
                <img class="" src="{{ asset('storage/' . $dish->cover_image) }}" class="card-img-top" alt="..." style="width: 100%; height: 400px; object-fit:contain;">
            @else
                <img class="" src="{{ $dish->cover_image }}" class="card-img-top" alt="..." style="width: 100%; height: 400px; object-fit:contain;">
            @endif
        
            <div class="buttons py-4 text-center">

                <button id="send" type="submit" class="btn btn-primary">Invia</button>
                <a class="btn btn-secondary" href="{{route('admin.dishes.index')}}">Torna indietro <span></span></a>

            </div>
            
        </form>

    </div>
    

@endsection