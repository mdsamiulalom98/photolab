@extends('frontEnd.layouts.member.master')
@section('title','Marchant Profile')
@section('content')
	<div class="page-header">
		<h5>Merchant Profile</h5>
	</div>
	<div class="page-content">
		<div class="row">
			<div class="col-sm-10">
				<div class="text-end">
					<a href="{{route('member.settings')}}" class="btn btn-primary"><i class="fa-solid fa-edit"></i> Edit</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-7">
				<div class="marchant-profile">
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td>Name</td>
								<td>{{$profile->name}}</td>
							</tr>
							<tr>
								<td>Shop Name</td>
								<td>{{$profile->shop_name}}</td>
							</tr>
							<tr>
								<td>Phone Name</td>
								<td>{{$profile->phone}}</td>
							</tr>
							<tr>
								<td>Phone Email</td>
								<td>{{$profile->email}}</td>
							</tr>
							<tr>
								<td>Address</td>
								<td>{{$profile->address}}</td>
							</tr>
							<tr>
								<td>District</td>
								<td>{{$profile->district?$profile->district->name:''}}</td>
							</tr>
							<tr>
								<td>Thana/Area</td>
								<td>{{$profile->area?$profile->area->name:''}}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection