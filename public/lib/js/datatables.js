/**
 * Created by anhlee.net on 4/25/2016.
 */
$(document).ready(function () {
    if ($('#dataTableBuilder')[0]) {
        var table = window.LaravelDataTables["dataTableBuilder"];
    }
    // Handle click on "Select all" control
    $(document).on('click', '#table-select-all', function(e){
        // Check/uncheck all checkboxes in the table
        var rows = table.rows({ 'search': 'applied' }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
    });

    // Handle click on checkbox to set state of "Select all" control
    $('#dataTableBuilder tbody').on('change', 'input[type="checkbox"]', function(){
        // If checkbox is not checked
        if(!this.checked){
            var el = $('#table-select-all').get(0);
            // If "Select all" control is checked and has 'indeterminate' property
            if(el && el.checked && ('indeterminate' in el)){
                // Set visual state of "Select all" control
                // as 'indeterminate'
                el.indeterminate = true;
            }
        }
    });

    var flagDelete = true;
    $(document).on('click', '.delete-all', function(e){
        if (flagDelete) {
            flagDelete = false;
            var ids = [];
            // Iterate over all checkboxes in the table
            table.$('input[type="checkbox"]').each(function(){
                // If checkbox doesn't exist in DOM
                // If checkbox is checked
                if(this.checked){
                    ids.push(this.value);
                }
            });

            $.ajax(e, $(this), {
                type: 'POST',
                url: $('input[name="delete-all-ajax"]').val(),
                data: {
                    _method: 'POST',
                    'ids[]': ids
                },
                onAjaxSuccess: function(response) {
                    flagDelete = true;
                },
            });
        }
    });
});