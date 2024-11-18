<div id="rate-medical-record-card">
    <div class="flex flex-col items-center justify-center p-4">
        {{-- <img id="doctor-picture" class="w-12 h-12 rounded-full" src="" alt="Doctor Profile Picture"> --}}
        <img id="doctor-picture" class="w-24 h-24 mb-3 rounded-full shadow-lg" src=""
                            alt="Doctor Profile Picture" />
        <h5 id="doctor-name" class="text-lg font-medium text-gray-900 dark:text-white">Doctor Name</h5>
    </div>
    <div class="mt-4">
        <h6 class="text-md font-bold text-dark-500 dark:text-light-500">Diagnosis</h6>
        <p id="record-date" class="text-sm text-dark-200 dark:text-light-800">Date</p>
        <p id="diagnosis" class="text-md text-dark-500 dark:text-light-500">Diagnosis details here...</p>
    </div>
    <div class="mt-4">
        <h6 class="text-md font-bold text-dark-500 dark:text-light-500">Rate The Service</h6>
        <div class="flex items-center mt-1">
            <div class="flex">
                <button type="button" class="rating-star w-8 h-8 text-gray-300 hover:text-yellow-400" data-value="1" aria-label="Rate 1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                    </svg>
                </button>
                <button type="button" class="rating-star w-8 h-8 text-gray-300 hover:text-yellow-400" data-value="2" aria-label="Rate 2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                    </svg>
                </button>
                <button type="button" class="rating-star w-8 h-8 text-gray-300 hover:text-yellow-400" data-value="3" aria-label="Rate 3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                    </svg>
                </button>
                <button type="button" class="rating-star w-8 h-8 text-gray-300 hover:text-yellow-400" data-value="4" aria-label="Rate 4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                    </svg>
                </button>
                <button type="button" class="rating-star w-8 h-8 text-gray-300 hover:text-yellow-400" data-value="5" aria-label="Rate 5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', async () => {
        const fetchMedicalRecord = async () => {
            try {
                const response = await fetch('{{ route('fetchLatestUnratedMedicalRecord') }}');
                if (!response.ok) throw new Error('Failed to fetch medical record');
                return await response.json();
            } catch (error) {
                console.error(error);
                return null;
            }
        };
    
        // Load data into the card
        const loadCardData = async () => {
            const data = await fetchMedicalRecord();
    
            const cardWrapper = document.getElementById('rate-medical-record-card');
    
            if (!data || data.error) {
                // If no data, show a thank-you message
                cardWrapper.innerHTML = `
                    <div class="flex justify-center items-center h-48 text-center">
                        <p class="text-lg font-semibold text-dark-500 dark:text-light-500">Thank you for your Rate!</p>
                    </div>`;
                return null;
            }
    
            // Populate card with data
            document.getElementById('doctor-picture').src = data.doctor.profile_picture;
            document.getElementById('doctor-name').textContent = data.doctor.name;
            document.getElementById('record-date').textContent = data.created_at;
            document.getElementById('diagnosis').textContent = data.diagnosis;
    
            return data;
        };
    
        // Handle star click event
        const handleStarClick = (recordId, value) => {
            fetch('{{ route('storeRate') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ medical_record_id: recordId, rate: value }),
            })
            .then(response => response.json())
            .then(data => {
                if (data?.error) throw new Error(data.error);
                alert('Terima kasih atas rating Anda!');
                location.reload();
            })
            .catch(error => console.error(error));
        };
    
        // Load the card data
        const recordData = await loadCardData();
    
        // Add event listener for star clicks
        if (recordData) {
            document.querySelectorAll('.rating-star').forEach(star => {
                star.addEventListener('click', () => {
                    const value = star.getAttribute('data-value');
                    handleStarClick(recordData.id, value);
                });
            });
        }
    });
</script>
    
