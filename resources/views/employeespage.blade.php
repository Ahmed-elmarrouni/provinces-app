<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Employees in Province') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <button class="add-btn" style="vertical-align:middle"><span>Add New Employee </span></button>

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
<script src="{{ asset('js/employees.js') }}"></script>
