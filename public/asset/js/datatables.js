// Call the dataTables jQuery plugin
$(document).ready(function () {
    var table1 = $('#tabunganTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
        ]
    });
    var table2 = $('#penarikanTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
        ]
    });
    var table3 = $('#memberTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
        ]
    });

    $('#konfirmTabunganTable').DataTable({
    });

    $('#konfirmPenarikanTable').DataTable({
    });
});