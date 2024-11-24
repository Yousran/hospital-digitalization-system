@extends('layouts.dashboard')

@section('title', 'Book Appointment')

@section('contents')
    <div class="max-w-7xl mx-auto">
        <div class="bg-light-600 dark:bg-dark-400 overflow-hidden shadow-sm rounded-lg border border-light-700 dark:border-dark-300">
            <div class="p-6">
                <form method="POST" action="{{ route('schedule.store') }}" class="space-y-6">
                    @csrf
                    <div class="pt-5 border-t border-gray-200 dark:border-gray-800 flex sm:flex-row flex-col sm:space-x-5 rtl:space-x-reverse">
                        <div id="datepicker" inline-datepicker datepicker-buttons datepicker-autoselect-today datepicker-format="yyyy-mm-dd" class="mx-auto sm:mx-0" data-date="{{ old('selected_date') }}"></div>
                        
                        <div class="sm:ms-7 sm:ps-5 sm:border-s border-gray-200 dark:border-gray-800 w-full sm:max-w-[15rem] mt-5 sm:mt-0">
                            <input type="hidden" name="selected_date" id="selected_date">
                            <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                            <h3 class="text-dark-500 dark:text-light-500 text-base font-medium mb-3 text-center" id="selected_date_display"></h3>
                            
                            <button type="button" data-collapse-toggle="timetable" class="inline-flex items-center w-full py-2 px-5 me-2 justify-center text-sm font-medium text-dark-500 focus:outline-none bg-light-500 rounded-lg border border-light-700 hover:bg-light-600 hover:text-primary-500 focus:ring-4 focus:ring-light-600 dark:focus:ring-dark-300 dark:bg-dark-300 dark:text-light-500 dark:border-dark-100 dark:hover:text-primary-500 dark:hover:bg-dark-200">
                                <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                                </svg>
                                Pick a time
                            </button>

                            <ul id="timetable" class="grid w-full grid-cols-2 gap-2 mt-5">
                                @php
                                    $times = [
                                        '10:00' => '10-00',
                                        '10:30' => '10-30',
                                        '11:00' => '11-00',
                                        '11:30' => '11-30',
                                        '12:00' => '12-00',
                                        '12:30' => '12-30',
                                        '13:00' => '13-00',
                                        '13:30' => '13-30',
                                        '14:00' => '14-00',
                                        '14:30' => '14-30',
                                        '15:00' => '15-00',
                                        '15:30' => '15-30',
                                    ];
                                @endphp

                                @foreach($times as $display => $id)
                                    <li>
                                        <input type="radio" 
                                            id="{{ $id }}" 
                                            value="{{ $display }}" 
                                            class="hidden peer" 
                                            name="selected_time"
                                            @disabled(isset($bookedSlots) && in_array($display, $bookedSlots))>
                                        <label for="{{ $id }}"
                                            @class([
                                                'inline-flex items-center justify-center w-full p-2 text-sm font-medium text-center border rounded-lg cursor-pointer',
                                                'text-red-500 bg-light-600 border-light-700 cursor-not-allowed' => isset($bookedSlots) && in_array($display, $bookedSlots),
                                                'text-primary-500 bg-light-500 border-primary-500 dark:hover:text-light-500 dark:border-primary-500 dark:peer-checked:border-primary-500 peer-checked:border-primary-500 peer-checked:bg-primary-500 hover:text-light-500 peer-checked:text-light-500 hover:bg-primary-500 dark:text-primary-500 dark:bg-dark-300 dark:hover:bg-primary-500 dark:hover:border-primary-500 dark:peer-checked:bg-primary-500' => !(isset($bookedSlots) && in_array($display, $bookedSlots))
                                            ])>
                                            {{ $display }}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="sm:ms-7 sm:ps-5 flex flex-col mt-5 sm:mt-0">
                            <h5 class="text-xl font-semibold text-dark-500 dark:text-light-500">{{ $doctor->user->name }}</h5>
                            <h5 class="text-xl font-semibold text-dark-500 dark:text-light-500">{{ $doctor->biograph->surename }}</h5>
                        </div>
                    </div>

                    <div class="flex justify-between mt-6">
                        <a href="{{ route('schedules') }}" class="px-4 py-2 font-medium text-light-500 bg-primary-500 rounded-lg hover:bg-primary-600 focus:ring-4 focus:ring-primary-300" >Back</a>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-light-500 bg-primary-500 rounded-lg hover:bg-primary-600 focus:ring-4 focus:ring-primary-300">
                            {{ __('Book Appointment') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get elements
            const datepicker = document.getElementById('datepicker');
            const selectedDateInputs = document.getElementById('selected_date');
            const selectedDateDisplay = document.getElementById('selected_date_display');
            const doctorId = {{ $doctor->id }};
        
            // Set initial date if exists
            const initialDate = selectedDateInputs.value;
            if (initialDate) {
                const date = new Date(initialDate);
                updateDateDisplay(date);
            }
        
            // Initialize datepicker with minDate
            new Datepicker(datepicker, {
                minDate: new Date(),
                format: 'yyyy-mm-dd',
                autoselect: true,
                buttons: true,
                todayBtn: true,
                clearBtn: true,
                inline: true,
                autohide: true
            });

            // Listen for datepicker changes
            datepicker.addEventListener('changeDate', function(e) {
                const date = new Date(e.detail.date);
                const dateString = date.toISOString().split('T')[0];
                
                // Update all inputs with name="selected_date"
                selectedDateInputs.value = dateString;
        
                // Update display text
                updateDateDisplay(date);
        
                // Fetch booked slots
                fetch(`{{ url('/schedule/check-availability') }}/${doctorId}/${dateString}`)
                    .then(response => response.json())
                    .then(data => {
                        const bookedSlots = data.bookedSlots.map(time => time.slice(0, 5));
        
                        // Reset all time slots
                        document.querySelectorAll('#timetable input[type="radio"]').forEach(input => {
                            input.disabled = false;
                            input.parentElement.querySelector('label').classList.remove(
                                'text-light-700', 
                                'bg-light-600', 
                                'border-light-700',
                                'hover:bg-primary-500',
                                'hover:text-light-500',
                                'dark:hover:bg-primary-500',
                                'dark:hover:text-light-500',
                            );
                        });
        
                        // Disable booked slots
                        bookedSlots.forEach(time => {
                            const input = document.querySelector(`input[value="${time}"]`);
                            if (input) {
                                input.disabled = true;
                                input.parentElement.querySelector('label').classList.add(
                                    'text-light-700', 
                                    'bg-light-600', 
                                    'border-light-700', 
                                    'cursor-not-allowed'
                                );
                            }
                        });
                    });
            });
        
            function updateDateDisplay(date) {
                selectedDateDisplay.textContent = date.toLocaleDateString('en-US', { 
                    weekday: 'long',
                    year: 'numeric', 
                    month: 'long', 
                    day: 'numeric' 
                });
            }
        });
    </script>
@endsection