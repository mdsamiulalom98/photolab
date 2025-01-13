@if ($messages->count() < 1)
    <i class="far fa-comment-alt"
        style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);font-size: 100px;opacity: 0.2;"></i>
@else
    @foreach ($messages as $key => $value)
        <li class="message-wrapper {{ $value->username != 'admin' ? 'member' : '' }}">
            <div class="avatar">
                <img src="{{ asset($value->username != 'admin' ? $value->member?->image : Auth::user()->image) }}" />
            </div>
            <div class="content">
                <p>{{ $value->message }}</p>
            </div>
        </li>
    @endforeach
@endif
