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

<script src="{{ asset('js/cities.js') }}"></script>

