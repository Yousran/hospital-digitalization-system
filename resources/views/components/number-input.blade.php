<div class="relative flex items-center max-w-[12rem]">
    <button type="button" 
    id="decrement-button" 
    data-input-counter-decrement="{{ $inputId }}" 
    class="bg-light-500 dark:bg-dark-500 dark:hover:bg-dark-400 dark:border-dark-400 hover:bg-light-600 border border-light-600 rounded-s-lg p-3 h-11 focus:ring-light-600 dark:focus:ring-dark-400 focus:ring-2 focus:outline-none">
        <svg class="w-3 h-3 text-dark-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
        </svg>
    </button>
    <input type="text" id="{{ $inputId }}" data-input-counter 
    data-input-counter-min="1"
    value="{{ $value }}"
    name="{{ $inputName }}"
    class="bg-light-500 dark:bg-dark-500 dark:hover:bg-dark-400 dark:border-dark-400 hover:bg-light-600 border border-light-600 h-11 text-center text-dark-500 dark:text-light-500 text-sm focus:ring-light-600 dark:focus:ring-dark-400 focus:ring-2 focus:outline-none block w-full py-0 rounded-none" placeholder="999" value="5" required />
    <button type="button" 
    id="increment-button" 
    data-input-counter-increment="{{ $inputId }}" 
    class="bg-light-500 dark:bg-dark-500 dark:hover:bg-dark-400 dark:border-dark-400 hover:bg-light-600 border border-light-600 rounded-e-lg p-3 h-11 focus:ring-light-600 dark:focus:ring-dark-400 focus:ring-2 focus:outline-none">
        <svg class="w-3 h-3 text-dark-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
        </svg>
    </button>
</div>