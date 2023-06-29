@extends('layouts/app')

@section('content')
    <h1 class="m-4 text-center text-white">Aggiungi un ristorante</h1>

    <form onsubmit="return validateForm()" class="background container form-control border-5 border-warning rounded-5 py-4" action="{{ route('admin.restaurants.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="mt-2 mb-2 label-bg text-white" for="activity_name">*Nome dell'attività</label>
            <input type="text" name="activity_name" id="activity_name"
                class="form-control text-dark @error('activity_name') is-invalid @enderror" value="{{ old('activity_name') }}" required>
            @error('activity_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="mt-2 mb-2 label-bg text-white" for="phone_number">*Numero di telefono</label>
            <input type="tel" name="phone_number" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" id="phone_number"
                class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}" required>
            <small class="fw-bold text-white label-bg p-0 px-1 mt-1">Formato: 123-456-7890</small>
            @error('phone_number')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="mt-2 mb-2 label-bg text-white" for="address">*Indirizzo</label>
            <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror"
                value="{{ old('address') }}" required>
            @error('address')
                <div class="invalid-feedback text-dark">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="mt-2 mb-2 label-bg text-white" for="vat">*Partita IVA</label>
            <input minlength="11" maxlength="15" type="text" name="vat" id="vat" class="form-control @error('vat') is-invalid @enderror"
                value="{{ old('vat') }}" required>
            @error('vat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-4 form-group d-flex flex-column">
            <p id="paragraph" class="mt-2 mb-2 label-bg text-white" style="width: fit-content">*Tipologia del locale</p>
            <div class="label-bg text-white" style="width: fit-content">
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
        </div>

        <div class="mb-4">
            <label class="mt-2 mb-2 label-bg text-white" for="cover_image" class="">*Copertina ristorante</label>
            <input onchange="previewImage()" name="cover_image" id="cover_image" type="file"
                class="form-control @error('cover_image') is-invalid @enderror" required>
            @error('cover_image')
                <div class="invalid-feedback mb-4 mt-0"> {{ $message }} </div>
            @enderror

            <hr>

            <span class="mt-2 mb-3 text-center label-bg text-white">Anteprima Immagine:</span>
            <img id="preview">

        </div>

        <div class="text-center">
            <button class="btn btn-dark text-center" type="submit">Aggiungi</button>
        </div>
    </form>
@endsection