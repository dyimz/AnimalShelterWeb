@extends('layouts.master')
@section('title', 'Personnel Edit')
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
	{{ Form::model($shelter_personnel,['method'=>'PATCH', 'route' => ['shelter_personnel.update', $shelter_personnel->id]]) }}
		<div class="input-group">
			{{ Form::label('First name:') }}
			{{ Form::text('p_fname',null,array('id'=>'fname')) }}
		</div>
		<div class="input-group">
			{{ Form::label('Last name:') }}
			{{ Form::text('p_lname',null,array('id'=>'lname')) }}
		</div>
		<div class="input-group">
			{{ Form::label('Job description:') }}
			@if ($shelter_personnel->job_description == 'Employee')
				<label for="Employee">Employee</label>
				{{ Form::radio('job_description', 'Employee', true) }}
				<label for="Veterinarian">Veterinarian</label>
				{{ Form::radio('job_description', 'Veterinarian', false) }}
				<label for="Volunteer">Volunteer</label>
				{{ Form::radio('job_description', 'Volunteer', false) }}
			@elseif ($shelter_personnel->job_description == 'Veterinarian')
				<label for="Employee">Employee</label>
				{{ Form::radio('job_description', 'Employee', false) }}
				<label for="Veterinarian">Veterinarian</label>
				{{ Form::radio('job_description', 'Veterinarian', true) }}
				<label for="Volunteer">Volunteer</label>
				{{ Form::radio('job_description', 'Volunteer', false) }}
			@elseif ($shelter_personnel->job_description == 'Volunteer')
				<label for="Employee">Employee</label>
				{{ Form::radio('job_description', 'Employee', false) }}
				<label for="Veterinarian">Veterinarian</label>
				{{ Form::radio('job_description', 'Veterinarian', false) }}
				<label for="Volunteer">Volunteer</label>
				{{ Form::radio('job_description', 'Volunteer', true) }}	
			@endif
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