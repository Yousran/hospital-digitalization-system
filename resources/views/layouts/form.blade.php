<!DOCTYPE html>
<html lang="en">

<head data-theme="dark">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    @yield('styles')
    <title>@yield('title')</title>
</head>

<body>
    @yield('contents')
    @yield('scripts')
</body>

</html>
