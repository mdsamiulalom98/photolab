@foreach ($services as $key => $value)
<div class="member-item" data-id="{{ $value->id }}">
    <p>{{ $value->title }}</p>
</div>
@endforeach
