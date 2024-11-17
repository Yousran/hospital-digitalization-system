@extends('layouts.dashboard')

@section('title', 'Consultation')

@section('contents')
    <form method="POST" action="{{ route('consultation.store') }}">
            <h2 class="text-2xl font-semibold text-dark-500 dark:text-light-500 sm:text-3xl">Consultation</h2>
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-2 flex flex-col gap-4" id="container-medicines">
                </div>
                <div class="col-span-1 flex flex-col gap-4">
                    <div
                        class="space-y-4 rounded-lg border border-light-700 bg-light-600 p-4 shadow dark:border-dark-300 dark:bg-dark-400 sm:p-6">
                        <div class="space-y-2">
                            <label for="medicine-name-input"
                                class="block text-sm font-medium text-dark-500 dark:text-light-500">Medicine Name</label>
                            <input type="text" name="medicine_name" id="medicine-name-input" placeholder="Enter medicine name"
                                class="block w-full px-4 py-2 text-sm border border-light-700 rounded-lg focus:ring-primary-500 dark:bg-dark-300 dark:text-light-500 dark:border-dark-100">
                            <p id="medicine-error" class="text-sm text-red-500 mt-1" style="display: none;"></p>
                        </div>
                        <button type="button" id="add-medicine-button"
                            class="mt-3 px-4 py-2 bg-primary-700 text-light-500 hover:bg-primary-800 rounded-lg">
                            Add Medicine
                        </button>
                    </div>
                    <div
                        class="space-y-4 rounded-lg border border-light-700 bg-light-600 p-4 shadow dark:border-dark-300 dark:bg-dark-400 sm:p-6">
                        @csrf
                        <p class="text-2xl font-semibold text-dark-500 dark:text-light-500">Medical Record</p>
        
                        <!-- Patient NIK -->
                        <div class="space-y-2">
                            <label for="patient_nik" class="block text-sm font-medium text-dark-500 dark:text-light-500">Patient
                                NIK</label>
                            <input type="text" name="patient_nik" id="patient_nik" required
                                class="block w-full px-4 py-2 text-sm border border-light-700 rounded-lg focus:ring-primary-500 dark:bg-dark-300 dark:text-light-500 dark:border-dark-100">
                            @error('patient_nik')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
        
                        <!-- Diagnosis -->
                        <div class="space-y-2">
                            <label for="diagnosis"
                                class="block text-sm font-medium text-dark-500 dark:text-light-500">Diagnosis</label>
                            <textarea name="diagnosis" id="diagnosis" rows="3" required
                                class="block w-full px-4 py-2 text-sm border border-light-700 rounded-lg focus:ring-primary-500 dark:bg-dark-300 dark:text-light-500 dark:border-dark-100"></textarea>
                            @error('diagnosis')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
        
                        <!-- Action -->
                        <div class="space-y-2">
                            <label for="action" class="block text-sm font-medium text-dark-500 dark:text-light-500">Action</label>
                            <input type="text" name="action" id="action" required
                                class="block w-full px-4 py-2 text-sm border border-light-700 rounded-lg focus:ring-primary-500 dark:bg-dark-300 dark:text-light-500 dark:border-dark-100">
                            @error('action')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
        
                        <button type="submit"
                            class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-light-500 hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-500 dark:hover:bg-primary-600 dark:focus:ring-primary-800">
                            Complete Consultation
                        </button>
                    </div>
                </div>
            </div>
    </form>
    <script>
        document.addEventListener('click', function(event) {
            if (event.target.closest('[data-input-counter-increment]')) {
                const inputId = event.target.closest('[data-input-counter-increment]').dataset.inputCounterIncrement;
                const input = document.getElementById(inputId);
                if (input) {
                    const currentValue = parseInt(input.value) || 0;
                    input.value = currentValue + 1;
                }
            }
    
            if (event.target.closest('[data-input-counter-decrement]')) {
                const inputId = event.target.closest('[data-input-counter-decrement]').dataset.inputCounterDecrement;
                const input = document.getElementById(inputId);
                if (input) {
                    const min = parseInt(input.dataset.inputCounterMin) || 0;
                    const currentValue = parseInt(input.value) || 0;
                    if (currentValue > min) {
                        input.value = currentValue - 1;
                    }
                }
            }
        });
    </script>
    <script>
        // Event listener untuk tombol
        document.addEventListener('DOMContentLoaded', () => {
            const button = document.querySelector('#add-medicine-button');
            button.addEventListener('click', addMedicineCard);
        });

        async function addMedicineCard(event) {
            if (event) event.preventDefault();

            const medicineNameInput = document.querySelector('#medicine-name-input');
            const medicineError = document.querySelector('#medicine-error');
            const container = document.querySelector('#container-medicines');

            // Reset pesan error
            medicineError.textContent = '';

            // Ambil nama obat
            const medicineName = medicineNameInput.value;

            // Validasi input
            if (!medicineName) {
                medicineError.textContent = 'Please enter a medicine name.';
                return;
            }

            try {
                // Kirim permintaan ke server
                const response = await fetch('/add-medicine', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        name: medicineName
                    })
                });

                // Cek apakah respons berhasil
                if (!response.ok) {
                    const errorData = await response.json();
                    medicineError.textContent = errorData.error || 'An error occurred while fetching the medicine.';
                    return;
                }

                const html = await response.text();

                // Tambahkan komponen HTML ke container
                container.insertAdjacentHTML('beforeend', html);
            } catch (error) {
                console.error('Error fetching medicine:', error);
                medicineError.textContent = 'An unexpected error occurred. Please try again.';
            }
        }
    </script>
@endsection