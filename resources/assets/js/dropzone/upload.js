/**
 * Created by anhlee.net on 3/17/2016.
 */
$(document).ready(function () {

    Dropzone.options.avatarDropzone = {
        url: $('#avatar-dropzone').data('link'),
        paramName: "avatar",
        previewsContainer: 'div#fileDropzone',
        maxFilesize: ($('#upload_max_filesize').val() / 1048576),

        init: function () {
            this.on("success", function (data) {
                // json_decode
                var res = eval('(' + data.xhr.responseText + ')');
                // Add to input hidden
                $('#picture').val(res.sortLink);
                $('#shortDirectory').val(res.shortDirectory);
                $('#filename').val(res.fileUpload);
                // Add images and show modal
                $('#images-crop').attr('src', res.fullLink);
                $('.modal-crop').modal('show');
                // Cropper
                $('.modal-crop').on('shown.bs.modal', function(e) {
                    $('#images-crop').cropper({
                        multiple: true,
                        aspectRatio: 1 / 1,
                        preview: ".image-preview",
                        movable: false,
                        zoomable: false,
                        rotatable: false,
                        scalable: false,
                        // Crop
                        crop: function(data) {
                            // Output the result data for cropping image.
                            $('#x').val(data.x);
                            $('#y').val(data.y);
                            $('#w').val(data.width);
                            $('#h').val(data.height);
                        }
                    });
                });
                // Close modal
                $('.modal-crop').on('hidden.bs.modal', function(e) {
                    $('.modal-body-crop').html('<img src="" class="images-crop" id="images-crop" style="max-width: 100%;"/>');
                });
            });
        }
    };

    Dropzone.options.postDropzone = {
        url: $('#post-dropzone').data('link'),
        paramName: "thumbnail",
        previewsContainer: 'div#fileDropzone',
        maxFilesize: ($('#upload_max_filesize').val() / 1048576),

        init: function () {
            this.on("success", function (data) {
                // json_decode
                var res = eval('(' + data.xhr.responseText + ')');
                // Add to input hidden
                $('#post-thumbnail').val(res.sortLink);
                $('#shortDirectory').val(res.shortDirectory);
                $('#filename').val(res.fileUpload);
                // Add images and show modal
                $('.thumbnail img').attr('src', res.fullLink);
            });
        }
    };

});
