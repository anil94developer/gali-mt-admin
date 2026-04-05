////load the data......................................................
var img = "{{url('/public/front/images/loading.gif')}}";
dataTable = $('#active_list').DataTable({
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
        url: BASE_URL + '/administrator/user/get-active-user-data',
        type: "post",
        error: function () {
            $(".user-table-error").html("");
            $("#active_list").append('<tbody class="user-table-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
        }
    },
    "copytext": function () {
        // call your function here
    },
    "columnDefs": [{ orderable: true, targets: [0, 5] }],
    "order": [
        [5, 'desc']
    ]
});
$('.dataTables_filter input').attr("placeholder", "Search with name or mobile");
// $('.dataTables_filter input').attr("class", "clearable");

////load the data......................................................
var img = "{{url('/public/front/images/loading.gif')}}";
dataTable = $('#today_list').DataTable({
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
        url: BASE_URL + '/administrator/user/get-today-user-data',
        type: "post",
        error: function () {
            $(".user-table-error").html("");
            $("#today_list").append('<tbody class="user-table-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
        }
    },
    "copytext": function () {
        // call your function here
    },
    "columnDefs": [{ orderable: true, targets: [0, 5] }],
    "order": [
        [5, 'desc']
    ]
});
$('.dataTables_filter input').attr("placeholder", "Search with name or mobile");
// $('.dataTables_filter input').attr("class", "clearable");

////load the data......................................................
var img = "{{url('/public/front/images/loading.gif')}}";
dataTable = $('#inactive_list').DataTable({
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
        url: BASE_URL + '/administrator/user/get-inactive-user-data',
        type: "post",
        error: function () {
            $(".user-table-error").html("");
            $("#inactive_list").append('<tbody class="user-table-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
        }
    },
    "columnDefs": [{ orderable: true, targets: [0, 5] }],
    "order": [
        [5, 'desc']
    ]
});
$('.dataTables_filter input').attr("placeholder", "Search with name or mobile");
// $('.dataTables_filter input').attr("class", "clearable");

////load the data......................................................
var img = "{{url('/public/front/images/loading.gif')}}";
dataTable = $('#playinguser_list').DataTable({
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
        url: BASE_URL + '/administrator/user/get-playing-user-data',
        type: "post",
        error: function () {
            $(".user-table-error").html("");
            $("#playinguser_list").append('<tbody class="user-table-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
        }
    },
    "columnDefs": [{ orderable: true, targets: [0, 5] }],
    "order": [
        [5, 'desc']
    ]
});
$('.dataTables_filter input').attr("placeholder", "Search with name or mobile");
// $('.dataTables_filter input').attr("class", "clearable");
////load the data......................................................
var img = "{{url('/public/front/images/loading.gif')}}";
dataTable = $('#notplayinguser_list').DataTable({
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
        url: BASE_URL + '/administrator/user/get-notplaying-user-data',
        type: "post",
        error: function () {
            $(".user-table-error").html("");
            $("#notplayinguser_list").append('<tbody class="user-table-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
        }
    },
    "columnDefs": [{ orderable: true, targets: [0, 5] }],
    "order": [
        [5, 'desc']
    ]
});
$('.dataTables_filter input').attr("placeholder", "Search with name or mobile");
// $('.dataTables_filter input').attr("class", "clearable");

////load the data......................................................
var img = "{{url('/public/front/images/loading.gif')}}";
dataTable = $('#onlineuser_list').DataTable({
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
        url: BASE_URL + '/administrator/user/get-online-user-data',
        type: "post",
        error: function () {
            $(".user-table-error").html("");
            $("#onlineuser_list").append('<tbody class="user-table-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
        }
    },
    "columnDefs": [{ orderable: true, targets: [0, 5] }],
    "order": [
        [5, 'desc']
    ]
});
$('.dataTables_filter input').attr("placeholder", "Search with name or mobile");
// $('.dataTables_filter input').attr("class", "clearable");

////load the data......................................................
var img = "{{url('/public/front/images/loading.gif')}}";
dataTable = $('#user_ip').DataTable({
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
        url: BASE_URL + '/administrator/user/get-user-ip-data',
        type: "post",
        error: function () {
            $(".user-table-error").html("");
            $("#user_ip").append('<tbody class="user-table-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
        }
    },
    "columnDefs": [{ orderable: true, targets: [0, 2] }],
    "order": [
        [2, 'desc']
    ]
});
$('.dataTables_filter input').attr("placeholder", "Search with name or mobile");
// $('.dataTables_filter input').attr("class", "clearable");


// function deleteItem(id){
//     // alert("dddd");
//     var result = confirm("Are you sure you want to delete the user ?");
//     if (result) {
//         $('#ajaxLoader').show();
//         $.ajax({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             },
//             url: BASE_URL+'/administrator/active/user/delete/{id}',
//             type: 'POST',
//             data: {id: id },
//             success: function (data) {
//                 location.reload();
//             },
//             error: function () {
//                 console.log('There is some error in user deleting. Please try again.');
//             }
//         });
//         return false;
//     }
// }


function deleteItem(id) {
    var result = confirm("Are you sure you want to delete the notice ?");
    if (result) {
        $('#ajaxLoader').show();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: BASE_URL + '/administrator/active/user/delete/' + id,
            type: 'GET',
            success: function (data) {
                location.reload();
            },
            error: function () {
                console.log('There is some error in user deleting. Please try again.');
            }
        });
        return false;
    }
}


    ////load the data......................................................
    dataTable = $('#UserGameReport').DataTable({
        fixedHeader: true,  "dom": 'C<"clear">lfrtip',
        "colVis": {
            "buttonText": "View columns"
        },

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
            url: BASE_URL + '/administrator/get-user-game-report-data',
            type: "post",
            error: function () {
                $(".user-table-error").html("");
                $("#UserGameReport").append('<tbody class="user-table-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
            }
        },
        "columnDefs": [{ orderable: true, targets: [0, 5] }],
        "order": [
            [5, 'desc']
        ]
    });
    $('.dataTables_filter input').attr("placeholder", "Search name or mobile");
    // $('.dataTables_filter input').attr("class", "clearable");
