@extends('administrator.layout.administrator')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Edit Deposit Pending Data </h6>
                </div>
                <div class="pull-right">
                    <a href="{{route('deposit_pending')}}" class="btn btn-danger">Go Back</a>
                </div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-wrap">
                                {{ Form::open(array('url' => route('update_deposit_pending_data'), 'data-toggle' => 'validator', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data')) }}
                                <input type="hidden" name="id" value="{{$point->id}}">
                                <div class="form-body">
                                    <hr class="light-grey-hr" />
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Amount<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control" name="amount" placeholder="Enter Amount" value="{{$point->tr_value}}"
                                                        required>
                                                        @error('market_name')
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert"
                                                                    aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i>{{ $message }}
                                                            </div>
                                                        @enderror
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
    <script src="{{asset('/backend/developer/js/market.js')}}"></script>
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
        rel="stylesheet" />
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript">
        $('.timepicker').timepicker({

        });

    </script>

    <script type="text/javascript">
        $('.datepicker').datepicker({
        });

    </script>
@endpush