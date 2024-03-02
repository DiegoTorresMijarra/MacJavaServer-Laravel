<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="{{ asset('images/favicon.png') }}" rel="icon" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rowdies:wght@400;700&display=swap">

    <style>
        .group {
            display: flex;
            line-height: 28px;
            align-items: center;
            position: relative;
            max-width: 190px;
            margin: 20px;
            margin-right: 50px;
        }

        .inputSearch {
            width: 100%;
            height: 40px;
            line-height: 28px;
            padding: 0 1rem;
            padding-left: 2.5rem;
            border: 2px solid transparent;
            border-radius: 8px;
            outline: none;
            background-color: rgb(237, 237, 237);
            color: #0d0c22;
            transition: .3s ease;
        }

        .inputSearch::placeholder {
            color: #9e9ea7;
        }

        .inputSearch:focus, inputSearch:hover {
            outline: none;
            border-color: rgb(255, 77, 107);
            background-color: #fff;
            box-shadow: 0 0 0 4px rgba(255, 77, 107, 0.1);
        }

        .icon {
            position: absolute;
            left: 1rem;
            fill: #9e9ea7;
            width: 1rem;
            height: 1rem;
        }
        /*Tabla*/
        .table{
            border: 2px solid transparent;
        }

        th{
            color: #ff4d6b;
        }

        {{--OFERTAS--}}
        @keyframes moveIn {
            0% {
                transform: translateX(100%) scale(0.7);
                opacity: 0;
            }
            25%, 35%, 45%, 55%, 65%, 75% {
                transform: translateX(0%) scale(0.7);
                opacity: 1;
            }
            40%{
                transform: translateX(0%) scale(0.8) rotate(2deg);
                opacity: 1;
            }
            50%{
                transform: translateX(0%) scale(0.8);
                opacity: 1;
            }
            60% {
                transform: translateX(0%) scale(0.8) rotate(-2deg);
                opacity: 1;
            }
            100% {
                transform: translateX(-100%) scale(0.7);
                opacity: 0;
            }
        }

        .animate-div {
            animation: moveIn 4s cubic-bezier(0, 0.5, 0, 2) infinite;
        }

        /*MENU*/
        .nav-link {
            color: coral;
            text-decoration: none;
            position: relative;
            border-bottom: 2px solid transparent;
            transition: border-bottom 0.3s ease;
        }

        .nav-link:hover {
            border-bottom-color: coral;
        }


    </style>
</head>

<body style="background-color:#ffffff ">
@include('header')

<div class="container">

    <div class="mx-2 my-2">
        @include('flash::message')
    </div>

    @yield('content')

</div>

@include('footer')

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>
</body>
</html>

