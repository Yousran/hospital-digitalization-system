<div class="relative overflow-x-auto sm:rounded-lg">
    <div class="pb-4 flex gap-4">
        <div class="relative mt-1">
            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="text" id="table-search"
                class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Search for {{ $dataName }}">
            <script>
                const routeDatatable = '{{ route($routeDatatable) }}';

                function fetchData(search = '') {
                    fetch(routeDatatable, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                search: search
                            })
                        })
                        .then(response => {
                            if (!response.ok) throw new Error('Gagal mengambil data dari server.');
                            return response.json();
                        })
                        .then(data => {
                            // Pastikan data memiliki struktur yang benar sebelum merender ulang konten tabel
                            if (data.data) {
                                renderTableContent(data.data, data.columns);
                            } else {
                                console.error("Respons tidak memiliki data atau kolom yang sesuai.");
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }

                // Event listener untuk input pencarian
                document.getElementById('table-search').addEventListener('input', function() {
                    const search = this.value;
                    fetchData(search); // Memanggil fungsi fetchData dengan query pencarian
                });
            </script>

        </div>
        <div class="relative mt-1">
            <button type="button" data-modal-target="createModal" data-modal-toggle="createModal"
                class="flex text-nowrap items-center justify-center text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:ring-blue-500 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                </svg>
                Add {{ $dataName }}
            </button>
        </div>
    </div>
    {{-- @include('components.datatable-content', ['data' => $data]) --}}

    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr id="table-head">
            </tr>
            <script>
                function renderTableHead(columns) {
                    // Dapatkan elemen table-head
                    const tableHead = document.getElementById('table-head');

                    // Hapus konten sebelumnya
                    tableHead.innerHTML = '';

                    // Tambahkan kolom-kolom sesuai dengan array columns
                    columns.forEach(column => {
                        const th = document.createElement('th');
                        th.scope = 'col';
                        th.className = 'px-6 py-3';
                        th.textContent = column;
                        tableHead.appendChild(th);
                    });

                    // Tambahkan kolom "Action"
                    const actionTh = document.createElement('th');
                    actionTh.scope = 'col';
                    actionTh.className = 'px-6 py-3 text-center';
                    actionTh.textContent = 'Action';
                    tableHead.appendChild(actionTh);
                }
            </script>
        </thead>
        <tbody id="table-content">
        </tbody>
        <script>
            function renderTableContent(data, columns) {
                const tableContent = document.getElementById('table-content');
        
                // Hapus konten sebelumnya
                tableContent.innerHTML = '';
        
                // Menambahkan baris untuk setiap item data
                data.forEach(item => {
                    const row = document.createElement('tr');
                    row.className = 'bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600';
        
                    // Menambahkan setiap kolom ke dalam baris
                    columns.forEach((column, index) => {
                        const cell = document.createElement(index === 0 ? 'th' : 'td');
                        
                        if (index === 0) {
                            cell.scope = 'row';
                            cell.className = 'px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white';
                        } else {
                            cell.className = 'px-6 py-4';
                        }
        
                        cell.textContent = item[column];
                        row.appendChild(cell);
                    });
        
                    // Membuat cell untuk aksi
                    const actionCell = document.createElement('td');
                    actionCell.className = 'px-6 py-4 flex items-center justify-center';
        
                    // Tombol Edit
                    const editLink = document.createElement('a');
                    editLink.href = `{{ route($routeEdit, ':id') }}`.replace(':id', item.id);  // Prevent default link behavior
                    editLink.className = 'text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-600';
                    editLink.textContent = 'Edit';
                    actionCell.appendChild(editLink);
        
                    // Form Hapus
                    const deleteForm = document.createElement('form');
                    deleteForm.action = `{{ route($routeDelete, '') }}/${item.id}`;
                    deleteForm.method = 'POST';
                    deleteForm.className = 'inline';
        
                    // CSRF token dan method override untuk DELETE
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';  // Ganti dengan CSRF token yang sesuai
        
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';
        
                    // Tombol Hapus
                    const deleteButton = document.createElement('button');
                    deleteButton.type = 'submit';
                    deleteButton.className = 'text-red-600 hover:text-red-800 ml-4 dark:text-red-400 dark:hover:text-red-600';
                    deleteButton.textContent = 'Delete';
        
                    // Menyusun form delete
                    deleteForm.appendChild(csrfToken);
                    deleteForm.appendChild(methodInput);
                    deleteForm.appendChild(deleteButton);
                    actionCell.appendChild(deleteForm);
        
                    // Tambahkan actionCell ke dalam row
                    row.appendChild(actionCell);
                    tableContent.appendChild(row);
                });
            }
        </script>        
    </table>
    <script>
        function loadDataTable() {
            fetch(routeDatatable, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({})
                })
                .then(response => {
                    if (!response.ok) throw new Error('Gagal mengambil data dari server.');
                    return response.json();
                })
                .then(data => {
                    console.log('Server Response:', data);

                    if (data.data && data.columns) {
                        renderTableHead(data.columns);
                        renderTableContent(data.data, data.columns);
                    } else {
                        console.error("Data atau columns tidak ditemukan dalam respons.");
                    }
                })
                .catch(error => console.error('Error:', error));
        }
        // Panggil loadDataTable saat halaman dimuat
        document.addEventListener('DOMContentLoaded', loadDataTable);
    </script>
</div>
