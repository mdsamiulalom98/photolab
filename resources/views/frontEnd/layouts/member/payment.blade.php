@extends('frontEnd.layouts.member.master')
@section('title', 'Payment')
@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <h6><strong>Payment</strong></h6>
            </div>
            <div class="col-sm-6">
                <div class="payment-btns text-end">
                    <ul>
                        <li><a data-bs-toggle="modal" data-bs-target="#payment_modal" class="btn btn-primary">Payment
                                Request</a></li>
                        <li><a href="{{ route('member.parcel.payable') }}" class="btn btn-success">Payable Parcel</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content">
        <div class="row d-none">
            <div class="col-sm-3">
                <div class="payable-box">
                    <p>Cod Amount</p>
                    <h4>$ </h4>
                </div>
            </div>
            <!-- col end -->
            <div class="col-sm-3">
                <div class="payable-box">
                    <p>Delivery Charge</p>
                    <h4>$ </h4>
                </div>
            </div>
            <!-- col end -->
            <div class="col-sm-3">
                <div class="payable-box">
                    <p>Cod Charge</p>
                    <h4>$ </h4>
                </div>
            </div>
            <!-- col end -->
            <div class="col-sm-3">
                <div class="payable-box">
                    <p>Payable Amount</p>
                    <h4>$ </h4>
                </div>
            </div>
            <!-- col end -->
        </div>
    </div>
    <div class="custom-filter d-none">
        <div class="row">
            <div class="col-sm-8 col-6">
                <h6><strong>Payment History</strong></h6>
            </div>
            <div class="col-sm-4 col-6">
                <form class="filter-form">
                    <div class="form-group">
                        <select class="form-control select2" name="filter" onchange="this.form.submit()">
                            <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>All</option>
                            <option value="today" {{ request('filter') == 'today' ? 'selected' : '' }}>Today</option>
                            <option value="week" {{ request('filter') == 'week' ? 'selected' : '' }}>Last 7 Days</option>
                            <option value="month" {{ request('filter') == 'month' ? 'selected' : '' }}>This Month</option>
                            <option value="last-month" {{ request('filter') == 'last-month' ? 'selected' : '' }}>Last Month
                            </option>
                            <option value="year" {{ request('filter') == 'year' ? 'selected' : '' }}>This Year</option>
                            <option value="last-year" {{ request('filter') == 'last-year' ? 'selected' : '' }}>Last Year
                            </option>
                        </select>
                    </div>
                    <!--col-sm-3-->
                </form>
            </div>
        </div>
    </div>
    <div class="page-content">
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th class="desktop-show">Date</th>
                            <th>Invoice</th>
                            <th class="desktop-show">Cod</th>
                            <th class="desktop-show">Charge</th>
                            <th class="desktop-show">Payable Amount</th>
                            <th class="mobile-show">Amount</th>
                            <th>Status</th>
                            <th class="desktop-show">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $key => $value)
                            <tr>
                                <td class="desktop-show">{{ $value->created_at->format('d m, Y h:m A') }}</td>
                                <td><a href="{{ route('member.payment.invoice', $value->invoice_id) }}">{{ $value->invoice_id }}
                                        <p class="mobile-show mt-2">Date: {{ $value->created_at->format('d m, Y h:m A') }}
                                        </p></a></td>
                                <td class="desktop-show">$ {{ $value->cod }}</td>
                                <td class="desktop-show">$ {{ $value->delivery_charge + $value->cod_charge }}</td>
                                <td class="desktop-show">$ {{ $value->payable_amount }}</td>
                                <td class="mobile-show d-none">
                                    <p>Cod : $ {{ $value->payable_amount }}</p>
                                    <p>Charge : $ {{ $value->cod_charge }}</p>
                                    <p>Payable : $ {{ $value->payable_amount }}</p>
                                </td>
                                <td><span
                                        class="@if ($value->status == 'paid') success @else warning @endif">{{ $value->status }}</span>
                                    <br> Trx: {{ $value->trx_id }}</td>
                                <td class="desktop-show"><a href="{{ route('member.payment.invoice', $value->invoice_id) }}"
                                        class="btn-view">View</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="payment-total">
                        <tr>
                            <td colspan="1"></td>
                            <td><strong>Total</strong></td>
                            <td>
                                <p>${{ $payments->sum('cod') }} </p>
                            </td>
                            <td>
                                <p> ${{ $payments->sum('delivery_charge') + $payments->sum('cod_charge') }}</p>
                            </td>
                            <td>
                                <p> ${{ $payments->sum('payable_amount') }}</p>
                            </td>
                            <td colspan="2"></td>
                        </tr>
                    </tfoot>
                    <tfoot class="payment-footer">
                        <tr>
                            <td><strong>Total</strong></td>
                            <td>
                                <p>Cod: ${{ $payments->sum('cod') }}</p>
                                <p>Charge: ${{ $payments->sum('delivery_charge') + $payments->sum('cod_charge') }}</p>
                                <p>Payable: {{ $payments->sum('payable_amount') }}</p>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="custom-paginate">
                    {{ $payments->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="payment_modal" tabindex="-1" aria-labelledby="payment_modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="payment_modalLabel">Payment Request</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('member.payment.request') }}" method="POST" enctype="multipart/form-data"
                        data-parsley-validate="">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 mb-3">
                                <div class="form-group">
                                    <label for="payment_method" class="mb-2"></label>
                                    <select class="form-control" name="payment_method" id="payment_method">
                                        <option value="">Select..</option>
                                        <option value="bank" data-method="{{ $memberpay->account_number ?? '' }}"
                                            {{ Auth::guard('member')->user()->default_method == 'bank' ? 'selected' : '' }}>
                                            Bank</option>
                                        <option value="bkash" data-method="{{ $memberpay->bkash ?? '' }}"
                                            {{ Auth::guard('member')->user()->default_method == 'bkash' ? 'selected' : '' }}>
                                            Bkash</option>
                                        <option value="nagad" data-method="{{ $memberpay->nagad ?? '' }}"
                                            {{ Auth::guard('member')->user()->default_method == 'nagad' ? 'selected' : '' }}>
                                            Nagad</option>
                                        <option value="rocket" data-method="{{ $memberpay->rocket ?? '' }}"
                                            {{ Auth::guard('member')->user()->default_method == 'rocket' ? 'selected' : '' }}>
                                            Rocket</option>
                                        <option value="cash"
                                            {{ Auth::guard('member')->user()->default_method == 'cash' ? 'selected' : '' }}>
                                            Cash</option>
                                    </select>
                                </div>
                                <p class="text-success mt-1" id="method_msg"></p>
                                <!-- form group -->
                                <div class="form-group mt-3">
                                    <button class="btn btn-primary" id="submitBtn">Submit</button>
                                </div>
                            </div>
                            <!-- col end -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $('#payment_method').on('change', function() {
            var method = $(this).val();
            var number = $(this).find('option:selected').data('method');
            if (number != '') {
                if (method == 'cash') {
                    $('#method_msg').text('You can collect your payment from office');
                } else {
                    $('#method_msg').text('Your ' + method + ' number is: ' + number);
                }
                $('#submitBtn').prop('disabled', false);
            } else {
                $('#method_msg').html('No ' + method +
                    ' number is added to your account! <a href="{{ route('member.settings') }}">Add Now</a>');
                $('#submitBtn').prop('disabled', true);
            }
        })
    </script>
@endpush
