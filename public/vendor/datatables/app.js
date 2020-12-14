// Call the dataTables jQuery plugin
$(document).ready(function () {

    $('.dataTable').DataTable({
        
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Portuguese-Brasil.json"
        },
        responsive:true,
        'aoColumnDefs':[{
                'bSortable': false,
                'aTargets':['no-sort']
        }]
        
    });
});


