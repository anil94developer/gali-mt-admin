////load the data......................................................
// alert('ppppp');
var img = "{{url('/public/front/images/loading.gif')}}";
dataTable1 = $('#withdraw_pending').DataTable({
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
        url: BASE_URL + '/administrator/get-withdrow-data',
        type: "post",
        error: function () {
            $(".user-table-error").html("");
            $("#withdraw_pending").append('<tbody class="user-table-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
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
function get_data1() {
    dataTable1.draw();
}

dataTable190 = $('#date_withdraw_pending').DataTable({
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
        url: BASE_URL + '/administrator/get-datewithdrow-data',
        type: "post",
        error: function () {
            $(".user-table-error").html("");
            $("#date_withdraw_pending").append('<tbody class="user-table-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
        },
        data: function (data) {
            data.withdraw_date = $('#withdraw_date').val();
            // data.select_market = $('#select_market').val();
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

// $('.dataTables_filter input').attr("class", "clearable");

////load the data......................................................
// var img = "{{url('/public/front/images/loading.gif')}}";
// dataTable = $('#gd_bid_history').DataTable({
//     responsive: true,
//     serverSide: true,
//     "oLanguage": {
//         "sProcessing": "<img class='loader' src=" + img + ">"
//     },
//     dom: '<"html5buttons"B>lTfgitp',
//     buttons: [
//         { extend: 'copy' },
//         { extend: 'csv' },
//         { extend: 'pdf', title: 'ExampleFile' },
//         {
//             extend: 'print',
//             customize: function(win) {
//                 $(win.document.body).addClass('white-bg');
//                 $(win.document.body).css('font-size', '10px');

//                 $(win.document.body).find('table')
//                     .addClass('compact')
//                     .css('font-size', 'inherit');
//             }
//         }
//     ],
//     "processing": true,
//     "serverSide": true,
//     pageLength: 10,
//     "ajax": {
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         url: BASE_URL + '/administrator/get-gd-bid-history-Data',
//         type: "post",
//         error: function() {
//             $(".user-table-error").html("");
//             $("#gd_bid_history").append('<tbody class="user-table-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
//         }
//     },
//     "columnDefs": [{ orderable: true, targets: [0, 2] }],
//     "order": [
//         [2, 'desc']
//     ]
// });
// $('.dataTables_filter input').attr("placeholder", "Search with username");
// $('.dataTables_filter input').attr("class", "clearable");

////load the data......................................................
var img = "{{url('/public/front/images/loading.gif')}}";
dataTable2 = $('#withdraw_success').DataTable({
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
        url: BASE_URL + '/administrator/get-withdrow-data-success',
        type: "post",
        error: function () {
            $(".user-table-error").html("");
            $("#withdraw_success").append('<tbody class="user-table-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
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
function get_data2() {
    dataTable2.draw();
}
// $('.dataTables_filter input').attr("class", "clearable");

////load the data......................................................
var img = "{{url('/public/front/images/loading.gif')}}";
dataTable3 = $('#withdrow_cancelled').DataTable({
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
        url: BASE_URL + '/administrator/get-withdrow-data-cancelled',
        type: "post",
        error: function () {
            $(".user-table-error").html("");
            $("#withdrow_cancelled").append('<tbody class="user-table-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
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
function get_data3() {
    dataTable3.draw();
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
        url: BASE_URL + '/administrator/get-gd-result-history-Data',
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



function showWithdrawStatusMessage(message) {
    if (!message || !window.sessionStorage) {
        return;
    }

    sessionStorage.setItem('withdrawStatusMessage', message);
}

$(document).ready(function () {
    if (!window.sessionStorage) {
        return;
    }

    var message = sessionStorage.getItem('withdrawStatusMessage');
    if (message) {
        alert(message);
        sessionStorage.removeItem('withdrawStatusMessage');
    }
});

function approvedwidth(payload) {
    var result = confirm('Are you sure ?');

    if (result) {
        $('#ajaxLoader').show();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: BASE_URL + '/administrator/withdraw-approve',
            type: 'POST',
            data: $.extend({ result: result }, payload || {}),

            success: function (data) {
                $('#ajaxLoader').hide();
                showWithdrawStatusMessage(data && data.message ? data.message : 'Withdrawal status updated successfully.');
                location.reload();
            },
            error: function (xhr) {
                $('#ajaxLoader').hide();
                var message = 'Approve failed. Please try again.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                }
                alert(message);
                console.log(message);
            }
        });
    }
};
function cancelledwidth(payload) {
    var result = confirm('Are you sure ?');

    if (result) {
        $('#ajaxLoader').show();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: BASE_URL + '/administrator/withdraw-cancelled',
            type: 'POST',
            data: $.extend({ result: result }, payload || {}),

            success: function (data) {
                $('#ajaxLoader').hide();
                showWithdrawStatusMessage(data && data.message ? data.message : 'Withdrawal status updated successfully.');
                location.reload();
            },
            error: function (xhr) {
                $('#ajaxLoader').hide();
                var message = 'Cancel failed. Please try again.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                }
                alert(message);
                console.log(message);
            }
        });
    }
};
