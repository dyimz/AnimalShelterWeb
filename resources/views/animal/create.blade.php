@extends('layouts.master')
@section('title', 'Animal Create')
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
	{!! Form::open(['route' => 'animal.store', 'method' => 'POST', 'files' => true]) !!}
		<div class="input-group">
			{{ Form::label('Type:') }}
			<label for="Cat">Cat</label>
			{{ Form::radio('type', 'Cat', false) }}
			<label for="Dog">Dog</label>
			{{ Form::radio('type', 'Dog', false) }}
		</div>
		<div class="input-group">
			{{ Form::label('Breed:') }}
			{{ Form::text('breed') }}
		</div>
		<div class="input-group">
			{{ Form::label('Name:') }}
			{{ Form::text('name') }}
		</div>
		<div class="input-group">
			{{ Form::label('Gender:') }}
			<label for="Male">Male</label>
			{{ Form::radio('gender', 'Male', false) }}
			<label for="Female">Female</label>
			{{ Form::radio('gender', 'Female', false) }}
		</div>
		<div class="input-group">
			{{ Form::label('Age:') }}
			{{ Form::text('age') }}
		</div>
		<div class="input-group">
			{{ Form::label('Date rescued:') }}
			{{ Form::date('date_rescued', \Carbon\Carbon::now()->format('Y-m-d')) }}
		</div>
		<div class="input-group">
			{{ Form::label('Place rescued:') }}
			{{ Form::text('place_rescued') }}
		</div>
		<div>
			{{ Form::label('Image:') }}
			{{ Form::file('image') }}
		</div>
		<div class="input-group">
			{{ Form::select('rescuer_id', $rescuer, null, ['class'=>'dropdown', 'placeholder'=>'Select rescuer:']) }}
		</div>
		<div class="input-group">
			{{ Form::select('personnel_id', $personnel, null, ['class'=>'dropdown', 'placeholder'=>'Select personnel:']) }}
		</div>
		<div class="input-group">
			{{ Form::label('Date checked:') }}
			{{ Form::date('date_checked', \Carbon\Carbon::now()->format('Y-m-d')) }}
		</div>
		<div class="input-group">
			{{ Form::label('Disease Injury:') }}
			@foreach ($disease_injury as $id => $treatmentdetail)
				{{ Form::label('treatmentdetail', $treatmentdetail)}}
                {{ Form::checkbox('disease_injury_id[]', $id, null, ['id'=>'treatmentdetail']) }}
            @endforeach
		</div>
		<div class="input-group">
			{{ Form::submit('Create', ['class'=>'btn']) }}
		</div>
		{{ Form::token() }}
	{!! Form::close() !!}
@endsection