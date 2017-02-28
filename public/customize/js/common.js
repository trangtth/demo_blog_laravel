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

    //Delete item in datatable
    $(document).on('click', '#form-delete #delete-btn', function () {
        var confirmDel = confirm('Are you sure ?');

        if (confirmDel) {
            $.ajax({
                type: 'DELETE',
                headers: {'X-CSRF-TOKEN': $(this).parent().find('input[name=_token]').val()},
                url: $(this).parent().attr('action'),
                success: function (data) {
                    if (data.status == 200) {
                        $('.dataTable').DataTable().draw();
                    }
                },
                error: function (data) {

                }
            });
        }
    });

    var page_number = 1;
    $(window).scroll(function() {
        if ($('.list-blog').length) {
            if ($(window).scrollTop() + $(window).height() == $(document).height()) {
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

    //Register user
    $(document).on('click', '#btn-register', function () {
        $.ajax({
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('#form-register input[name=_token]').val()},
            url: $('#form-register').attr('action'),
            data: $('#form-register').serializeArray(),
            success: function (data) {
                $('#form-errors').html('');
                if (data.status == 200) {
                        window.location = data.responseText.url;
                }
            },
            error: function (data) {
                var errorsHtml = '<div class="alert alert-danger"><ul>';

                $.each(data.responseJSON, function(key, value) {
                    errorsHtml += '<li>' + value + '</li>';
                });
                errorsHtml += '</ul></di>';

                $('#form-errors').html(errorsHtml);
            }
        });
    });

    //Delete blogs checked
    $(document).on('click', '#btn-delete-blogs-checked', function () {
        $.ajax({
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('#btn-delete-blogs-checked').attr('data-csrf')},
            url: $('#btn-delete-blogs-checked').attr('href'),
            data: {
                list_item: $('#datatableBlogs tbody tr td input.group-checkable:checked').serialize()
            },
            success: function (data) {

            },
            error: function (data) {

            }
        });
    });
});