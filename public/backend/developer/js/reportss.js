////load the data......................................................
// var img = "{{url('/public/front/images/loading.gif')}}";
// dataTable = $('#bidhistory').DataTable({
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
//             customize: function (win) {
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
//         url: BASE_URL + '/administrator/report/get-userbid-Data',
//         type: "post",
//         error: function () {
//             $(".user-table-error").html("");
//             $("#bidhistory").append('<tbody class="user-table-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
//         }
//     },
//     "columnDefs": [{ orderable: true, targets: [0, 2] }],
//     "order": [
//         [2, 'desc']
//     ]
// });
// $('.dataTables_filter input').attr("placeholder", "Search Keywords");
// $('.dataTables_filter input').attr("class", "clearable");

///// LOAD DATA.........................................
if ($('#bidhistory').length) {
dataTable = $('#bidhistory').DataTable({
    fixedHeader: true,  "dom": 'C<"clear">lfrtip',
    "colVis": {
        "buttonText": "View columns"
    },
    // "oLanguage": {
    //     "sProcessing": "<img src='"+ASSET_URL+"admin/images/loading.gif'>"
    // },
    "processing": true,
    "serverSide": true,
    pageLength: 10,
    "ajax":{
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : BASE_URL+'/administrator/report/get-userbid-Data', // json datasource
        type: "POST",  // method  , by default get

        error: function(){


            $(".user-table-error").html("");
            $("#bidhistory").append('<tbody class="user-table-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
            //$("#user-table_processing").css("display","none");
        }
    },
    "columnDefs": [ { orderable: false, targets: [0,2] }],
    "order": [[ 2, 'desc' ]]
});
$('.dataTables_filter input').attr("placeholder", "Name");
$('.dataTables_filter input').attr("class", "name");
}

///// User Commission.........................................
if ($('#user_commission').length) {
dataTable14 = $('#user_commission').DataTable({
    fixedHeader: true,  "dom": 'C<"clear">lfrtip',
    "colVis": {
        "buttonText": "View columns"
    },
    // "oLanguage": {
    //     "sProcessing": "<img src='"+ASSET_URL+"admin/images/loading.gif'>"
    // },
    "processing": true,
    "serverSide": true,
    pageLength: 10,
    "ajax":{
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : BASE_URL+'/administrator/user-commission/getData-list', // json datasource
        type: "POST",  // method  , by default get

        error: function(){


            $(".user-table-error").html("");
            $("#bidhistory").append('<tbody class="user-table-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
            //$("#user-table_processing").css("display","none");
        },
        data:function(data) {
            data.date = $('#date').val();
        },
    },
    "columnDefs": [ { orderable: false, targets: [0,4] }],
    "order": [[ 4, 'desc' ]]
});
$('.dataTables_filter input').attr("placeholder", "Name");
$('.dataTables_filter input').attr("class", "name");

function getdata()
{
   
    dataTable14.draw();
};
}

///// LOAD DATA.........................................
if ($('#withdraw').length) {
dataTable = $('#withdraw').DataTable({
    fixedHeader: true,  "dom": 'C<"clear">lfrtip',
    "colVis": {
        "buttonText": "View columns"
    },
    // "oLanguage": {
    //     "sProcessing": "<img src='"+ASSET_URL+"admin/images/loading.gif'>"
    // },
    "processing": true,
    "serverSide": true,
    pageLength: 10,
    "ajax":{
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : BASE_URL+'/administrator/report/get-withdrawReport-Data', // json datasource
        type: "POST",  // method  , by default get

        error: function(){


            $(".user-table-error").html("");
            $("#withdraw").append('<tbody class="user-table-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
            //$("#user-table_processing").css("display","none");
        }
    },
    "columnDefs": [ { orderable: false, targets: [0,2] }],
    "order": [[ 2, 'desc' ]]
});
$('.dataTables_filter input').attr("placeholder", "Name");
$('.dataTables_filter input').attr("class", "name");
}


///// LOAD DATA.........................................
if ($('#autoDeposit').length) {
dataTable = $('#autoDeposit').DataTable({
    fixedHeader: true,  "dom": 'C<"clear">lfrtip',
    "colVis": {
        "buttonText": "View columns"
    },
    // "oLanguage": {
    //     "sProcessing": "<img src='"+ASSET_URL+"admin/images/loading.gif'>"
    // },
    "processing": true,
    "serverSide": true,
    pageLength: 10,
    "ajax":{
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : BASE_URL+'/administrator/report/get-autoDeposit-Data', // json datasource
        type: "POST",  // method  , by default get

        error: function(){


            $(".user-table-error").html("");
            $("#autoDeposit").append('<tbody class="user-table-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
            //$("#user-table_processing").css("display","none");
        }
    },
    "columnDefs": [ { orderable: false, targets: [0,2] }],
    "order": [[ 2, 'desc' ]]
});
$('.dataTables_filter input').attr("placeholder", "Name");
$('.dataTables_filter input').attr("class", "name");
}


///// LOAD DATA.........................................
if ($('#addfund').length) {
dataTable = $('#addfund').DataTable({
    fixedHeader: true,  "dom": 'C<"clear">lfrtip',
    "colVis": {
        "buttonText": "View columns"
    },
    // "oLanguage": {
    //     "sProcessing": "<img src='"+ASSET_URL+"admin/images/loading.gif'>"
    // },
    "processing": true,
    "serverSide": true,
    pageLength: 10,
    "ajax":{
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : BASE_URL+'/administrator/report/get-addfundReport-Data', // json datasource
        type: "POST",  // method  , by default get

        error: function(){


            $(".user-table-error").html("");
            $("#addfund").append('<tbody class="user-table-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
            //$("#user-table_processing").css("display","none");
        }
    },
    "columnDefs": [ { orderable: false, targets: [0,2] }],
    "order": [[ 2, 'desc' ]]
});
$('.dataTables_filter input').attr("placeholder", "Name");
$('.dataTables_filter input').attr("class", "name");
}


///// LOAD DATA.........................................
if ($('#winning_Data').length) {
dataTable = $('#winning_Data').DataTable({
    fixedHeader: true,  "dom": 'C<"clear">lfrtip',
    "colVis": {
        "buttonText": "View columns"
    },
    // "oLanguage": {
    //     "sProcessing": "<img src='"+ASSET_URL+"admin/images/loading.gif'>"
    // },
    "processing": true,
    "serverSide": true,
    pageLength: 10,
    "ajax":{
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : BASE_URL+'/administrator/report/get-winningReport-Data', // json datasource
        type: "POST",  // method  , by default get

        error: function(){


            $(".user-table-error").html("");
            $("#winning_Data").append('<tbody class="user-table-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
            //$("#user-table_processing").css("display","none");
        }
    },
    "columnDefs": [ { orderable: false, targets: [0,2] }],
    "order": [[ 2, 'desc' ]]
});
$('.dataTables_filter input').attr("placeholder", "Name");
$('.dataTables_filter input').attr("class", "name");
}


///// LOAD DATA.........................................
if ($('#transfarPoint').length) {
dataTable = $('#transfarPoint').DataTable({
    fixedHeader: true,  "dom": 'C<"clear">lfrtip',
    "colVis": {
        "buttonText": "View columns"
    },
    // "oLanguage": {
    //     "sProcessing": "<img src='"+ASSET_URL+"admin/images/loading.gif'>"
    // },
    "processing": true,
    "serverSide": true,
    pageLength: 10,
    "ajax":{
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : BASE_URL+'/administrator/report/get-transfarPoint-Data', // json datasource
        type: "POST",  // method  , by default get

        error: function(){


            $(".user-table-error").html("");
            $("#transfarPoint").append('<tbody class="user-table-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
            //$("#user-table_processing").css("display","none");
        }
    },
    "columnDefs": [ { orderable: false, targets: [0,2] }],
    "order": [[ 2, 'desc' ]]
});
$('.dataTables_filter input').attr("placeholder", "Name");
$('.dataTables_filter input').attr("class", "name");
}


///// LOAD DATA.........................................
if ($('#bidwinning').length) {
dataTable = $('#bidwinning').DataTable({
    fixedHeader: true,  "dom": 'C<"clear">lfrtip',
    "colVis": {
        "buttonText": "View columns"
    },
    // "oLanguage": {
    //     "sProcessing": "<img src='"+ASSET_URL+"admin/images/loading.gif'>"
    // },
    "processing": true,
    "serverSide": true,
    pageLength: 10,
    "ajax":{
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : BASE_URL+'/administrator/report/get-bidWinning-Data', // json datasource
        type: "POST",  // method  , by default get

        error: function(){


            $(".user-table-error").html("");
            $("#bidwinning").append('<tbody class="user-table-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
            //$("#user-table_processing").css("display","none");
        }
    },
    "columnDefs": [ { orderable: false, targets: [0,2] }],
    "order": [[ 2, 'desc' ]]
});
$('.dataTables_filter input').attr("placeholder", "Name");
$('.dataTables_filter input').attr("class", "name");
}

////load the data......................................................

if ($('#usercommissionpay').length) {
dataTable = $('#usercommissionpay').DataTable({
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
        url: BASE_URL + '/administrator/get-user-commission-pay-data',
        type: "post",
        error: function () {
            $(".user-table-error").html("");
            $("#usercommissionpay").append('<tbody class="user-table-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
        },
        data: function (data) {
            data.date = $('#date').val();
            data.mobile = $('#mobile').val();
        },
    },
    "columnDefs": [{ orderable: true, targets: [0, 2] }],
    "order": [
        [2, 'desc']
    ]
});
function searchdata()
{
dataTable.draw();
};
$('.dataTables_filter input').attr("placeholder", "Search with mobile & username");
// $('.dataTables_filter input').attr("class", "clearable");
}