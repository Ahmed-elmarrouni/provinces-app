<x-app-layout>
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.6.0-web/css/all.min.css') }}">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Provinces') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="table-container">
                    <div class="search-bar">
                        <input type="text" id="searchInput" placeholder="Search province..." onkeyup="filterProvinces()">
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>Provinces name</th>
                                <th>N° of employees</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="provincesTable">
                            @foreach ($provinces as $province)
                            <tr>
                                <td>{{ $province->province_name }}</td>
                                <td>{{ $province->employees_count }}</td>
                                <td>
                                    <button class="show-btn" data-province-id="{{ $province->id }}">Show&nbsp;&nbsp; <i class="fa-regular fa-eye"></i></button>
                                    <button class="update-btn">Update&nbsp;&nbsp; <i class="fa-regular fa-pen-to-square"></i></button>
                                    <button class="delete-btn" data-province-id="{{ $province->id }}">Delete&nbsp;&nbsp;<i class="fa fa-trash"></i></button>
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
            let provinceId = this.getAttribute('data-province-id');
            window.location.href = `/provinces/${provinceId}/employees`;
        });
    });

    // Function to filter provinces based on input
    function filterProvinces() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('provincesTable');
        const rows = table.getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            const provinceCell = rows[i].getElementsByTagName('td')[0];
            if (provinceCell) {
                const provinceName = provinceCell.textContent || provinceCell.innerText;
                rows[i].style.display = provinceName.toLowerCase().indexOf(filter) > -1 ? '' : 'none';
            }
        }
    }

    // delete func 
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const provinceId = this.getAttribute('data-province-id');

            if (confirm('Are you sure you want to delete this province?')) {
                fetch(`/provinces/${provinceId}`, {
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
                                alert('Failed to delete province: ' + data.message);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Failed to delete province.');
                    });
            }
        });
    });

</script>
