@extends('frontEnd.layouts.master')
@section('title', $generalsetting->meta_title)
@section('content')
    <!-- PAGE TITLE START -->
    <section class="custom-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h2>get a quote</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- PAGE TITLE END -->
    <section class="trial-offer-area">
        <div class="container">
            <form action="{{ route('order.free_trial') }}" method="POST" accept-charset="utf-8"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="2" name="type" />

                <div class="row">

                    <div class="col-md-12 d-none">
                        <div class="trail-offer-form-wrapper">
                            <div class="trial-offer-header">
                                <p>Get a quote in 30 minutes...<br></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-element margin-bottom-30">
                            <label for="name">Your Name
                                <span>*</span>
                            </label>
                            <input type="text" id="name" name="name" placeholder="Your Name" value=""
                                class="input-field borderd" required="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-element margin-bottom-30">
                            <label for="email">Email Address
                                <span>*</span>
                            </label>
                            <input type="email" id="email" name="email" placeholder="Email Address" value=""
                                class="input-field borderd" required="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-element margin-bottom-30">
                            <label for="phone">Phone No
                            </label>
                            <input type="text" id="phone" name="phone" placeholder="Phone No" value=""
                                class="input-field borderd">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-element margin-bottom-30">
                            <label for="country">Your Country
                                <span>*</span>
                            </label>
                            <select id="country" name="country" class="input-field custom-select borderd" required="">
                                <option value="">Select One</option>

                                <option value="United States">United States</option>
                                <option value="England">England</option>
                                <option value="Australia">Australia</option>
                                <option value="India">India</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-element margin-bottom-30">
                            <label for="company">Your Company
                            </label>
                            <input type="text" id="company" name="company" placeholder="Your Company" value=""
                                class="input-field borderd">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-element margin-bottom-30">
                            <label for="website">Website URL
                            </label>
                            <input type="url" id="website" name="website" placeholder="Website URL" value=""
                                class="input-field borderd">
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-element margin-bottom-10">
                            <label for="services">Services (Can Choose Multiple)
                                <span>*</span>
                            </label>
                        </div>
                        <div class="row">
                            @foreach ($services as $key => $value)
                            <div class="col-md-6">
                                <div class="checkbox-element">
                                    <div class="checkbox-wrapper">
                                        <label class="checkbox-inner">{{ $value->title }}
                                            <input type="checkbox" name="services[]" value="{{ $value->id }}">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-element margin-top-20">
                            <label for="image_size">What to Do With Size?
                                <span>*</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="custom-control custom-radio margin-bottom-30">
                            <input class="custom-control-input" type="radio" name="image_size" value="Resize"
                                id="resize" checked="" required="">

                            <label class="custom-control-label" for="resize">
                                Resize to
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="custom-control custom-radio margin-bottom-30">
                            <input class="custom-control-input" type="radio" name="image_size" value="Original"
                                id="original" required="">

                            <label class="custom-control-label" for="original">
                                Keep original size
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row resizeto-div" style="display: none;">
                            <div class="col-md-6">
                                <div class="form-element margin-bottom-30">
                                    <label for="width">Width in (px)</label>
                                    <input type="number" id="width" name="width" placeholder="Width in (px)"
                                        value="" class="input-field borderd">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-element margin-bottom-30">
                                    <label for="height">Height in (px)</label>
                                    <input type="number" id="height" name="height" placeholder="Height in (px)"
                                        value="" class="input-field borderd">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-element margin-bottom-30">
                            <label for="quantity">Total Quantity
                                <span>*</span>
                            </label>
                            <input type="number" id="quantity" name="quantity" placeholder="Total Quantity"
                                value="" class="input-field borderd" required="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-element margin-bottom-30">
                            <label for="margin">Margin in (px)
                            </label>
                            <input type="number" id="margin" name="margin" placeholder="Margin in (px)"
                                value="" class="input-field borderd">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-element margin-bottom-30">
                            <label for="message">Additional Comments (optional)</label>
                            <textarea rows="20" id="message" name="message" placeholder="Type Additional Comments..."
                                class="input-field textarea borderd"></textarea>
                        </div>
                    </div>

                    <div class="col-sm-6 mb-3 form-element">
                        <label class="mb-2" for="image">Image *</label>
                        <div class="clone hide" style="display: none;">
                            <div class="control-group input-group mb-3 gap-3 align-items-center">
                                <input type="file" name="image[]" class="form-control" />
                                <div class="input-group-btn">
                                    <button class="btn btn-danger" type="button"><i
                                            class="fa fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                        <div
                            class="input-group control-group increment align-items-center gap-3 input-group mb-3">
                            <input type="file" name="image[]"
                                class="form-control @error('image') is-invalid @enderror" />
                            <div class="input-group-btn">
                                <button class="btn btn-success btn-increment" type="button"><i
                                        class="fa fa-plus"></i></button>
                            </div>
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- col-end -->
                    <div class="col-md-6">
                        <div class="form-element margin-bottom-30">
                            <label for="pre_delivery_time">Preferred Delivery Time
                                <span>*</span>
                            </label>
                            <select id="pre_delivery_time" name="pre_delivery_time"
                                class="input-field custom-select borderd" required="">
                                <option value="">Select One</option>

                                <option value="12 Hours">12 Hours</option>
                                <option value="24 Hours">24 Hours</option>
                                <option value="2 Days">2 Days</option>
                                <option value="3 Days">3 Days</option>
                                <option value="1 Week">1 Week</option>
                                <option value="Flexible TIme">Flexible TIme</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <input type="submit" value="Submit Now" class="submit-btn btn-rounded btn-center">
                    </div>

                </div>
            </form>
        </div>
    </section>
@endsection

@push('script')
<script type="text/javascript">
    $(document).ready(function() {
        $(".btn-increment").click(function() {
            var html = $(".clone").html();
            $(".increment").after(html);
        });
        $("body").on("click", ".btn-danger", function() {
            $(this).parents(".control-group").remove();
        });
    });
</script>
@endpush
