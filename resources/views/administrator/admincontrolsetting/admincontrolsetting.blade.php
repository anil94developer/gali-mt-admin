@extends('administrator.layout.administrator')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Admin Control Setting</h6>
                </div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-wrap">
                                {{ Form::open(array('url' => route('admin_control_setting_store'), 'data-toggle'=>'validator' , 'class'=> 'form-horizontal', 'enctype'=>'multipart/form-data')) }}
                                    <div class="form-body">
                                        <hr class="light-grey-hr"/>
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Name</label>
                                                    <div class="col-md-9">
                                                        <input type="text"  class="form-control" name="ad_name" value="{{$select?$select->ad_name:''}}" required>
                                                        @error('ad_name')
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Email</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control"  value="{{$select?$select->ad_email:''}}" name="ad_email"  required>
                                                        @error('ad_email')
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Whatsapp Number</label>
                                                    <div class="col-md-9">
                                                        <input type="tel" class="form-control"  name="ad_whtsp"  value="{{$select?$select->ad_whtsp:''}}" required>
                                                        @error('ad_whtsp')
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="text" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Package Key</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control"  name="ad_package_key"  value="{{$select?$select->ad_package_key:''}}" >
                                                        @error('ad_package_key')
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">App Updated Version</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" required  name="app_updated_version"  value="{{$select?$select->app_updated_version:''}}" >
                                                        @error('app_updated_version')
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3"> Force Updated</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" name="force_update"  value="{{$select?$select->force_update:''}}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">App Maintenance</label>
                                                    <div class="col-md-9">
                                                        <input type="text"  class="form-control" required name="is_app_maintanace"  value="{{$select?$select->is_app_maintanace:''}}" >
                                                        @error('is_app_maintanace')
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Till Date Maintenance</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" name="till_date_maintanace"  value="{{$select?$select->till_date_maintanace:''}}" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Message Maintenance</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" name="maintanace_message"  value="{{$select?$select->maintanace_message:''}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Maintenance Title</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" name="maintanace_title"   value="{{$select?$select->maintanace_title:''}}" required>
                                                        @error('maintanace_title')
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Image</label>
                                                    <div class="col-md-9">
                                                        <!-- <input type="file" class="form-control" name="maintanace_image"  value="{{$select?$select->maintanace_image:''}}" required> -->
                                                        <input type="file" class="form-control" name="maintanace_image">
                                                        <img src="{{asset('/backend/uploads/admin_control/'.$select->maintanace_image)}}" alt="image" width="100px">
                                                        <input type="hidden" name="old_image" value="{{$select->maintanace_image}}">
                                                        @error('maintanace_image')
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Online Deposit</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" name="online_deposit"  value="{{$select?$select->online_deposit:''}}" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Whatsapp Deposit</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" name="whatsapp_deposit"  value="{{$select?$select->whatsapp_deposit:''}}" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Currency</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" name="currency"  value="{{$select?$select->currency:''}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Walllet</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control"  name="wallet"  value="{{$select?$select->wallet:''}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">History</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control"  name="history"  value="{{$select?$select->history:''}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Transaction</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control"  name="transaction" value="{{$select?$select->transaction:''}}" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Redeem</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control"  name="redeem"  value="{{$select?$select->redeem:''}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Rates</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control"  name="rates"  value="{{$select?$select->rates:''}}" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Access Key</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control"  name="accesskey"  value="{{$select?$select->accesskey:''}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Commission </label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control"  name="commission"  value="{{$select?$select->commission:''}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">UPI ID</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control"  name="upiid"  value="{{$select?$select->upiid:''}}" >
                                                    </div>
                                                </div>
                                            </div>

											
                                           
                                    </div>
                                    <div class="form-actions mt-10">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <button type="submit" class="btn btn-success  mr-10">Submit</button>
                                                        <button type="reset" class="btn btn-default">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6"> </div>
                                        </div>
                                    </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection