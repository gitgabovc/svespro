/* ------------------------------------------------------------------------------
*
*  # Buttons extension for Datatables. Flash examples
*
*  Demo JS code for datatable_extension_buttons_flash.html page
*
* ---------------------------------------------------------------------------- */

document.addEventListener('DOMContentLoaded', function() {


    // Table setup
    // ------------------------------

    // Setting datatable defaults
    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filtrar:</span> _INPUT_',
            searchPlaceholder: 'Type to filter...',
            lengthMenu: '<span>Mostrar:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
        }
    });


    // Basic initialization
    $('.datatable-button-flash-basic').DataTable({
        buttons: {
            dom: {
                button: {
                    className: 'btn btn-default'
                }
            },
            buttons: [
                {extend: 'copyFlash'},
                {extend: 'csvFlash'},
                {extend: 'excelFlash'},
                {extend: 'pdf'}
            ]
        }
    });


    // Custom file name
    $('.datatable-button-flash-name').DataTable({
        buttons: {
            dom: {
                button: {
                    className: 'btn btn-default'
                }
            },
            buttons: [
                {
                    extend: 'excelFlash',
                    title: 'Data export in Excel'
                },
                {
                    extend: 'pdfFlash',
                    title: 'Data export in PDF'
                }
            ]
        }
    });


    // Custom message
    $('.datatable-button-flash-message').DataTable({
        buttons: [
            {
                extend: 'pdfFlash',
                text: 'Export to PDF',
                className: 'btn bg-blue',
                message: 'This is a custom text added in table configuration.'
            }
        ]
    });


    // File size and orientation
    $('.datatable-button-flash-size').DataTable({
        buttons: [
            {
                extend: 'pdfFlash',
                text: 'Export to PDF',
                className: 'btn bg-blue',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            }
        ]
    });



    // External table additions
    // ------------------------------

    // Enable Select2 select for the length option
    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        width: 'auto'
    });
    
});
