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
    {{-- <script src="{{ mix('js/spots-map.js') }}" defer></script> --}}
    <script src="{{ mix('js/im-the-map.js') }}" defer></script>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="https://cloud.typography.com/7601296/6583212/css/fonts.css" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/mapbox.css') }}" rel="stylesheet">

</head>

<body>

    <div id="im-the-map">
        <h1 class="logo"></h1>
        
        <modals
            :amenities='{!! json_encode($amenities) !!}'
        ></modals>

        <im-the-map></im-the-map>

        <spot-details></spot-details>

        <map-footer></map-footer>
    </div>

</body>

</html>
