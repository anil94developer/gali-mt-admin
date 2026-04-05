@extends('administrator.layout.administrator')
@section('content')
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <strong>Products Details</strong>
          </h1>
          {{--<ol class="breadcrumb">
            <li><a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="{{ URL::to('admin/plans') }}">Ads</a></li>
            <li class="active">View</li>
          </ol>--}}
        </section
        
        ><section class="content">
           <div class="box box-info">
                <div class="box-header">
                  <a href="{{ URL::to('administrator/product') }}" class="pull-right btn btn-info btn-sm" ><i class="fa fa-info"></i> View All</a>
                </div><!-- /.box-header -->
            </div>

          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
            </div>
            <div class="box-body">
                 <table  class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th width="15%" >Name</th>
                         <td><?php echo $plans->name;?></td>
                          </tr>
                      <tr>
                          <th width="15%">Description</th>
                          <td><?php echo $plans->description;?></td>
                      </tr>
                      <tr>
                          <th width="15%">Amount</th>
                          <td><?php echo $plans->amount;?></td>
                      </tr>
                       
                      <tr>
                          <th width="15%">Sale Price</th>
                          <td><?php echo $plans->sale_price;?></td>
                      </tr>
                      <tr>
                          <th width="15%">Prouduct Image</th>
                        
                          <td><img src="{{URL::asset('public/backend/uploads/product/'.$plans->product_image)}}" style="height: 100px;width: 30%;"

> </td>
                      </tr>
                     
                   

                     
                           <tr>
                        <th width="15%">Status</th>
                        <th><?php if($plans->status=='1'){ echo 'Active';}else{echo 'Inactive';}?></th>
                      </tr>
                       
                    </thead>
                    <tbody>
                                                      
                    </tbody>
                    
                  </table>
             
            </div><!-- /.box-body -->
           
          </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@stop