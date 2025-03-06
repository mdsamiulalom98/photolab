@extends('frontEnd.layouts.master')
@section('title', 'Forgot Password')
@section('content')
    <section class="section-padding page-margin">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-sm-12">
                    <div class="auth-inner">
                        <h5 class="title">Forgot Password</h5>
                        <form action="{{ route('member.forgot.verify') }}" method="POST" data-parsley-validate="">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Email Address<span>*</span></label>
                                <input type="email" class="form-control  {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                    placeholder="Enter Email Address *" name="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button class="btn-submit d-block">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script src="{{ asset('public/frontEnd/') }}/js/parsley.min.js"></script>
@endpush
