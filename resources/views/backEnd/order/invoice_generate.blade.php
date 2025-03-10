@extends('backEnd.layouts.master')
@section('title', 'Order Invoice')
@section('content')
    <style>
        .customer-invoice {
            margin: 25px 0;
        }

        .invoice_btn {
            margin-bottom: 15px;
        }

        p {
            margin: 0;
        }

        td {
            padding: 5px !important;
        }

        th.table__header {
            padding: 6px 6px 6px 0;
            background-color: #3d7c82;
            color: #fff;
            border: none;
            text-align: center;
            text-transform: uppercase;
        }

        table tr:nth-child(odd) {
            background-color: #c4d7d9;
        }

        @page {
            margin: 0px;
        }

        img.barcode__image {
            padding: 23px 0px 17px 25px;
            height: 90px;
            width: 180px;
        }

        .invoice_to {
            text-align: right;
        }

        .invoice_form {
            padding-top: 20px;
        }

        table td {
            padding: 5px !important;
            font-size: 14px;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 10px;
        }

        .logo {
            display: flex;
            align-items: center;
            flex: 1 1 auto;
            height: 100%;
            position: relative;
        }

        .logo::after {
            content: '';
            display: block;
            position: absolute;
            width: 109%;
            height: 3px;
            background: #d3d3d3;
            bottom: -15px;
        }

        .logo::before {
            content: '';
            display: block;
            position: absolute;
            width: 70px;
            height: 5px;
            background: #3d7c82;
            left: 0;
            bottom: -16px;
            border-radius: 7px;
            z-index: 1;
        }

        .logo img {
            height: 50px;
            width: auto;
            margin-right: 10px;
        }

        .logo-text {
            font-weight: bold;
            font-size: 20px;
        }

        .creative-agency {
            font-size: 12px;
            color: gray;
        }

        .invoice-text {
            text-align: right;
        }

        .invoice-text span {
            font-size: 54px;
            font-weight: 800;
            color: #3d7c82;
        }

        .website {
            font-size: 16px;
            color: gray;
            text-transform: uppercase;
        }

        .payment-method,
        .total-section {
            background: #3d7c82;
            color: white;
            padding: 5px 10px;
            font-weight: bold;
            margin-top: 20px;
        }

        .total-section {
            max-width: 450px;
            margin-left: auto;
            display: flex;
            justify-content: space-between;
            padding-left: 60px;
        }

        .details {
            margin: 10px 0;
            max-width: 450px;
            text-align: right;
            margin-left: auto;
            padding-left: 60px;
        }

        .details p {
            display: flex;
            justify-content: space-between;
        }

        .terms {
            font-size: 14px;
            color: #666;
            margin-top: 10px;
        }

        .signature {
            margin-top: 30px;
            text-align: right;
            position: absolute;
            bottom: 0;
            right: 0;
        }

        .contact {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
            border-top: 2px solid #ddd;
            padding-top: 10px;
            position: absolute;
            bottom: 0;
            width: 94%;
        }

        .contact::before {
            content: '';
            display: block;
            position: absolute;
            width: 80px;
            height: 4px;
            background: #3d7c82;
            top: -3px;
            left: 0;
        }

        .contact::after {
            content: '';
            display: block;
            position: absolute;
            width: 80px;
            height: 4px;
            background: #3d7c82;
            top: -3px;
            right: 0;
        }

        .contact p {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .contact p i {
            font-size: 1.7rem;
            color: #3d7c82;
        }

        .invoice-bottom {
            gap: 100px;
        }

        .invoice-bottom-left {
            flex: 0 0 300px;
            margin-top: 54px;
        }

        .invoice-bottom-right {
            flex: 1 1 auto;
            text-align: right;
            position: relative;
        }

        @media print {
            .invoice-innter {
                margin-left: 0px !important;
            }

            .invoice_btn {
                margin-bottom: 0 !important;
            }

            .customer-invoice .container {
                max-width: 750px;
            }

            td {
                font-size: 18px;
            }

            p {
                margin: 0;
            }

            header,
            footer,
            .no-print,
            .left-side-menu,
            .navbar-custom {
                display: none !important;
            }
        }
    </style>
    <div class="container-fluid no-print">
        <div class="row">
            <div class="col-sm-12">
                <div class="card mt-2">
                    <div class="card-body">
                        <form action="" class="row">
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="member_id" class="form-label">Member ID:</label>
                                    <select name="member_id" class="select2 form-control" id="member_id">
                                        <option value="">Select..</option>
                                        @foreach ($members as $key => $member)
                                            <option value="{{ $member->id }}">{{ $member->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="start_date" class="form-label">Start Date:</label>
                                    <input type="date" class="form-control flatpickr" placeholder="Start Date"
                                        id="start_date" name="start_date" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="end_date" class="form-label">End Date:</label>
                                    <input type="date" class="form-control flatpickr" placeholder="End Date"
                                        id="end_date" name="end_date" required>
                                </div>
                            </div>
                            <div class="col-sm-3 mt-3">
                                <button type="submit" class="btn btn-primary">Generate Invoice</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (count($orderdetails))
        <section class="customer-invoice">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <a href="javascript:history.back()" class="no-print">
                            <strong><i class="fe-arrow-left"></i> Back To Order</strong>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <button onclick="printFunction()" class="no-print btn btn-primary waves-effect waves-light"><i
                                class="fa fa-print"></i> Print</button>
                        <button class="no-print btn  btn-success waves-effect waves-light" data-bs-toggle="modal"
                            data-bs-target="#seller_payment"><i class="fa-solid fa-paper-plane"></i> Send To Buyer</button>

                    </div>
                    <div class="col-sm-12 mt-3">
                        <div class="invoice-innter"
                            style="width: 100%;margin: 0 auto;background: #fff;overflow: hidden;padding: 30px;padding-top: 0;position: relative;padding-bottom: 100px;">
                            <div class="invoice-header">
                                <div class="logo">
                                    <img src="{{ asset($generalsetting->dark_logo) }}" alt="Logo">
                                    <!-- Replace with your logo -->
                                    <div>

                                    </div>
                                </div>
                                <div class="invoice-text">
                                    <span>INVOICE</span><br>
                                    <div class="website">photo-lab.net</div>
                                </div>
                            </div>
                            <table style="width: 100%;">
                                <tr style="background-color: #fff;">
                                    <td style="width: 40%; float: left; padding-top: 15px;border-color: #fff">


                                        <div class="invoice_form ">
                                            <p style="font-size: 16px; line-height: 1.8; color: #222;"><strong>Invoice
                                                    To:</strong></p>
                                            <p style="font-size: 16px; line-height: 1.8; color: #222; text-align: left;">
                                                <strong style="font-size: 19px;">{{ $member_info->name }}</strong>
                                            </p>
                                            <p style="font-size: 16px; line-height: 1.8; color: #222; text-align: left;">
                                                {{ $member_info->phone }}
                                            </p>
                                            <p style="font-size: 16px; line-height: 1.8; color: #222; text-align: left;">
                                                {{ $member_info->email }}
                                            </p>
                                            <p style="font-size: 16px; line-height: 1.8; color: #222; text-align: left;">
                                                {{ $member_info->address }}
                                            </p>
                                        </div>
                                    </td>
                                    <td style="width: 60%; float: left;border-color: #fff">

                                        <div class="invoice_to" style="padding-top: 20px;">
                                            {{-- <div class="invoice_bar">
                                                <img class="barcode__image"
                                                    src="data:image/png;base64,{{ DNS1D::getBarcodePNG(50, 'C39+', 1.5, 60.0) }}" />
                                            </div> --}}
                                            <p style="font-size: 16px; line-height: 1.8; color: #222;"><strong>Invoice
                                                    Number: {{ Str::random(16) }}</strong></p>

                                            <p style="font-size: 16px; line-height: 1.8; color: #222; text-align: right;">
                                                {{ Carbon\Carbon::now()->format('d M Y') }}
                                            </p>

                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table class="table" style="margin-top: 30px; margin-bottom: 0;">
                                <thead style="color: #222;">
                                    <tr>
                                        <th class="table__header">NO</th>
                                        <th class="table__header">Order Date</th>
                                        <th class="table__header">Order Name</th>
                                        <th class="table__header">Total Image</th>
                                        <th class="table__header">Unit Price</th>
                                        <th class="table__header">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total_amount = 0;
                                        $total_discount = 0;
                                        $conversion_rate = 110; // Example: 1 USD = 110 BDT (adjust as needed)
                                    @endphp
                                    @foreach ($orderdetails as $details)
                                        <tr>
                                            <td style="border-color:#ddd;text-align: center;">{{ $loop->iteration }}</td>
                                            <td style="border-color:#ddd;text-align: center;">
                                                {{ date('d M Y, h:i A', strtotime($details->created_at)) }}</td>
                                            <td style="border-color:#ddd;text-align: center;">
                                                {{ $details->order?->order_name }}</td>
                                            <td style="border-color:#ddd;text-align: center;">{{ $details->qty }}</td>
                                            <td style="border-color:#ddd;text-align: center;">
                                                {{ $details->order?->currency == 'usd' ? '$' : '৳' }}
                                                {{ $details->sale_price }}</td>
                                            <td style="border-color:#ddd;text-align: center;">
                                                {{ $details->order?->currency == 'usd' ? '$' : '৳' }}
                                                {{ $details->sale_price * $details->qty }}</td>
                                        </tr>

                                        @php
                                            $currency = $details->order?->currency; // Get currency
                                            $subtotal = $details->sale_price * $details->qty;

                                            if ($currency == 'usd') {
                                                $total_amount += round($subtotal * $conversion_rate, 2);
                                            } else {
                                                $total_amount += $subtotal;
                                            }
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="invoice-bottom d-flex">
                                <div class="invoice-bottom-right order-2">
                                    <div class="details">
                                        <p><strong>Sub Total:</strong>
                                            <strong>{{ $member_info->type == 'buyer' ? '$' : '৳' }}
                                                {{ $total_amount }}</strong>
                                        </p>
                                        <p><strong>Discount:</strong>
                                            <strong>{{ $member_info->type == 'buyer' ? '$' : '৳' }}
                                                {{ $total_discount }}</strong>
                                        </p>
                                    </div>
                                    <div class="total-section">GRAND TOTAL:
                                        <strong>{{ $member_info->type == 'buyer' ? '$' : '৳' }}
                                            {{ $total_amount - $total_discount }}</strong>
                                    </div>
                                    <div class="signature">
                                        <p><strong>Henrietta Mitchell</strong></p>
                                        <p>Administrator</p>
                                    </div>
                                </div>
                                <div class="invoice-bottom-left">
                                    <div class="payment-method">PAYMENT METHOD:</div>
                                    <p style="margin-top: 20px">Bank Name: Borcelle</p>
                                    <p>Account Number: 123-456-7890</p>
                                    <hr style="height: 3px; color: #a7a7a7">
                                    <p style="margin-bottom: 20px;"><strong>Thank you for business with us!</strong></p>

                                    <div class="terms">
                                        <p><strong>Term and Conditions:</strong></p>
                                        <p>Please send payment within 30 days of receiving this invoice. There will be a 10%
                                            interest charge per month on late invoices.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="contact">
                                <p><i class="fa fa-contact-book"></i> 123-456-7890</p>
                                <p><i class="fa fa-envelope"></i> hello@reallygreatsite.com</p>
                                <p><i class="fa fa-location-pin"></i> 123 Anywhere St, Any City</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('admin.orders.invoice_save') }}" method="POST" class="d-inline">
                @csrf
                <input type="hidden" name="member_id" value="{{ $member_info->id }}">
                <input type="hidden" name="order_ids" value="{{ json_encode($order_ids) }}">
                <div class="modal fade" id="seller_payment" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="ApproveLabel">Payment Invoice</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="subject">Payment Method <span>*</span></label>
                                    <select name="payment_method" class="form-control" required>
                                        <option value="">Select..</option>
                                        <option value="bkash">Bkash</option>
                                        <option value="nagad">Nagad</option>
                                        <option value="bank">Bank</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="account_number">Account Number<span>*</span></label>
                                    <input type="text" name="account_number" class="form-control" value=""
                                        required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="trx_id">Trx ID<span>*</span></label>
                                    <input type="text" name="trx_id" class="form-control" value="" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Approve</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
        <script>
            function printFunction() {
                window.print();
            }
        </script>
    @endif
@endsection
