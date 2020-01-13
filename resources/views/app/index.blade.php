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
    <script src="/js/app.js" defer></script>
    <script src="/js/manifest.js"></script>
    <script src="/js/vendor.js"></script>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" rel="stylesheet" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="/css/app.css" rel="stylesheet">

</head>

<body>
    <div id="app">
        <router-view></router-view>
        <!-- <router-view v-if="!showSplashScreen"></router-view> -->
        <!-- <p v-if="showSplashScreen">Splash Screen</p> -->
    </div>
</body>

</html>
