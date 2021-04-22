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


$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#Supervisor-Table-View  thead tr').clone(true).appendTo('#Supervisor-Table-View  thead');
    $('#Supervisor-Table-View  thead tr:eq(1) th').each(function(i) {
        $(this).html('<input type="text" placeholder="Find" style="width:80%;" />');

        $('input', this).on('keyup change', function() {
            if (table.column(i).search() !== this.value) {
                table.column(i).search(this.value).draw();
            }
        });
    });

    var table = $('#Supervisor-Table-View').DataTable({
        paging: false,
        pageLength: false
    });
});