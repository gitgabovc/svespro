/* ------------------------------------------------------------------------------
*
*  # Key Table extension for Datatables
*
*  Demo JS code for datatable_extension_key_table.html page
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
    $('.datatable-key-basic').DataTable({
        keys: true
    });


    // Scrollable table
    $('.datatable-key-scroll').DataTable({
        dom: '<"datatable-header info-right"fi><"datatable-scroll-wrap"t>',
        scrollY: 300,
        paging: false,
        keys: true
    });
 

    // Custom class
    $('.datatable-key-class').DataTable({
        keys: {
            className: 'focus focus-success'
        }
    });


    // Table with events
    var table = $('.datatable-key-events').DataTable({
        keys: true
    });
 
    // Events
    var events = $('#key-events');
    table
        .on('key', function (e, datatable, key, cell, originalEvent) {
            events.append(JSON.stringify('Key press: '+key+' for cell '+cell.data()), '\n');
        })
        .on('key-focus', function (e, datatable, cell) {
            events.append(JSON.stringify('Cell focus: '+cell.data()), '\n');
        })
        .on('key-blur', function (e, datatable, cell) {
            events.append(JSON.stringify('Cell blur: '+cell.data()), '\n');
        });



    // External table additions
    // ------------------------------

    // Enable Select2 select for the length option
    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        width: 'auto'
    });
    
});
