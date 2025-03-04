@extends('backEnd.layouts.master')
@section('title','Team Edit')
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
                    <a href="{{route('teams.index')}}" class="btn btn-primary waves-effect waves-light btn-sm rounded-pill">Manage</a>
                </div>
                <h4 class="page-title">Team Edit</h4>
            </div>
        </div>
    </div>       
    <!-- end page title --> 
   <div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form action="{{route('teams.update')}}" method="POST" class=row data-parsley-validate=""  enctype="multipart/form-data" name="editForm">
                    @csrf
                    <input type="hidden" value="{{$edit_data->id}}" name="id">
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="name" class="form-label">Name *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   name="name" 
                                   value="{{ $edit_data->name }}" 
                                   id="name" 
                                   maxlength="155" 
                                   required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Designation Field -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="designation" class="form-label">Designation *</label>
                            <input type="text" class="form-control @error('designation') is-invalid @enderror" 
                                   name="designation" 
                                   value="{{ $edit_data->designation }}" 
                                   id="designation" 
                                   maxlength="55" 
                                   required>
                            @error('designation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Email Field -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   name="email" 
                                   value="{{ $edit_data->email }}" 
                                   id="email" 
                                   maxlength="55" 
                                   required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Phone Field -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="phone" class="form-label">Phone *</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                   name="phone" 
                                   value="{{ $edit_data->phone }}" 
                                   id="phone" 
                                   maxlength="25" 
                                   required>
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Facebook Field -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="facebook" class="form-label">Facebook</label>
                            <input type="url" class="form-control @error('facebook') is-invalid @enderror" 
                                   name="facebook" 
                                   value="{{ $edit_data->facebook }}" 
                                   id="facebook" 
                                   maxlength="99">
                            @error('facebook')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- YouTube Field -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="youtube" class="form-label">YouTube</label>
                            <input type="url" class="form-control @error('youtube') is-invalid @enderror" 
                                   name="youtube" 
                                   value="{{ $edit_data->youtube }}" 
                                   id="youtube" 
                                   maxlength="99">
                            @error('youtube')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Twitter Field -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="twitter" class="form-label">Twitter</label>
                            <input type="url" class="form-control @error('twitter') is-invalid @enderror" 
                                   name="twitter" 
                                   value="{{ $edit_data->twitter }}" 
                                   id="twitter" 
                                   maxlength="99">
                            @error('twitter')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- LinkedIn Field -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="linked_in" class="form-label">LinkedIn</label>
                            <input type="url" class="form-control @error('linked_in') is-invalid @enderror" 
                                   name="linked_in" 
                                   value="{{ $edit_data->linked_in }}" 
                                   id="linked_in" 
                                   maxlength="99">
                            @error('linked_in')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Instagram Field -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="instagram" class="form-label">Instagram</label>
                            <input type="url" class="form-control @error('instagram') is-invalid @enderror" 
                                   name="instagram" 
                                   value="{{ $edit_data->instagram }}" 
                                   id="instagram" 
                                   maxlength="99">
                            @error('instagram')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Pinterest Field -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="pinterest" class="form-label">Pinterest</label>
                            <input type="url" class="form-control @error('pinterest') is-invalid @enderror" 
                                   name="pinterest" 
                                   value="{{ $edit_data->pinterest }}" 
                                   id="pinterest" 
                                   maxlength="99">
                            @error('pinterest')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- ======== -->
                     <div class="col-sm-12 mb-3">
                       <div class="form-group">
                        <label for="image" class="form-label">Image *</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}"  id="image" >
                        <img src="{{asset($edit_data->image)}}" class="edit-image" alt="">
                        @error('image')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                    <!-- ============= -->
                        
                    <div class="col-sm-6 mb-3">
                        <div class="form-group">
                            <label for="status" class="d-block">Status</label>
                            <label class="switch">
                              <input type="checkbox" value="1" name="status" @if($edit_data->status==1)checked @endif>
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