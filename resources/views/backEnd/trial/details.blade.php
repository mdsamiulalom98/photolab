@extends('backEnd.layouts.master')
@section('title', $order->type == 'free-trial' ? 'Free Trial' : 'Get Quote')
@section('css')
    <link href="{{ asset('public/backEnd') }}/assets/libs/summernote/summernote-lite.min.css" rel="stylesheet"
        type="text/css" />
@endsection 
@section('content')
    <div class="page-content sm-order-1">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">{{$order->type == 'free-trial' ? 'Free Trial' : 'Get Quote'}}</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-md-6 mb-30">
                <div class="card b-radius--10 box--shadow1 mb-4 overflow-hidden">
                    <div class="card-header">
                        <h5 class="">{{$order->type == 'free-trial' ? 'Free Trial' : 'Get Quote'}} #{{$order->id}}</h5>

                    </div>
                    <div class="card-body">

                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Name <span class="fw-bold">{{ $order->name }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Phone <span class="fw-bold"><a
                                       >{{ $order->phone ?? '' }}</a></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Email <span class="fw-bold"><a
                                       >{{ $order->email ?? '' }}</a></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Country <span class="fw-bold"><a
                                       >{{ $order->country ?? '' }}</a></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Company <span class="fw-bold"><a
                                       >{{ $order->company ?? '' }}</a></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Website <span class="fw-bold"><a
                                       >{{ $order->website ?? '' }}</a></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Services <span class="fw-bold">
                                    @foreach ($services as $index => $details)
                                        <span class="btn btn-primary rounded-pill waves-effect waves-light btn-xs">{{ $details->title }}</span>
                                    @endforeach
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Images <span class="fw-bold">{{ $order->quantity}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Resolution <span class="fw-bold text-capitalize">{{ $order->resolution}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Format <span class="fw-bold text-capitalize">{{ $order->format}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Status <span class="fw-bold text-capitalize">{{ $order->status}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Customer File <span class="fw-bold"><a class="btn btn-outline-primary btn-sm" href="{{ url('admin/website/image-zip/'. $order->id) }}">
                                <i class="fa fa-download"></i> Download</a></span>
                            </li>
                        </ul>
                        <div class="button-list my-3">
                            <h5>Status:</h5>
                            @if($order->type == 'free-trial')
                            <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#Approve">Approve</button>
                            <!-- Modal -->
                            <form action="{{route('admin.free_trial.status')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$order->id}}">
                                <input type="hidden" name="status" value="approve">
                                <div class="modal fade" id="Approve" tabindex="-1" aria-labelledby="ApproveLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="ApproveLabel">Free Trial Approve</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="subject">Subject <span>*</span></label>
                                                <input type="text" name="subject" class="form-control" value="Your Free Trial Approve by {{$generalsetting->name}}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="subject">Message <span>*</span></label>
                                                <textarea type="text" name="message" class="summernote form-control">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text.</textarea>
                                            </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Approve</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </form>

                           <button type="button" class="btn btn-warning waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#Process">Process</button>
                            <!-- Modal -->
                            <form action="{{route('admin.free_trial.status')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$order->id}}">
                                <input type="hidden" name="status" value="process">
                                <div class="modal fade" id="Process" tabindex="-1" aria-labelledby="ProcessLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="ProcessLabel">Free Trial Process</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="subject">Subject <span>*</span></label>
                                                <input type="text" name="subject" class="form-control" value="Your Free Trial Process by {{$generalsetting->name}}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="subject">Message <span>*</span></label>
                                                <textarea type="text" name="message" class="summernote form-control">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text.</textarea>
                                            </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-warning">Process</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </form>
                            <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#Finish">Finish</button>
                            <!-- Modal -->
                            <form action="{{route('admin.free_trial.status')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$order->id}}">
                                <input type="hidden" name="status" value="finish">
                                <div class="modal fade" id="Finish" tabindex="-1" aria-labelledby="FinishLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="FinishLabel">Free Trial Finish</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="subject">Subject <span>*</span></label>
                                                <input type="text" name="subject" class="form-control" value="Your Free Trial Finish by {{$generalsetting->name}}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="subject">Message <span>*</span></label>
                                                <textarea type="text" name="message" class="summernote form-control">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text.</textarea>
                                            </div>
                                             <div class="form-group mb-3">
                                                <label class="form-label" for="file_link">File Link (Dropbox or any) <span>*</span></label>
                                                <input type="text" class="form-control" name="file_link" value="Your Free Trial Finish by {{$generalsetting->name}}">
                                            </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Finish</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </form>
                            <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#Reject">Reject</button>
                            <!-- Modal -->
                            <form action="{{route('admin.free_trial.status')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$order->id}}">
                                <input type="hidden" name="status" value="reject">
                                <div class="modal fade" id="Reject" tabindex="-1" aria-labelledby="RejectLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="RejectLabel">Free Trial Reject</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="subject">Subject <span>*</span></label>
                                                <input type="text" name="subject" class="form-control" value="Your Free Trial Reject by {{$generalsetting->name}}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="subject">Message <span>*</span></label>
                                                <textarea type="text" name="message" class="summernote form-control">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text.</textarea>
                                            </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Reject</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </form>
                            @else
                           <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#Approve_Quote">Approve</button>
                            <!-- Modal -->
                            <form action="{{route('admin.get_quote.status')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$order->id}}">
                                <input type="hidden" name="status" value="approve">
                                <div class="modal fade" id="Approve_Quote" tabindex="-1" aria-labelledby="ApproveLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="ApproveLabel">Get Quote Approve</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="subject">Subject <span>*</span></label>
                                                <input type="text" name="subject" class="form-control" value="Your Free Trial Approve by {{$generalsetting->name}}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="subject">Message <span>*</span></label>
                                                <textarea type="text" name="message" class="summernote form-control">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text.</textarea>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="subject">Amount <span>*</span></label>
                                                <input type="text" name="amount" class="form-control" value="1.0">
                                            </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Approve</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </form>
                           <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#Reject_Quote">Reject</button>
                            <!-- Modal -->
                            <form action="{{route('admin.get_quote.status')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$order->id}}">
                                <input type="hidden" name="status" value="reject">
                                <div class="modal fade" id="Reject_Quote" tabindex="-1" aria-labelledby="RejectLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="RejectLabel">Get Quote Reject</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="subject">Subject <span>*</span></label>
                                                <input type="text" name="subject" class="form-control" value="Your Free Trial Reject by {{$generalsetting->name}}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="subject">Message <span>*</span></label>
                                                <textarea type="text" name="message" class="summernote form-control">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text.</textarea>
                                            </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Reject</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6 mb-30">
                <div class="card b-radius--10 box--shadow1 mb-4 overflow-hidden">
                    <div class="card-header">
                        <h5 class="">Instruction</h5>

                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Order Place <span class="fw-bold"><a
                                       >{{ date('d-M-Y', strtotime($order->create_at)) }} |
                                                {{ date('h:i:s A', strtotime($order->create_at)) }}</a></span>
                            </li>
                             <li class="list-group-item d-flex justify-content-between align-items-center">
                                Last Action <span class="fw-bold"><a
                                       >{{ date('d-M-Y', strtotime($order->update_at)) }} |
                                                {{ date('h:i:s A', strtotime($order->update_at)) }}</a></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Image Sizes <span class="fw-bold"><a
                                       >{{ $order->image_size ?? '' }}</a></span>
                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Width <span class="fw-bold"><a
                                       >{{ $order->width ?? 'Not Specified' }}</a></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Height <span class="fw-bold"><a
                                       >{{ $order->height ?? 'Not Specified' }}</a></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Quantity <span class="fw-bold"><a
                                       >{{ $order->quantity ?? '' }}</a></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Margin <span class="fw-bold"><a
                                       >{{ $order->margin ?? '' }}</a></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Message <span class="fw-bold"><a
                                       >{{ $order->message ?? '' }}</a></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Preffered Delivery <span class="fw-bold"><a
                                       >{{ $order->pre_delivery_time ?? '' }}</a></span>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('public/backEnd/') }}/assets/js/pages/form-advanced.init.js"></script>
    <!-- Plugins js -->
    <script src="{{ asset('public/backEnd/') }}/assets/libs//summernote/summernote-lite.min.js"></script>
    <script>
        $(".summernote").summernote({
            placeholder: "Enter Your Text Here",

        });
    </script>
@endsection
