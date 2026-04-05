@extends('administrator.layout.administrator')
@section('content')
<section>
    <div>
        <div class="row">
            <!-- Basic Table -->
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h5 class="panel-title txt-dark">Winning Prediction List </h5>
                        </div>
                        <div class="pull-right">
                            <label for="form_date">Type:</label>
                            <!-- <input type="text" id="type" placeholder="Market Type" name="type" > -->
                            <select name="type" id="type" required>
                            <option value="">Select</option>
                            <option value="type">Open</option>
                            <option value="type">Close</option>
                            </select>


                            <label for="form_date">Form Date</label> 
                            <input type="date" id="from_date" name="startDate" required>
                            <label for="form_date">To Date</label>
                            <input type="date" id="to_date" name="endDate" required>
                            <button type="button" onclick="get_data()" id="filter" class="btn btn-success">Submit</button>									
                        </div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap mt-40">
                                <div class="table-responsive">
                                    <table id="datacatr" class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>Sr.</th>
                                                <th>Market</th>
                                                <th>DateTime</th>
                                                <th>Result</th> 
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
@endsection
@push('scripts')
<script src="{{asset('/backend/developer/js/Winning.js')}}"></script>
@endpush
