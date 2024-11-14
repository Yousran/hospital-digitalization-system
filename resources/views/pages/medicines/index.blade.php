@extends('layouts.dashboard')

@section('title', 'Medicines')

@section('contents')
    <section class="bg-white mt-16 px-10 max-h-full min-h-screen antialiased dark:bg-gray-900 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-8">
            <a href="{{ route('medicines.create') }}">
                <div class="w-full min-h-80 h-full border rounded-lg shadow bg-gray-800 border-gray-700 flex flex-col  justify-center">
                    <p class="text-center text-white text-2xl font-semibold">
                        Add Medicine
                    </p>
                </div>
            </a>
            @foreach ($medicines as $medicine)
                    <div class="w-full h-full border rounded-lg shadow bg-gray-800 border-gray-700">
                        @isset($medicine->medicinePicture->path)
                                <img class="rounded-t-lg object-cover h-80 w-full" src="{{ asset('storage/' . $medicine->medicinePicture->path) }}"
                                alt="{{ $medicine->medicinePicture->name }}" />
                                
                        @else
                            <img class="rounded-t-lg object-cover h-80 w-full" src="https://picsum.photos/100"
                                alt="product image" />
                        @endisset
                        
                        <div class="p-5">
                            <h5 class="mb-5 text-xl font-semibold tracking-tight text-white">{{ $medicine->name }}</h5>
                            <div class="flex items-center justify-between">
                                <form action="{{ route('medicines.destroy', $medicine->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                        Delete
                                    </button>
                                </form>                                
                                <div class="relative flex items-center max-w-[8rem]">
                                    <button type="button"
                                        onclick="updateStock({{ $medicine->id }}, -1)"
                                        class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
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
                                        class="bg-gray-50 border-x-0 border-gray-300 h-11 w-full text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="999" value="{{ $medicine->stock }}" required />
                                    <button type="button"
                                        onclick="updateStock({{ $medicine->id }}, 1)"
                                        class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                        
                                        <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M9 1v16M1 9h16" />
                                        </svg>
                                    </button>
                                </div>
                                <a href="{{ route('medicines.edit', $medicine->id) }}"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit</a>
                            </div>
                        </div>
                    </div>
            @endforeach
        </div>
    </section>
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
@endsection
