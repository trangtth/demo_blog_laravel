$(document).ready(function() {
    var tableBlogs = $('#table_blogs').DataTable({

    });

    $('#table_blogs tfoot th.filter').each( function (i) {
        var title = $('#table_blogs tfoot th.filter').eq( $(this).index() ).text();
        $(this).append( '<p></p><input type="text" placeholder="Search '+title+'" data-index="'+i+'" />' );
    } );

    $( tableBlogs.table().container() ).on( 'keyup', 'tfoot input', function () {
        tableBlogs
            .column( $(this).data('index') )
            .search( this.value )
            .draw();
    });

});

function ConfirmDelete() {
    return confirm('Are you sure ?');
}