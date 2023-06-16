@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-white m-4 text-center">
            <div class="card-header text-center">Benvenuto {{ Auth::user()->name }}</div>
        </h1>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card border-5 border-warning rounded-5">
                    <div class="card-body text-center">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{ __("Hai effettuato l'accesso all'area amministrativa.") }}
                    </div>

                    <div class="text-center p-4">
                        <div class="container">
                            <strong><p>Gestisci il tuo <a
                                    class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
                                    href="{{ route('admin.restaurants.index') }}">
                                    RISTORANTE
                                </a></p></strong>
                        </div>
                        <p>Oppure</p>
                        <strong><p>Torna alla <a
                                class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
                                href="{{ url('/') }}">
                                Homepage
                            </a></p></strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
