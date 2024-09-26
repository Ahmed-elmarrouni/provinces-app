document.querySelectorAll('.show-btn').forEach(button => {
    button.addEventListener('click', function () {
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
    button.addEventListener('click', function () {
        const provinceId = this.getAttribute('data-province-id');

        if (confirm('Are you sure you want to delete this province?')) {
            fetch(`/provinces/${provinceId}`, {
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
