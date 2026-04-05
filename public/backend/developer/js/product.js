////load the data......................................................
var img = "{{url('/public/front/images/loading.gif')}}";
dataTableD = $('#datatable-fixed-header').DataTable({
    responsive: true,
    serverSide: true,
    "oLanguage": {
        "sProcessing": "<img class='loader' src=" + img + ">"
    },
    dom: '<"html5buttons"B>lTfgitp',
    buttons: [
        { extend: 'copy' },
        { extend: 'csv' },
        { extend: 'pdf', title: 'ExampleFile' },
        {
            extend: 'print',
            customize: function(win) {
                $(win.document.body).addClass('white-bg');
                $(win.document.body).css('font-size', '10px');

                $(win.document.body).find('table')
                    .addClass('compact')
                    .css('font-size', 'inherit');
            }
        }
    ],
    "processing": true,
    "serverSide": true,
    pageLength: 10,
    "ajax": {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: BASE_URL + '/administrator/product/getproductData',
        type: "post",
        error: function() {
            $(".user-table-error").html("");
            $("#datatable-fixed-header").append('<tbody class="user-table-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
        },  data:function(data) {
            // console.log("here");
            data.from = $('#from_date').val();
            data.to = $('#to_date').val();
            //data.type = $('#type').val();
            
        },
    },
    "columnDefs": [{ orderable: true, targets: [0, 2] }],
    "order": [
        [2, 'desc']
    ]
});
