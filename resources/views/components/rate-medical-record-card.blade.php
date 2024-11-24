<div id="rate-medical-record-card">
    <div class="flex flex-col items-center justify-center p-4">
        <img id="doctor-picture" class="w-24 h-24 mb-3 rounded-full shadow-lg" src="" alt="Doctor Profile Picture" />
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
                @for ($i = 1; $i <= 5; $i++)
                    <button type="button" class="rating-star w-8 h-8 text-gray-300 hover:text-yellow-300" data-value="{{ $i }}" aria-label="Rate {{ $i }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                        </svg>
                    </button>
                @endfor
            </div>
        </div>
    </div>
</div>

<!-- Comment Modal -->
<div id="comment-modal" class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white dark:bg-dark-400 rounded-lg shadow-lg p-6 w-full max-w-md">
        <h2 class="text-lg font-medium text-dark-500 dark:text-light-500 mb-4">Add a Comment</h2>
        <form id="comment-form" class="space-y-4">
            @csrf
            <input type="hidden" name="medical_record_id" id="modal-medical_record_id">
            <div>
                <label for="modal-comment" class="block text-sm font-medium text-dark-500 dark:text-light-500">Comment</label>
                <textarea name="comment" id="modal-comment" rows="4" class="mt-1 block w-full rounded-md border-light-700 bg-light-500 dark:border-dark-300 dark:bg-dark-400" required></textarea>
            </div>
            <div class="flex justify-end">
                <button type="button" id="close-modal" class="px-4 py-2 text-sm font-medium text-light-500 bg-gray-500 rounded-lg hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 mr-2">Cancel</button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-light-500 bg-primary-500 rounded-lg hover:bg-primary-600 focus:ring-4 focus:ring-primary-300">Submit Comment</button>
            </div>
        </form>
    </div>
</div>
@push('scripts')

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

            const loadCardData = async () => {
                const data = await fetchMedicalRecord();

                const cardWrapper = document.getElementById('rate-medical-record-card');

                if (!data || data.error) {
                    cardWrapper.innerHTML = `
                        <div class="flex justify-center items-center h-48 text-center">
                            <p class="text-lg font-semibold text-dark-500 dark:text-light-500">Thank you for your Rate!</p>
                        </div>`;
                    return null;
                }

                document.getElementById('doctor-picture').src = data.doctor.profile_picture;
                document.getElementById('doctor-name').textContent = data.doctor.name;
                document.getElementById('record-date').textContent = data.created_at;
                document.getElementById('diagnosis').textContent = data.diagnosis;
                document.getElementById('modal-medical_record_id').value = data.id;

                return data;
            };

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
                    document.getElementById('comment-modal').classList.remove('hidden');
                    document.getElementById('comment-modal').classList.add('flex');
                })
                .catch(error => console.error(error));
            };

            const handleCommentSubmit = (event) => {
                event.preventDefault();
                const form = event.target;
                const formData = new FormData(form);
                fetch('{{ route('comments.store') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data?.error) throw new Error(data.error);
                    form.reset();
                    document.getElementById('comment-modal').classList.add('hidden');
                    document.getElementById('comment-modal').classList.remove('flex');
                    location.reload();
                })
                .catch(error => console.error(error));
            };

            const recordData = await loadCardData();

            if (recordData) {
                document.querySelectorAll('.rating-star').forEach(star => {
                    star.addEventListener('click', () => {
                        const value = star.getAttribute('data-value');
                        handleStarClick(recordData.id, value);
                    });
                });

                document.getElementById('comment-form').addEventListener('submit', handleCommentSubmit);
                document.getElementById('close-modal').addEventListener('click', () => {
                document.getElementById('comment-modal').classList.add('hidden');
                });
            }
        });
    </script>
@endpush