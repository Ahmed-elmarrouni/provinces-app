<x-app-layout>
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.6.0-web/css/all.min.css') }}">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Regions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="table-container">
                    <div class="search-bar">
                        <input type="text" id="searchInput" placeholder="Search region or city ..." onkeyup="filterRegions()">
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>Regions</th>
                                <th>N° of cities</th>
                                <th>N° of provinces</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="regionsTableBody">
                            @foreach ($regions as $region)
                            <tr>
                                <td>{{ $region->region_name }}</td>
                                <td>{{ $region->cities_count }}</td>
                                <td>{{ $region->provinces_count }}</td>
                                <td>
                                    <button class="show-btn" data-region-id="{{ $region->id }}">Show&nbsp;&nbsp; <i class="fa-regular fa-eye"></i></button>
                                    <button class="update-btn">Update&nbsp;&nbsp; <i class="fa-regular fa-pen-to-square"></i></button>
                                    <button class="delete-btn" data-region-id="{{ $region->id }}">Delete&nbsp;&nbsp;<i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

<link rel="stylesheet" href="{{ asset('assets/style/table.css') }}">

<script>
    document.querySelectorAll('.show-btn').forEach(button => {
        button.addEventListener('click', function() {
            let regionId = this.getAttribute('data-region-id');
            window.location.href = `/regions/${regionId}/cities`;
        });
    });

    function filterRegions() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('regionsTableBody');
        const rows = table.getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let match = false;

            // Check if the region name or city count matches the input
            for (let j = 0; j < cells.length; j++) {
                if (cells[j]) {
                    const cellText = cells[j].textContent || cells[j].innerText;
                    if (cellText.toLowerCase().indexOf(filter) > -1) {
                        match = true;
                        break;
                    }
                }
            }

            rows[i].style.display = match ? '' : 'none';
        }
    }


    // Delete Region
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const regionId = this.getAttribute('data-region-id');

            if (confirm('Are you sure you want to delete this region?')) {
                fetch(`/regions/${regionId}`, {
                        method: 'DELETE'
                        , headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            , 'Content-Type': 'application/json'
                        , }
                    , })
                    .then(response => {
                        if (response.ok) {
                            window.location.reload(); // Reload page after delete the regon
                        } else {
                            response.json().then(data => {
                                alert('Failed to delete region: ' + data.message);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Failed to delete region.');
                    });
            }
        });
    });

</script>
