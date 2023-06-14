@extends('layouts/app')

@section('content')
    <h1 class="m-4 text-center">Aggiungi un ristorante</h1>

    <form action="{{ route('admin.restaurants.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="activity_name">Nome dell'attività</label>
            <input type="text" name="activity_name" id="activity_name"
                class="form-control @error('activity_name') is-invalid @enderror" value="{{ old('activity_name') }}" required>
            @error('activity_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="phone_number">Numero di telefono</label>
            <input type="tel" name="phone_number" {{-- pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" --}} id="phone_number"
                class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}" required>
            @error('phone_number')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="address">Indirizzo</label>
            <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror"
                value="{{ old('address') }}" required>
            @error('address')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="vat">Partita IVA</label>
            <input type="number" name="vat" id="vat" class="form-control @error('vat') is-invalid @enderror"
                value="{{ old('vat') }}" required>
            @error('vat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3 form-group">
            <p>Tipologia del locale</p>
            @foreach ($types as $type)
                <div class="form-check">
                    <input type="checkbox" name="types[]" id="type-{{ $type->id }}"
                        value="{{ $type->id }}" @checked(in_array($type->id, old('types', [])))>
                    <label for="type-{{ $type->id }}">{{ $type->name }}</label>
                </div>
            @endforeach
            @error('creation_date')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cover_image" class="">Copertina ristorante</label>
            <input name="cover_image" id="cover_image" type="file"
                class="form-control @error('cover_image') is-invalid @enderror">
            @error('cover_image')
                <div class="invalid-feedback mb-3 mt-0"> {{ $message }} </div>
            @enderror
        </div>


        <button class="btn btn-primary" type="submit">Aggiungi</button>
    </form>
@endsection
