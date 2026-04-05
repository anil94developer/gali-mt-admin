@extends('administrator.layout.administrator')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Add New Admin</h6>
                </div>
                <div class="pull-right">
                   <a href="{{route('admin_sub_admin')}}" class="btn btn-danger">Go Back</a>
                </div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-wrap">
                                {{ Form::open(array('url' => route('admin_sub_admin_store'), 'data-toggle'=>'validator' , 'class'=> 'form-horizontal', 'enctype'=>'multipart/form-data')) }}
                                    <div class="form-body">
                                        <hr class="light-grey-hr"/>
                                        <div class="row">

                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">First Name<span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                       <input type="text"class="form-control" name="first_name" value="{{old('first_name')}}" id="first_name" placeholder="first name">
                                                        @error('first_name')
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
                                                    <label class="control-label col-md-4">Last Name<span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                       <input type="text"class="form-control" name="last_name" value="{{old('last_name')}}" id="last_name" placeholder="last name">
                                                        @error('last_name')
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
                                                    <label class="control-label col-md-4">Email<span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                        <input type="email" class="form-control" name="email"  id="email" placeholder="Email" value="{{old('email')}}">
                                                        @error('email')
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
                                                    <label class="control-label col-md-4">Password<span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                        <input type="password" class="form-control" name="password" placeholder="Password"  required>
                                                        @error('password')
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
                                                    <label class="control-label col-md-4">Confirm Password<span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                                                        @error('password_confirmation')
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12">
                                            <div class="form-group">
                                            <label class="control-label col-md-3">Image<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <input type="file" class="form-control" name="image" required>
                                                        @error('image')
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> -->




                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Access Permission<span class="text-danger">*</span></label>
                                                <div class="col-sm-7">
                                                      <div class="col-md-6"><input type="checkbox" name="permission[]" value="orders">Orders
                                                         <ul style="margin-left: 25px;">
                                                            <li><input type="checkbox" name="permission[]" value="pending_order">Pending Order</li>
                                                            <li><input type="checkbox" name="permission[]" value="ongoing_order">Ongoing Order</li>
                                                            <li><input type="checkbox" name="permission[]" value="completed_order">Completed Order</li>
                                                            <li><input type="checkbox" name="permission[]" value="cancelled_order">Cancelled Order</li>
                                                         </ul>
                                                         </div>
                                                     <div class="col-md-6"> <input type="checkbox" name="permission[]" value="customer">Users
                                                       <ul style="margin-left: 25px;">
                                                           <li><input type="checkbox" name="permission[]" value="all_users">All Users</li>
                                                           <li><input type="checkbox" name="permission[]" value="active_users">Active Users</li>
                                                           <li><input type="checkbox" name="permission[]" value="inactive_users">Inactive Users</li>
                                                        </ul>
                                                    </div>
                                                      <div class="col-md-6"> <input type="checkbox" name="permission[]" value="product_management">Product Management
                                                           <ul style="margin-left: 25px;">
                                                            <li><input type="checkbox" name="permission[]" value="category">Category</li>
                                                            <li><input type="checkbox" name="permission[]" value="sub_category">Sub Category</li>
                                                          </ul>
                                                      </div>
                                                        <div class="col-md-6"><input type="checkbox" name="permission[]" value="setting">Setting
                                                          <ul style="margin-left: 25px;">
                                                            <li><input type="checkbox" name="permission[]" value="general_setting">General Setting</li>
                                                          </ul>
                                                      </div>
                                                      <div class="col-md-6"><input type="checkbox" name="permission[]" value="contact_us">Contact Us
                                                    </div>

                                                </div>
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
@push('scripts')
<script src="{{asset('/backend/developer/js/subAdmin.js')}}"></script>
<script>
	$('input[type=checkbox]').click(function(){
        // children checkboxes depend on current checkbox
        $(this).next().find('input[type=checkbox]').prop('checked',this.checked);
        // go up the hierarchy - and check/uncheck depending on number of children checked/unchecked
        $(this).parents('ul').prev('input[type=checkbox]').prop('checked',function(){
            return $(this).next().find(':checked').length;
        });
    });
	</script>
@endpush
