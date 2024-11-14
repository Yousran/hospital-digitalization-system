@extends('layouts.dashboard')

@section('title', 'Consultation')

@section('contents')
    <form method="POST" action="{{ route('consultation.store') }}">
        <section class="bg-white mt-16 px-10 max-h-full min-h-screen antialiased dark:bg-gray-900 py-8">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Consultation</h2>
            <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
                <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                    <div class="space-y-6" id="container-medicines">

                    </div>
                </div>
                <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
                    <div
                        class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                        @csrf
                        <p class="text-xl font-semibold text-gray-900 dark:text-white">Medical Record</p>

                        <!-- Patient NIK -->
                        <div class="space-y-2">
                            <label for="patient_nik" class="block text-sm font-medium text-gray-900 dark:text-white">Patient
                                NIK</label>
                            <input type="text" name="patient_nik" id="patient_nik" required
                                class="block w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-primary-500 dark:bg-gray-700 dark:text-white dark:border-gray-600">
                            @error('patient_nik')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Diagnosis -->
                        <div class="space-y-2">
                            <label for="diagnosis"
                                class="block text-sm font-medium text-gray-900 dark:text-white">Diagnosis</label>
                            <textarea name="diagnosis" id="diagnosis" rows="3" required
                                class="block w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-primary-500 dark:bg-gray-700 dark:text-white dark:border-gray-600"></textarea>
                            @error('diagnosis')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Action -->
                        <div class="space-y-2">
                            <label for="action"
                                class="block text-sm font-medium text-gray-900 dark:text-white">Action</label>
                            <input type="text" name="action" id="action" required
                                class="block w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-primary-500 dark:bg-gray-700 dark:text-white dark:border-gray-600">
                            @error('action')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                            class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Complete Consultation
                        </button>
                    </div>
                    <div
                        class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                        <div class="space-y-2">
                            <label for="medicine-name-input"
                                class="block text-sm font-medium text-gray-900 dark:text-white">Medicine Name</label>
                            <input type="text" name="medicine_name" id="medicine-name-input"
                                placeholder="Enter medicine name"
                                class="block w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-primary-500 dark:bg-gray-700 dark:text-white dark:border-gray-600">
                            <p id="medicine-error" class="text-sm text-red-500 mt-1" style="display: none;"></p>
                            <!-- Error message -->
                        </div>
                        <button type="button" id="add-medicine-btn"
                            class="mt-3 px-4 py-2 bg-blue-500 text-white rounded-lg">Add Medicine</button>
                    </div>
                </div>

            </div>
        </section>
    </form>
    <script>
        document.getElementById('add-medicine-btn').addEventListener('click', async function() {
            const medicineNameInput = document.getElementById('medicine-name-input');
            const medicineError = document.getElementById('medicine-error');
            const medicineName = medicineNameInput.value.trim();

            // Clear any previous error messages
            medicineError.style.display = 'none';
            medicineError.textContent = '';

            try {
                const response = await fetch(`/add-medicine?name=${encodeURIComponent(medicineName)}`);
                const data = await response.json();

                if (response.ok) {
                    // Insert new medicine component if response is successful
                    document.getElementById('container-medicines').insertAdjacentHTML('beforeend', data.html);
                    medicineNameInput.value = ''; // Clear input after successful addition
                } else {
                    // Display error message inline if response contains an error
                    medicineError.textContent = data.error || 'An error occurred. Please try again.';
                    medicineError.style.display = 'block';
                }
            } catch (error) {
                console.error('Error:', error);
                medicineError.textContent = 'Network error. Please check your connection and try again.';
                medicineError.style.display = 'block';
            }
        });
    </script>
@endsection
