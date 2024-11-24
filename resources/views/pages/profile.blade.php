@extends('layouts.dashboard')

@section('contents')
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <!-- Card 1 -->
            <x-profile-card>
                <div class="flex flex-col items-center w-full p-0 m-0 my-4">

                    @isset($user->profilPicture->path)
                    <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{ asset('storage/' . $user->profilPicture->path) }}"
                    alt="Profile Image" />
                    @else
                    <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="https://picsum.photos/200" alt="Profile Image" />
                    @endisset
                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $user->name }}</h5>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
                    
                    <div class="mt-2">
                        @foreach ($user->roles as $role)
                        <span class="inline-block {{ $role->badge_colour }} text-light-500 text-sm font-medium rounded-full px-3 py-1 mr-2">
                            {{ $role->name }}
                        </span>
                        @endforeach
                    </div>
                    @if ($user->doctor)
                    <div class="p-4 pb-0 flex flex-col justify-start w-full">
                        <h5 class="text-md font-medium text-dark-500 dark:text-light-500">Dokter Spesialis</h5>
                        <p class="text-dark-100 dark:text-light-900">
                            {{ $user->doctor->speciality->name }}
                        </p>
                        <h5 class="text-md font-medium text-dark-500 dark:text-light-500">Rating</h5>
                        <p class="text-dark-100 dark:text-light-900">
                            <div class="flex items-center mt-1">
                                @for ($i = 0; $i < 5; $i++)
                                @if ($i < floor($user->doctor->rating))
                                <!-- Yellow star for the rating -->
                                <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>
                                @else
                                <!-- Transparent star for the remaining stars -->
                                <svg class="w-4 h-4 text-gray-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>
                                @endif
                                @endfor
                                <p class="text-dark-100 dark:text-light-900">{{ $user->doctor->rating }}</p>
                            </div>                            
                        </p>
                    </div>
                    @endif
                </div>
                    @if (Auth::User()->id == $user->id)  
                    <x-slot name="menu">
                        <x-card-menu dropdownId="1">
                            <li>
                                <a href="#" data-modal-target="editModal" data-modal-toggle="editModal"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                            Edit
                        </a>
                    </li>
                </x-card-menu>
                <x-modal target="editModal" modalTitle="Edit User">
                    <div class="p-4 max-h-[80vh] w-[50vw]">
                        <form method="POST" action="{{ route('users.update', $user->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- First Column -->
                                <div>
                                    <div class="mb-4">
                                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                                        <input type="text" name="name" value="{{ $user->name }}" class="mt-1 block w-full p-2 border rounded-lg" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                                        <input type="email" name="email" value="{{ $user->email }}" class="mt-1 block w-full p-2 border rounded-lg" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Profile Picture</label>
                                        <x-file-dropzone id="1" />
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div>
                                    <div class="mb-4">
                                        <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Current Password</label>
                                        <input type="password" name="current_password" class="mt-1 block w-full p-2 border rounded-lg" placeholder="Enter current password" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">New Password</label>
                                        <input type="password" name="password" class="mt-1 block w-full p-2 border rounded-lg" placeholder="New password">
                                    </div>
                                    <div class="mb-4">
                                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirm New Password</label>
                                        <input type="password" name="password_confirmation" class="mt-1 block w-full p-2 border rounded-lg" placeholder="Confirm new password">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update</button>
                        </form>
                    </div>                        
                </x-modal>
            </x-slot>
            @endif
        </x-profile-card>
        @if ((Auth::User()->id == $user->id) || (!Auth::User()->roles->contains('name', 'pasien')))
            <!-- Card 2 (Melebihi 1 Kolom) -->
            <div class="col-span-1 sm:col-span-2">
                <x-profile-card>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 w-full p-4">
                        <!-- Full Name (Capitalized) -->
                        <div class="text-left">
                            <p class="text-lg text-gray-900 dark:text-white">Nama Lengkap</p>
                            <p class="text-base text-gray-900 dark:text-white">
                                {{ strtoupper($user->biograph->surename ?? 'Data not available') }}</p>
                        </div>

                        <!-- NIK (Uppercase first letter) -->
                        <div class="text-left">
                            <p class="text-lg text-gray-900 dark:text-white">NIK</p>
                            <p class="text-base text-gray-900 dark:text-white">
                                {{ ucwords(strtolower($user->biograph->nik ?? 'Data not available')) }}</p>
                        </div>

                        <!-- Date of Birth (Uppercase first letter) -->
                        <div class="text-left">
                            <p class="text-lg text-gray-900 dark:text-white">Tanggal Lahir</p>
                            <p class="text-base text-gray-900 dark:text-white">
                                {{ $user->biograph && $user->biograph->date_of_birth ? \Carbon\Carbon::parse($user->biograph->date_of_birth)->format('d M Y') : 'Data not available' }}
                            </p>
                        </div>

                        <!-- Gender (Uppercase first letter) -->
                        <div class="text-left">
                            <p class="text-lg text-gray-900 dark:text-white">Jenis Kelamin</p>
                            <p class="text-base text-gray-900 dark:text-white">
                                {{ ucwords(strtolower($user->biograph->gender ?? 'Data not available')) }}</p>
                        </div>

                        <!-- Religion (Uppercase first letter) -->
                        <div class="text-left">
                            <p class="text-lg text-gray-900 dark:text-white">Agama</p>
                            <p class="text-base text-gray-900 dark:text-white">
                                {{ ucwords(strtolower($user->biograph->religion ?? 'Data not available')) }}</p>
                        </div>

                        <!-- Marriage Status (Uppercase first letter) -->
                        <div class="text-left">
                            <p class="text-lg text-gray-900 dark:text-white">Status Pernikahan</p>
                            <p class="text-base text-gray-900 dark:text-white">
                                {{ ucwords(strtolower($user->biograph->marriage_status ?? 'Data not available')) }}</p>
                        </div>

                        <!-- Job (Uppercase first letter) -->
                        <div class="text-left col-span-2">
                            <p class="text-lg text-gray-900 dark:text-white">Pekerjaan</p>
                            <p class="text-base text-gray-900 dark:text-white">
                                {{ ucwords(strtolower($user->biograph->job ?? 'Data not available')) }}</p>
                        </div>

                        <!-- Address (Uppercase first letter) -->
                        <div class="text-left col-span-2">
                            <p class="text-lg text-gray-900 dark:text-white">Alamat</p>
                            <p class="text-base text-gray-900 dark:text-white">
                                {{ ucwords(strtolower($user->biograph->address ?? 'Data not available')) }}</p>
                        </div>
                    </div>
                    @if (Auth::User()->id == $user->id)
                    <x-slot name="menu">
                        <x-card-menu dropdownId="2">
                            <li>
                                <a href="#" data-modal-target="editBiograph" data-modal-toggle="editBiograph"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                    Edit
                                </a>
                            </li>
                        </x-card-menu>
                            <x-modal target="editBiograph" modalTitle="Edit Biograph">
                                <div class="p-4 w-[50vw]">
                                    <form method="POST" action="{{ $user->biograph ? route('biographs.update', $user->biograph->id) : route('biographs.store') }}">
                                        @csrf
                                        @if ($user->biograph)
                                            @method('PUT')
                                        @endif
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <!-- First Column -->
                                            <div>
                                                <!-- Surname Field -->
                                                <div class="mb-4">
                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                    <label for="surename" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Surename</label>
                                                    <input type="text" name="surename" value="{{ $user->biograph->surename ?? '' }}" class="mt-1 block w-full p-2 border rounded-lg" required>
                                                </div>
                                
                                                <!-- Date of Birth Field -->
                                                <div class="mb-4">
                                                    <label for="date_of_birth" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date of Birth</label>
                                                    <input type="date" name="date_of_birth" value="{{ $user->biograph->date_of_birth ?? '' }}" class="mt-1 block w-full p-2 border rounded-lg" required>
                                                </div>
                                
                                                <!-- Address Field -->
                                                <div class="mb-4">
                                                    <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                                                    <textarea name="address" class="mt-1 block w-full p-2 border rounded-lg" required>{{ $user->biograph->address ?? '' }}</textarea>
                                                </div>
                                
                                                <!-- Religion Field -->
                                                <div class="mb-4">
                                                    <label for="religion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Religion</label>
                                                    <input type="text" name="religion" value="{{ $user->biograph->religion ?? '' }}" class="mt-1 block w-full p-2 border rounded-lg" required>
                                                </div>
                                
                                                <!-- Job Field -->
                                                <div class="mb-4">
                                                    <label for="job" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Job</label>
                                                    <input type="text" name="job" value="{{ $user->biograph->job ?? '' }}" class="mt-1 block w-full p-2 border rounded-lg" required>
                                                </div>
                                            </div>
                                
                                            <!-- Second Column -->
                                            <div>
                                                <!-- NIK Field -->
                                                <div class="mb-4">
                                                    <label for="nik" class="block text-sm font-medium text-gray-700 dark:text-gray-300">NIK</label>
                                                    <input type="text" name="nik" value="{{ $user->biograph->nik ?? '' }}" class="mt-1 block w-full p-2 border rounded-lg" required>
                                                </div>
                                
                                                <!-- Gender Field -->
                                                <div class="mb-4">
                                                    <label for="gender" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gender</label>
                                                    <select name="gender" class="mt-1 block w-full p-2 border rounded-lg" required>
                                                        <option value="laki-laki" {{ isset($user->biograph->gender) == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                        <option value="perempuan" {{ isset($user->biograph->gender) == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                    </select>
                                                </div>
                                
                                                <!-- Marriage Status Field -->
                                                <div class="mb-4">
                                                    <label for="marriage_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Marriage Status</label>
                                                    <input type="text" name="marriage_status" value="{{ $user->biograph->marriage_status ?? '' }}" class="mt-1 block w-full p-2 border rounded-lg" required>
                                                </div>
                                
                                                <!-- File ID Field -->
                                                <div class="mb-4">
                                                    <label for="file_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Foto KTP</label>
                                                    <x-file-dropzone id="2"/>
                                                </div>
                                            </div>
                                        </div>
                                
                                        <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update</button>
                                    </form>
                                </div>                                
                            </x-modal>
                    </x-slot>
                    @endif
                </x-profile-card>
            </div>
        @endif

            {{-- Medical Record --}}
            @if (Auth::User()->id == $user->id)
                <x-card mdColSpan="md:col-span-2" xlColSpan="xl:col-span-3">
                    <x-datatable :data="$medicalRecords" datatableId="datatable" title="Your Medical Records"/>
                </x-card>
            @endif

            {{-- Next Schedule --}}
            {{-- <div class="col-span-1 sm:col-span-1">
                <x-profile-card dropdownId="4">
                    
                </x-profile-card>
            </div> --}}
            @if ($user->doctor)
            <div class="col-span-1 sm:col-span-1">
                <x-comment-card :doctorId="$doctor->id" />
            </div>
            @endif
        </div>
@endsection
