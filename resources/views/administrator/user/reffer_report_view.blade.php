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

        .table-responsive {
            overflow-x: visible;
        }
    </style>
    <div class="container-fluid pt-25">

        <!-- Row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="pull-left">
                    <h5 class="panel-title txt-dark">User Reffer Report View</h5>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">User ID</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Mobile </th>
                            <th scope="col">ref Code</th>
                            <th scope="col">ref By</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach(@$users as $ks => $vs)
                            <?php    //print_r($vs->user_id);die; ?>
                            <tr>
                                <th scope="row">{{ $i }}</th>
                                <td>{{ $vs->user_id ?? 'NA' }}</td>
                                <td>{{ $vs->FullName ?? 'NA' }}</td>
                                <td>{{ $vs->mob ?? 'NA' }}</td>
                                <td>{{ $vs->ref_code ?? 'NA' }}</td>
                                <td>{{ $vs->ref_by ?? 'NA' }}</td>
                            </tr>
                            @php $i++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection