////load the data......................................................
// alert('ppppp');
var img = "{{url('/public/front/images/loading.gif')}}";
dataTable190 = $('#deposit_pending').DataTable({
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
            customize: function (win) {
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
    pageLength: 100000,
    "ajax": {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: BASE_URL + '/administrator/get-deposit-data-pending-old',
        type: "post",
        error: function () {
            $(".user-table-error").html("");
            $("#deposit_pending").append('<tbody class="user-table-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
        },
        data: function (data) {
            data.market_date = $('#market_date').val();
        },
    },
    "columnDefs": [{ orderable: true, targets: [0, 2] }],
    "order": [
        [2, 'desc']
    ]
});
$('.dataTables_filter input').attr("placeholder", "Search with username");
function get_data11() {
    dataTable190.draw();
}

////load the data......................................................
var img = "{{url('/public/front/images/loading.gif')}}";
// alert('hello');
dataTable19 = $('#deposit_success').DataTable({

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
            customize: function (win) {
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
        url: BASE_URL + '/administrator/get-deposit-data-success-old',
        type: "post",
        error: function () {
            $(".user-table-error").html("");
            $("#deposit_success").append('<tbody class="user-table-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
        },
        data: function (data) {
            data.market_date = $('#market_date').val();
        },

    },
    "columnDefs": [{ orderable: true, targets: [0, 2] }],
    "order": [
        [2, 'desc']
    ]
});
function get_data111() {
    dataTable19.draw();
}
var img = "{{url('/public/front/images/loading.gif')}}";
// alert('hello');
dataTable180 = $('#date_withdraw_pending').DataTable({

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
            customize: function (win) {
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
    pageLength: 100000,
    "ajax": {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: BASE_URL + '/administrator/get-datedeposit-data-old',
        type: "post",
        error: function () {
            $(".user-table-error").html("");
            $("#deposit_success").append('<tbody class="user-table-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
        },
        data: function (data) {
            data.deposit_date = $('#deposit_date').val();
            // data.select_market = $('#select_market').val();
        },
    },
    "columnDefs": [{ orderable: true, targets: [0, 2] }],
    "order": [
        [2, 'desc']
    ]
});
$('.dataTables_filter input').attr("placeholder", "Search with username");
function get_data12() {
    dataTable180.draw();
}


// $('.dataTables_filter input').attr("class", "clearable");

////load the data......................................................
var img = "{{url('/public/front/images/loading.gif')}}";
dataTable18 = $('#deposit_cancelled').DataTable({
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
            customize: function (win) {
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
    pageLength: 100000,
    "ajax": {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: BASE_URL + '/administrator/get-deposit-data-cancelled-old',
        type: "post",
        error: function () {
            $(".user-table-error").html("");
            $("#deposit_cancelled").append('<tbody class="user-table-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
        },
        data: function (data) {
            data.market_date = $('#market_date').val();
        },
    },
    "columnDefs": [{ orderable: true, targets: [0, 2] }],
    "order": [
        [2, 'desc']
    ]
});
$('.dataTables_filter input').attr("placeholder", "Search with username");
function get_data() {
    dataTable18.draw();
}
// $('.dataTables_filter input').attr("class", "clearable");

////load the data......................................................
var img = "{{url('/public/front/images/loading.gif')}}";
dataTable = $('#result_history').DataTable({
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
            customize: function (win) {
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
        url: BASE_URL + '/administrator/get-gd-result-history-Data-old',
        type: "post",
        error: function () {
            $(".user-table-error").html("");
            $("#result_history").append('<tbody class="user-table-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
        }
    },
    "columnDefs": [{ orderable: true, targets: [0, 5] }],
    "order": [
        [5, 'desc']
    ]
});
$('.dataTables_filter input').attr("placeholder", "Search with username");
// $('.dataTables_filter input').attr("class", "clearable");

////load the data......................................................
var img = "{{url('/public/front/images/loading.gif')}}";
dataTable = $('#gd_winning_report').DataTable({
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
            customize: function (win) {
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
        url: BASE_URL + '/administrator/get-gd-winning-report-Data',
        type: "post",
        error: function () {
            $(".user-table-error").html("");
            $("#gd_winning_report").append('<tbody class="user-table-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
        }
    },
    "columnDefs": [{ orderable: true, targets: [0, 2] }],
    "order": [
        [2, 'desc']
    ]
});
$('.dataTables_filter input').attr("placeholder", "Search with username");
// $('.dataTables_filter input').attr("class", "clearable");

////load the data......................................................
var img = "{{url('/public/front/images/loading.gif')}}";
dataTable = $('#gd_winningReport').DataTable({
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
            customize: function (win) {
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
        url: BASE_URL + '/administrator/get-gd-winning-prediction-Data',
        type: "post",
        error: function () {
            $(".user-table-error").html("");
            $("#gd_winningReport").append('<tbody class="user-table-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
        }
    },
    "columnDefs": [{ orderable: true, targets: [0, 5] }],
    "order": [
        [5, 'desc']
    ]
});
$('.dataTables_filter input').attr("placeholder", "Search with username");
// $('.dataTables_filter input').attr("class", "clearable");




////load the data......................................................
var img = "{{url('/public/front/images/loading.gif')}}";
// alert('hello');
dataTable19 = $('#deposit_old').DataTable({

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
            customize: function (win) {
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
    pageLength: 100000,
    "ajax": {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: BASE_URL + '/administrator/get-deposit-data-old',
        type: "post",
        error: function () {
            $(".user-table-error").html("");
            $("#deposit_old").append('<tbody class="user-table-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
        },
        data: function (data) {
            data.market_date = $('#market_date').val();
        },

    },
    "columnDefs": [{ orderable: true, targets: [0, 2] }],
    "order": [
        [2, 'desc']
    ]
});