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
                            <h5 class="panel-title txt-dark">User Report List</h5>
                        </div>
                        <div class="pull-right">
                           {{-- <a href="{{route('add_user')}}" class="btn btn-primary btn-anim"><i class="fa fa-plus"></i><span class="btn-text">Add New</span></a>--}}
                        </div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap mt-40">
                                <div class="table-responsive">
                                    <table id="active_list" class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>Sr.</th>
                                                <th>User ID</th>
                                                <th>Balance</th>
                                                <th>Game Type</th>
                                                <th>Status</th>
                                                <th>Tr. Type</th>
                                                <th>Market</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            @foreach($report as $key=> $vs)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$vs->user_id}}</td>
                                                <td>{{$vs->tr_value}}</td>
                                                <?php if($vs->game_type =='1'){ ?>
                                                <td>{{'Single Digit'}}</td>
                                                <?php }elseif($vs->game_type=='2'){ ?>
                                                <td>{{'Jodi Digit'}}</td>
                                                <?php }elseif($vs->game_type=='3'){ ?>
                                                <td>{{'Single Pana'}}</td>
                                                <?php }elseif($vs->game_type=='4'){ ?>
                                                <td>{{'Double Pana'}}</td>
                                                <?php }elseif($vs->game_type=='5'){ ?>
                                                <td>{{'Triple Pana'}}</td>
                                                <?php }elseif($vs->game_type=='6'){ ?>
                                                <td>{{'Half Sangam'}}</td>
                                                <?php }elseif($vs->game_type=='7'){ ?>
                                                <td>{{'Full Sangam'}}</td>
                                                <?php }elseif($vs->game_type=='8'){ ?>
                                                <td>{{'Jodi'}}</td>
                                                <?php }elseif($vs->game_type=='9'){ ?>
                                                <td>{{'Andar'}}</td>
                                                <?php }elseif($vs->game_type=='10'){ ?>
                                                <td>{{'Bahar'}}</td>
                                                <?php }elseif($vs->game_type=='11'){ ?>
                                                <td>{{'Crossing'}}</td>
                                                <?php }elseif($vs->game_type=='12'){ ?>
                                                <td>{{'Number To Number'}}</td>
                                                <?php }else{ ?>
                                                    <td>{{'Null'}}</td>
                                                    <?php } ?>
                                                <td>{{$vs->tr_status}}</td>
                                                <td>{{$vs->value_update_by}}</td>
                                                <td>{{$vs->table_id}}</td>
                                                <td>{{$vs->date}}</td>
                                            </tr>
                                            @endforeach
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
