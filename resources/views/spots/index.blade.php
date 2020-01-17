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

    <meta name="sweetspot" content="true">

    <!-- Scripts -->
    <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' };</script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    {{-- <script src="{{ mix('js/spots-map.js') }}" defer></script> --}}
    <script src="{{ mix('js/im-the-map.js') }}" defer></script>

    <!-- Styles -->
    
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/mapbox.css') }}" rel="stylesheet">

    {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous"> --}}

</head>

<body>

    <div id="im-the-map">
        <modals
            :content='@json($staticContent)'
        ></modals>

        <welcome-mob
            v-if="{{$initSpot ? 'false' : 'true'}}"
        ></welcome-mob>

        <submit-spot
            :amenities='@json($amenities)'
        ></submit-spot>

        <im-the-map></im-the-map>

        <spot-details></spot-details>

        {{-- <map-footer></map-footer> --}}
    </div>

</body>

</html>
