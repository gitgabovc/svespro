/* ------------------------------------------------------------------------------
*
*  # Select extension for Datatables
*
*  Demo JS code for datatable_extension_select.html page
*
* ---------------------------------------------------------------------------- */

document.addEventListener('DOMContentLoaded', function() {


    // Table setup
    // ------------------------------

    // Setting datatable defaults
    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{
            orderable: false,
            width: '100px',
            targets: [ 5 ]
        }],
        dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filtrar:</span> _INPUT_',
            searchPlaceholder: 'Type to filter...',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });


    // Basic initialization
    $('.datatable-select-basic').DataTable({
        select: true
    });


    // Single item selection
    $('.datatable-select-single').DataTable({
        select: {
            style: 'single'
        }
    });


    // Multiple items selection
    $('.datatable-select-multiple').DataTable({
        select: {
            style: 'multi'
        }
    });


    // Checkbox selection
    $('.datatable-select-checkbox').DataTable({
        columnDefs: [
            {
                orderable: false,
                className: 'select-checkbox',
                targets: 0
            },
            {
                orderable: false,
                width: '100px',
                targets: 6
            }
        ],
        select: {
            style: 'os',
            selector: 'td:first-child'
        },
        order: [[1, 'asc']]
    });


    // Buttons
    $('.datatable-select-buttons').DataTable({
        dom: '<"dt-buttons-full"B><"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
        buttons: [
            {extend: 'selected', className: 'btn btn-default'},
            {extend: 'selectedSingle', className: 'btn btn-default'},
            {extend: 'selectAll', className: 'btn bg-blue'},
            {extend: 'selectNone', className: 'btn bg-blue'},
            {extend: 'selectRows', className: 'btn bg-teal-400'},
            {extend: 'selectColumns', className: 'btn bg-teal-400'},
            {extend: 'selectCells', className: 'btn bg-teal-400'}
        ],
        select: true
    });



    // External table additions
    // ------------------------------

    // Enable Select2 select for the length option
    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        width: 'auto'
    });
    
});
