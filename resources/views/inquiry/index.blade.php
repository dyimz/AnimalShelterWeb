@extends('layouts.master')
@section('title', 'Inquiries')
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
				<th>PHONE</th>
				<th>SUBJECT</th>
				<th>MESSAGE</th>
				<th colspan="6"></th>
			</tr>
		</thead>
		<tbody>
			@foreach($inquiries as $row)
			<tr>
				<td>{{$row->id}}</td>
				<td>{{$row->name}}</td>
				<td>{{$row->email}}</td>
				<td>{{$row->phone}}</td>
				<td>{{$row->subject}}</td>
				<td>{{$row->message}}</td>
				<td>
					{{ Form::model($row,['method'=>'POST', 'route' => ['inquiry.destroy', $row->id], 'class' => 'delete_form']) }}
						{{ Form::hidden('_method', 'DELETE') }}
						{{ Form::submit('DELETE', ['class'=>'tbtn']) }}
					{!! Form::close() !!}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<script>
		$(document).ready(function()
		{
			$('.delete_form').on('submit', function(){
				if(confirm("Weh?"))
				{
					return true;
				}
				else
				{
					return false;
				}
			});
		});
	</script>
@endsection