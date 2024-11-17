<div>
    <div class="flex items-center justify-between mb-4">
        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">{{ $title }}</h5>
    </div>
    <div class="flow-root">
        <ul id="{{ $listId }}" role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
            {{-- Data akan dimuat oleh JavaScript --}}
        </ul>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const fetchData = async () => {
                try {
                    const response = await fetch('{{ $fetchUrl }}');
                    if (!response.ok) throw new Error('Failed to fetch data');
                    const items = await response.json();

                    // Clear the list
                    const list = document.getElementById('{{ $listId }}');
                    list.innerHTML = '';

                    // Populate list
                    items.forEach(item => {
                        const listItem = document.createElement('li');
                        listItem.className = 'py-3 sm:py-4';

                        const profileImage = item.profil_picture
                            ? `{{ asset('storage') }}/${item.profil_picture.path}`
                            : 'https://picsum.photos/200';

                        listItem.innerHTML = `
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <img class="w-8 h-8 rounded-full" src="${profileImage}" alt="${item.name}">
                                </div>
                                <div class="flex-1 min-w-0 ms-4">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        ${item.name}
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        ${item.email}
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

            // Fetch data every 2 seconds
            fetchData();
            setInterval(fetchData, 2000);
        });
    </script>
</div>
