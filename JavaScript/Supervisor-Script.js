// STUDENTS - TABLE GET ROW
for (i = 1; i < document.getElementById('Supervisor-Table-View').rows.length; i++) {
    document.getElementById('Supervisor-Table-View').rows[i].addEventListener("click", function() {
        document.getElementById("get_id").value = this.cells[0].innerHTML;
        document.getElementById("supervisor_name").value = this.cells[1].innerHTML;
        document.getElementById("department").value = this.cells[2].innerHTML;
        confirm("Now Update Data.");
    });
}
// STUDENTS - TABLE GET ROW