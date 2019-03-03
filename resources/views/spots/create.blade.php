@extends('layouts.slim')

@section ('header')
    <link href="{{ asset('css/mapbox.css') }}" rel="stylesheet">
    <style>
        /*
        body { margin:0; padding:0; }
        #map { position:absolute; top:0; bottom:0; width:100%; }
        #geocoder-container > div {
            min-width:50%;
            margin-left:25%;
        }
        */
    </style>
@endsection

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section id="submit-spot-wrapper">
        <submit-spot></submit-spot>
        @csrf
    </section>

@endsection

@section ('footer')

    <script src="{{ asset('js/submit-spot.js') }}" defer></script>

@endsection
