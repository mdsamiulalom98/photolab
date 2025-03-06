@extends('backEnd.layouts.master')
@section('title', 'Contact Data Manage')

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

                    <h4 class="page-title">Contact Data Manage</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="mb-2">
                        <a href="{{ route('contactdatas.bulk_destroy') }}"class="btn rounded-pill btn-danger order_delete"><i
                                class="fe-plus"></i> Delete Message
                        </a>

                    </div>
                    <div class="card-body">

                        <table id="datatable-buttons" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="form-check">
                                            <label class="form-check-label">All <input type="checkbox"
                                                    class="form-check-input checkall" value="">(<span
                                                    id="checkedCount">0</span>)</label>
                                        </div>
                                    </th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Message</th>
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
                                        <td>{{ $value->message }}</td>
                                        <td>
                                            <div class="button-list">
                                                <form method="post" action="{{ route('contactdatas.destroy') }}"
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
    <script>
        $(document).ready(function() {
            // order delete
            $(document).on('click', '.order_delete', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                var order = $('input.checkbox:checked').map(function() {
                    return $(this).val();
                });
                var info_ids = order.get();

                if (info_ids.length == 0) {
                    toastr.error('Please Select An Order First !');
                    return;
                }

                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {
                        info_ids
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
