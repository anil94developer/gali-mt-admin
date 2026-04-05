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
                            <h5 class="panel-title txt-dark">Gali Disawar Game Rate List</h5>
                        </div>
                        <div class="pull-right">
                            <a href="{{route('admin_market_create')}}" class="btn btn-primary btn-anim"><i class="fa fa-plus"></i><span class="btn-text">Back To Game</span></a>
                        </div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap mt-40">
                                <form>
                                    @csrf
                                    <div class="col-md-6 form-group">
                                        <label for="inputEmail4" class="form-label">Single Digit Value 1</label>
                                        <input type="number" class="form-control" id="inputEmail4" value="{{$gd_game->single_digit_value1}}">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="inputPassword4" class="form-label">Single Digit Value 2</label>
                                        <input type="number" class="form-control" id="inputPassword4" value="{{$gd_game->single_digit_value2}}">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="inputEmail4" class="form-label">Jodi Digit Value 1</label>
                                        <input type="number" class="form-control" id="inputEmail4" value="{{$gd_game->jodi_digit_value1}}">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="inputPassword4" class="form-label">Jodi Digit Value 2</label>
                                        <input type="number" class="form-control" id="inputPassword4" value="{{$gd_game->jodi_digit_value2}}">
                                    </div>
                                    
                                    <div class="col-md-6 form-group">
                                        <label for="inputCity" class="form-label">Single Pana Value 1</label>
                                        <input type="number" class="form-control" id="inputCity" value="{{$gd_game->single_pana_value1}}">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="inputCity" class="form-label">Single Pana Value 2</label>
                                        <input type="number" class="form-control" id="inputCity" value="{{$gd_game->single_pana_value2}}">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="inputEmail4" class="form-label">Double Pana Value 1</label>
                                        <input type="number" class="form-control" id="inputEmail4" value="{{$gd_game->double_pana_value1}}">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="inputPassword4" class="form-label">Doublele Pana Value 2</label>
                                        <input type="number" class="form-control" id="inputPassword4" value="{{$gd_game->double_pana_value2}}" >
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="inputEmail4" class="form-label">Triple Pana Value 1</label>
                                        <input type="number" class="form-control" id="inputEmail4" value="{{$gd_game->triple_pana_value1}}">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="inputPassword4" class="form-label">Triple Pana Value 2</label>
                                        <input type="number" class="form-control" id="inputPassword4" value="{{$gd_game->triple_pana_value2}}">
                                    </div>
                                    
                                    <div class="col-md-6 form-group">
                                        <label for="inputCity" class="form-label">Half Sangam Value 1</label>
                                        <input type="number" class="form-control" id="inputCity"  value="{{$gd_game->Half_Sangam_Value1}}">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="inputCity" class="form-label">Half Sangam Value 2</label>
                                        <input type="number" class="form-control" id="inputCity" value="{{$gd_game->Half_Sangam_Value1}}">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="inputCity" class="form-label">Fulll Sangam Value 1</label>
                                        <input type="number" class="form-control" id="inputCity" value="{{$gd_game->Half_Sangam_Value1}}">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="inputCity" class="form-label">Full Sangam Value 2</label>
                                        <input type="number" class="form-control" id="inputCity" value="{{$gd_game->Half_Sangam_Value2}}">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <button type="submit" class="btn btn-primary">Add Game Rate</button>
                                    </div>
                                </form>
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
