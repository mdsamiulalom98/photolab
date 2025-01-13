@if($parcels)
<div class="search_consignment">
	<ul>
		@foreach($parcels as $parcel)
		<li><a href="{{route('member.parcel.view',$parcel->parcel_id)}}"><i class="fa-solid fa-clock"></i> {{$parcel->name}}  {{$parcel->parcel_id}} {{$parcel->phone}}</a></li>
		@endforeach
	</ul>
</div>
@endif
