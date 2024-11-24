@extends('layouts.dashboard')

@section('title', 'Doctor Schedule')

@section('contents')
<div class="space-y-6">
    @foreach($specialities as $speciality)
        <!-- Speciality Section -->
        <div class="p-4">
            <h2 class="text-2xl font-semibold text-dark-500 dark:text-light-500 mb-4">
                {{ $speciality->name }}
            </h2>
            
            <!-- Scrollable Doctor List -->
            <div class="overflow-x-auto">
                <div class="flex space-x-4 pb-4">
                    @foreach($speciality->doctors as $doctor)
                        <!-- Doctor Card -->
                        <div class="flex-none w-72">
                            <div class="flex flex-col rounded-lg border border-light-700 bg-light-500 shadow-sm dark:border-dark-300 dark:bg-dark-400 p-4">
                                <div class="flex items-center space-x-4">
                                    <!-- Doctor Avatar -->
                                        @if (isset($doctor->user->profilPicture->path))
                                            <img class="w-16 h-16 rounded-full" src="{{ asset($doctor->user->profilPicture->path) }}" alt="user photo">
                                        @else
                                            <img class="w-16 h-16 rounded-full" src="https://picsum.photos/200" alt="user photo">
                                        @endif                                    
                                    <!-- Doctor Info -->
                                    <div>
                                        <h3 class="font-medium text-dark-500 dark:text-light-500">
                                            {{ optional($doctor->biograph)->surename ?? 'No Name' }}
                                        </h3>
                                        <p class="text-sm text-dark-100">
                                            {{ optional($doctor->speciality)->name ?? 'No Speciality' }}
                                        </p>
                                    </div>
                                </div>
                                    <!-- Action Button -->
                                    <a href="{{ route('schedule.book-appointment', $doctor->id) }}" class="px-4 py-2 mt-4 font-medium text-light-500 bg-primary-500 rounded-lg hover:bg-primary-600 focus:ring-4 focus:ring-primary-300">
                                        Book Appointment
                                    </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection