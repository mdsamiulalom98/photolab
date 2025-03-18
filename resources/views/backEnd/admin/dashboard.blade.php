@extends('backEnd.layouts.master')
@section('title', 'Dashboard')
@section('css')
    <!-- Plugins css -->
    <link href="{{ asset('public/backEnd/') }}/assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/backEnd/') }}/assets/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet"
        type="text/css" />

@endsection
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">

                    </div>
                    <h4 class="page-title">Dashboard</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body border border-success rounded">
                        <div class="row">
                            <div class="col-6">
                                <h3 class="text-dark my-1 "><span data-plugin="counterup">{{ $total_orders }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Total Orders</p>
                            </div>
                            <div class="col-6">
                                <div class="float-right">
                                    <div class="avatar-md bg-success bg-opacity-25 rounded">
                                        <i class="fe-bar-chart-2 avatar-title font-22 text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col-->
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body border border-secondary rounded">
                        <div class="row">
                            <div class="col-6">
                                <h3 class="text-dark my-1"><span data-plugin="counterup">{{ $buyer_orders }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Buyer Orders</p>
                            </div>
                            <div class="col-6">
                                <div class="float-right">
                                    <div class="avatar-md bg-secondary bg-opacity-25 rounded">
                                        <i class="fe-activity avatar-title font-22 text-secondary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col-->
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body border border-warning rounded">
                        <div class="row">
                            <div class="col-6">
                                <h3 class="text-dark my-1"><span data-plugin="counterup">{{ $seller_orders }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Seller Orders</p>
                            </div>
                            <div class="col-6">
                                <div class="float-right">
                                    <div class="avatar-md bg-warning bg-opacity-25 rounded">
                                        <i class="fe-shopping-cart avatar-title font-22 text-warning"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body border border-danger rounded">
                        <div class="row">
                            <div class="col-6">
                                <h3 class="text-dark my-1"><span data-plugin="counterup">{{ $buyer_count }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Total Buyer</p>
                            </div>
                            <div class="col-6">
                                <div class="float-right">
                                    <div class="avatar-md bg-danger bg-opacity-25 rounded">
                                        <i class="fe-users avatar-title font-22 text-danger"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col-->
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body border-primary border rounded">
                        <div class="row">
                            <div class="col-6">
                                <h3 class="text-dark my-1"><span data-plugin="counterup">{{ $seller_count }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Total Seller</p>
                            </div>
                            <div class="col-6">
                                <div class="float-right">
                                    <div class="avatar-md bg-primary bg-opacity-25 rounded">
                                        <i class="fe-users avatar-title font-22 text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col-->
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body border-primary border rounded">
                        <div class="row">
                            <div class="col-6">
                                <h3 class="text-dark my-1"><span data-plugin="counterup">{{ $get_quote }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Get Quote</p>
                            </div>
                            <div class="col-6">
                                <div class="float-right">
                                    <div class="avatar-md bg-primary bg-opacity-25 rounded">
                                        <i class="fa fa-quote-left avatar-title font-22 text-primary text-center" style="line-height: 55px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col-->
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body border-primary border rounded">
                        <div class="row">
                            <div class="col-6">
                                <h3 class="text-dark my-1"><span data-plugin="counterup">{{ $free_trial }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Free Trial</p>
                            </div>
                            <div class="col-6">
                                <div class="float-right">
                                    <div class="avatar-md bg-primary bg-opacity-25 rounded">
                                        <i class="fe-gift avatar-title font-22 text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col-->
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body border-primary border rounded">
                        <div class="row">
                            <div class="col-6">
                                <h3 class="text-dark my-1"><span data-plugin="counterup">{{ $subscribes }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Subscribe</p>
                            </div>
                            <div class="col-6">
                                <div class="float-right">
                                    <div class="avatar-md bg-primary bg-opacity-25 rounded">
                                        <i class="fe-mail avatar-title font-22 text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col-->
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body border-primary border rounded">
                        <div class="row">
                            <div class="col-6">
                                <h3 class="text-dark my-1"><span data-plugin="counterup">{{ $total_blog }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Blog</p>
                            </div>
                            <div class="col-6">
                                <div class="float-right">
                                    <div class="avatar-md bg-primary bg-opacity-25 rounded">
                                        <i class="fe-book avatar-title font-22 text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col-->
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body border-primary border rounded">
                        <div class="row">
                            <div class="col-6">
                                <h3 class="text-dark my-1"><span data-plugin="counterup">{{ $total_portfolio }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Portfolio</p>
                            </div>
                            <div class="col-6">
                                <div class="float-right">
                                    <div class="avatar-md bg-primary bg-opacity-25 rounded">
                                        <i class="fe-image avatar-title font-22 text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col-->
        </div>
        <!-- end row-->


    </div> <!-- container -->
@endsection

