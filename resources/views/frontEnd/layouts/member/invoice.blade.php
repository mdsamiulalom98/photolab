@extends('frontEnd.layouts.member.master')
@section('title', 'Merchant Invoice')
@section('content')
    <style>
        .customer-invoice {
            margin: 25px 0;
        }

        .invoice_btn {
            margin-bottom: 15px;
        }

        td {
            font-size: 16px;
        }

        @page {
            size: a4;
            margin: 0mm;
            background: #F9F9F9
        }

        @media print {
            td {
                font-size: 18px;
            }

            header,
            footer,
            .no-print {
                display: none !important;
            }
        }
    </style>
    <section class="customer-invoice ">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <a href="{{ route('member.orders') }}"><strong><i class="fa-solid fa-arrow-left"></i>
                            Back</strong></a>
                </div>
                <div class="col-sm-6">
                    <button onclick="printFunction()" class="no-print btn btn-success invoice_btn"><i class="fa fa-print"></i></button>
                </div>

                <div class="col-sm-12">
                    <div class="invoice-innter"
                        style="width: 900px;margin: 0 auto;background: #fff;overflow: hidden;padding: 30px;padding-top: 0;">
                        <table style="width:100%">
                            <tr>
                                <td style="width: 40%; float: left; padding-top: 15px;">
                                    <img src="{{ asset($generalsetting->white_logo) }}"
                                        style="margin-top:25px !important;width:150px" alt="">
                                    <p style="font-size: 14px; color: #222;margin-top: 10px; display: none;"><strong>Payment
                                            Method:</strong> <span
                                            style="text-transform: uppercase;">{{ $payment->payment_method }}</span></p>
                                    @if ($payment->trx_id)
                                        <p style="font-size: 14px; color: #222;"><strong>Trx Id:</strong>
                                            <span
                                                style="text-transform: uppercase;">{{ $payment->trx_id }}</span>
                                        </p>
                                    @endif
                                    <div class="invoice_form" style="margin-top:7px">
                                        <p style="font-size:16px;line-height:1.8;color:#222"><strong>Invoice From:</strong>
                                        </p>
                                        <p style="font-size:16px;line-height:1.8;color:#222">{{ $generalsetting->name }}</p>
                                        <p style="font-size:16px;line-height:1.8;color:#222">{{ $contact->phone }}</p>
                                        <p style="font-size:16px;line-height:1.8;color:#222">{{ $contact->email }}</p>
                                        <p style="font-size:16px;line-height:1.8;color:#222">{{ $contact->address }}</p>
                                    </div>
                                </td>
                                <td style="width:60%;float: left;">
                                    <div class="invoice-bar"
                                        style=" background: #3F9669; transform: skew(38deg); width: 100%; margin-left: 65px; padding: 15px 60px; ">
                                        <p
                                            style="font-size: 25px; color: #fff; transform: skew(-38deg); text-transform: uppercase; text-align: right; font-weight: bold;">
                                            Invoice</p>
                                    </div>
                                    <div class="invoice-bar"
                                        style="background:#fff; transform: skew(36deg); width: 75%; margin-left: 182px; padding: 8px 42px; margin-top: 4px;text-align:right">
                                        <p style="transform: skew(-36deg);display:inline-block">Invoice Date:
                                            <strong>{{ $order->created_at->format('d-m-y') }}</strong></p>
                                        <p style="transform: skew(-36deg);display:inline-block;margin-right: 18px;">Invoice
                                            No: <strong>{{ $order->invoice_id }}</p>
                                        </p>
                                    </div>
                                    <div class="invoice_to" style="padding-top: 0px;">
                                        <p style="font-size:16px;line-height:1.8;color:#222;text-align: right;">
                                            <strong>Invoice To:</strong></p>
                                        <p
                                            style="font-size:16px;line-height:1.8;color:#222;text-align: right;font-weight:normal">
                                            {{ $order->member ? $order->member->name : '' }}</p>
                                        <p
                                            style="font-size:16px;line-height:1.8;color:#222;text-align: right;font-weight:normal">
                                            {{ $order->member ? $order->member->phone : '' }}</p>
                                        <p
                                            style="font-size:16px;line-height:1.8;color:#222;text-align: right;font-weight:normal">
                                            {{ $order->member ? $order->member->address : '' }}</p>
                                        <p style="text-align:right;text-transform:capitalize;"><span
                                                class="@if ($payment->status == 'paid') success @else warning @endif">{{ $payment->status }}</span>
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <table class="table" style="margin-top: 20px">
                            <thead style="background: #3F9669; color: #fff;">
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderdetails as $value)
                                    <tr>
                                        <td>{{ $value->product_name }}</td>
                                        <td>${{ $value->sale_price }}</td>
                                        <td>{{ $value->qty }}</td>
                                        <td>${{ $value->sale_price * $value->qty }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="invoice-bottom">
                            <table class="table" style="width: 300px; float: right;margin-bottom: 30px;">
                                <tbody style="background:#3F9669">
                                    <tr style="color:#fff">
                                        <td style="font-weight: 600;font-size:15px">Order Items</td>
                                        <td style="font-weight: 600;font-size:15px">
                                            {{ $order->orderdetails->count() ?? 0 }}</td>
                                    </tr>
                                    <tr style="color:#fff">
                                        <td style="font-weight: 600;font-size:15px">Total</td>
                                        <td style="font-weight: 600;font-size:15px">${{ $order->amount }}</td>
                                    </tr>

                                </tbody>
                            </table>
                            <div class="terms-condition"
                                style="overflow: hidden; width: 100%; text-align: center; padding: 20px 0; border-top: 1px solid #ddd;">
                                <h5 style="font-style: italic;"><a
                                        href="{{ route('page', ['slug' => 'terms-condition']) }}">Terms & Conditions</a></h5>
                                <p style="text-align: center; font-style: italic; font-size: 15px; margin-top: 10px;">* This
                                    is a computer generated invoice, does not require any signature.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <script>
        function printFunction() {
            window.print();
        }
    </script>

@endsection
