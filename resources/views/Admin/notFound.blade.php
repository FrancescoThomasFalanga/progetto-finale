@extends('layouts/app')

@section('content')
 
<section class="wrapper">

    <div class="container">

        <div id="scene" class="scene" data-hover-only="false">


            <div class="circle" data-depth="1.2"></div>

            <div class="one" data-depth="0.9">
                <div class="content">
                    <span class="piece"></span>
                    <span class="piece"></span>
                    <span class="piece"></span>
                </div>
            </div>

            <div class="two" data-depth="0.60">
                <div class="content">
                    <span class="piece"></span>
                    <span class="piece"></span>
                    <span class="piece"></span>
                </div>
            </div>

            <div class="three" data-depth="0.40">
                <div class="content">
                    <span class="piece"></span>
                    <span class="piece"></span>
                    <span class="piece"></span>
                </div>
            </div>

            <p class="p404" data-depth="0.50">401</p>
            <p class="p404" data-depth="0.10">401</p>

        </div>

        <div class="text">
            <article>
                <p>Uh oh! Sembra che tu ti sia perso. <br>Torna alla homepage se hai capito!</p>
                <a class="" href="{{ url('/') }}">Homepage!</a>
            </article>
        </div>

    </div>
</section>

@endsection