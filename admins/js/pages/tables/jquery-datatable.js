$(function () {
    $('.js-basic-example').DataTable({
        responsive: true
    });

    //
    $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});