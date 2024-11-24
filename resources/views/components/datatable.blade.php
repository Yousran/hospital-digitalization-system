@if ($title)
    <h2 class="text-lg font-medium text-dark-500 dark:text-light-500 mb-4">{{ $title }}</h2>
@endif
<table id="{{ $datatableId }}" class="min-w-full">
    @if ($data)
        
    <thead>
        <tr>
            @foreach (array_keys($data[0]) as $heading)
            <th>
                <span class="flex items-center">
                    {{ ucfirst($heading) }}
                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                    </svg>
                </span>
            </th>
            @endforeach
            @if($routeEdit || $routeDelete)
                <th data-ignore-search="true" class="flex justify-center">
                    Action
                </th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
        <tr>
            @foreach ($row as $value)
            <td class="font-medium whitespace-nowrap text-dark-500 dark:text-light-500">
                {{ $value }}
            </td>
            @endforeach
            @if($routeEdit || $routeDelete)
                <td class="flex items-center justify-around px-6 py-4">
                    @if ($routeEdit)                        
                        <a href="{{ route($routeEdit, $row['id']) }}" class="font-medium text-primary-500 hover:underline">Edit</a>
                    @endif
                    @if ($routeDelete)
                        <form action="{{ route($routeDelete, $row['id']) }}" method="post" class="mb-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-medium text-red-500 hover:underline ms-4">Remove</button>
                        </form>
                    @endif
                </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
<script>
    if (document.getElementById("{{ $datatableId }}") && typeof simpleDatatables.DataTable !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#{{ $datatableId }}", {
            tableRender: (_data, table, type) => {
                if (type === "print") {
                    return table;
                }
                
                const tHead = table.childNodes[0];
                
                const filterHeaders = {
                    nodeName: "TR",
                    attributes: {
                        class: "search-filtering-row"
                    },
                    childNodes: tHead.childNodes[0].childNodes.map((_th, index) => {
                        if (_th.attributes && _th.attributes["data-ignore-search"]) {
                            return { nodeName: "TH" };
                        }
                        return {
                            nodeName: "TH",
                            childNodes: [
                                {
                                    nodeName: "INPUT",
                                    attributes: {
                                        class: "datatable-input",
                                        type: "search",
                                        "data-columns": "[" + index + "]",
                                    }
                                }
                            ]
                        };
                    })
                };
                
                tHead.childNodes.push(filterHeaders);
                
                return table;
            }
        });
        
        @if($routeCreate)
        const datatableTop = document.querySelector(".datatable-top");
        if (datatableTop) {
            const datatableInput = datatableTop.querySelector(".datatable-search");
            const datatableSearchInput = datatableInput.querySelector(".datatable-input");
            
            if (datatableInput) {
                const wrapperDiv = document.createElement("div");
                wrapperDiv.classList.add("flex", "flex-start");
                
                wrapperDiv.appendChild(datatableInput);
                const addDataLink = document.createElement("a");
                addDataLink.href = "{{ route($routeCreate) }}"; 
                addDataLink.classList.add("bg-primary-500");
                addDataLink.classList.add("hover:bg-primary-600");
                addDataLink.classList.add("rounded-lg");
                addDataLink.classList.add("mx-4");
                addDataLink.classList.add("py-2");
                addDataLink.classList.add("px-4");
                addDataLink.classList.add("text-light-500");
                addDataLink.classList.add("focus:ring-2");
                addDataLink.classList.add("ring-light-500");
                addDataLink.textContent = "Add Data";
                
                wrapperDiv.appendChild(addDataLink);
                
                datatableTop.appendChild(wrapperDiv);
            }
        }
        @endif
    }
</script>
    @else
            <p class="text-dark-500 dark:text-light-500">No Data</p>
        </table>
    @endif


