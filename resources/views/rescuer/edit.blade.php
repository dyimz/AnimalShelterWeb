@extends('layouts.master')
@section('title', 'Rescuer Edit')
@section('content')
	@if(count($errors) > 0)
		<div class="msg">
			<ul>
				@foreach($errors->all() as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
	@endif
	{{ Form::model($rescuer,['method'=>'PATCH', 'route' => ['rescuer.update', $rescuer->id]]) }}
		<div class="input-group">
			{{ Form::label('First name:') }}
			{{ Form::text('r_fname',null,array('id'=>'fname')) }}
		</div>
		<div class="input-group">
			{{ Form::label('Last name:') }}
			{{ Form::text('r_lname',null,array('id'=>'lname')) }}
		</div>
		<div class="input-group">
			{{ Form::label('Address:') }}
			{{ Form::text('address',null,array('id'=>'address')) }}
		</div>
		<div class="input-group">
			{{ Form::label('Phone:') }}
			{{ Form::text('phone',null,array('id'=>'phone')) }}
		</div>
		<div class="input-group">
			{{ Form::submit('Edit', ['class'=>'btn']) }}
		</div>
		{{ Form::token() }}
	{!! Form::close() !!}
@endsection