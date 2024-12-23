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
            <div class="col-md-6 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                
                                    <h3 class="text-dark my-1 taka-sign"><span data-plugin="counterup"></span></h3>
                                    <p class="text-muted mb-1 text-truncate">Total Sales</p>
                                
                            </div>
                            <div class="col-6">
                                <div class="float-right">
                                    <div class="avatar-sm bg-blue rounded">
                                        <i class="fe-pie-chart avatar-title font-22 text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end widget-rounded-circle-->
            </div> <!-- end col-->
            <div class="col-md-6 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h3 class="text-dark my-1 taka-sign"><span data-plugin="counterup"></span></h3>
                                <p class="text-muted mb-1 text-truncate">This Month Sales</p>
                            </div>
                            <div class="col-6">
                                <div class="float-right">
                                    <div class="avatar-sm bg-blue rounded">
                                        <i class="fe-bar-chart-2 avatar-title font-22 text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col-->
            <div class="col-md-6 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h3 class="text-dark my-1 taka-sign"><span data-plugin="counterup"></span></h3>
                                <p class="text-muted mb-1 text-truncate">Today Sales</p>
                            </div>
                            <div class="col-6">
                                <div class="float-right">
                                    <div class="avatar-sm bg-blue rounded">
                                        <i class="fe-activity avatar-title font-22 text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col-->
            <div class="col-md-6 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h3 class="text-dark my-1"><span data-plugin="counterup"></span></h3>
                                <p class="text-muted mb-1 text-truncate">Total Order</p>
                            </div>
                            <div class="col-6">
                                <div class="float-right">
                                    <div class="avatar-sm bg-blue rounded">
                                        <i class="fe-shopping-cart avatar-title font-22 text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col-->
            <div class="col-md-6 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h3 class="text-dark my-1"><span data-plugin="counterup"></span></h3>
                                <p class="text-muted mb-1 text-truncate">This Month Orders</p>
                            </div>
                            <div class="col-6">
                                <div class="float-right">
                                    <div class="avatar-sm bg-blue rounded">
                                        <i class="fe-database avatar-title font-22 text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col-->
            <div class="col-md-6 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h3 class="text-dark my-1"><span data-plugin="counterup">0</span></h3>
                                <p class="text-muted mb-1 text-truncate">Customers</p>
                            </div>
                            <div class="col-6">
                                <div class="float-right">
                                    <div class="avatar-sm bg-blue rounded">
                                        <i class="fe-users avatar-title font-22 text-white"></i>
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

