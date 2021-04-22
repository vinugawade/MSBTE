$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#Notice-Table-View thead tr').clone(true).appendTo('#Notice-Table-View thead');
    $('#Notice-Table-View thead tr:eq(1) th').each(function(i) {
        $(this).html('<input type="text" placeholder="Find" style="width:80%;" />');

        $('input', this).on('keyup change', function() {
            if (table.column(i).search() !== this.value) {
                table.column(i).search(this.value).draw();
            }
        });
    });

    var table = $('#Notice-Table-View').DataTable({
        paging: false,
        pageLength: false
    });
});