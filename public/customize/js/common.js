$(document).ready(function() {
    var datatableProj = $('#datatableProj').DataTable({

    });

    $('#datatableProj tfoot th.filter').each( function (i) {
        var title = $('#datatableProj tfoot th.filter').eq( $(this).index() ).text();
        $(this).append( '<p></p><input type="text" placeholder="Search '+title+'" data-index="'+i+'" />' );
    } );

    $( datatableProj.table().container() ).on( 'keyup', 'tfoot input', function () {
        datatableProj
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

    $("#form-delete #delete-btn").click(function () {
        var confirmDel = confirm('Are you sure ?');

        if (confirmDel) {
            var del_id = $(this).attr('data-id');
            $.ajax({
                type: 'DELETE',
                headers: {'X-CSRF-TOKEN': $(this).parent().find('input[name=_token]').val()},
                url: $(this).parent().attr('action'),
                success: function (data) {
                    if (data.status == 200) {
                        $('.item_' + del_id).remove();
                    }
                },
                error: function (data) {

                }
            });
        }
    });

    $("#form-delete #delete-btn").click(function () {
        var confirmDel = confirm('Are you sure ?');

        if (confirmDel) {
            var del_id = $(this).attr('data-id');
            $.ajax({
                type: 'DELETE',
                headers: {'X-CSRF-TOKEN': $(this).parent().find('input[name=_token]').val()},
                url: $(this).parent().attr('action'),
                success: function (data) {
                    if (data.status == 200) {
                        $('.item_' + del_id).remove();
                    }
                },
                error: function (data) {

                }
            });
        }
    });

    var page_number = 1;

    $("#view-more-btn").click(function () {
        $.ajax({
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $(this).parent().find('input[name=_token]').val()},
            url: $(this).parent().attr('action'),
            data: {
                page_number: page_number
            },
            success: function (data) {

                if (data.response && data.response.length) {
                    var html = '';
                    for (var i = 0; i < data.response.length; i++) {
                        html += '<div class="col-md-6 col-md-offset-3">'
                            + '<div><h3>' + data.response[i]['title'] + '</h3></div>'
                            + '<h5>' + data.response[i]['content'] + '</h5>'
                            + '<div><img src="' + data.response[i]['image'] + '" width="70%"/></div>'
                            + '<h5 class="text-danger"><strong>Author:</strong>' + data.response[i]['author'] + '</h5>'
                            + '</div>';
                    }

                    $(".list-blog").append(html);
                }

                if (data.status == 400) {
                    $("#view-more-btn").hide();
                }
            },
            error: function (data) {

            }
        });
        page_number++;
    });
});