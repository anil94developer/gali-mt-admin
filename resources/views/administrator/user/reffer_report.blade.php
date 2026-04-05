@extends('administrator.layout.administrator')
@section('content')
    <style>
        .tyu {
            width: 75px;
            border: 5px solid #4e204c;
            height: 70px;
            float: left;
        }

        .num {
            font-size: 25px;
            color: #7210a5;
        }

        .form-control {
            height: 52px;
        }

        .hello {
            height: 47px;
        }
    </style>
    <div class="container-fluid pt-25">

        <!-- Row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="pull-left">
                    <h5 class="panel-title txt-dark">User Reffer List</h5>
                </div>
            </div>

            <!-- {{ Form::open(array('url' => URL::to(''), 'data-toggle'=>'validator' , 'class'=> 'form-horizontal', 'enctype'=>'multipart/form-data')) }} -->
            <form method="get">
                <div class="row">
                    <div class="col-md-3">
                        <?php 
                        if (isset($_GET['mob'])) {
        $mob = $_GET['mob'];
    }
                        ?>
                        <input type="text" class="form-control" name="mob" id="mob" placeholder="Enter Mobile Number"
                            required>

                    </div>

                    <div class="col-md-3 d-flex">
                        <button type="submit" class="btn btn-success hello">Search</button>
                        <div class="">
							<a style="padding: 12px;" href="{{ URL::to('/administrator/user/user-reffer-report') }}" class="btn btn-success m-0">Refresh</a>
						</div>
                    </div>
                    
                    
                </div>

                {{ Form::close() }}
               
                    

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Mobile </th>
                                <th scope="col">ref Code</th>
                                <th scope="col">ref Count</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach(@$users as $ks => $vs)
                                <tr>
                                    <th scope="row">{{ $i }}</th>
                                    <td>{{ $vs['user_name'] ?? 'NA' }}</td>
                                    <td>{{ $vs['user_mobile'] ?? 'NA' }}</td>
                                    <td>{{ $vs['ref_code'] ?? 'NA' }}</td>
                                    <td>{{ $vs['reffer_count'] ?? 'NA' }}</td>
                                    <td>
                                        <a href="{{ url('administrator/user/reffer_report_view/' . $vs['ref_code']) }}"
                                            class="btn btn-primary btn-sm">
                                            View
                                        </a>
                                    </td>
                                </tr>
                                @php $i++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
@endsection