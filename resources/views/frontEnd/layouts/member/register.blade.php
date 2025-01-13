@extends('frontEnd.layouts.master')
@section('title', 'Register')
@section('content')
    <section class="section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-sm-12">
                    <div class="auth-inner">
                        <h5>Create an Account</h5>
                        <form action="{{ route('member.store') }}" method="POST" data-parsley-validate="" autocomplete="off"
                            class="row">
                            @csrf

                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Your Name <span>*</span></label>
                                    <input type="text"
                                        class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }} has-validation"
                                        value="{{ old('name') }}" id="name" placeholder="Enter Your Name *"
                                        name="name" required>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <!-- form group -->
                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="phone" class="form-label">Phone No <span>*</span></label>
                                    <input type="number"
                                        class="form-control  {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                        placeholder="Enter Phone Number *" name="phone" value="{{ old('phone') }}"
                                        required>
                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <!-- form group -->
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">Email <span>*</span></label>
                                    <input type="email"
                                        class="form-control  {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                        placeholder="Enter Email Address *" name="email" value="{{ old('email') }}"
                                        required>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <!-- form group -->
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="password" class="form-label">Password <span>*</span></label>
                                    <div class="input-group">
                                        <input type="password"
                                            class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }} password"
                                            placeholder="Enter Password" name="password" value="{{ old('password') }}"
                                            required>
                                        <span class="input-group-text toggle_password">
                                            <i class="fas fa-eye eye_icon"></i>
                                        </span>
                                    </div>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <!-- form group -->
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="confirmed" class="form-label">Confirm Password <span>*</span></label>
                                    <input type="password" name="confirmed"
                                        class="form-control  {{ $errors->has('confirmed') ? 'is-invalid' : '' }} password"
                                        id="confirmed" required placeholder="Confirm Password *">
                                    @if ($errors->has('confirmed'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('confirmed') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <!-- form group -->
                            <div class="col-sm-12 d-flex gap-4">
                                <div class="form-group mb-3">
                                    <input type="radio" name="type" value="buyer"
                                        class=" {{ $errors->has('type') ? 'is-invalid' : '' }} " id="type1"
                                        required>
                                    <label for="type1" class="form-label">Buyers</label>
                                    @if ($errors->has('type'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <input type="radio" name="type" value="seller"
                                        class=" {{ $errors->has('type') ? 'is-invalid' : '' }} " id="type2"
                                        required>
                                    <label for="type2" class="form-label">Sellers</label>
                                    @if ($errors->has('type'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <!-- form group -->
                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" name="agree" required type="checkbox"
                                            value="1" id="agree">
                                        <label class="form-check-label" for="agree">
                                            I am agree with terms & conditions
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <button class="btn-submit d-block" id="submit" disabled>Register</button>
                                </div>
                            </div>
                            <!-- form group -->
                            <p class="quick_link">Already have a account? <a href="{{ route('member.login') }}">
                                    Login</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('script')
    <script src="{{ asset('public/frontEnd/') }}/js/parsley.min.js"></script>
    <script>
        $(".toggle_password").on("click", function() {
            var password_field = $('.password');
            var icon = $('.eye_icon');
            if (password_field.attr('type') === 'password') {
                password_field.attr('type', 'text');
                icon.removeClass('fa-eye');
                icon.addClass('fa-eye-slash');
            } else {
                password_field.attr('type', 'password');
                icon.removeClass('fa-eye-slash');
                icon.addClass('fa-eye');
            }
        });
    </script>
    <script>
        $('#agree').on('click', function() {
            // alert('test');
            $('#submit').prop('disabled', !this.checked);
        });
    </script>
@endpush
