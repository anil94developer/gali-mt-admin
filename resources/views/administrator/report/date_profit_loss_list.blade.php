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
                            <h5 class="panel-title txt-dark">Profit/Loss Report</h5>
                        </div>
                        <div class="pull-right">
                            <!-- <a href="{{route('admin_sub_admin_create')}}" class="btn btn-primary btn-anim"><i class="fa fa-plus"></i><span class="btn-text">Add New</span></a> -->
							
									
                        </div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap mt-40">
                                <div class="table-responsive">
                                    <table id="pl_report" class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>Sr.</th>
                                                <th>Date</th>
                                                <th>Market Name</th>
                                                <th>Profit/Loss</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?PHP 
                                            $sum=0;
                                            foreach($market as $ks=>$vs): 
                                              $amt=Helper::get_pl($date,$vs->market_id);
                                               $sum=$sum+$amt;  
                                              ?>
                                                <tr>
                                                <td><?=$ks+1?></td>
                                                <td><?=$date?></td>
                                                <td><?=$vs->market_id;?></td>
                                                <td><?=$amt;?></td>
                                                </tr> 
                                               <?php  endforeach ?> 
                                        </tbody>
										
										<tfoot>
                                    <tr>
                                    <th>Total=</th>
                                    <th></th>
                                    <th></th>
                                    <th><?=$sum?></th>
                                    </tr>
                                    </tfoot>
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
