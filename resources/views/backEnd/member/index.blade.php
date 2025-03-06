@extends('backEnd.layouts.master')
@section('title', $member_type . 'Manage')

@section('css')
    <link href="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-select-bs5/css/select.bootstrap5.min.css"
        rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title text-capitalize">{{ $member_type }} Manage</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!--<div class="row mb-3">-->
                        <!--    <div class="col-sm-8"></div>-->
                        <!--    <div class="col-sm-4">-->
                        <!--        <form class="custom_form">-->
                        <!--            <div class="form-group">-->
                        <!--                <input type="text" value="{{ request()->get('keyword') }}" name="keyword" placeholder="Search">-->
                        <!--                <button class="btn  rounded-pill btn-info">Search</button>-->
                        <!--            </div>-->
                        <!--        </form>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <div class="mb-2">
                            <a
                                href="{{ route('admin.members.bulk_destroy') }}"class="btn rounded-pill btn-danger order_delete"><i
                                    class="fe-plus"></i> Delete Members
                            </a>
                            <a
                                href="{{ route('admin.members.bulk_active') }}"class="btn rounded-pill btn-success order_delete"><i
                                    class="fe-plus"></i> Active All
                            </a>
                            <a
                                href="{{ route('admin.members.bulk_inactive') }}"class="btn rounded-pill btn-warning order_delete"><i
                                    class="fe-plus"></i> Inactive All
                            </a>
                        </div>
                        <div class="table-responsive ">
                            <table id="datatable-buttons" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check">
                                                <label class="form-check-label">All <input type="checkbox"
                                                        class="form-check-input checkall" value="">(<span id="checkedCount">0</span>)</label>
                                            </div>
                                        </th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($show_data as $key => $value)
                                        <tr>
                                            <td><input type="checkbox" class="checkbox" value="{{ $value->id }}"></td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->phone }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td>
                                                @if ($value->status == 'active')
                                                    <span class="badge bg-soft-success text-success">Active</span>
                                                @else
                                                    <span
                                                        class="badge bg-soft-danger text-danger">{{ $value->status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="button-list">
                                                    @if ($value->status == 'active')
                                                        <form method="post" action="{{ route('admin.members.inactive') }}"
                                                            class="d-inline">
                                                            @csrf
                                                            <input type="hidden" value="{{ $value->id }}"
                                                                name="hidden_id">
                                                            <button type="button"
                                                                class="btn btn-xs  btn-secondary waves-effect waves-light change-confirm"><i
                                                                    class="fe-thumbs-down"></i></button>
                                                        </form>
                                                    @else
                                                        <form method="post" action="{{ route('admin.members.active') }}"
                                                            class="d-inline">
                                                            @csrf
                                                            <input type="hidden" value="{{ $value->id }}"
                                                                name="hidden_id">
                                                            <button type="button"
                                                                class="btn btn-xs  btn-success waves-effect waves-light change-confirm"><i
                                                                    class="fe-thumbs-up"></i></button>
                                                        </form>
                                                    @endif

                                                    <a href="{{ route('admin.members.edit', $value->id) }}"
                                                        class="btn btn-xs btn-primary waves-effect waves-light"><i
                                                            class="fe-edit-1"></i></a>

                                                    <a href="{{ route('admin.members.profile', ['id' => $value->id]) }}"
                                                        class="btn btn-xs btn-blue waves-effect waves-light"><i
                                                            class="fe-eye"></i></a>

                                                    <form method="post" action="{{ route('admin.members.adminlog') }}"
                                                        class="d-inline" target="_blank">
                                                        @csrf
                                                        <input type="hidden" value="{{ $value->id }}" name="hidden_id">
                                                        <button type="button"
                                                            class="btn btn-xs btn-pink waves-effect waves-light change-confirm"
                                                            title="Login as customer"><i class="fe-log-in"></i></button>
                                                    </form>

                                                    <form method="post" action="{{ route('admin.members.destroy') }}"
                                                        class="d-inline">
                                                        @csrf
                                                        <input type="hidden" value="{{ $value->id }}" name="hidden_id">
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
@endsection

@section('script')
    <!-- third party js -->
    <script src="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js">
    </script>
    <script
        src="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js">
    </script>
    <script src="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js">
    </script>
    <script src="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js">
    </script>
    <script src="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
    <script src="{{ asset('/public/backEnd/') }}/assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="{{ asset('/public/backEnd/') }}/assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="{{ asset('/public/backEnd/') }}/assets/js/pages/datatables.init.js"></script>
    <!-- third party js ends -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // order delete
            $(document).on('click', '.order_delete', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                var order = $('input.checkbox:checked').map(function() {
                    return $(this).val();
                });
                var customer_ids = order.get();

                if (customer_ids.length == 0) {
                    toastr.error('Please Select An Order First !');
                    return;
                }

                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {
                        customer_ids
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
