<script>
    KTMenu.createInstances();
    $(document).ready(function() {
        KTMenu.createInstances();
        setTimeout(function() {
            if ($('#ns').length > 0) {
                $('#ns').remove();
            }
        }, 5000);

        if (typeof oTable !== 'undefined') {
            //start: datatables common js file for changing sort-icons
            oTable.columns().iterator('column', function(ctx, idx) {
                var sorting_class = $(oTable.column(idx).header()).hasClass('sorting_disabled');
                if (!sorting_class) {
                    $(oTable.column(idx).header()).append('<span class="sort-icon"/>');
                }
            });
            //end: datatables common js file for changing sort-icons

            //start: Re-init functions on every table re-draw
            oTable.on('draw', function() {
                // initToggleToolbar();
                // toggleToolbars();
                // handleDeleteRows();
                KTMenu.createInstances();
            });
            //end: Re-init functions on every table re-draw

            $('#kt_table_1 tbody').on('click', 'tr td', function(e) {
                if ($(e.target).closest('span').length == 0) {
                    KTMenu.createInstances();
                    //so clicked on pseudo :before element!
                    //do your work here ;)
                    // console.log('Pseudo :before element is clicked! Skipping click event');
                    return;
                }

                // The Responsive event handler still executes,
                // make sure to immediately click a second time to reopen or reclose the child.
                // Causes this click event handler to run again but
                // is stopped by the above if statement because the td is clicked
                // not the <span>
                $(this).click();

                // Execute event handler code.
                KTMenu.createInstances();
                // console.log('Processing click event');


            });
        }
    });
</script>
@include('admin.layouts.components.custom_js.ckeditor')
