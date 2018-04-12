<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <title>Zamówienia</title>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style>
            body{
                background-color: #f0eeec
            }
        </style>
        @yield('css')
    </head>
    <body class="body">
        <div id="app">
            <nav class="bg-white">
                <div class="navbar navbar-expand-md navbar-light " style="padding: 0px">
                    <div class="container">
                        <a class="navbar-brand" href="{{ url('/') }}">Zamówienia</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav mr-auto">
                            </ul>
                            <ul class="navbar-nav ml-auto">
                                <li><a class="nav-link" href="{{ route('LargestOrders') }}">30 największych zamówień na leki</a></li>
                                <li><a class="nav-link" href="{{ route('GetOrderByGroup', ['id' => 1]) }}">Grupy</a></li>
                                <li><a class="nav-link" href="{{ route('ShowCustomerConsonants') }}">Customers liczba spółgłosek</a></li>
                                <li><a class="nav-link" href="{{ route('StatutesInFiles') }}">statusy matrymonialne</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
            </nav>
            <main class="py-4">
                @yield('content')
            </main>
        </div>
        @include('layouts/footer')
        <script src=""></script>
        <style>
    </body>
</html>