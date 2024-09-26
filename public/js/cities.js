document.querySelectorAll('.show-btn').forEach(button => {
    button.addEventListener('click', function () {
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
    button.addEventListener('click', function () {
        const cityId = this.getAttribute('data-city-id');

        if (confirm('Are you sure you want to delete this city?')) {
            fetch(`/cities/${cityId}`, {
                method: 'DELETE'
                , headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    , 'Content-Type': 'application/json'
                    ,
                }
                ,
            })
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

