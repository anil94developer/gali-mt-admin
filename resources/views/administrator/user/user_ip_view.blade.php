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
                            <h5 class="panel-title txt-dark"> User IP List</h5>
                        </div>
                        <div class="pull-right">
                            <a href="{{route('user_ip')}}" class="btn btn-primary btn-anim"><i class="fa fa-plus"></i><span class="btn-text">Back</span></a>
                        </div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap mt-40">
                                <div class="table-responsive">
                                    <table id="user_ip" class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>Sr.</th>
                                                <th>Device Id</th>
                                                <th>Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; ?>
                                            @foreach($ip_user as $vs)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$vs->device_id}}</td>
                                                <td>{{$vs->FullName}}</td>
                                            </tr>
                                            <?php $i++; ?>
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
<!-- <script src="{{asset('/backend/developer/js/User.js')}}"></script> -->
<script>

</script>

@endpush
