@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Homepage') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('User Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                <div class="container">
                    <a href="{{route('admin.restaurants.index')}}">Il tuo ristorante</a>
                    <a href="{{route('admin.')}}"></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
