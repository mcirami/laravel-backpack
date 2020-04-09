<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        {{--<script src="https://js.braintreegateway.com/web/dropin/1.8.1/js/dropin.min.js"></script>--}}
        <title>BP Website - @yield('title')</title>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/bootstrap-formhelpers.min.js') }}" defer></script>
        @yield('braintree')
    </head>

    <body>
        @include('inc.navbar')

        <div class="container">
            @yield('content')
        </div>


    </body>
</html>