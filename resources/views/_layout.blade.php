<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel-Eloquent Talk</title>

    <link rel="stylesheet" type="text/css" href="/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
<nav>
    <div class="nav-wrapper">
        <a href="#" class="brand-logo">Example System</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="/simple/">Patients (Simple)</a></li>
            <li><a href="/simple/lazy">Sessions (Lazy load)</a></li>
            <li><a href="/simple/eager">Sessions (Eager Load)</a></li>
            <li><a href="/solution/1">Solution #1</a></li>
            <li><a href="/solution/2">Solution #2</a></li>
            <li><a href="/solution/3">Solution #3</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    @yield('content')
</div>

<script src="/js/materialize.min.js"></script>
</body>
</html>
