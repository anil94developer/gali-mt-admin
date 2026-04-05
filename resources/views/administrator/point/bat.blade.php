@extends('administrator.layout.administrator')
@section('content')

<section>
    <div>
        <div class="row">
            <!-- Basic Table -->
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <h3>Bat</h3>
                    <div class="panel-heading">

                        <div class="pull-right">
                            <form name="date_filter" id="date_filter" method="get">
                                <div class="col-md-12">
                                    <select name="market" required id="market">
                                        <option value="" selected>--Select Market--</option>
                                        @foreach($market as $vs)
                                        <option value="{{$vs->market_id}}">{{$vs->market_name}}</option>
                                        @endforeach
                                    </select>
                                    <label for="form_date">Form Date</label>
                                    <input type="date" id="from_date" name="startDate" required>
                                    <label for="form_date">To Date</label>
                                    <input type="date" id="to_date" name="endDate" required>
                                    <button type="button" onclick="get_bdata()" id="filter" class="btn btn-success">Submit</button>
                                </div>
                            </form>
                            <!-- <a href="{{route('admin_sub_admin_create')}}" class="btn btn-primary btn-anim"><i class="fa fa-plus"></i><span class="btn-text">Add New</span></a> -->
                        </div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap mt-40">
                                <div class="table-responsive">
                                    <table id="bat" class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>Sr.</th>
                                                <th>Mobile</th>
                                                <th>Username</th>
                                                <th>Market</th>
                                                <th>Game Type</th>
                                                <th>Bat Type</th>
                                                <th>Bat Key</th>
                                                <th>Sangam Close Pana Key</th>

                                                <th>Win Amount</th>
                                                <th>Bet Amount</th>
                                                <th>Time</th>

                                                <!-- <th>Device ID</th> -->
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Number Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'administrator/bet_point/number-update')) }}
                <input type="hidden" id="id" name="id" class="id">
                <input type="number" name="number" class="form-control" placeholder="Enter Number"><br>
                <div id="second">
                    <input type="number" name="numbersecond" class="form-control" placeholder="Enter Close Number">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{asset('/backend/developer/js/point.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#second').hide();

    });

    function getid(id, value1) {
        // alert(value1);
        $('.id').val(id);
        if (value1 == 1) {
            $('#second').show();
        } else {
            $('#second').hide();

        }
    }
</script>
@endpush