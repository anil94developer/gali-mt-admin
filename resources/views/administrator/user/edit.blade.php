@extends('administrator.layout.administrator')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Edit User Details </h6>
                    </div>
                    <div class="pull-right">
                        <a href="{{ URL::to('administrator/user/active-user-list') }}" class="btn btn-danger">Go Back</a>
                    </div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-wrap">
                                    {{ Form::open(['url' => route('edit_store_data'), 'data-toggle' => 'validator', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
                                    <input type="hidden" name="markets_id" value="{{ $select->id }}">
                                    <div class="form-body">
                                        <hr class="light-grey-hr" />
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Name<span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                        <input type="text"class="form-control" name="FullName"
                                                            placeholder="Name" value="{{ $select->FullName }}" required>
                                                        @error('FullName')
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert"
                                                                    aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Password<span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                        <input type="text"class="form-control" name="us_pass"
                                                            placeholder="Password" value="{{ $select->us_pass }}" required>
                                                        @error('us_pass')
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert"
                                                                    aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Reffer By<span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                        <input type="text"class="form-control" name="ref_by"
                                                            placeholder="Reffer By" value="{{ $select->ref_by ?? '' }}" >
                                                        @error('ref_by')
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert"
                                                                    aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Mobile No. <span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                       <input type="text"class="form-control" name="mob"   placeholder="Open Time" value="{{$select->mob}}" required>
                                                        @error('mob')
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> --}}

                                            {{-- <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Date of Birth <span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                        <input type="date" class="form-control" name="dob" value="{{$select->dob}}" required>
                                                        @error('dob')
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> --}}

                                            {{-- <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Gender</label>
                                                    <div class="col-md-9">
                                                        <div class="radio radio-success">
                                                            <input type="radio" name="us_gender" id="radio14"
                                                                value="Male" select>
                                                            <label for="radio14"> Male </label>
                                                        </div>
                                                        <div class="radio radio-success">
                                                            <input type="radio" name="us_gender" id="radio16"
                                                                value="Female">
                                                            <label for="radio16"> Female </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}



                                            <div class="form-actions mt-10">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit"
                                                                    class="btn btn-success  mr-10">Submit</button>
                                                                <button type="reset"
                                                                    class="btn btn-default">Cancel</button>
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
