<x-app-layout>
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.6.0-web/css/all.min.css') }}">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cities') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="table-container">
                    <div class="search-bar">
                        <input type="text" id="searchInput" placeholder="Search city..." onkeyup="filterCities()">
                    </div>

                    <table id="citiesTableBody">
                        <thead>
                            <tr>
                                <th>City Name</th>
                                <th>N° of provinces</th>
                                <th>N° of employees</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="citiesTable">
                            @foreach ($cities as $city)
                            <tr>
                                <td>{{ $city->city_name }}</td>
                                <td>{{ $city->provinces_count }}</td>
                                <td>{{ $city->employees_count }}</td>
                                <td>
                                    <button class="show-btn" data-province-id="{{ $city->id }}">Show&nbsp;&nbsp; <i class="fa-regular fa-eye"></i></button>
                                    <button class="update-btn">Update&nbsp;&nbsp; <i class="fa-regular fa-pen-to-square"></i></button>
                                    <button class="delete-btn" data-city-id="{{ $city->id }}">Delete&nbsp;&nbsp;<i class="fa fa-trash"></i></button>
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
            let cityId = this.getAttribute('data-province-id');
            window.location.href = `/cities/${cityId}/provinces`;
        });
    });

    // Function to filter cities based on input
    function filterCities() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('citiesTable');
        const rows = table.getElementsByTagName('tr');

        // Loop through all table rows and hide those that don't match the search query
        for (let i = 0; i < rows.length; i++) {
            const cityCell = rows[i].getElementsByTagName('td')[0]; // First cell is the city name
            if (cityCell) {
                const cityName = cityCell.textContent || cityCell.innerText;
                rows[i].style.display = cityName.toLowerCase().indexOf(filter) > -1 ? '' : 'none';
            }
        }
    }

    // function to delete city
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const cityId = this.getAttribute('data-city-id');

            if (confirm('Are you sure you want to delete this city?')) {
                fetch(`/cities/${cityId}`, {
                        method: 'DELETE'
                        , headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            , 'Content-Type': 'application/json'
                        , }
                    , })
                    .then(response => {
                        if (response.ok) {
                            window.location.reload(); // Reload the page after successful deletion
                        } else {
                            response.json().then(data => {
                                alert('Failed to delete city: ' + data.message);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Failed to delete city.');
                    });
            }
        });
    });

</script>
