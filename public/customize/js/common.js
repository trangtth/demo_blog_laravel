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


    // Initialize form validation on the blog form.
    $("#blog-form").validate({
        rules: {
            title: {
                required: true,
                maxlength: 100
            },
            content: "required",
            image: {
                extension: "jpeg|png|gif"
            }
        },
        messages: {
            title: {
                required: "Please enter title",
                maxlength: "Your title is only a maximum of 100 characters"
            },
            content: "Please enter content",
            image: {
                extension: "You just upload the file extension with jpeg, png, gif"
            }
        },
        submitHandler: function(form) {
            form.submit();
            //$.ajax({
            //    type: 'POST',
            //    headers: {'X-CSRF-TOKEN': $('#blog-form input[name=_token]').val()},
            //    url: $("#blog-form").attr('action'),
            //    data: new FormData($("#blog-form")),
            //    async: false,
            //    success: function(msg) {
            //        alert(msg);
            //    },
            //    error: function(data) {
            //        var errors = data.responseJSON;
            //        console.log(errors);
            //    }
            //});
        }
    });

    $("#form-delete-blog #delete-blog").click(function () {
        $.ajax({
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('#form-delete-blog input[name=_token]').val()},
            url: $("#form-delete-blog").attr('action'),
            data: $("#form-delete-blog").serialize(),
            success: function(data) {
                //if (data.status == 200) {
                    //location.reload();
                //}
            },
            error: function(data) {

            }
        });
    });
});

function ConfirmDelete() {
    return confirm('Are you sure ?');
}