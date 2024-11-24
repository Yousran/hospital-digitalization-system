<!DOCTYPE html>
<html lang="en">

<head data-theme="dark">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
    @stack('styles')
</head>

<body class="p-0 m-0 min-h-screen max-h-full bg-light-500 dark:bg-dark-500">
        <section class="flex flex-col items-center justify-center h-full p-4">
            <a href="{{ route('home') }}" class="flex items-center mb-4 text-2xl font-semibold text-dark-500 dark:text-light-500">
                <img src="{{ asset('logo.png') }}" class="w-8 h-8 mr-4" alt="Logo" />
                Rumah Sehat
            </a>
            <div class="p-4 min-w-[40vw] w-full md:w-fit rounded-lg border border-light-700 dark:border-dark-300 bg-light-600 dark:bg-dark-400 shadow-md">
                @yield('contents')
            </div>
        </section>
    @yield('scripts')
</body>

</html>
