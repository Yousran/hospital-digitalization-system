@extends('layouts.form')
@section('contents')
                <form method="POST" action="{{ route('register') }}" class="space-y-4 md:space-y-6">
                    @csrf

                    <!-- Name Input -->
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                        <input type="text" name="name" id="name"
                            class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Username" required="">
                        @error('name')
                            <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email Input -->
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                        <input type="email" name="email" id="email"
                            class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="name@company.com" required="">
                        @error('email')
                            <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••"
                            class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required="">
                        @error('password')
                            <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password Input -->
                    <div>
                        <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••"
                            class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required="">
                        @error('password_confirmation')
                            <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- File Upload (Optional) -->
                    <x-file-dropzone id="1"/>

                    <!-- Terms Checkbox -->
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="terms" aria-describedby="terms" type="checkbox" name="terms"
                                class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800"
                                required="">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="font-light text-gray-500 dark:text-gray-300">I accept the <a
                                    class="font-medium text-primary-600 hover:underline dark:text-primary-500"
                                    href="" id="showTerms">Terms and Conditions</a></label>
                        </div>
                    <!-- Terms and Conditions Modal -->
                    <div id="termsModal" class="hidden fixed inset-0 bg-light-600 dark:bg-dark-400 bg-opacity-50 dark:bg-opacity-50 overflow-y-auto h-full w-full">
                        <div class="relative top-20 mx-auto p-5 w-96 shadow-lg rounded-md bg-light-500 dark:bg-dark-500">
                            <div class="mt-3 text-center">
                                <h3 class="text-lg leading-6 font-medium text-dark-500 dark:text-light-500">Terms and Conditions</h3>
                                <div class="mt-2 px-7 py-3">
                                    <p class="text-sm text-dark-500 dark:text-light-500 text-justify">
                                        - Follow <a class="text-blue-500" target="_blank" href="https://github.com/Yousran">Github</a><br>
                                        - Star <a class="text-blue-500" target="_blank" href="https://github.com/Yousran/hospital-digitalization-system">Repo ini ⭐⭐⭐</a><br>
                                        - Star <a class="text-blue-500" target="_blank" href="https://github.com/Yousran/factorygame">Butuh 16 ⭐⭐⭐</a><br>
                                        - Kasi nilai <strong>100!!</strong>
                                    </p>
                                </div>
                                <div class="items-center px-4 py-3">
                                    <button id="closeModal" class="px-4 py-2 bg-primary-600 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-300">
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.getElementById('showTerms').addEventListener('click', function(event) {
                            event.preventDefault();
                            document.getElementById('termsModal').classList.remove('hidden');
                        });

                        document.getElementById('terms').addEventListener('change', function() {
                            document.getElementById('termsModal').classList.remove('hidden');
                        });
                    
                        document.getElementById('closeModal').addEventListener('click', function() {
                            document.getElementById('termsModal').classList.add('hidden');
                        });
                    </script>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Create an account
                    </button>

                    <!-- Login Link -->
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Already have an account? <a href="{{ route('login') }}"
                            class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login here</a>
                    </p>
                </form>
@endsection
