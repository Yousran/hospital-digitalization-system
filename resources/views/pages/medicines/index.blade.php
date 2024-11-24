@extends('layouts.dashboard')

@section('title', 'Medicines')

@section('contents')
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
            <a href="{{ route('medicines.create') }}">
                <div class="w-full min-h-80 h-full border rounded-lg shadow bg-light-600 hover:bg-light-700 border-light-700 dark:bg-dark-400 dark:hover:bg-dark-300 dark:border-dark-300 flex flex-col justify-center">
                    <p class="text-center text-dark-500 dark:text-light-500 text-2xl font-semibold">
                        Add Medicine
                    </p>
                </div>
            </a>
            @foreach ($medicines as $medicine)
                    <div class="w-full h-full border rounded-lg shadow bg-light-600 border-light-700 dark:bg-dark-400 dark:border-dark-300">
                        @isset($medicine->medicinePicture->path)
                                <img class="rounded-t-lg object-cover h-80 w-full" src="{{ asset('storage/' . $medicine->medicinePicture->path) }}"
                                alt="{{ $medicine->medicinePicture->name }}" />
                                
                        @else
                            <img class="rounded-t-lg object-cover h-80 w-full" src="https://picsum.photos/100"
                                alt="Medicine image" />
                        @endisset
                        
                        <div class="p-5">
                            <h5 class="mb-5 text-xl font-semibold text-dark-500 dark:text-light-500">{{ $medicine->name }}</h5>
                            <div class="flex items-center justify-between">
                                <form action="{{ route('medicines.destroy', $medicine->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white bg-red-500 hover:bg-red-800 font-medium rounded-lg text-sm px-4 py-2 text-center focus:ring-2 ring-light-500">
                                        Delete
                                    </button>
                                </form>                                
                                <div class="relative flex items-center max-w-40">
                                    <button type="button"
                                        onclick="updateStock({{ $medicine->id }}, -1)"
                                        class="p-3 bg-light-800 hover:bg-light-900 border border-light-900 dark:border-dark-100 dark:bg-dark-300 dark:hover:bg-dark-100 rounded-s-lg focus:outline-none">
                                        <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M1 1h16" />
                                        </svg>
                                    </button>
                                    <input type="text" name="stock"
                                        id="quantity-input-{{ $medicine->id }}"
                                        onchange="updateStock({{ $medicine->id }}, this.value)"
                                        data-input-counter data-input-counter-min="1" data-input-counter-max="999999"
                                        class="bg-light-800 hover:bg-light-900 border border-light-900 dark:border-dark-100 dark:bg-dark-300 dark:hover:bg-dark-100 w-full text-center text-dark-500 dark:placeholder-gray-400 dark:text-light-500"
                                        placeholder="999" value="{{ $medicine->stock }}" required />
                                    <button type="button"
                                        onclick="updateStock({{ $medicine->id }}, 1)"
                                        class="p-3 bg-light-800 hover:bg-light-900 border border-light-900 dark:border-dark-100 dark:bg-dark-300 dark:hover:bg-dark-100 rounded-e-lg focus:outline-none">
                                        
                                        <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M9 1v16M1 9h16" />
                                        </svg>
                                    </button>
                                </div>
                                <a href="{{ route('medicines.edit', $medicine->id) }}"
                                    class="bg-primary-500 hover:bg-primary-600 rounded-lg py-2 px-4 text-light-500 focus:ring-2 ring-light-500 font-medium">Edit</a>
                            </div>
                        </div>
                    </div>
            @endforeach
        </div>
@endsection

@push('scripts')
    <script>
        function updateStock(medicineId, change) {
            const inputField = document.getElementById(`quantity-input-${medicineId}`);
            let newStock;

            if (typeof change === 'number') {
                // Adjust stock based on increment or decrement button
                newStock = parseInt(inputField.value) + change;
                if (newStock < parseInt(inputField.dataset.inputCounterMin)) newStock = inputField.dataset.inputCounterMin;
                if (newStock > parseInt(inputField.dataset.inputCounterMax)) newStock = inputField.dataset.inputCounterMax;
                inputField.value = newStock;
            } else {
                // If change is not a number, it’s a direct input value
                newStock = parseInt(change);
            }

            // Send AJAX request to update the stock
            fetch('{{ route('medicines.updateStock') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    id: medicineId,
                    stock: newStock
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Stock updated successfully:', data.message);
                } else {
                    console.error('Error updating stock:', data.message);
                }
            })
            .catch(error => {
                console.error('Request failed:', error);
            });
        }

    </script>
@endpush