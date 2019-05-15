<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <title>SweetSpot | True Vacation Rentals</title>
    <link href="/images/favicon.png" rel="shortcut icon" />

    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' };</script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>

    <link rel="stylesheet" type="text/css" href="https://cloud.typography.com/7601296/6583212/css/fonts.css" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/mapbox.css') }}" rel="stylesheet">

    {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous"> --}}

</head>

<body>
        
    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}
    <section id="edit-spot-wrapper">
        <edit-spot-new
            :initdata="{{json_encode($spotJson)}}"
            :amenities='{!!json_encode($amenities)!!}'
            token="{{$editToken->token}}"
        ></edit-spot-new>
        @csrf
    </section>

    <script src="{{ asset('js/edit-spot-new.js') }}" defer></script>
</body>

</html>
