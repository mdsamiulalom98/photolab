@extends('backEnd.layouts.master')
@section('title', 'Service Create')
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
                        <a href="{{ route('service.index') }}" class="btn btn-primary rounded-pill">Manage</a>
                    </div>
                    <h4 class="page-title">Service Create</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('service.store') }}" method="POST" class="row" data-parsley-validate=""
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="title" class="form-label">Title *</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        name="title" value="{{ old('title') }}" id="title" required="">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col-end -->

                            <div class="col-sm-12 mb-3">
                                <div class="form-group">
                                    <label for="image" class="form-label">Image ( 445px * 270px ) *</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror "
                                        name="image" value="{{ old('image') }}" id="image" required="">
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col end -->
                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="short_description" class="form-label">Short Description*</label>

                                    <textarea type="text" class="summernote form-control @error('short_description') is-invalid @enderror" name="short_description"
                                        rows="6" value="{{ old('short_description') }}" id="short_description" required=""></textarea>
                                    @error('short_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col-end -->
                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="description" class="form-label">Description*</label>
                                    <textarea type="text" class="summernote form-control @error('description') is-invalid @enderror" name="description"
                                        rows="6" value="{{ old('description') }}" id="description" required=""></textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col-end -->
                            <div class="variable_product">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="names" class="form-label">Price Name *</label>
                                            <input type="text" class="form-control @error('names') is-invalid @enderror"
                                                name="names[]" value="{{ old('names') }}" id="names" />
                                            @error('purchase_price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col-end -->
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="old_prices" class="form-label">Old Price </label>
                                            <input type="number" min="0.0" step="0.01"
                                                class="form-control @error('old_prices') is-invalid @enderror"
                                                name="old_prices[]" value="{{ old('old_prices') }}" id="old_prices" />
                                            @error('old_prices')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col-end -->
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="new_prices" class="form-label">New Price *</label>
                                            <input type="number" min="0.0" step="0.01"
                                                class="form-control @error('new_prices') is-invalid @enderror"
                                                name="new_prices[]" value="{{ old('new_prices') }}" id="new_prices" />
                                            @error('new_prices')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col-end -->


                                    <!-- col end -->
                                    <div class="input-group-btn mt-3">
                                        <button class="btn btn-success increment_btn  btn-xs text-white" type="button"><i
                                                class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="clone_variable" style="display:none">
                                    <div class="row increment_control">

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="names" class="form-label"> Price Name*</label>
                                                <input type="text"
                                                    class="form-control @error('names') is-invalid @enderror"
                                                    name="names[]" value="{{ old('names') }}" id="names" />
                                                @error('names')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col-end -->
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="old_prices" class="form-label">Old Price </label>
                                                <input type="number" min="0.0" step="0.01"
                                                    class="form-control @error('old_prices') is-invalid @enderror"
                                                    name="old_prices[]" value="{{ old('old_prices') }}" min="0.0" step="0.01"
                                                    id="old_prices" />
                                                @error('old_prices')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col-end -->
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="new_prices" class="form-label">New Price *</label>
                                                <input type="number" min="0.0" step="0.01"
                                                    class="form-control @error('new_prices') is-invalid @enderror"
                                                    name="new_prices[]" value="{{ old('new_prices') }}" min="0.0" step="0.01"
                                                    id="new_prices" />
                                                @error('new_prices')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col-end -->

                                        <div class="input-group-btn mt-3">
                                            <button class="btn btn-danger remove_btn  btn-xs text-white" type="button"><i
                                                    class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--variable product  end-->
                            <div class="col-sm-12 mb-3">
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

    <script>
        $(document).ready(function() {
            var serialNumber = 1;
            $(".increment_btn").click(function() {
                var html = $(".clone_variable").html();
                var newHtml = html.replace(/stock\[\]/g, "stock[" + serialNumber + "]");
                $(".variable_product").after(newHtml);
                serialNumber++;
            });
            $("body").on("click", ".remove_btn", function() {
                $(this).parents(".increment_control").remove();
                serialNumber--;
            });
        });
    </script>
@endsection
