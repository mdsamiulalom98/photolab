@extends('backEnd.layouts.master')
@section('title', ' Order')
@section('content')
    @php
        $type = request()->get('type') ?? 'seller';
    @endphp
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">{{ request()->get('type') == 2 ? 'Get Quote' : 'Free Trial' }} Orders
                        ({{ $show_data->count() }})</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <!-- end page title -->
        <div class="row order_page">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-2">
                            <a
                                href="{{ route('admin.trial_order.bulk_destroy') }}"class="btn rounded-pill btn-danger order_delete"><i
                                    class="fe-plus"></i> Delete All
                            </a>

                        </div>
                        <div class="table-responsive ">
                            <table id="datatable-buttons" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check">
                                                <label class="form-check-label">All
                                                    <input type="checkbox" class="form-check-input checkall" value="">
                                                    (<span id="checkedCount">0</span>)
                                                </label>
                                            </div>
                                        </th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th class="white-space-nowrap">Order Placed</th>
                                        <th class="white-space-nowrap">Prefer Delivery</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($show_data as $key => $value)
                                        <tr>
                                            <td><input type="checkbox" class="checkbox" value="{{ $value->id }}"></td>
                                            <td
                                                class="white-space-nowrap {{ $value->seen == 0 ? 'fw-bold text-danger' : '' }}">
                                                {{ $value->name ?? '' }}
                                            </td>
                                            <td>{{ $value->phone ?? '' }}</td>
                                            <td>{{ $value->email ?? '' }}</td>
                                            <td>{{ date('d-M-Y', strtotime($value->create_at)) }} |
                                                {{ date('h:i:s A', strtotime($value->create_at)) }}</td>
                                            <td>{{ $value->pre_delivery_time }}</td>
                                            <td><span class="btn btn-info rounded-pill btn-xs">{{ $value->status }}</span>
                                            </td>
                                            <td class="white-space-nowrap">
                                                <div class="button-list">
                                                    <a href="{{ route('admin.trial.details', ['id' => $value->id]) }}"
                                                        class="btn btn-success  waves-effect btn-xs" title="Invoice"><i
                                                            class="fe-eye"></i></a>
                                                    <form method="post" action="{{ route('admin.trial_order.destroy') }}"
                                                        class="d-inline">
                                                        @csrf
                                                        <input type="hidden" value="{{ $value->id }}" name="id">
                                                        <button type="submit"
                                                            class="btn btn-xs btn-danger waves-effect waves-light delete-confirm"><i
                                                                class="mdi mdi-close"></i></button>
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
        })
    </script>
    <script>
        $(document).ready(function() {
            function updateCheckedCount() {
                let count = $(".checkbox:checked").length;
                $("#checkedCount").text(count);
            }

            $(".checkbox").on("change", function() {
                updateCheckedCount();
            });

            // Initial count on page load
            updateCheckedCount();

            $(".checkall").on('change', function() {
                $(".checkbox").prop('checked', $(this).is(":checked"));
                updateCheckedCount();
            });
        });
    </script>
@endsection
