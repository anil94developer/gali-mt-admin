////load the data......................................................
var img = "{{url('/public/front/images/loading.gif')}}";
dataTable = $('#result_report_data').DataTable({
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
        url: BASE_URL + '/administrator/get-result-data',
        type: "post",
        error: function() {
            $(".user-table-error").html("");
            $("#result_report_data").append('<tbody class="user-table-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
        }
    },
    "columnDefs": [{ orderable: true, targets: [0, 2] }],
    "order": [
        [2, 'desc']
    ],
	"footerCallback": function ( row, data, start, end, display ) {
				var api = this.api();
				nb_cols =  6;//api.columns().nodes().length;
				var j = 3;
				while(j < nb_cols){
					var pageTotal = api
                .column( j, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return Number(a) + Number(b);
                }, 0 );
          // Update footer
          $( api.column( j ).footer() ).html(pageTotal.toFixed(2));
					j++;
				} 
			},
});
$('.dataTables_filter input').attr("placeholder", "Search with username");
// $('.dataTables_filter input').attr("class", "clearable");

////load the data......................................................
var img = "{{url('/public/front/images/loading.gif')}}";
dataTable = $('#withdraw').DataTable({
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
        url: BASE_URL + '/administrator/withdraw_point/getpointData',
        type: "post",
        error: function() {
            $(".user-table-error").html("");
            $("#withdraw").append('<tbody class="user-table-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
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
dataTable = $('#winner').DataTable({
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
        url: BASE_URL + '/administrator/winner_point/getpointData',
        type: "post",
        error: function() {
            $(".user-table-error").html("");
            $("#winner").append('<tbody class="user-table-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
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
dataTable = $('#child_report').DataTable({
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
        url: BASE_URL + '/administrator/bonus/getchildData',
        type: "post",
        error: function() {
            $(".user-table-error").html("");
            $("#winner").append('<tbody class="user-table-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
        },
		data:function(data) {
                // console.log("here");
                data.user_id = user_id;
                //data.type = $('#type').val();
                
            },
    },
    "columnDefs": [{ orderable: true, targets: [0, 5] }],
    "order": [
        [5, 'desc']
    ],
	"footerCallback": function ( row, data, start, end, display ) {
				var api = this.api();
				nb_cols =  5;//api.columns().nodes().length;
				var j = 3;
				while(j < nb_cols){
					var pageTotal = api
                .column( j, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return Number(a) + Number(b);
                }, 0 );
          // Update footer
          $( api.column( j ).footer() ).html(pageTotal.toFixed(2));
					j++;
				} 
			},
});
$('.dataTables_filter input').attr("placeholder", "Search with username");
// $('.dataTables_filter input').attr("class", "clearable");


////load the data......................................................
var img = "{{url('/public/front/images/loading.gif')}}";
dataTable = $('#market_report').DataTable({
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
        url: BASE_URL + '/administrator/bonus/getMarketData',
        type: "post",
        error: function() {
            $(".user-table-error").html("");
            $("#winner").append('<tbody class="user-table-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
        },
		data:function(data) {
                // console.log("here");
                data.user_id = user_id;
                //data.type = $('#type').val();
                
            },
    },
    "columnDefs": [{ orderable: true, targets: [0, 2] }],
    "order": [
        [2, 'desc']
    ],
	"footerCallback": function ( row, data, start, end, display ) {
				var api = this.api();
				nb_cols =  4;//api.columns().nodes().length;
				var j = 2;
				while(j < nb_cols){
					var pageTotal = api
                .column( j, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return Number(a) + Number(b);
                }, 0 );
          // Update footer
          $( api.column( j ).footer() ).html(pageTotal.toFixed(2));
					j++;
				} 
			},
});



////load the data......................................................
var img = "{{url('/public/front/images/loading.gif')}}";
dataTable = $('#pl_report').DataTable({
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
        url: BASE_URL + '/administrator/report/getPlData',
        type: "post",
        error: function() {
            $(".user-table-error").html("");
            $("#winner").append('<tbody class="user-table-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
        },
		
    },
    "columnDefs": [{ orderable: true, targets: [0, 2] }],
    "order": [
        [2, 'desc']
    ],
	"footerCallback": function ( row, data, start, end, display ) {
				var api = this.api();
				nb_cols =  4;//api.columns().nodes().length;
				var j = 3;
				while(j < nb_cols){
					var pageTotal = api
                .column( j, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return Number(a) + Number(b);
                }, 0 );
          // Update footer
          $( api.column( j ).footer() ).html(pageTotal.toFixed(2));
					j++;
				} 
			},
});


var img = "{{url('/public/front/images/loading.gif')}}";
dataTableMPL = $('#mpl_report').DataTable({
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
        url: BASE_URL + '/administrator/report/getMPlData',
        type: "post",
        error: function() {
            $(".user-table-error").html("");
            $("#winner").append('<tbody class="user-table-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
        },
        data:function(data) {
            // console.log("here");
            data.month =  $('#month').val();
            data.year =  $('#year').val();
            
            //data.type = $('#type').val();
            
        },
		
    },
    "columnDefs": [{ orderable: true, targets: [0, 1] }],
    "order": [
        [1, 'desc']
    ],
	"footerCallback": function ( row, data, start, end, display ) {
				var api = this.api();
				nb_cols =  3;//api.columns().nodes().length;
				var j = 2;
				while(j < nb_cols){
					var pageTotal = api
                .column( j, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return Number(a) + Number(b);
                }, 0 );
          // Update footer
          $( api.column( j ).footer() ).html(pageTotal.toFixed(2));
					j++;
				} 
			},
});

function get_mpldata()
{
    dataTableMPL.draw();
}
$('.dataTables_filter input').attr("placeholder", "Search with username");
// $('.dataTables_filter input').attr("class", "clearable");



var img = "{{url('/public/front/images/loading.gif')}}";
dataTable2 = $('#result_report').DataTable({
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
        url: BASE_URL + '/administrator/result_report/getResultData',
        type: "post",
        error: function() {
            $(".user-table-error").html("");
            $("#winner").append('<tbody class="user-table-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
        },data:function(data) {
            data.to_date = $('#to_date').val();
            data.from_date = $('#from_date').val();
            data.type = $('#type').val();
        },
    },
    "columnDefs": [{ orderable: true, targets: [0, 1] }],
    "order": [
        [1, 'desc']
    ]
});
$('.dataTables_filter input').attr("placeholder", "Search with username");
// $('.dataTables_filter input').attr("class", "clearable");
function get_data()
{
   
    dataTable2.draw();
};