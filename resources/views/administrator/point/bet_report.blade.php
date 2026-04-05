@extends('administrator.layout.administrator')
@section('content')

<section>
    <div>
        <div class="row">
            <!-- Basic Table -->
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                  
                    <div class="panel-heading">
                        
                          <div class="pull-right">
                                <form name="date_filter" id="date_filter" method="get">
                                <div class="col-md-12">
										 <select name="market" required id="market">
									<option value="" selected>--Select Market--</option>
									@foreach($market as $vs)
									@if($vs->market_id==@$_GET['market'])
									<option selected value="{{$vs->market_id}}">{{$vs->market_name}}</option>
								    @else
									<option value="{{$vs->market_id}}">{{$vs->market_name}}</option>
								    @endif
								
									@endforeach
								  </select>			
                                    <label for="form_date">Form Date</label>
                                    <input type="date" id="from_date" name="startDate" value="<?=@$_GET['startDate']?>" required>
                                    <label for="form_date">To Date</label>
                                    <input type="date" id="to_date" name="endDate" value="<?=@$_GET['endDate']?>" required>
                                    <button type="submit" onclick="get_bdata()" id="filter" class="btn btn-success">Submit</button>
                                </div>
                                </form>
                            <!-- <a href="{{route('admin_sub_admin_create')}}" class="btn btn-primary btn-anim"><i class="fa fa-plus"></i><span class="btn-text">Add New</span></a> -->
                        </div>
						
                    </div>
                  
                </div>
            </div>
			<div class="row">
			 <div class="col-sm-12">
			 <div class="panel panel-default card-view">
                    <h3 style="margin-left: 10%;">Bat</h3>
                    <div class="panel-heading" style="margin-left: 10%;">
                            
							<h2 class="panel-title txt-dark">Total Deposit  {{ $total_amount}}</h2>
                            <h2 class="panel-title txt-dark">Total Win  {{ $with}}</h2>
                            <h2 class="panel-title txt-dark">Total L&P Profit {{$total_amount-$with}}</h2>


                        </div>
                        </div>
                        </div>
			</div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script src="{{asset('/backend/developer/js/point.js')}}"></script>
@endpush