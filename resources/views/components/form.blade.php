<h1 class="text-xl font-bold text-dark-500 md:text-2xl dark:text-light-500">
    {{ $formHeading }}
</h1>
<form action="{{ $action }}" method="{{ $formMethod }}">
    <div class="grid grid-cols-1 md:grid-cols-{{ $mdColSpan }} xl:grid-cols-{{ $xlColSpan }} gap-4 my-4">
        @csrf
        @isset($csrfMethod)
            @method($csrfMethod)
        @endisset
        {{ $slot }}
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <a href="{{ $routeBack }}" 
        class="w-full 
        text-dark-500 
        font-medium
        bg-primary-300 
        hover:bg-primary-500 
        rounded-lg 
        text-sm py-2 text-center">
            Back
        </a>

        <button type="submit"
            class="w-full 
        text-light-500 
        font-medium
        bg-primary-500 
        hover:bg-primary-600 
        rounded-lg 
        text-sm py-2 text-center">
            Submit
        </button>
    </div>
</form>