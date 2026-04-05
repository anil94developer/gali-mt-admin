@extends('administrator.layout.administrator')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Product List</h5>
                    <div class="text-right"> <a href="{{URL::to('administrator/product-create')}}" class="btn btn-info">Add New</a></div>

                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table id="datatable-fixed-header" class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Product Name</th>
                                    <th>Product Image</th>
                                    <th>Description</th>
                                    
                                    <th>Amount</th>
                                    <th>Sale Price</th>
                                   

                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mainly scripts -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
<!-- Page-Level Scripts -->
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

<script>
    ASSET_URL = '{{ URL::asset('public') }}/';
    BASE_URL = '{{ URL::to('/') }}';
</script>
<script language="JavaScript" type="text/javascript" src="{{ URL::asset('backend/developer/js/product.js') }}"></script>
<script>
    $('.input-sm').attr('placeholder', "category,title");
</script>
@stop