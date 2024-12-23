@extends('backEnd.layouts.master')
@section('title', 'Mission Vission Create')
@section('css')
    <link href="{{ asset('public/backEnd') }}/assets/libs/summernote/summernote-lite.min.css" rel="stylesheet"
        type="text/css" />
@endsection
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('missionvission.index') }}"
                            class="btn btn-primary waves-effect waves-light btn-sm rounded-pill">Manage</a>

                    </div>
                    <h4 class="page-title">Mission Vission Create</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('missionvission.store') }}" method="POST" class=row data-parsley-validate=""
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label for="category" class="form-label">Category Select</label>
                                    <select name="category" class="form-select" id="category">
                                        <option>Select a Category</option>

                                        <option value="1">Mission</option>
                                        <option value="2">Vission</option>

                                    </select>
                                </div>
                            </div>
                            <!-- col-end -->

                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="title" class="my-2">Title *</label>
                                        <input type="text" id="title" name="title" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 mb-3">
                                <div class="form-group">
                                    <label for="description" class="form-label">Description *</label>
                                    <textarea name="description" class="summernote form-control @error('description') is-invalid @enderror" id="description"
                                        rows="5"></textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="status" class="d-block">Status</label>
                                    <label class="switch">
                                        <input type="checkbox" value="1" name="status" checked>
                                        <span class="slider round"></span>
                                    </label>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col end -->
                            <div>
                                <input type="submit" class="btn btn-success" value="Submit">
                            </div>

                        </form>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
    </div>
@endsection



@section('script')
    <script src="{{ asset('public/backEnd/') }}/assets/libs/parsleyjs/parsley.min.js"></script>
    <script src="{{ asset('public/backEnd/') }}/assets/js/pages/form-validation.init.js"></script>
    <script src="{{ asset('public/backEnd/') }}/assets/js/pages/form-advanced.init.js"></script>
    <!-- Plugins js -->
    <script src="{{ asset('public/backEnd/') }}/assets/libs//summernote/summernote-lite.min.js"></script>
    <script>
        $(".summernote").summernote({
            placeholder: "Enter Your Text Here",

        });
    </script>
@endsection