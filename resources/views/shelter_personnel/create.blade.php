@extends('layouts.master')
@section('title', 'Personnel Create')
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
	{!! Form::open(['route' => 'shelter_personnel.store', 'method' => 'POST']) !!}
		<div class="input-group">
			{{ Form::label('First name:') }}
			{{ Form::text('p_fname') }}
		</div>
		<div class="input-group">
			{{ Form::label('Last name:') }}
			{{ Form::text('p_lname') }}
		</div>
		<div class="input-group">
			{{ Form::label('Job Description:') }}
			<label for="Employee">Employee</label>
			{{ Form::radio('job_description', 'Employee', false) }}
			<label for="Veterinarian">Veterinarian</label>
			{{ Form::radio('job_description', 'Veterinarian', false) }}
			<label for="Volunteer">Volunteer</label>
			{{ Form::radio('job_description', 'Volunteer', false) }}
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