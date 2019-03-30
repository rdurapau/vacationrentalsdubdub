<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <title>SweetSpot | True Vacation Rentals</title>
    <link href="/images/favicon.png" rel="shortcut icon" />

    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/im-the-map.js') }}" defer></script>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="https://cloud.typography.com/7601296/6583212/css/fonts.css" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/mapbox.css') }}" rel="stylesheet">

</head>

<body>

    <h1 class="logo"></h1>

    <footer style="display:none">
        <a class="submit" href="">Submit Your Property</a>
        <ul class="navigation">
            <li><a href="">About Us</a></li>
            <li><a href="">Terms of Service</a></li>
            <li>&copy; SweetSpot</li>
        </ul>
    </footer>

    <div id="im-the-map">
        <im-the-map></im-the-map>

        <section class="spot-details">
            <section class="hero">
                <button class="close"><span class="icon-clear-css"></span></button>
                <div class="controls">
                    <a href="#" class="left"></a>
                    <a href="#" class="right"></a>
                    <nav>
                        <a href="#">1</a>
                        <a href="#" class="current">2</a>
                        <a href="#">3</a>
                    </nav>
                </div>
                <div class="photos"> 
                    <span style="background-image:url('/images/temp/spot-photo.jpg')"></span>
                </div>
            </section>
            <section class="content">
                <article>
                    <h2>Lakefront Escape</h2>
                    <section class="icon-deets">
                        <div>
                            <img src="/images/icons/person-circle.svg" />
                            <span>Sleeps 12</span>
                        </div>
                        <div>
                            <img src="/images/icons/bed.svg" />
                            <span>4 beds</span>
                        </div>
                        <div>
                            <img src="/images/icons/shower.svg" />
                            <span>3 baths</span>
                        </div>
                    </section>

                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis.</p>
                    <p>Cras mattis consectetur purus sit amet fermentum. Etiam porta sem malesuada magna mollis euismod. Nullam quis risus eget urna mollis ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>

                    <h3>Amenities</h3>
                    <ul class="amenities">
                        <li class="washer">
                            <div class="icon"><img src="/images/icons/amenities/washer.svg" /></div>
                            <span>Washer &amp; Dryer</span>
                        </li>
                        <li class="washer">
                            <div class="icon"><img src="/images/icons/amenities/iron.svg" /></div>
                            <span>Iron</span>
                        </li>
                        <li class="washer">
                            <div class="icon"><img src="/images/icons/amenities/iron.svg" /></div>
                            <span>Torture Dungeon</span>
                        </li>
                        <li class="washer">
                            <div class="icon"><img src="/images/icons/amenities/washer.svg" /></div>
                            <span>Magical Portal to Narnia</span>
                        </li>
                    </ul>
                </article>
                <aside>
                    <h5><span>$</span><strong>399</strong> per night</h5>
                    <button class="btn btn-wide btn-purple btn-reservation">Make a reservation</button>
                    <ul class="contact">
                        <li>(555) 555-5555</li>
                        <li>Visit Property Website</li>
                    </ul>
                </aside>
            </section>

        </section>
    </div>

</body>

</html>
