<div class="relative inline-block text-left">
    <button id="theme-toggle-button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 dark:bg-dark-400 dark:text-light-500">
        Theme
        
    </button>

    <div id="theme-menu" class="hidden absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white dark:bg-dark-500 ring-1 ring-black ring-opacity-5">
        <div class="py-1">
            <button onclick="setTheme('light')" class="w-full block px-4 py-2 text-sm text-start text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                Light Mode
            </button>
            <button onclick="setTheme('dark')" class="w-full block px-4 py-2 text-sm text-start text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                Dark Mode
            </button>
            <button onclick="setTheme('system')" class="w-full block px-4 py-2 text-sm text-start text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                System Default
            </button>
        </div>
    </div>
</div>
@push('scripts')
    
    <script>
        document.getElementById('theme-toggle-button').addEventListener('click', () => {
            const menu = document.getElementById('theme-menu');
            menu.classList.toggle('hidden');
        });

        function setTheme(theme) {
            const root = document.documentElement;
            if (theme === 'light') {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            } else if (theme === 'dark') {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            } else if (theme === 'system') {
                // Remove the theme setting to allow system default
                localStorage.removeItem('color-theme');
                // Apply system preference
                if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            }
        }
    </script>
@endpush