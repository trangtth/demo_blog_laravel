$(document).ready(function() {
    //Datatable filter
    var datatableProj = $('.datatableProj').DataTable({
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        "pageLength": 5,
        "order": [[ 4, "desc" ]]
    });

    $('.datatableProj tfoot th.filter').each( function (i) {
        var title = $('.datatableProj tfoot th.filter').eq( $(this).index() ).text();
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

    //Delete item in datatable
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
    $(window).scroll(function(){
        if($(window).scrollTop() + $(window).height() == $(document).height()) {
            $('.list-blog').append($(".loading-ajax-data").html());
            $(".list-blog .loading-ajax-data").show();
            $(".list-blog .loading-ajax-data img").show();
            $.ajax({
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $("#view-more-btn").parent().find('input[name=_token]').val()},
                url: $("#view-more-btn").parent().attr('action'),
                data: {
                    page_number: page_number
                },
                success: function (data) {

                    $(".list-blog").append(data.html);

                    if (data.status == 400) {
                        $("#view-more-btn").hide();
                        $('.list-blog').find(".loading-ajax-data").remove();
                    }
                },
                error: function (data) {

                }
            });
            page_number++;
        }
    });

    //Like blog
    $(document).on('click', '.btn-like-item', function () {
        var blog_id = $(this).attr('data-id');
        $.ajax({
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $(this).parent().find('input[name=_token]').val()},
            url: $(this).parent().attr('action'),
            data: {
                blog_id: blog_id
            },
            success: function (data) {

                if (data.status == 200) {
                    $('.form_like_' + blog_id).hide();
                    $('.form_unlike_' + blog_id).show();
                }
            },
            error: function (data) {

            }
        });
    });

    //UnLike blog
    $(document).on('click', '.btn-unlike-item', function () {
        var blog_id = $(this).attr('data-id');
        $.ajax({
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $(this).parent().find('input[name=_token]').val()},
            url: $(this).parent().attr('action'),
            data: {
                blog_id: blog_id
            },
            success: function (data) {
                if (data.status == 200) {
                    $('.form_like_' + blog_id).show();
                    $('.form_unlike_' + blog_id).hide();
                }
            },
            error: function (data) {

            }
        });
    });
});