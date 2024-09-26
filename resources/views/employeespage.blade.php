<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Employees in Province') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="table-container">
                    <div class="search-bar">
                        <input type="text" id="searchEmployeeInput" placeholder="Search by name or ID number..." onkeyup="filterEmployees()">
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>Employee Name</th>
                                <th>ID Number</th>
                                <th>Phone Number</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="employeesTable">
                            @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                <td>{{ $employee->id_number }}</td>
                                <td>{{ $employee->phone_number }}</td>
                                <td>
                                    <button class="update-btn">Update</button>
                                    <button class="delete-btn" data-employee-id="{{ $employee->id }}">Delete</button>
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
    // Function to filter employees by name or ID number
    function filterEmployees() {
        const input = document.getElementById('searchEmployeeInput');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('employeesTable');
        const rows = table.getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            const nameCell = rows[i].getElementsByTagName('td')[0];
            const idCell = rows[i].getElementsByTagName('td')[1];
            if (nameCell || idCell) {
                const name = nameCell.textContent.toLowerCase() || nameCell.innerText.toLowerCase();
                const idNumber = idCell.textContent.toLowerCase() || idCell.innerText.toLowerCase();

                if (name.indexOf(filter) > -1 || idNumber.indexOf(filter) > -1) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        }
    }


    // delete fun
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const employeeId = this.getAttribute('data-employee-id');

            if (confirm('Are you sure you want to delete this employee?')) {
                fetch(`/employees/${employeeId}`, {
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
                                alert('Failed to delete employee: ' + data.message);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Failed to delete employee.');
                    });
            }
        });
    });

</script>
