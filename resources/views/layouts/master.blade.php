<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="developed for Poulstar HTML, CSS, JS, education">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="author" content="Poulstar">
    <title>{{ $title ?? 'عنوان صفحه یادت رفته!' }}</title>
    <link rel="shortcut icon" href="{{ asset('IMAGE/logo/TopBarLogo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('CSS/Main.css') }}">
    @stack('styles')
</head>
<body>
<button onclick="topFunction()" id="myBtn" title="Go to top">&uArr;</button>
<div class="mainBox topHeader">
    <a class="link" href="{{ route('login') }}">
        <button class="inlineLogin active">ورود</button>
    </a>
    <a class="link" href="{{ route('register') }}">
        <button class="inlineLogin">ثبت نام</button>
    </a>
    <p id="customizeDate" class="inlineDate"></p>
</div>
<div class="mainBox topBarLogo">
    <img src="{{ asset('IMAGE/logo/TopBarLogo.png') }}" alt="TopBarLogo">
</div>
<x-navigation-menu/>
<div class="whiteSpace"></div>
@yield('content')
<div class="whiteSpace"></div>
@include('layouts.footer')
<script src="{{ asset('JS/Layout.js') }}"></script>
@stack('scripts')
</body>
</html>
