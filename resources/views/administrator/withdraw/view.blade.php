@extends('administrator.layout.administrator')
@section('content')

<style>
    .pull-right{
        margin-left: 900px;
        margin-bottom: 10px;
    }
</style>
    <section>
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">Profit & Loss View</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Kuber King</a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Profit & Loss</a></li>
                                        <li class="breadcrumb-item active">Profit & Loss View</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Profit & Loss List</h5>
                                    <div class="pull-right">
                                        {{-- <a href="{{route('admin_market_create')}}" class="btn btn-primary btn-anim"><i class="fa fa-plus"></i><span class="btn-text"> Add New</span></a> --}}
                                    </div>
                                       <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Sr.</th>
                                                    <th>User Name</th>
                                                    <th>Mobile</th>
                                                    <th>Account No.</th>
                                                    <th>IFSC Code</th>
                                                    <th>Amount</th>
                                                    <th>ReMark</th>
                                                    <th>Date</th>
                                                    <th>Time</th> 
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              
                                            <?php $i=1; ?>
                                            @foreach($select as $item)
                                                <tr>
                                                    <td><?= $i ?> </td>
                                                    <td> <?= is_null($item->user_data)?"NA":$item->user_data->FullName ?></td>
                                                    <td> <?= is_null($item->user_data)?"NA":$item->user_data->mob ?></td>
                                                    <td><?= is_null($item->account_no)?"NA":$item->account_no ?> </td>
                                                    <td><?= is_null($item->ifsc_code)?"NA":$item->ifsc_code ?> </td>
                                                    <td><?= is_null($item->tr_value)?"NA":$item->tr_value ?> </td>
                                                    <td><?= is_null($item->tr_remark)?"NA":$item->tr_remark ?> </td>
                                                    <td><?= date("d-m-Y", strtotime($item->date)) ?> </td>
                                                    <td><?= date("h:i A", strtotime($item->created_at)) ?> </td>
                                                    <td> <?= is_null($item->tr_status)?"NA":$item->tr_status ?></td>                                                                                                  
                                                </tr>
                                                <?php $i++; ?>
                                                @endforeach
                                            </tbody>
                                            </table>
                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                </div>
            </div>
    </section>

    <!-- Modal -->

    <!-- Modal -->
    {{-- <script type="text/javascript" src="libs/jquery.slimscroll.min.js"></script> --}}
{{-- <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script> --}}
{{-- <script src="assets/resource/tiny_mce.js"></script> --}}
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js"></script>



@endsection
@push('scripts')
<script src="{{asset('/backend/developer/js/subAdmin.js')}}"></script>
<script>

	</script>
@endpush
