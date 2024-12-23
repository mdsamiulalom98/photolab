@extends('backEnd.layouts.master')
@section('title', 'Mission Vission Edit')
@section('css')
    <link href="{{ asset('public/backEnd') }}/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/backEnd') }}/assets/summernote-lite/summernote-lite.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('portfolios.index') }}"
                            class="btn btn-primary waves-effect waves-light btn-sm rounded-pill">Manage</a>
                    </div>
                    <h4 class="page-title">Mission Vission Edit</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('portfolios.update') }}" method="POST" class=row
                            data-parsley-validate="" enctype="multipart/form-data" name="editForm">
                            @csrf
                            <input type="hidden" value="{{ $edit_data->id }}" name="id">

                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label for="category_id" class="form-label"> Category Select</label>
                                    <select name="category_id" class="form-select" id="category_id">
                                        <option>Select a Category</option>
                                        @foreach ($pcategories as $key => $value)
                                        <option {{ $value->id == $edit_data->category_id ? 'selected' : '' }}  value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- col-end -->
                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="image_one" class="form-label">Image One *</label>
                                    <input type="file" class="form-control @error('image_one') is-invalid @enderror "
                                        name="image_one" value="{{ old('image_one') }}" id="image_one">
                                    @error('image_one')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <img style="height: 60px; width: auto; margin-top: 20px" src="{{ asset($edit_data->image_one) }}" alt="">
                            </div>
                            <!-- col end -->
                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="image_two" class="form-label">Image Two *</label>
                                    <input type="file" class="form-control @error('image_two') is-invalid @enderror "
                                        name="image_two" value="{{ old('image_two') }}" id="image_two">
                                    @error('image_two')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <img style="height: 60px; width: auto; margin-top: 20px" src="{{ asset($edit_data->image_two) }}" alt="">
                            </div>
                            <!-- col end -->


                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="status" class="d-block">Status</label>
                                    <label class="switch">
                                        <input type="checkbox" value="1" name="status"
                                            @if ($edit_data->status == 1) checked @endif>
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
    <script src="{{ asset('public/backEnd/') }}/assets/libs/select2/js/select2.min.js"></script>

    <script src="{{ asset('public/backEnd/') }}/assets/summernote-lite/summernote-lite.js"></script>

    <script src="{{ asset('public/backEnd/') }}/assets/js/pages/form-advanced.init.js"></script>

    <script type="text/javascript">
        document.forms['editForm'].elements['blogcategory_id'].value = "{{ $edit_data->blogcategory_id }}"
    </script>

    <script>
        $('.summernote').summernote({
            height: 250,
            callbacks: {
                // Clear all formatting of the pasted text
                onPaste: function(e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData(
                        'Text');
                    e.preventDefault();
                    setTimeout(function() {
                        document.execCommand('insertText', false, bufferText);
                    }, 300);

                }
            }
        });
    </script>
@endsection
