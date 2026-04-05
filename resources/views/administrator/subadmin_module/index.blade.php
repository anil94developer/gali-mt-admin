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
              <h5 class="panel-title txt-dark">List User</h5>
            </div>
            <div class="pull-right">
              <a href="{{route('admin_sub_admin_create')}}" class="btn btn-primary btn-anim"><i class="fa fa-plus"></i><span class="btn-text">Add New</span></a>
            </div>
          </div>
          <div class="panel-wrapper collapse in">
            <div class="panel-body">
              <div class="table-wrap mt-40">
                <div class="table-responsive">
                  <table id="sub_admin_list" class="table mb-0">
                    <thead>
                      <tr>
                        <th>Sr.</th>
                        <th>Username</th>
                        <!-- <th>Email</th> -->
                        <th>Password</th>
                        <th>Mobile</th>
                        <!-- <th>Rol ID</th> -->
                        <!-- <th>Date</th> -->
                        <th>Credit</th>
                        <th>Ref Code</th>
                        <th>Ref By</th>
                        <th>Date</th>
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

<!-- Modal -->
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Deposit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(array('url' => 'administrator/deposit/store')) }}
      <div class="modal-body">
        <input type="hidden" name="user_id" id="user_id">
        <label>Please Enter Amount</label>
        <input type="number" name="amount" id="amount" class="form-control" required="true">
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalScrollable_withdraw" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Withdraw</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(array('url' => 'administrator/withdraw/store')) }}
      <div class="modal-body">
        <input type="hidden" name="user_id" id="user_id_w">
        <label>Please Enter Amount</label>
        <input type="number" name="amount" min="0" id="amount_with" class="form-control" required="true">
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script src="{{asset('/backend/developer/js/subAdmin.js')}}"></script>
<script>
  function get_id(id) {
    $('#user_id').val(id);
  }

  function get_id_withdraw(id, amt) {
    // alert(amt);

    $('#amount_with').attr('max', amt);
    $('#user_id_w').val(id);
  }
</script>

@endpush