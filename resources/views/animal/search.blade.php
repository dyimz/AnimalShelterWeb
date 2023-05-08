@extends('layouts.app')

@section('content')

	<table id="elbat">
		<thead>
			<tr>
				<th>TYPE</th>
				<th>BREED</th>
				<th>NAME</th>
				<th>GENDER</th>
				<th>AGE</th>
				<th>IMAGE</th>
			</tr>
		</thead>
		<tbody>
			@if($word == '')
				<tr>
				<td>Walang</td>
				<td>lumabas</td>
				<td>kase</td>
				<td>wala</td>
				<td>kang</td>
				<td>nilagay.</td>
				</tr>
			@else
				@foreach($animals as $row)
				<tr>
				<td>{{$row->type}}</td>
				<td>{{$row->breed}}</td>
				<td>{{$row->name}}</td>
				<td>{{$row->gender}}</td>
				<td>{{$row->age}}</td>
				<td><img src="{{ asset($row->image) }}" width="100px" height="100px"></td>
				</tr>
			@endforeach
			@endif
		</tbody>
	</table>

@endsection