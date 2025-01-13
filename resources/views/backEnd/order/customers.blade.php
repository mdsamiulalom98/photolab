@foreach ($members as $key => $value)
<div class="member-item" data-id="{{ $value->id }}">
    <b>{{ $value->phone }}</b>
    <p>{{ $value->name }}</p>
</div>
@endforeach
