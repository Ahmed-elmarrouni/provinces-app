document.querySelectorAll('.show-btn').forEach(button => {
    button.addEventListener('click', function () {
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
    button.addEventListener('click', function () {
        const regionId = this.getAttribute('data-region-id');

        if (confirm('Are you sure you want to delete this region?')) {
            fetch(`/regions/${regionId}`, {
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

