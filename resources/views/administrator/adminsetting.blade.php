@extends('administrator.layout.administrator')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Admin Setting</h6>
                </div>
            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
            @endif

            @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
            @endif
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-wrap">
                                {{ Form::open(array('url' => route('admin_setting_store'), 'data-toggle'=>'validator' , 'class'=> 'form-horizontal', 'enctype'=>'multipart/form-data')) }}
                                <div class="form-body">
                                    <hr class="light-grey-hr" />
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Wallet</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="wallet" value="{{$select?$select->wallet:''}}" required>
                                                    @error('wallet')
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
                                                <label class="control-label col-md-3">History</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" value="{{$select?$select->history:''}}" name="history" required>
                                                    @error('history')
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
                                                <label class="control-label col-md-3">transaction</label>
                                                <div class="col-md-9">
                                                    <input type="tel" class="form-control" name="transaction" value="{{$select?$select->transaction:''}}" required>
                                                    @error('transaction')
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
                                                <label class="control-label col-md-3">online_deposit</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="online_deposit" value="{{$select?$select->online_deposit:''}}">
                                                    @error('online_deposit')
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
                                                <label class="control-label col-md-3">whatsapp</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" required name="whatsapp" value="{{$select?$select->whatsapp:''}}">
                                                    @error('whatsapp')
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
                                                <label class="control-label col-md-3"> redeem</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="redeem" value="{{$select?$select->redeem:''}}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">min_deposit</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" required name="min_deposit" value="{{$select?$select->min_deposit:''}}">
                                                    @error('min_deposit')
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
                                                <label class="control-label col-md-3">min_redeem</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="min_redeem" value="{{$select?$select->min_redeem:''}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">HarufMax</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="HarufMax" value="{{$select?$select->HarufMax:''}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">HarufMin</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="HarufMin" value="{{$select?$select->HarufMin:''}}" required>
                                                    @error('HarufMin')
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
                                                <label class="control-label col-md-3">jodi_max</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="jodi_max" value="{{$select?$select->jodi_max:''}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">jodi_min</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="jodi_min" value="{{$select?$select->jodi_min:''}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">crossingMin</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="crossingMin" value="{{$select?$select->crossingMin:''}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">crossingMax</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="crossingMax" value="{{$select?$select->crossingMax:''}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">dep_pp</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="dep_pp" value="{{$select?$select->dep_pp:''}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">dep_pytm</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="dep_pytm" value="{{$select?$select->dep_pytm:''}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">dep_gp</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="dep_gp" value="{{$select?$select->dep_gp:''}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">with_pytm</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="with_pytm" value="{{$select?$select->with_pytm:''}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">is_app_maintainance</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="is_app_maintainance" value="{{$select?$select->is_app_maintainance:''}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">result_on_off</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="result_on_off" value="{{$select?$select->result_on_off:''}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">is_paly_on_off </label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="is_paly_on_off" value="{{$select?$select->is_paly_on_off:''}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">offers</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="offers" value="{{$select?$select->offers:''}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">reffral</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="reffral" value="{{$select?$select->reffral:''}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">app_status</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="app_status" value="{{$select?$select->app_status:''}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">how_to_play</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="how_to_play" value="{{$select?$select->how_to_play:''}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">nav_chart</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="nav_chart" value="{{$select?$select->nav_chart:''}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">admin_contact_mob</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="admin_contact_mob" value="{{$select?$select->admin_contact_mob:''}}">
                                                </div>
                                            </div>
                                        </div>
										<div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Referral Commission</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control"  name="ref_comm"  value="{{$select?$select->ref_comm:''}}" >
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