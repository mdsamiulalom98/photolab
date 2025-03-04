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

    p {
        margin: 0;
    }

    td {
        padding: 5px !important;
    }
    th.table__header {
        padding: 6px 6px 6px 0;
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
        padding-top: 30px;
    }
    table td {
        padding: 5px !important;
        font-size: 14px;
    }

    @media print {
        .invoice-innter {
            margin-left: 0px !important;
        }

        .invoice_btn {
            margin-bottom: 0 !important;
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
<section class="customer-invoice">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <a href="javascript:history.back()" class="no-print">
                    <strong><i class="fe-arrow-left"></i> Back To Order</strong>
                </a>
            </div>
            <div class="col-sm-6">
                <button onclick="printFunction()" class="no-print btn btn-primary waves-effect waves-light"><i class="fa fa-print"></i> Print</button>
     
            </div>
            <div class="col-sm-12 mt-3">
                <div class="invoice-innter" style="width: 100%; margin: 0 auto; background: #fff; overflow: hidden; padding: 30px; padding-top: 0;">
                    <table style="width: 100%;">
                        <tr>
                            <td style="width: 40%; float: left; padding-top: 15px;">
                                <img src="{{ asset($generalsetting->dark_logo) }}" style="margin-top: 25px !important; width: 160px;" alt="" />
                                <div class="invoice_form mt-3 text-left">
                                    <p style="font-size: 16px; line-height: 1.8; color: #222;"><strong>Send From</strong></p>
                                    <p style="font-size: 16px; line-height: 1.8; color: #222;">{{ $generalsetting->name }}</p>
                                    <p style="font-size: 16px; line-height: 1.8; color: #222;">{{ $contact->phone }}</p>
                                    <p style="font-size: 16px; line-height: 1.8; color: #222;">{{ $contact->address }}</p>
                                </div>
                            </td>
                            <td style="width: 60%; float: left;">
                                
                                <div class="invoice_to" style="padding-top: 20px;">
                                    <div class="invoice_bar">
                                    <img class="barcode__image" src="data:image/png;base64,{{DNS1D::getBarcodePNG(50, 'C39+',1.5,60.0)}}" />
                                </div>
                                    <p style="font-size: 16px; line-height: 1.8; color: #222; text-align: right;">
                                        <strong>Sent To</strong>
                                    </p>
                                    <p style="font-size: 16px; line-height: 1.8; color: #222; text-align: right;">
                                        {{ $member_info->name}}
                                    </p>
                                    <p style="font-size: 16px; line-height: 1.8; color: #222; text-align: right;">
                                        {{ $member_info->email}}
                                    </p>
                                    <p style="font-size: 16px; line-height: 1.8; color: #222; text-align: right;">
                                        {{ $member_info->phone}}
                                    </p>
                                    <p style="font-size: 16px; line-height: 1.8; color: #222; text-align: right;">
                                        {{ $member_info->address}}
                                    </p>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <table class="table" style="margin-top: 30px; margin-bottom: 0;">
                        <thead style="color: #222;">
                            <tr>
                                <th class="table__header">Order Date</th>
                                <th class="table__header">Service Name</th>
                                <th class="table__header">Total Image</th>
                                <th class="table__header">Unit Price</th>
                                <th class="table__header">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                             @php
                                $total_amount = 0;
                                $total_discount = 0;
                            @endphp
                            @foreach($payment->paymentdetails as $details)
                           
                            <tr>
                                <td style="border-color:#ddd">{{ date('d M Y, h:i A', strtotime($details->created_at)) }}</td>
                                <td style="border-color:#ddd">{{$details->service_name}}</td>
                                <td style="border-color:#ddd">{{$details->qty}}</td>
                                <td style="border-color:#ddd">{{$details->currency == 'usd' ? '$' : '৳'}} {{$details->sale_price}}</td>
                                <td style="border-color:#ddd">{{$details->currency == 'usd' ? '$' : '৳'}} {{$details->sale_price*$details->qty}}</td>
                            </tr>

                            @php
                                $total_amount += $details->sale_price * $details->qty;
                            @endphp

                            @endforeach
                        </tbody>
                    </table>
                    <div class="invoice-bottom">
                        <table class="table border bordered" style="width: 390px; float: right; margin-bottom: 20px;">
                            <tbody>
                                <tr >
                                    <td class="border"><strong>Total</strong></td>
                                    <td><strong>{{$member_info->type == 'buyer' ? '$' : '৳'}} {{ $total_amount}}</strong></td>
                                </tr>
                                <tr>
                                    <td class="border"><strong>Discount</strong></td>
                                    <td><strong>{{$member_info->type == 'buyer' ? '$' : '৳'}} {{ $total_discount }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="border"><strong>Final Total</strong></td>
                                    <td><strong>{{$member_info->type == 'buyer' ? '$' : '৳'}} {{ $total_amount - $total_discount }}</strong></td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="terms-condition" style="overflow: hidden; width: 100%; text-align: center; padding: 20px 0; border-top: 1px solid #ddd;">
                            <h5 style="font-style: italic;"><a href="{{ route('page', ['slug' => 'terms-condition']) }}">Terms & Conditions</a></h5>
                            <p style="text-align: center; font-style: italic; font-size: 15px; margin-top: 10px;">* This is a computer generated invoice, does not require any signature.</p>
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
