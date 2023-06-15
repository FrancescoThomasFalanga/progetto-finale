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
        
            <label for="price" class="pt-5">Prezzo:</label>
            <input name="price" id="price" type="text" class="form-control input @error('price') is-invalid @enderror" value="{{old('price') ?? $dish->price}}" required>
            @error('price')
            <div class="invalid-feedback mb-3 mt-0">
                {{$message}}
            </div>
            @enderror

            <label for="availability" class="pt-5">Disponibilità:</label>
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
                <div>
                    
                    <label for="Glutine">Glutine</label>
                    <input type="checkbox" name="intolerance[]" id="Glutine" value="Glutine" >
                </div>
                <div>
                    
                    <label for="Lattosio">Lattosio</label>
                    <input type="checkbox" name="intolerance[]" id="Lattosio" value="Lattosio" >
                </div>
                <div>
                    <label for="Uova">Uova</label>
                    <input type="checkbox" name="intolerance[]" id="Uova" value="Uova" >
                </div>
                <div>
                    <label for="Crostacei">Crostacei</label>
                    <input type="checkbox" name="intolerance[]" id="Crostacei" value="Crostacei" >
                </div>
                <div>
                    <label for="Frutta-secca">Frutta secca</label>
                    <input type="checkbox" name="intolerance[]" id="Frutta-secca" value="Frutta-secca" >
                </div>
                <div>
                    <label for="Soia">Soia</label>
                    <input type="checkbox" name="intolerance[]" id="Soia" value="Soia" >
                </div>
                <div>
                    <label for="Pesce">Pesce</label>
                    <input type="checkbox" name="intolerance[]" id="Pesce" value="Pesce" >
                </div>
                <div>
                    <label for="Nichel">Nichel</label>
                    <input type="checkbox" name="intolerance[]" id="Nichel" value="Nichel" >
                </div>
            </div>

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