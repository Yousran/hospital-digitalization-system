@extends('layouts.form')
@section('contents')
    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
        Login to your account
    </h1>
    <form class="space-y-4 md:space-y-6" action="{{ route('login') }}" method="POST">
        @csrf
        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">Email User</label>
            <input type="email" name="email" id="email" class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="name@company.com" required="">
            @error('email')
                <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="password" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">Password</label>
            <input type="password" name="password" id="password" placeholder="••••••••"
                class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
            @error('password')
                <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="flex items-center justify-between">
            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <input id="remember" aria-describedby="remember" type="checkbox"
                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800">
                </div>
                <div class="ml-3 text-sm">
                    <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                </div>
            </div>
            <a href="#"
                class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot password?</a>
        </div>
        <button type="submit"
            class="w-full text-white bg-primary-500 hover:bg-primary-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-primary-800">Login</button>
        <a href="{{ route('auth.google') }}"
            class="w-full flex items-center justify-center 
            text-dark-300 bg-white border border-gray-300 hover:bg-gray-100 
            focus:ring-4 focus:outline-none 
            focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center
            dark:bg-dark-300 dark:text-white dark:border-dark-200
            dark:hover:bg-dark-200 dark:focus:ring-gray-700">
            <i class="bx bxl-google w-5 h-5 text-2xl me-4"></i>
            Login with Google
        </a>
        <p class="text-sm font-light text-dark-300 dark:text-light-600">
            Don't have an account yet? <a href="{{ route('register') }}"
                class="font-medium text-primary-500 hover:underline dark:text-light-500">Register</a>
        </p>
    </form>
@endsection