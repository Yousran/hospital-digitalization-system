<div class="flex items-center justify-center w-full">
    <label for="dropzone-file-{{ $id }}" class="flex flex-col items-center justify-center w-full min-h-64 p-4 border-2 border-dark-100 border-dashed rounded-lg cursor-pointer bg-light-500 dark:hover:bg-dark-500 dark:bg-dark-300 hover:bg-light-700 hover:border-primary-500 dark:border-dark-100 dark:hover:border-primary-500" id="dropzone-area-{{ $id }}">
        <div class="flex flex-col items-center justify-center pt-5 pb-6">
            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
            </svg>
            <p id="upload-text-{{ $id }}" class="mb-2 text-sm text-gray-500 dark:text-gray-400 text-center"><span class="font-semibold">Click to upload</span> or drag and drop</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF</p>
        </div>
        <input id="dropzone-file-{{ $id }}" type="file" class="hidden" />
        <input type="hidden" name="file_id" id="fileId-{{ $id }}">
    </label>
</div>

@push('scripts')
    <script>
        function initDropzone(id) {
            const dropzoneArea = document.getElementById(`dropzone-area-${id}`);
            const fileInput = document.getElementById(`dropzone-file-${id}`);
            const uploadText = document.getElementById(`upload-text-${id}`);
            const fileIdInput = document.getElementById(`fileId-${id}`);

            // Handle file selection via file input
            fileInput.addEventListener('change', handleFileSelection);

            // Handle drag over (display dropzone area)
            dropzoneArea.addEventListener('dragover', function(event) {
                event.preventDefault();
                dropzoneArea.classList.add('bg-dark-100');
            });

            // Handle drag leave (reset dropzone area)
            dropzoneArea.addEventListener('dragleave', function() {
                dropzoneArea.classList.remove('bg-gray-100');
            });

            // Handle drop (file drop action)
            dropzoneArea.addEventListener('drop', function(event) {
                event.preventDefault();
                dropzoneArea.classList.remove('bg-gray-100');
                const files = event.dataTransfer.files;
                if (files.length > 0) {
                    handleFileSelection({ target: { files: files } });
                }
            });

            // Handle the file selection or drop
            function handleFileSelection(event) {
                let file = event.target.files[0];

                if (file) {
                    let formData = new FormData();
                    formData.append('file', file);

                    // Send the file via AJAX to your Laravel controller
                    fetch("{{ route('files.store') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Add CSRF token for Laravel protection
                        },
                        body: formData,
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // After successful upload, set the file ID in the hidden input field
                            fileIdInput.value = data.file.id;
                            // Update the label text with the uploaded file name
                            uploadText.innerHTML = `File uploaded: <span class="font-semibold">${data.file.name}</span>`;
                        } else {
                            // Handle upload error
                            console.error('Error uploading file');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                }
            }
        }

        // Initialize the dropzone by passing the unique ID
        initDropzone('{{ $id }}');
    </script>
@endpush