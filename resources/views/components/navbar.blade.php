<nav class="fixed top-0 z-50 w-full bg-light-600 border-light-700 dark:bg-dark-400 dark:border-dark-300">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between p-4">
        <div class="flex items-center space-x-3">
            @auth
                <button
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-dark-500 rounded-lg hover:bg-light-500 focus:ring-2 focus:ring-light-700 dark:text-dark-200 dark:hover:bg-dark-500 dark:focus:ring-dark-200"
                    type="button" data-drawer-target="drawer-navigation" data-drawer-toggle="drawer-navigation"
                    aria-controls="drawer-navigation">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            @endauth
            <a href="{{ route('home') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('logo.png') }}" class="h-8" alt="Logo Rumah Sehat" />
                <span
                    class="self-center text-2xl font-semibold hidden md:inline whitespace-nowrap dark:text-light-500">Rumah
                    Sehat</span>
            </a>
        </div>

        <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            <button type="button"
                class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                data-dropdown-placement="bottom">
                @auth
                    @if (isset(Auth::user()->profilPicture->path))
                        <img class="w-8 h-8 rounded-full" src="{{ asset('storage/' . Auth::user()->profilPicture->path) }}" alt="user photo">
                    @else
                        <img class="w-8 h-8 rounded-full" src="https://picsum.photos/200" alt="user photo">
                    @endif
                @else
                    <div class="relative w-8 h-8 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                        <svg class="absolute w-10 h-10 text-gray-400 -left-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                @endauth
            </button>
            <!-- Dropdown user menu -->
            <div class="z-50 hidden my-4 text-base list-none bg-light-500 divide-y divide-light-600 rounded-lg shadow dark:bg-dark-500 dark:divide-dark-400"
                id="user-dropdown">
                @auth
                    <div class="px-4 py-3">
                        <span class="block text-sm text-gray-900 dark:text-white">{{ auth()->user()->name }}</span>
                        <span
                            class="block text-sm text-gray-500 truncate dark:text-gray-400">{{ auth()->user()->email }}</span>
                    </div>
                @endauth
                <ul class="py-2" aria-labelledby="user-menu-button">
                    @auth
                        <li><a href="{{ route('user.profile', ['username' => auth()->user()->name]) }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-dark-400 dark:text-gray-200 dark:hover:text-white">Profile</a>
                        </li>
                        <li><a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-dark-400 dark:text-gray-200 dark:hover:text-white">Settings</a>
                        </li>
                        <li><a href="{{ route('logout') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-dark-400 dark:text-gray-200 dark:hover:text-white">Logout</a>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-dark-400 dark:text-gray-200 dark:hover:text-white">Login</a>
                        </li>
                        <li><a href="{{ route('register') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-dark-400 dark:text-gray-200 dark:hover:text-white">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
            <button data-collapse-toggle="navbar-user" type="button"
                class="inline-flex md:hidden items-center p-2 w-10 h-10 justify-center text-sm text-dark-500 rounded-lg hover:bg-light-500 focus:ring-2 focus:ring-light-700 dark:text-dark-200 dark:hover:bg-dark-500 dark:focus:ring-dark-200"
                aria-controls="navbar-user" aria-expanded="false">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>

        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
            <ul
                class="flex flex-col font-medium p-4 md:p-0 mt-4 rounded-lg md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0">
                <li><a href="#"
                    {{-- TODO: Warna link di navbar --}}
                        class="block py-2 px-3 text-dark-500 dark:text-light-500 bg-light-500 dark:bg-dark-500 rounded md:bg-transparent dark:md:bg-transparent md:text-primary-500 dark:md:text-primary-500 md:p-0"
                        aria-current="page">Home</a></li>
                <li><a href="#"
                        class="block py-2 px-3 text-dark-500 dark:text-light-500 bg-light-500 dark:bg-dark-500 rounded md:bg-transparent dark:md:bg-transparent md:text-primary-500 dark:md:text-primary-500 md:p-0">
                        About</a>
                </li>
                <li><a href="#"
                        class="block py-2 px-3 text-dark-500 dark:text-light-500 bg-light-500 dark:bg-dark-500 rounded md:bg-transparent dark:md:bg-transparent md:text-primary-500 dark:md:text-primary-500 md:p-0">
                        Services</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
