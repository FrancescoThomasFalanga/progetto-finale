@extends('layouts/app')

@section('content')
    <h1 class="m-4 text-center text-white">Aggiungi un ristorante</h1>

    <form onsubmit="return validateForm()" class="container form-control border-5 border-warning rounded-5 py-4" action="{{ route('admin.restaurants.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="activity_name">*Nome dell'attività</label>
            <input type="text" name="activity_name" id="activity_name"
                class="form-control @error('activity_name') is-invalid @enderror" value="{{ old('activity_name') }}" required>
            @error('activity_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="phone_number">*Numero di telefono</label>
            <input type="tel" name="phone_number" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" id="phone_number"
                class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}" required>
            <small>Formato: 123-456-7890</small>
            @error('phone_number')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="address">*Indirizzo</label>
            <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror"
                value="{{ old('address') }}" required>
            @error('address')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="vat">*Partita IVA</label>
            <input minlength="11" maxlength="15" type="text" name="vat" id="vat" class="form-control @error('vat') is-invalid @enderror"
                value="{{ old('vat') }}" required>
            @error('vat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-4 form-group">
            <p id="paragraph">*Tipologia del locale</p>
            @foreach ($types as $type)
                <div class="form-check @error('types') is-invalid @enderror">
                    <input type="checkbox" class="form-check-input" name="types[]" id="type_{{ $type->id }}" value="{{ $type->id }}" @checked(in_array($type->id, old('types', [])))>
                    <label for="type-{{ $type->id }}">{{ $type->name }}</label>
                </div>
            @endforeach
            @error('types')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="cover_image" class="">*Copertina ristorante</label>
            <input onchange="previewImage()" name="cover_image" id="cover_image" type="file"
                class="form-control @error('cover_image') is-invalid @enderror" required>
            @error('cover_image')
                <div class="invalid-feedback mb-4 mt-0"> {{ $message }} </div>
            @enderror

            <hr>

            <span class="my-5 text-center">Anteprima Immagine:</span>
            <img id="preview">

        </div>

        <button class="btn btn-primary" type="submit">Aggiungi</button>
    </form>
@endsection