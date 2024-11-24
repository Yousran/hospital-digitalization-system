<div class="grid grid-cols-4 bg-light-600 dark:bg-dark-400 border border-light-700 dark:border-dark-300 rounded-lg medicine-card">
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
        <div class="mt-2">
            <label for="medicine-description-{{ $medicine->id }}" class="block text-sm font-medium text-dark-500 dark:text-light-500">Description</label>
            <textarea name="description[]" id="medicine-description-{{ $medicine->id }}" rows="2" class="block w-full px-4 py-2 text-sm border border-light-700 rounded-lg focus:ring-primary-500 dark:bg-dark-300 dark:text-light-500 dark:border-dark-100"></textarea>
        </div>
    </div>
    <div class="col-span-1 p-4 flex flex-col justify-end">
        <div class="flex justify-end">
            <x-number-input inputId="{{ 'quantity-'.$medicine->id }}" inputName="quantity[]" value="1"/>
        </div>
        <button type="button" class="remove-medicine-button mt-2 px-4 py-2 bg-red-500 text-light-500 hover:bg-red-600 rounded-lg">
            Remove
        </button>
    </div>
</div>