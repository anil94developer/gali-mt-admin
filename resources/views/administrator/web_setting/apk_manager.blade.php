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
                            <h5 class="panel-title txt-dark">Apk Manager</h5>
                        </div>
                        <div class="pull-right">
                            {{-- <a href="{{route('admin_market_create')}}" class="btn btn-primary btn-anim"><i class="fa fa-plus"></i><span class="btn-text">Back To Game</span></a> --}}
                        </div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap mt-40">
                                <!-- <form> -->
                                    <!-- @csrf -->
                                    {{ Form::open(array('url' => route('apk_manager_update'), 'data-toggle'=>'validator','method'=>'post' , 'class'=> '', 'enctype'=>'multipart/form-data')) }}
                                    <input type="hidden" class="form-control" name="id" id="id" value="{{ $apkManager->id }}">
                                    <div class="col-md-6 form-group m-0">
                                        <label for="whatsapp" class="form-label">Whatsapp No.</label>
                                        <input type="text" class="form-control" name="whatsapp" id="whatsapp" value="{{$apkManager->whatsapp}}">
                                    </div>
                                    <div class="col-md-6 form-group  m-0">
                                        <label for="whatsapp" class="form-label">User Reg. No.</label>
                                        <input type="text" class="form-control" name="user_reg_no" id="user_reg_no" value="{{$apkManager->user_reg_no}}">
                                    </div>
                                    <div class="col-md-6 form-group  m-0">
                                        <label for="min_deposit" class="form-label">Minimum Deposit</label>
                                        <input type="text" class="form-control" name="min_deposit" id="min_deposit" value="{{$apkManager->min_deposit}}">
                                    </div>
                                    <div class="col-md-6 form-group  m-0">
                                        <label for="min_deposit" class="form-label">Maximum Deposit</label>
                                        <input type="text" class="form-control" name="max_deposit" id="max_deposit" value="{{$apkManager->max_deposit}}">
                                    </div>
                                    <div class="col-md-6 form-group  m-0">
                                        <label for="min_deposit" class="form-label">Minimum jodi</label>
                                        <input type="text" class="form-control" name="jodi_min" id="jodi_min" value="{{$apkManager->jodi_min}}">
                                    </div>
                                    <div class="col-md-6 form-group  m-0">
                                        <label for="min_deposit" class="form-label">Maximum jodi</label>
                                        <input type="text" class="form-control" name="jodi_max" id="jodi_max" value="{{$apkManager->jodi_max}}">
                                    </div>
                                    <div class="col-md-6 form-group  m-0">
                                        <label for="min_deposit" class="form-label">Minimum Harruf</label>
                                        <input type="text" class="form-control" name="HarufMin" id="HarufMin" value="{{$apkManager->HarufMin}}">
                                    </div>
                                    <div class="col-md-6 form-group  m-0">
                                        <label for="min_deposit" class="form-label">Maximum Harruf</label>
                                        <input type="text" class="form-control" name="HarufMax" id="HarufMax" value="{{$apkManager->HarufMax}}">
                                    </div>
                                    <div class="col-md-6 form-group  m-0">
                                        <label for="min_deposit" class="form-label">Minimum Crossing</label>
                                        <input type="text" class="form-control" name="crossingMin" id="crossingMin" value="{{$apkManager->crossingMin}}">
                                    </div>
                                    <div class="col-md-6 form-group  m-0">
                                        <label for="min_deposit" class="form-label">Maximum Crossing</label>
                                        <input type="text" class="form-control" name="crossingMax" id="crossingMax" value="{{$apkManager->crossingMax}}">
                                    </div>
                                    <div class="col-md-6 form-group m-0">
                                        <label for="inputEmail4" class="form-label">Minimum Redeem</label>
                                        <input type="text" class="form-control" name="min_redeem" id="inputEmail4" value="{{$apkManager->min_redeem}}">
                                    </div>
                                    <div class="col-md-6 form-group m-0">
                                        <label for="inputPassword4" class="form-label">Upi Id</label>
                                        <input type="text" class="form-control" name="upiId" id="inputPassword4" value="{{$apkManager->upiId}}">
                                    </div>
                                    
                                    <div class="col-md-6 form-group m-0">
                                        <label for="inputCity" class="form-label">App Maintinance</label>
                                        <input type="text" class="form-control" name="is_app_maintainance" id="inputCity" value="{{$apkManager->is_app_maintainance}}">
                                    </div>

                                    <div class="col-md-6 form-group m-0">
                                        <label for="inputCity" class="form-label">App Maintinance 2</label>
                                        <input type="text" class="form-control" name="is_app_mentinance2" id="is_app_mentinance2" value="{{$apkManager->is_app_mentinance2}}">
                                    </div>

                                    <div class="col-md-6 form-group m-0">
                                        <label for="inputCity" class="form-label">App Maintinance 3</label>
                                        <input type="text" class="form-control" name="is_app_mentinance3" id="is_app_mentinance3" value="{{$apkManager->is_app_mentinance3}}">
                                    </div>
                                    <div class="col-md-6 form-group m-0">
                                        <label for="inputCity" class="form-label">App Maintinance 4</label>
                                        <input type="text" class="form-control" name="is_app_mentinance4" id="is_app_mentinance4" value="{{$apkManager->is_app_mentinance4}}">
                                    </div>
                                    <div class="col-md-6 form-group m-0">
                                        <label for="inputCity" class="form-label">App Maintinance 5</label>
                                        <input type="text" class="form-control" name="is_app_maintenance5" id="is_app_maintenance5" value="{{$apkManager->is_app_maintenance5}}">
                                    </div>
                                    <div class="col-md-6 form-group m-0">
                                        <label for="inputCity" class="form-label">Version</label>
                                        <input type="text" class="form-control" name="version" id="version" value="{{$apkManager->version}}">
                                    </div>

                                    <div class="col-md-6 form-group m-0">
                                        <label for="inputCity" class="form-label">Admin Contact Mobile</label>
                                        <input type="text" class="form-control" name="admin_contact_mob" id="inputCity" value="{{$apkManager->admin_contact_mob}}">
                                    </div>
                                    <div class="col-md-6 form-group m-0">
                                        <label for="whatsapp" class="form-label">Help line No.</label>
                                        <input type="text" class="form-control" name="help_line_number" id="help_line_number" value="{{$apkManager->help_line_number}}">
                                    </div>
                                    <div class="col-md-6 form-group m-0">
                                        <label for="inputEmail4" class="form-label">Imp Notice on Home</label>
                                        <input type="text" class="form-control" name="imp_notice_on_home" id="inputEmail4" value="{{$apkManager->imp_notice_on_home}}">
                                    </div>
                                    <div class="col-md-6 form-group m-0">
                                        <label for="inputEmail4" class="form-label">Telegram</label>
                                        <input type="text" class="form-control" name="telegram" id="inputEmail4" value="{{$apkManager->telegram}}">
                                    </div>

                                    <div class="col-md-6 form-group m-0">
                                        <label for="inputEmail4" class="form-label">Reffer Link</label>
                                        <input type="text" class="form-control" name="reffer_link" id="reffer_link" value="{{$apkManager->reffer_link}}">
                                    </div>

                                    <div class="col-md-6 form-group m-0">
                                        <label for="inputEmail4" class="form-label">Disable Market (0->Disable , 1->Enable)</label>
                                        <input type="text" class="form-control" name="market_disable" id="market_disable" value="{{$apkManager->market_disable}}">
                                    </div>

                                    <div class="col-md-6 form-group m-0">
                                        <label for="inputEmail4" class="form-label">Withdraw Disable (0->Disable , 1->Enable)</label>
                                        <input type="text" class="form-control" name="withdraw_disable" id="withdraw_disable" value="{{$apkManager->withdraw_disable}}">
                                    </div>

                                    <div class="col-md-6 form-group m-0">
                                        <label for="inputEmail4" class="form-label">Deposit Disable (0->Disable , 1->Enable)</label>
                                        <input type="text" class="form-control" name="deposit_disable" id="deposit_disable" value="{{$apkManager->deposit_disable}}">
                                    </div>

                                    <div class="col-md-12 form-group m-0">
                                        <label for="inputEmail4" class="form-label">How to Play</label>
                                        <input type="text" class="form-control" name="how_to_play" id="how_to_play" value="{{$apkManager->how_to_play}}">
                                    </div>

                                    <div class="col-md-6 form-group m-0">
                                        <label for="inputEmail4" class="form-label">Withdraw Open Time</label>
                                        <input type="time" class="form-control" name="withdraw_open_time" id="withdraw_open_time" value="{{$apkManager->withdraw_open_time}}">
                                    </div>

                                    <div class="col-md-6 form-group m-0">
                                        <label for="inputEmail4" class="form-label">Withdraw Close Time</label>
                                        <input type="time" class="form-control" name="withdraw_close_time" id="withdraw_close_time" value="{{$apkManager->withdraw_close_time}}">
                                    </div>


                                    <!-- <div class="col-md-6 form-group">
                                        <label for="inputPassword4" class="form-label">Doublele Pana Value 2</label>
                                        <input type="number" class="form-control" id="inputPassword4" value="{{$apkManager->double_pana_value2}}" >
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="inputEmail4" class="form-label">Triple Pana Value 1</label>
                                        <input type="number" class="form-control" id="inputEmail4" value="{{$apkManager->triple_pana_value1}}">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="inputPassword4" class="form-label">Triple Pana Value 2</label>
                                        <input type="number" class="form-control" id="inputPassword4" value="{{$apkManager->triple_pana_value2}}">
                                    </div>
                                    
                                    <div class="col-md-6 form-group">
                                        <label for="inputCity" class="form-label">Half Sangam Value 1</label>
                                        <input type="number" class="form-control" id="inputCity"  value="{{$apkManager->Half_Sangam_Value1}}">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="inputCity" class="form-label">Half Sangam Value 2</label>
                                        <input type="number" class="form-control" id="inputCity" value="{{$apkManager->Half_Sangam_Value1}}">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="inputCity" class="form-label">Fulll Sangam Value 1</label>
                                        <input type="number" class="form-control" id="inputCity" value="{{$apkManager->Half_Sangam_Value1}}">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="inputCity" class="form-label">Full Sangam Value 2</label>
                                        <input type="number" class="form-control" id="inputCity" value="{{$apkManager->Half_Sangam_Value2}}">
                                    </div> -->
                                    <div class="col-md-6 form-group m-0">
                                        <label for="inputCity" class="form-label">Withdraw Otp</label>
                                        <input type="text" class="form-control" name="withdraw_otp" id="withdraw_otp" value="{{$apkManager->withdraw_otp}}">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                    {{ Form::close() }}
                                <!-- </form> -->
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
<script src="{{asset('/backend/developer/js/GaliDisawar.js')}}"></script>
<script>

</script>

@endpush
