<div class="grid grid-cols-4 bg-light-600 dark:bg-dark-400 border border-light-700 dark:border-dark-300 rounded-lg">
    <div class="col-span-1 p-4">
        @isset($medicine->medicinePicture)
            <img class="w-full object-cover rounded-lg" 
            src="{{ asset('storage/' . $medicine->medicinePicture->path) }}" 
            alt="{{ $medicine->medicinePicture->name }}">
        @else    
            <img class="h-auto w-full object-cover rounded-lg" src="https://picsum.photos/100" alt="Placeholder">
        @endisset
    </div>
    <div class="col-span-2 p-4">
        <input type="hidden" name="medicines[]" value="{{ $medicine->id }}">
        <h3 class="text-dark-500 dark:text-light-500 text-xl font-medium">{{ $medicine->name }}</h3>
        <p class="text-dark-500 dark:text-light-500 text-md font-medium">{{ $medicine->stock }}</p>
        <p class="text-dark-500 dark:text-light-500 text-sm text-justify">{{ $medicine->description }}</p>
    </div>
    <div class="col-span-1 p-4 flex flex-col justify-end">
        <div class="flex justify-end">
            <x-number-input inputId="{{ 'quantity-'.$medicine->id }}" inputName="quantity[]" value="1"/>
        </div>
    </div>
</div>