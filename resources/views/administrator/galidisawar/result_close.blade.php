@extends('administrator.layout.administrator')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark"> Declare Result</h6>
                </div>
                <div class="pull-right">
                    {{-- <a href="{{route('gali_disawar_game_name_list')}}" class="btn btn-danger">Go Back</a> --}}
                    <a href="{{URL::to('administrator/gali-disawar-game-name-list')}}" class="btn btn-danger">Go
                        Back</a>
                </div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <!-- {{ Form::open(array('url' => 'administrator/result-gd-game-declear')) }} -->
                    {{ Form::open(array('url' => '#')) }}

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-wrap">
                                <div class="form-body">
                                    <hr class="light-grey-hr" />
                                    <div class="row">
                                        <input type="text" name="id" id="id" value="{{$id}}" style="display:none;">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Enter No. Andar<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control" id="andar" name="andar"
                                                        placeholder="Enter Ander No" required><br>

                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Enter No. Bahar<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-7 pt-3">
                                                    <input type="text" class="form-control" id="bahar" name="bahar"
                                                        placeholder="Enter Bahar No" required>

                                                </div>

                                            </div>
                                        </div>

                                        <!-- <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Enter Bahar No.<span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                       <input type="text"class="form-control" name="bahar" placeholder="Enter Bahar No" required >
                                                        @error('bahar')
                                                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <i class="zmdi zmdi-block"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> -->



                                    </div>
                                </div>
                                <div class="form-actions mt-10">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="button" id="submitResult"
                                                        class="btn btn-success  mr-10">Submit</button>
                                                    <!-- <button type="submit" class="btn btn-success  mr-10">Submit</button> -->
                                                    <button type="reset" class="btn btn-default">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6"> </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{asset('/backend/developer/js/subAdmin.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).on('click', '#submitResult', function () {
        // alert('pppp');
        var id = $('#id').val();
        var andar = $('#andar').val();
        var bahar = $('#bahar').val();
        if (andar == '') {
            Swal.fire({
                title: 'Please Enter Andar Result Number',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            })
            exist();
        }
        if (bahar == '') {
            Swal.fire({
                title: 'Please Enter Bahar Result Number',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            })
            exist();
        }

        Swal.fire({
            title: 'Are You Sure Declear Result Andar ' + andar + ' and Bahar ' + bahar,
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Declear',
            denyButtonText: `Don't Declear`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                // Swal.fire('Saved!', '', 'success')
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: BASE_URL + '/administrator/result-gd-game-declear',
                    type: 'POST',
                    data: {
                        id: id, andar: andar, bahar: bahar
                    },
                    success: function (data) {
                        if (data.already_declear) {
                            Swal.fire('Result is Already Declear', '', 'error')

                        }
                        if (data.success) {
                            Swal.fire('Saved!', '', 'success').then((result) => {
                                window.location.href = BASE_URL + '/administrator/gali-disawar-game-name-list';
                            });

                        }
                    },
                    error: function () {
                        console.log('There is some error in user deleting. Please try again.');
                    }
                });
            } else if (result.isDenied) {
                Swal.fire('Result is not Declear!', '', 'info')
            }
        })
    });
</script>
@endpush