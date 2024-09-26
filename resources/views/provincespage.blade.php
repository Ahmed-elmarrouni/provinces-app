<x-app-layout>
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.6.0-web/css/all.min.css') }}">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Provinces') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <button class="add-btn" style="vertical-align:middle"><span>Add New Province </span></button>

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
    <link rel="stylesheet" href="{{ asset('assets/style/table.css') }}">
    <script src="{{ asset('js/provinces.js') }}"></script>
</x-app-layout>
