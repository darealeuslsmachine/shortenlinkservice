<!doctype html>
<html>
<head>
    @include('layouts.head')
</head>
<body>
<div class="container">
    <header class="row">
        @include('layouts.header')
    </header>
    <div id="main" class="row">
        @yield('content')
    </div>
    <footer class="row">
        @include('layouts.footer')
    </footer>
</div>
</body>
</html>
