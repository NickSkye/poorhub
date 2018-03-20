<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head >




        <meta name=“description” content=””/>
        <meta name=“keywords” content=“”/>
        <meta name="author" content="Intelliskye, LLC"/>
        <link rel="canonical" href="https://poorhub.org/"/>
        <meta name="dc.language" content="en">
        <meta http-equiv="Content-Language" content="en">

            <link rel="publisher" href="https://poorhub.org/" />
            <meta name="robots" content="all"/>
            <meta name="robots" content="index, follow"/>
            <meta name="revisit-after" content="4 days"/>
            <title>poorHUB | Buy / Sell Safely</title>
            <meta name="description" content="Buy and Sell Safely"/>
            <meta name="keywords" content="craigslist, buy, sell, safe, safety, safely" />

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ asset('images/iconfile') }}">
        {{--<title>IntelliSkye</title>--}}
        <script src="https://use.fontawesome.com/b36c39fbb0.js"></script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,800" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @if(app()->isLocal())
            <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @else
            <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        @endif

        @if(app()->isLocal())
            <script src="{{ asset('js/app.js') }}"></script>
        @else
            <script src="{{ mix('js/app.js') }}"></script>
        @endif
        <link rel="stylesheet" type="text/css" href="https://cloud.typography.com/6715694/6200752/css/fonts.css"/>

        {{--<link rel="stylesheet" href="http://www.steinway.com/.resources/steinway-main-webapp/resources/css/new-main~2017-08-30-18-48-34-000~cache.css" media="all"/>--}}
    </head>
    @if(Request::is('/'))
        {{--DO SOMETHING--}}
    @endif

    <body >
    {{--@include('partials.home-header')--}}
        @yield('content')
        <footer> @include('partials.footer')</footer>
    </body>


</html>
