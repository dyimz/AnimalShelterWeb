@extends('layouts.app')
@section('content')
	<table class="table table-sm" id="laravel_crud">
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
			<tr>
				<td>{{$animal->type}}</td>
				<td>{{$animal->breed}}</td>
				<td>{{$animal->name}}</td>
				<td>{{$animal->gender}}</td>
				<td>{{$animal->age}}</td>
				<td><img src="{{ asset($animal->image) }}" width="100px" height="100px"></td>
			</tr>
		</tbody>
	</table>
	<div>
            @comments(['model' => $animal])
        </div>
@endsection