<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>@yield('title')</title>
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="bg-light-500 dark:bg-dark-500">
    <x-navbar />
    @auth
        <x-sidebar />
    @endauth
    <section class="h-screen" id="home">
        <div class="grid h-full max-w-screen-xl px-4 mx-auto lg:gap-8 xl:gap-0 lg:py-32 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1
                    class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                    Solusi Sehat dengan Sentuhan Digital</h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">Dari
                    layanan medis hingga pemulihan yang cepat, kami hadir untuk membuat pengalaman kesehatan Anda lebih
                    mudah, aman, dan nyaman.</p>
                <a href="
                @auth
                    {{ route('authorized-medical-records.patient') }}
                @else
                    {{ route('login') }}
                @endauth"
                    class="inline-flex items-center justify-center px-5 py-3 mr-3 text-light-500 
        font-medium
        bg-primary-500 
        hover:bg-primary-600 
        rounded-lg focus:ring-4">
                    Make An Appointment
                    <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
                <a href="#about"
                    class="inline-flex 
                    items-center 
                    justify-center 
                    px-5 
                    py-3 
                    text-base 
                    font-medium 
                    text-center 
                    text-dark-500 
                    border border-light-700 
                    rounded-lg 
                    hover:bg-light-700 focus:ring-4 dark:text-light-500 dark:border-dark-300 dark:hover:bg-dark-300">
                    Read More
                </a>
            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                <img src="{{ asset('hero.png') }}" alt="mockup">
            </div>
        </div>
    </section>
    <section class="h-screen flex flex-col justify-center items-center" id="about">
        <h2 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-4xl xl:text-5xl dark:text-white">About Us</h2>
        <p class="px-4 text-justify max-w-2xl text-lg text-gray-500 dark:text-gray-300">
            Kami adalah tim medis yang berkomitmen untuk memberikan solusi kesehatan terbaik melalui teknologi digital. Dengan pengalaman lebih dari 10 tahun di bidang medis dan teknologi, kami berfokus pada inovasi dalam menyediakan layanan kesehatan yang mudah diakses, aman, dan nyaman bagi semua orang. 
            <br><br>
            Dengan memanfaatkan kemajuan teknologi digital, kami menyediakan berbagai layanan medis jarak jauh yang memungkinkan pasien untuk mendapatkan perawatan kesehatan dari kenyamanan rumah mereka. Layanan kami meliputi konsultasi medis virtual, pemantauan kesehatan real-time, serta pemberian resep digital yang dapat diakses dengan mudah melalui perangkat mobile.
            <br><br>
            Kami selalu berinovasi untuk menghadirkan pengalaman kesehatan yang lebih baik bagi Anda dan keluarga. Dengan tim dokter, perawat, dan tenaga medis yang berpengalaman, serta dukungan teknologi terbaru, kami siap mendampingi Anda dalam setiap langkah perjalanan kesehatan Anda.
        </p>        
    </section>
    <section class="h-screen flex flex-col justify-center items-center bg-gray-50 dark:bg-dark-600" id="services">
        <h2 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-4xl xl:text-5xl dark:text-white">Our Services</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-screen-xl px-4 mx-auto">
            <div class="bg-white dark:bg-dark-700 p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold text-dark-500 dark:text-light-500">Medical Consultation</h3>
                <p class="mt-4 text-gray-500 dark:text-gray-300">Konsultasi medis dengan dokter berpengalaman melalui platform digital untuk kenyamanan Anda.</p>
            </div>
            <div class="bg-white dark:bg-dark-700 p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold text-dark-500 dark:text-light-500">Virtual Health Monitoring</h3>
                <p class="mt-4 text-gray-500 dark:text-gray-300">Pantau kesehatan Anda secara real-time dengan teknologi pemantauan kesehatan jarak jauh.</p>
            </div>
            <div class="bg-white dark:bg-dark-700 p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold text-dark-500 dark:text-light-500">Doctor Recomendation</h3>
                <p class="mt-4 text-gray-500 dark:text-gray-300">Layanan bantuan diakses untuk membagikan pengalaman.</p>
            </div>
        </div>
    </section>

    
</body>

</html>
