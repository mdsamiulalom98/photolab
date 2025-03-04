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
    .invoice-header {
        display: flex;
        justify-content: space-between;
        padding: 10px 20px;
        background: #35c75a;
    }
    .invoice-name h3 {
        color: #fff;
        font-weight: 800;
        font-size: 30px;
    }
    .invoice-number h4 {
        color: #fff;
        font-size: 28px;
        font-weight: 400;
        padding-top: 4px;
    }
    th.table__header {
        padding: 10px 0px;
        background: #35c75a;
        color: #fff;
        border: none;
        font-size: 17px;
    }
    table tr:nth-child(odd) {
        background-color: #ffffff !important;
    }
    table tr:nth-child(even) {
        background-color: #ffffff !important;
    }



    p {
        margin: 0;
    }

    td {
        padding: 5px !important;
        border:none !important;
    }
    th.table__header {
        padding: 10px;
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
        text-align: left !important;
    }
    
    table td {
        padding: 5px !important;
        font-size: 14px;
    }

    @media print {
        .invoice-innter {
            margin-left: -140px !important;
            padding: 0px !important;
            width: 790px !important;
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
            <div class="col-sm-12 col-lg-12 mt-3">
                <div class="invoice-innter" style="width: 100%; margin: 0 auto; background: #fff; overflow: hidden; padding: 30px; padding-top: 0;">
                    <div class="invoice-header">
                        <div class="invoice-name">
                            <h3>Image Editing Service Invoice</h3>
                        </div>
                        <div class="invoice-number">
                            <h4>Invoice No #{{ $order->invoice_id}}</h4>
                        </div>
                    </div>
                    



                    <table style="width: 100%;">
                        <tr style="background: #fff !important;">
                            <td style="width: 30%; text-align: center; padding-top: 15px;">
                                <img src="{{ asset($generalsetting->dark_logo) }}" style="margin-top: 25px !important; width: 90%;" alt="" />
                            </td>
                            <td style="width: 50%; float: left;">
                                

                                <div class="invoice_form mt-3">
                                    <p style="font-size: 16px; line-height: 1.8; color: #222; font-weight: 700;"><strong>{{ $generalsetting->name }}</strong></p>
                                    <p style="font-size: 16px; line-height: 1.8; color: #222; font-weight: 700;">Reg.no:TRAD/DNCC/027129/202in</p>
                                    <p style="font-size: 16px; line-height: 1.8; color: #222; font-weight: 700;">{{ $contact->email }}</p>
                                    <p style="font-size: 16px; line-height: 1.8; color: #222; font-weight: 700;">{{ $contact->phone }}</p>
                                    <p style="font-size: 16px; line-height: 2.8; color: #222; font-weight: 700;">www.photo-lab.net</p>
                                    <p style="font-size: 16px; line-height: 1.8; color: #222; font-weight: 700;">{{ $contact->address }}</p>
                                </div>
                            </td>
                            <td style="width: 20%; float: left;">
                                
                                <div class="invoice_to" style="padding-top: 20px;">
                                    
                                    <p style="font-size: 16px; line-height: 1.8; color: #222; font-weight: 700; text-align: left;">
                                        <strong>Bill To</strong>
                                    </p>
                                    <p style="font-size: 16px; line-height: 1.8; color: #222; font-weight: 700; text-align: left;">
                                        {{ $member_info->name}} 
                                    </p>
                                    <p style="font-size: 16px; line-height: 1.8; color: #222; font-weight: 700; text-align: left;">
                                        {{ $member_info->email}}
                                    </p>
                                    <p style="font-size: 16px; line-height: 1.8; color: #222; font-weight: 700; text-align: left;">
                                        {{ $member_info->phone}}
                                    </p>
                                    <p style="font-size: 16px; line-height: 1.8; color: #222; font-weight: 700; text-align: left;">
                                        {{ $member_info->address}}
                                    </p>
                                    <br>
                                    <p style="font-size: 16px; line-height: 1.8; color: #222; font-weight: 700; text-align: left;">
                                        <strong>Ref .</strong>
                                    </p>
                                    <p style="font-size: 16px; line-height: 1.8; color: #222; font-weight: 700; text-align: left;">
                                        {{ $member_info->address}}
                                    </p>
                                    <p style="font-size: 16px; line-height: 1.8; color: #222; font-weight: 700; text-align: left;">
                                         TRACKING #{{$order->invoice_id}}
                                    </p>

                                    <!-- <div class="invoice_bar">
                                       <img class="barcode__image" src="data:image/png;base64,{{DNS1D::getBarcodePNG(50, 'C39+',1.5,60.0)}}" />
                                    </div> -->
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
                                <td style="border: 1px solid #36c75b !important; padding: 15px 0px 15px 10px !important;">{{ date('d M Y, h:i A', strtotime($details->created_at)) }}</td>
                                <td style="border: 1px solid #36c75b !important; padding: 15px 0px 15px 10px !important;">{{$details->service_name}}</td>
                                <td style="border: 1px solid #36c75b !important; padding: 15px 0px 15px 10px !important;">{{$details->qty}}</td>
                                <td style="border: 1px solid #36c75b !important; padding: 15px 0px 15px 10px !important;">{{$details->currency == 'usd' ? '$' : '৳'}} {{$details->sale_price}}</td>
                                <td style="border: 1px solid #36c75b !important; padding: 15px 0px 15px 10px !important;">{{$details->currency == 'usd' ? '$' : '৳'}} {{$details->sale_price*$details->qty}}</td>
                            </tr>

                            @php
                                $total_amount += $details->sale_price * $details->qty;
                            @endphp

                            @endforeach
                        </tbody>
                    </table>
                    <div class="invoice-bottom">

                        <table class="table" style="width: 330px; float: right; margin-bottom: 20px; margin-top:40px; font-size: 20px;">
                            <h4 style="float: left; margin-top: 40px; line-height: 28px;"> <strong>Payment Instruction:</strong> <br>Your Payment Method</h4>
                            <tbody>
                                <!-- {{$member_info->type == 'buyer' ? '$' : '৳'}} -->
                                <tr style="font-weight: 800; color: #222;">
                                    <td class="shipping-information"><strong>SubTotal, USD :</strong></td>
                                    <td style="text-align: center;"><strong> {{ $total_amount}}</strong></td>
                                </tr>
                                <tr style="color:#222;">
                                    <td class="shipping-information"><strong>Discount, USD :</strong></td>
                                    <td style="text-align: center;"><strong> {{ $total_discount }}</strong></td>
                                </tr>
                                <tr style="color:#222;">
                                    <td class="shipping-information"><strong>Shipping Cost, USD :</strong></td>
                                    <td style="text-align: center;"><strong> 0</strong></td>
                                </tr>
                                <tr style="color:#222;">
                                    <td class="shipping-information"><strong>Seles Tax, USD :</strong></td>
                                    <td style="text-align: center;"><strong> 0</strong></td>
                                </tr>
                                <tr style="font-weight: 800; color: #222;">
                                    <td class="shipping-information"><strong> Total, USD</strong></td>
                                    <td style="text-align: center;"><strong> {{ $total_amount - $total_discount }}</strong></td>
                                </tr>
                                <tr style="color:#222;">
                                    <td class="shipping-information"><strong>Amount Paid, USD :</strong></td>
                                    <td style="text-align: center;"><strong> 0</strong></td>
                                </tr>
                                <tr style="font-weight: 800; color: #fff; background: #3ac65e !important;">
                                    <td class="shipping-information" style="padding: 10px !important;"><strong> Blance Due , USD</strong></td>
                                    <td style="padding: 10px !important; text-align: center;"><strong> {{ $total_amount - $total_discount }}</strong></td>
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