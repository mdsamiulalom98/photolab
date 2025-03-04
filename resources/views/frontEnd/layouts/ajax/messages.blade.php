@php
    $admin = \App\Models\User::where('status', 1)->first();
@endphp
@if ($messages->count() < 1)
    <i class="far fa-comment-alt"
        style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);font-size: 100px;opacity: 0.2;"></i>
@else
    @foreach ($messages as $key => $value)
        <li class="message-wrapper {{ $value->username == 'admin' ? 'admin' : '' }} {{ $value->status == 0 ? 'inactive' : '' }}" data-id="{{ $value->id }}">
            <div class="avatar">
                <img src="{{ asset($value->username == 'admin' ? $admin->image : Auth::guard('member')->user()->image) }}" />
            </div>
            <div class="content">
                <p>{!! $value->message !!}</p>
            </div>
        </li>
    @endforeach
@endif
