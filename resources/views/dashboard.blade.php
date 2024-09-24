<x-app-layout>
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.6.0-web/css/all.min.css') }}">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                {{-- <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
            </div> --}}

            <div class="table-container ">
                <div class="search-bar">
                    <input type="text" placeholder="Search region or city ...">
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Regions </th>
                            <th>N° of cities</th>
                            <th>N° of provinces</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tanger-Tétouan-Al Hoceïma </td>
                            <td>10</td>
                            <td>62</td>
                            <td>
                                <button class="show-btn">Show&nbsp;&nbsp; <i class="fa-regular fa-eye"></i></button>
                                <button class="update-btn">Update&nbsp;&nbsp; <i class="fa-regular fa-pen-to-square"></i></button>
                                <button class="delete-btn">Delete&nbsp;&nbsp; <i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    </div>
</x-app-layout>


<style>
    .table-container {
        width: 100%;
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
    }

    .search-bar {
        margin-bottom: 20px;
    }

    .search-bar input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table th,
    table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    table th {
        background-color: #f8f8f8;
        font-weight: bold;
    }

    table tr:hover {
        background-color: #f1f1f1;
    }

    button {
        padding: 8px 12px;
        margin-right: 5px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .show-btn {
        background-color: #4CAF50;
        color: white;
    }

    .update-btn {
        background-color: #2196F3;
        color: white;
    }

    .delete-btn {
        background-color: #f44336;
        color: white;
    }

    button:hover {
        opacity: 0.8;
    }

</style>
