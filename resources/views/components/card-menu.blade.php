<!-- resources/views/components/card-menu.blade.php -->
<div class="flex justify-end px-4 pt-4">
    <button id="dropdownButton{{ $dropdownId }}" data-dropdown-toggle="dropdown{{ $dropdownId }}"
        class="inline-block text-dark-500 rounded-lg hover:bg-light-500 focus:ring-2 focus:ring-light-700 dark:text-dark-200 dark:hover:bg-dark-500 dark:focus:ring-dark-200 text-sm p-1.5"
        type="button">
        <span class="sr-only">Open dropdown</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            viewBox="0 0 16 3">
            <path
                d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
        </svg>
    </button>
</div>

<div id="dropdown{{ $dropdownId }}"
    class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
    <ul class="py-2" aria-labelledby="dropdownButton{{ $dropdownId }}">
        {{ $slot }}
    </ul>
</div>