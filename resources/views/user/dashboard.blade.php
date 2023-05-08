@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')
	<table class="table table-sm" id="laravel_crud">
		@if($message = Session::get('success'))
			<div class="msg">
				<p>{{$message}}</p>
			</div>
		@endif
			<thead>
				<tr>
					<th>ID</th>
					<th>NAME</th>
					<th>EMAIL</th>
					<th>ROLE</th>
					<th colspan="4">EDIT</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>{{$admin->id}}</td>
					<td>{{$admin->name}}</td>
					<td>{{$admin->email}}</td>
					<td>{{$admin->role}}</td>
					<td><a href="{{route('admin.edit', $admin->id)}}" class="tbtn"><i class="fa fa-pencil"></i></a></td>
				</tr>
			</tbody>
	</table>
	<div class="row">
        <div  class="col-sm-6 col-md-6">
            @if(empty($adoptedChart))
                <div></div>
            @else
                <div>{!! $adoptedChart->container() !!}</div>
                {!! $adoptedChart->script() !!}
            @endif
        </div>
        <div  class="col-sm-6 col-md-6">
            @if(empty($rescuedChart))
                <div></div>
            @else
                <div>{!! $rescuedChart->container() !!}</div>
                {!! $rescuedChart->script() !!}
            @endif
        </div>
    </div>
    <div class="row">
        @if(empty($rescuedChart))
                <div></div>
        @else
            <div>{!! $clinicChart->container() !!}</div>
            {!! $clinicChart->script() !!}
        @endif
    </div>
@endsection