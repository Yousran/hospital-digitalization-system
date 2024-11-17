<div id="drawer-navigation" 
    class="fixed top-[4.5rem] left-0 z-40 w-64 h-full p-4 overflow-y-auto transition-transform -translate-x-full bg-light-600 dark:bg-dark-400"
    tabindex="-1" aria-labelledby="drawer-navigation-label">
    <h5 id="drawer-navigation-label" class="text-base font-semibold text-dark-300 uppercase dark:text-light-800">Menu</h5>
    <div class="py-4 overflow-y-auto">
        @php
            $user = Auth::user();
            $roles = $user->roles->pluck('name')->toArray();
        @endphp

        <ul class="space-y-2 font-medium">
            <!-- Dashboard -->
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center p-2 text-dark-300 rounded-lg dark:text-light-800 hover:bg-light-500 hover:text-dark-500 dark:hover:text-light-500 dark:hover:bg-dark-500 group">
                    <i
                        class='bx bx-pie-chart-alt-2 w-5 h-5 text-2xl text-dark-300 transition duration-75 dark:text-light-800 group-hover:text-dark-500 dark:group-hover:text-light-500'></i>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>

            <!-- Tables -->
            @if (in_array('admin', $roles))
                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-dark-300 rounded-lg dark:text-light-800 hover:bg-light-500 hover:text-dark-500 dark:hover:text-light-500 dark:hover:bg-dark-500 group"
                        aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                        <i
                            class='bx bx-table flex-shrink-0 w-5 h-5 text-2xl text-dark-300 transition duration-75 dark:text-light-800 group-hover:text-dark-500 dark:group-hover:text-light-500'></i>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Tables</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="dropdown-example" class="hidden py-2 space-y-2">
                        <li><a href="{{ route('users.index') }}" class="flex items-center p-2 text-dark-300 rounded-lg dark:text-light-800 hover:bg-light-500 hover:text-dark-500 dark:hover:text-light-500 dark:hover:bg-dark-500 group">Users</a></li>
                        <li><a href="{{ route('patients.index') }}" class="flex items-center p-2 text-dark-300 rounded-lg dark:text-light-800 hover:bg-light-500 hover:text-dark-500 dark:hover:text-light-500 dark:hover:bg-dark-500 group">Patients</a></li>
                        <li><a href="{{ route('doctors.index') }}" class="flex items-center p-2 text-dark-300 rounded-lg dark:text-light-800 hover:bg-light-500 hover:text-dark-500 dark:hover:text-light-500 dark:hover:bg-dark-500 group">Doctors</a></li>
                        <li><a href="{{ route('specialities.index') }}" class="flex items-center p-2 text-dark-300 rounded-lg dark:text-light-800 hover:bg-light-500 hover:text-dark-500 dark:hover:text-light-500 dark:hover:bg-dark-500 group">Specialities</a></li>
                        <li><a href="{{ route('roles.index') }}" class="flex items-center p-2 text-dark-300 rounded-lg dark:text-light-800 hover:bg-light-500 hover:text-dark-500 dark:hover:text-light-500 dark:hover:bg-dark-500 group">Roles</a></li>
                        <li><a href="{{ route('medical-records.index') }}" class="flex items-center p-2 text-dark-300 rounded-lg dark:text-light-800 hover:bg-light-500 hover:text-dark-500 dark:hover:text-light-500 dark:hover:bg-dark-500 group">Medical Records</a></li>
                    </ul>
                </li>
            @endif

            <!-- Consultation -->
            @if (in_array('dokter', $roles))
                <li>
                    <a href="{{ route('consultation') }}"
                        class="flex items-center p-2 text-dark-300 rounded-lg dark:text-light-800 hover:bg-light-500 hover:text-dark-500 dark:hover:text-light-500 dark:hover:bg-dark-500 group">
                        <i
                            class='bx bx-health flex-shrink-0 w-5 h-5 text-2xl text-dark-300 transition duration-75 dark:text-light-800 group-hover:text-dark-500 dark:group-hover:text-light-500'></i>
                        <span class="ms-3">Consultation</span>
                    </a>
                </li>
            @endif

            <!-- Doctor Medical Records -->
            @if (in_array('dokter', $roles))
                <li>
                    <a href="{{ route('authorized-medical-records.doctor') }}"
                        class="flex items-center p-2 text-dark-300 rounded-lg dark:text-light-800 hover:bg-light-500 hover:text-dark-500 dark:hover:text-light-500 dark:hover:bg-dark-500 group">
                        <i
                            class='bx bx-list-ul flex-shrink-0 w-5 h-5 text-2xl text-dark-300 transition duration-75 dark:text-light-800 group-hover:text-dark-500 dark:group-hover:text-light-500'></i>
                        <span class="ms-3">Doctor Medical Records</span>
                    </a>
                </li>
            @endif

            <!-- Patient Medical Records -->
            @if (in_array('pasien', $roles))
            <li>
                <a href="{{ route('authorized-medical-records.patient') }}"
                    class="flex items-center p-2 text-dark-300 rounded-lg dark:text-light-800 hover:bg-light-500 hover:text-dark-500 dark:hover:text-light-500 dark:hover:bg-dark-500 group">
                    <i
                        class='bx bx-list-ul flex-shrink-0 w-5 h-5 text-2xl text-dark-300 transition duration-75 dark:text-light-800 group-hover:text-dark-500 dark:group-hover:text-light-500'></i>
                    <span class="ms-3">Medical Records</span>
                </a>
            </li>
            @endif

            <!-- Medicines -->
            @if (in_array('admin', $roles))
                <li>
                    <a href="{{ route('medicines.index') }}"
                        class="flex items-center p-2 text-dark-300 rounded-lg dark:text-light-800 hover:bg-light-500 hover:text-dark-500 dark:hover:text-light-500 dark:hover:bg-dark-500 group">
                        <i
                            class='bx bx-capsule flex-shrink-0 w-5 h-5 text-2xl text-dark-300 transition duration-75 dark:text-light-800 group-hover:text-dark-500 dark:group-hover:text-light-500'></i>
                        <span class="ms-3">Medicines</span>
                    </a>
                </li>
            @endif

            <!-- Schedule (Placeholder, Always Visible) -->
            @if (in_array('pasien', $roles))
            <li>
                <a href="#"
                    class="flex items-center p-2 text-dark-300 rounded-lg dark:text-light-800 hover:bg-light-500 hover:text-dark-500 dark:hover:text-light-500 dark:hover:bg-dark-500 group">
                    <i
                        class='bx bx-calendar flex-shrink-0 w-5 h-5 text-2xl text-dark-300 transition duration-75 dark:text-light-800 group-hover:text-dark-500 dark:group-hover:text-light-500'></i>
                    <span class="ms-3">Schedule</span>
                </a>
            </li>
            @endif

            <!-- Schedule (Logs Viewer) -->
            @if (in_array('admin', $roles))
            <li>
                <a href="{{ route('log-viewer.index') }}"
                    class="flex items-center p-2 text-dark-300 rounded-lg dark:text-light-800 hover:bg-light-500 hover:text-dark-500 dark:hover:text-light-500 dark:hover:bg-dark-500 group">
                    <i
                        class='bx bx-history flex-shrink-0 w-5 h-5 text-2xl text-dark-300 transition duration-75 dark:text-light-800 group-hover:text-dark-500 dark:group-hover:text-light-500'></i>
                    <span class="ms-3">Logs</span>
                </a>
            </li>
            @endif

            <!-- Settings (Placeholder, Always Visible) -->
            <li>
                <a href="{{ route('settings') }}"
                    class="flex items-center p-2 text-dark-300 rounded-lg dark:text-light-800 hover:bg-light-500 hover:text-dark-500 dark:hover:text-light-500 dark:hover:bg-dark-500 group">
                    <i
                        class='bx bx-cog flex-shrink-0 w-5 h-5 text-2xl text-dark-300 transition duration-75 dark:text-light-800 group-hover:text-dark-500 dark:group-hover:text-light-500'></i>
                    <span class="ms-3">Settings</span>
                </a>
            </li>
        </ul>
    </div>
</div>
