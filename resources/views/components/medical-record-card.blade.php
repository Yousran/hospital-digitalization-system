<div>
    <div class="flex items-center justify-between mb-4">
        <h5 class="text-xl font-bold leading-none text-dark-500 dark:text-light-500">Last Medical Record</h5>
        <p class="text-dark-200 dark:text-light-800" id="data-created-at"></p>
    </div>
    <div class="flow-root">
        <div id="latest-medical-record">

        </div>
        <ul id="medicines-list" role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
            {{-- Data akan dimuat oleh JavaScript --}}
        </ul>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const fetchData = async () => {
                try {
                    const response = await fetch('{{ route('fetchPatientLatestMedicines') }}'); // Ganti dengan URL API yang sesuai
                    if (!response.ok) throw new Error('Failed to fetch data');
                    const data = await response.json();

                    const diagnosisElement = document.querySelector('#latest-medical-record');
                    diagnosisElement.innerHTML = `
                        <div class="mb-4 text-sm text-dark-500 dark:text-light-500">
                            <h5 class="mb-1 text-lg font-bold text-dark-500 dark:text-light-500">Diagnosis</h5>
                            <p>${data.diagnosis || 'No diagnosis available'}</p>
                        </div>
                        <div class="mb-4 text-sm text-dark-500 dark:text-light-500">
                            <h5 class="mb-1 text-lg font-bold text-dark-500 dark:text-light-50">Action</h5>
                            <p>${data.action || 'No action available'}</p>
                        </div>
                    `;

                    const dataCreatedAt = document.querySelector('#data-created-at');
                    dataCreatedAt.innerText = data.created_at;

                    const list = document.getElementById('medicines-list');
                    list.innerHTML = '';

                    data.medicines.forEach(medicine => {
                        const listItem = document.createElement('li');
                        listItem.className = 'py-3 sm:py-4';

                        const profileImage = medicine.medicine_picture;

                        listItem.innerHTML = `
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <img class="w-8 h-8 rounded-full" src="${profileImage}" alt="${medicine.name}">
                                </div>
                                <div class="flex-1 min-w-0 ms-4">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        ${medicine.name}
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        Type: ${medicine.type}
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        Quantity: ${medicine.quantity} - ${medicine.prescription_description}
                                    </p>
                                </div>
                            </div>
                        `;
                        list.appendChild(listItem);
                    });
                } catch (error) {
                    console.error('Error fetching data:', error);
                }
            };

            fetchData();
        });

    </script>
</div>
