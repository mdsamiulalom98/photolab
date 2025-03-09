@extends('backEnd.layouts.master')
@section('title', $order_status->name . ' Order')
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    @if(request()->get('type') == 'seller')
                    <div class="page-title-right">
                        <a href="{{ route('admin.order.create', ['type' => 'seller']) }}" class="btn btn-danger rounded-pill"><i
                                class="fe-shopping-cart"></i> Add New</a>
                    </div>
                    @endif
                    <h4 class="page-title">{{ $order_status->name }} Order ({{ $show_data->count() }})</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <!-- end page title -->
        <div class="row order_page">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-8"></div>
                            <div class="col-sm-4">
                                <form class="custom_form">
                                    <div class="form-group">
                                        <input type="text" name="keyword" placeholder="Search">
                                        <button class="btn  rounded-pill btn-info">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="datatable-buttons" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th style="width: 10%" class="">SL</th>
                                        <th style="width: 20%" class="">Order No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th class="">Order Placed</th>
                                        <th class="">Delivery Time</th>
                                        <th class="">Prefer Delivery</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($show_data as $key => $value)
                                        <tr class="{{$value->order_status == 4 ? 'complete' : (\Carbon\Carbon::parse($value->prefer_delivery)->subHour() <= Carbon\Carbon::now() ? 'coundown' : '') }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td><a href="{{ route('admin.order.details', ['id' => $value->id]) }}">{{ $value->order_name }}</a> </td>
                                            <td class="">
                                                {{ $value->member->name ?? '' }}
                                                <p>{{ $value->member->address ?? '' }}</p>
                                            </td>
                                            <td>{{ $value->member->email ?? '' }}</td>
                                            <td>{{ date('d M Y, h:i A', strtotime($value->created_at)) }}</td>
                                            <td>{{ date('d M Y, h:i A', strtotime($value->delivery_time)) }}</td>
                                            <td class="text-capitalize">{{ $value->prefer_time }} {{ $value->prefer_time > 1 ? $value->time_frame . 's' : $value->time_frame . '' }}</td>
                                            <td>{{$value->currency == 'usd' ? '$' : '৳'}} {{ $value->amount }}</td>
                                            <td>{{ $value->status ? $value->status->name : '' }}</td>
                                            <td class="">
                                                <div class="button-list">
                                                    <a href="{{ route('admin.order.details', ['id' => $value->id]) }}" class="btn btn-xs btn-info waves-effect waves-light"
                                                        title="Invoice"><i class="fe-eye"></i></a>
                                                    <a href="{{ route('admin.order.edit', ['id' => $value->id]) }}" class="btn btn-xs btn-success waves-effect waves-light"
                                                        title="Edit"><i class="fe-edit"></i></a>
                                                    <form method="post" action="{{ route('admin.order.destroy') }}"
                                                        class="d-inline">
                                                        @csrf
                                                        <input type="hidden" value="{{ $value->id }}" name="id">
                                                        <button type="submit" title="Delete" class="btn btn-xs btn-danger waves-effect waves-light delete-confirm "><i
                                                                class="fe-trash-2"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="custom-paginate">
                            {{ $show_data->links('pagination::bootstrap-4') }}
                        </div>
                    </div> <!-- end card body-->

                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
    </div>



    <!-- Assign User End -->
    <div class="modal fade" id="changeStatus" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Order Status Change</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.order.status') }}" id="order_status_form">
                    <div class="modal-body">
                        <div class="form-group">
                            <select name="order_status" id="order_status" class="form-control">
                                <option value="">Select..</option>
                                @foreach ($orderstatus as $key => $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Assign User End-->


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".checkall").on('change', function() {
                $(".checkbox").prop('checked', $(this).is(":checked"));
            });

            // order assign
            $(document).on('submit', 'form#order_assign', function(e) {
                e.preventDefault();
                var url = $(this).attr('action');
                var method = $(this).attr('method');
                let user_id = $(document).find('select#user_id').val();

                var order = $('input.checkbox:checked').map(function() {
                    return $(this).val();
                });
                var order_ids = order.get();

                if (order_ids.length == 0) {
                    toastr.error('Please Select An Order First !');
                    return;
                }

                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {
                        user_id,
                        order_ids
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            toastr.success(res.message);
                            window.location.reload();

                        } else {
                            toastr.error('Failed something wrong');
                        }
                    }
                });

            });

            // order status change
            $(document).on('submit', 'form#order_status_form', function(e) {
                e.preventDefault();
                var url = $(this).attr('action');
                var method = $(this).attr('method');
                let order_status = $(document).find('select#order_status').val();

                var order = $('input.checkbox:checked').map(function() {
                    return $(this).val();
                });
                var order_ids = order.get();

                if (order_ids.length == 0) {
                    toastr.error('Please Select An Order First !');
                    return;
                }

                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {
                        order_status,
                        order_ids
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            toastr.success(res.message);
                            window.location.reload();

                        } else {
                            toastr.error('Failed something wrong');
                        }
                    }
                });

            });
            // order delete
            $(document).on('click', '.order_delete', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                var order = $('input.checkbox:checked').map(function() {
                    return $(this).val();
                });
                var order_ids = order.get();

                if (order_ids.length == 0) {
                    toastr.error('Please Select An Order First !');
                    return;
                }

                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {
                        order_ids
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            toastr.success(res.message);
                            window.location.reload();

                        } else {
                            toastr.error('Failed something wrong');
                        }
                    }
                });

            });

            // multiple print
            $(document).on('click', '.multi_order_print', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                var order = $('input.checkbox:checked').map(function() {
                    return $(this).val();
                });
                var order_ids = order.get();

                if (order_ids.length == 0) {
                    toastr.error('Please Select Atleast One Order!');
                    return;
                }
                $.ajax({
                    type: 'GET',
                    url,
                    data: {
                        order_ids
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            console.log(res.items, res.info);
                            var myWindow = window.open("", "_blank");
                            myWindow.document.write(res.view);
                        } else {
                            toastr.error('Failed something wrong');
                        }
                    }
                });
            });
            // multiple courier
            $(document).on('click', '.multi_order_courier', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                var order = $('input.checkbox:checked').map(function() {
                    return $(this).val();
                });
                var order_ids = order.get();

                if (order_ids.length == 0) {
                    toastr.error('Please Select An Order First !');
                    return;
                }

                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {
                        order_ids
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            toastr.success(res.message);
                            window.location.reload();

                        } else {
                            toastr.error('Failed something wrong');
                        }
                    }
                });

            });
        })
    </script>
@endsection
