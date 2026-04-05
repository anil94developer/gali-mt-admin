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
                                <h5 class="panel-title txt-dark">Gali Disawar Bid History List</h5>
                            </div>
                            <div class="pull-right">

                                <form method="get">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php 
                                            if (isset($_GET['market_date'])) {
        $date = $_GET['market_date'];
    } else {
        $date = date('Y-m-d');
    }
                                            ?>
                                            <input type="date" name="market_date" id="market_date" value="{{$date}}"
                                                class="form-control" placeholder="Select Date" required>

                                        </div>

                                        <div class="col-md-3">
                                            {{--
                                            <?php 
                                                if(isset($_GET['select_market']))
                                                {
                                                    $date = $_GET['select_market'];
                                                }else{
                                                    $date = $_GET['None'];
                                                }
                                                ?> --}}
                                            <select class="form-control" name="select_market" id="select_market" required>
                                                <option value="">Select Market</option>
                                                @foreach ($market_data as $item)
                                                    <option value="{{ $item->market_id }}">{{ $item->market_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3">

                                            <button type="button" onclick="get_data11()"
                                                class="btn btn-success">Search</button>

                                        </div>

                                        <div class="col-md-3">
                                            {{-- <a href="{{URL::to('/administrator/dashboard')}}"
                                                class="btn btn-success">Refresh Today</a> --}}
                                        </div>
                                    </div>
                                    {{ Form::close() }}
                            </div>
                        </div>

                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <input type="checkbox" id="select_all_header" />
                                        <label for="select_all">Select All</label>
                                    </div>
                                    <button id="delete_selected" class="btn btn-danger btn-sm" disabled>Delete Selected
                                        Bets</button>
                                </div>
                                <div class="table-wrap mt-40">
                                    <div class="table-responsive">
                                        <table id="gd_bid_history" class="table mb-0">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <input type="checkbox" id="select_all_header" />
                                                    </th>
                                                    <th>Sr.</th>
                                                    <th>User Name</th>
                                                    <th>Mobile No.</th>
                                                    <th>Game Type</th>
                                                    <th>Market id </th>
                                                    <th>Amount</th>
                                                    <th>Bat key</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
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
        function myFunction(id) {
            var copyText = document.getElementById("myInput_" + id);
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices
            navigator.clipboard.writeText(copyText.value);
            alert("Copied the text: " + copyText.value);
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            // Handle Select All functionality
            $('#select_all_header').on('change', function () {
                const isChecked = $(this).is(':checked');
                $('.select_row').prop('checked', isChecked);
                toggleDeleteButton();
            });

            // Handle individual row selection
            $(document).on('change', '.select_row', function () {
                const allChecked = $('.select_row:checked').length === $('.select_row').length;
                $('#select_all_header').prop('checked', allChecked);
                toggleDeleteButton();
            });

            // Enable/Disable Delete Button
            function toggleDeleteButton() {
                const anyChecked = $('.select_row:checked').length > 0;
                $('#delete_selected').prop('disabled', !anyChecked);
            }

            // Handle Delete Selected Bets
            $('#delete_selected').on('click', function () {
                const selectedIds = [];
                $('.select_row:checked').each(function () {
                    selectedIds.push($(this).data('id'));
                });

                if (selectedIds.length > 0) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'Do you want to delete the selected bets?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ route('bets.delete') }}",
                                type: 'POST',
                                data: {
                                    bet_ids: selectedIds,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function (response) {
                                    if (response.status === 'success') {
                                        Swal.fire({
                                            title: 'Deleted!',
                                            text: response.message,
                                            icon: 'success',
                                            confirmButtonColor: '#3085d6',
                                            confirmButtonText: 'OK'
                                        }).then(() => {
                                            $('#gd_bid_history').DataTable().ajax.reload(); // Reload DataTable
                                            $('#select_all_header').prop('checked', false);
                                            toggleDeleteButton();
                                        });
                                    } else {
                                        Swal.fire({
                                            title: 'Error!',
                                            text: response.message,
                                            icon: 'error',
                                            confirmButtonColor: '#d33',
                                            confirmButtonText: 'OK'
                                        });
                                    }
                                },
                                error: function () {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'An error occurred while deleting the bets. Please try again.',
                                        icon: 'error',
                                        confirmButtonColor: '#d33',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            });
                        }
                    });
                }

            });
        });

    </script>

@endpush