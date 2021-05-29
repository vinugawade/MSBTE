// STUDENTS - TABLE GET ROW
for (i = 1; i < document.getElementById('Student-Table-View').rows.length; i++) {
    document.getElementById('Student-Table-View').rows[i].addEventListener("click", function() {
        document.getElementById("get_id").value = this.cells[0].innerHTML;
        document.getElementById("student_name").value = this.cells[1].innerHTML;
        document.getElementById("seat_no").value = this.cells[2].innerHTML;
        document.getElementById("enrolment_no").value = this.cells[3].innerHTML;
        document.getElementById("department").value = this.cells[4].innerHTML;
        document.getElementById("year_sem").value = this.cells[5].innerHTML;
        // confirm("Now Update Data.");
    });
}
// STUDENTS - TABLE GET ROW
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#Student-Table-View thead tr').clone(true).appendTo('#Student-Table-View thead');
    $('#Student-Table-View thead tr:eq(1) th').each(function(i) {
        $(this).html('<input type="text" placeholder="Find" style="width:80%;" />');

        $('input', this).on('keyup change', function() {
            if (table.column(i).search() !== this.value) {
                table.column(i).search(this.value).draw();
            }
        });
    });

    var table = $('#Student-Table-View').DataTable({
        paging: false,
        pageLength: false
    });
});