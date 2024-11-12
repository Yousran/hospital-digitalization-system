@foreach ($data as $item)
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
        @foreach ($columns as $column)
            @if ($loop->first)
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $item->$column }}
                </th>
            @else
                <td class="px-6 py-4">
                    {{ $item->$column }}
                </td>
            @endif
        @endforeach
        <td class="px-6 py-4 flex items-center justify-center">
            <button id="{{ $item->id }}-dropdown-button" data-dropdown-toggle="{{ $item->id }}-dropdown"
                class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                type="button">
                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                </svg>
            </button>
            {{-- TODO: Action seperti modal dan lainnya tidak berfungsi setelah melakukan proses pencarian --}}
            <div id="{{ $item->id }}-dropdown"
                class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                    aria-labelledby="{{ $item->id }}-dropdown-button">
                    <li>
                        <a href="#" data-modal-target="editModal-{{ $item->id }}"
                            data-modal-toggle="editModal-{{ $item->id }}"
                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                    </li>
                    <li>
                        <form action="{{ route($routeDelete, $item->id) }}" method="POST"
                            class="block hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full m-0 py-2 px-4 text-left">Delete</button>
                        </form>
                    </li>
                </ul>
            </div>
        </td>
    </tr>
@endforeach
