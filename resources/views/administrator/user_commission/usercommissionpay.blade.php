@extends('administrator.layout.administrator')
@section('content')
<section>
    <div>
        <div class="row">
        <div class="col-sm-12">
    <div class="panel panel-default card-view matka">
        <div class="panel-heading">
            <div class="pull-left">
                <h5 class="panel-title txt-dark">User Commission Date Wise Report</h5>
            </div>

        </div>
        <div class="panel-wrapper collapse in">
            <div class="panel-body">
                <div class="table-wrap mt-40">
                    <div class="table-responsive">                      
                        <table id="market_list" class="table mb-0">
                            <table class="table mb-0">
                                <form action="#">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="form-group ">
                                                    <label class="">Date</label>
                                                    <input type="date" class="form-control" name="date" id="date" value="<?= @$_GET['date'] ?>" required>
                                                </div>

                                            </th>
                                            <th>
                                                <div class="form-group">
                                                    <label for="">Mobile No.</label>
                                                    <input type="number" class="form-control" name="market" id="mobile" value="<?= @$_GET['mobile'] ?>" required>
                                                </div>
                                            </th>
                                            <th>
                                                <form>
                                                    <div class="form-group">
                                                        <div class="">
                                                            <button type="button" onclick = searchdata() id="searchgame" class="btn btn-primary">SEARCH GAME LOAD</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </form>
                            </table>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        </div>
        <div class="row">
            
            <!-- Basic Table -->
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h5 class="panel-title txt-dark">User Commission Pay List</h5>
                        </div>
                        <div class="pull-right">
                           {{--<a href="{{route('add_user')}}" class="btn btn-primary btn-anim"><i class="fa fa-plus"></i><span class="btn-text">Add New</span></a>--}}
                        </div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap mt-40">
                                <div class="table-responsive">
                                    <table id="usercommissionpay" class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>Sr.</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Time</th>
                                                <th>Date</th>
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

<!-- Modal -->

<!-- Modal -->

@endsection
@push('scripts')
<script src="{{asset('/backend/developer/js/reportss.js')}}"></script>
<script>
function myFunction(id) {  
  var copyText = document.getElementById("myInput_"+id);
  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices
  navigator.clipboard.writeText(copyText.value);
  alert("Copied the text: " + copyText.value);
}

function divFunction()
{
    confirm("Are you sure want to delete?")
}
</script>

@endpush
