@extends('layouts.app')
@section('content')

<div class="container">
    <div class="fs-4 my-4">
    </div>
    <div class="card p-4 mb-4 background shadow rounded-lg border-5 border-warning rounded-5">

        @include('profile.partials.update-profile-information-form')

    </div>

    <div class="card p-4 mb-4 background shadow rounded-lg border-5 border-warning rounded-5">


        @include('profile.partials.update-password-form')

    </div>

    <div class="card p-4 mb-4 background shadow rounded-lg border-5 border-warning rounded-5">


        @include('profile.partials.delete-user-form')

    </div>
</div>

@endsection
