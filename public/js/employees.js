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
    button.addEventListener('click', function () {
        const employeeId = this.getAttribute('data-employee-id');

        if (confirm('Are you sure you want to delete this employee?')) {
            fetch(`/employees/${employeeId}`, {
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
