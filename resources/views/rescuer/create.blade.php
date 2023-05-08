@extends('layouts.master')
@section('title', 'Rescuer Create')
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
	{!! Form::open(['route' => 'rescuer.store', 'method' => 'POST']) !!}
		<div class="input-group">
			{{ Form::label('First name:') }}
			{{ Form::text('r_fname') }}
		</div>
		<div class="input-group">
			{{ Form::label('Last name:') }}
			{{ Form::text('r_lname') }}
		</div>
		<div class="input-group">
			{{ Form::label('Address:') }}
			{{ Form::text('address') }}
		</div>
		<div class="input-group">
			{{ Form::label('Phone:') }}
			{{ Form::text('phone') }}
		</div>
		<div class="input-group">
			{{ Form::submit('Create', ['class'=>'btn']) }}
		</div>
		{{ Form::token() }}
	{!! Form::close() !!}
@endsection