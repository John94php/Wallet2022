<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <title>Wallet 2022</title>
</head>
<body class="container container-fluid">
<div class="wrapper">
    <div class="card card-info text-center">
        <div class="card-header">
            <h3 class="card-title">Welcome in Wallet 2022 ! Application to manage your finances in 2022</h3>
        </div>
        <div class="card-body">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/home') }}" class="btn btn-outline-primary">Home</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="btn btn-outline-primary">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</div>
</body>
</html>
