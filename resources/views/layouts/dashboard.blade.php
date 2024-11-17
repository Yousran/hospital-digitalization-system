<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    @yield('styles')
    <!-- Theme Loader -->
    <script>
        const savedTheme = localStorage.getItem('color-theme');
        if (savedTheme === 'dark') {
            document.documentElement.classList.add('dark');
        } else if (savedTheme === 'light') {
            document.documentElement.classList.remove('dark');
        } else if (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.classList.add('dark');
        }
    </script>
    <title>@yield('title')</title>
</head>

<body class="bg-light-500 dark:bg-dark-500">
    <x-navbar />
    <x-sidebar />
    <section class="mt-[4.5rem] p-4">
        @yield('contents')
    </section>
    @yield('scripts')
</body>

</html>
