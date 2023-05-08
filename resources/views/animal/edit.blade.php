@extends('layouts.master')
@section('title', 'Animal Edit')
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
	{{ Form::model($animal, ['method'=>'PATCH', 'route' => ['animal.update', $animal->id]]) }}
		<div class="input-group">
			{{ Form::label('Type:') }}
			@if ($animal->type == 'Cat')
				<label for="Cat">Cat</label>
				{{ Form::radio('type', 'Cat', true) }}
				<label for="Dog">Dog</label>
				{{ Form::radio('type', 'Dog', false) }}
			@else
				<label for="Cat">Cat</label>
				{{ Form::radio('type', 'Cat', false) }}
				<label for="Dog">Dog</label>
				{{ Form::radio('type', 'Dog', true) }}
			@endif
		</div>
		<div class="input-group">
			{{ Form::label('Breed:') }}
			{{ Form::text('breed',null,array('id'=>'breed')) }}
		</div>
		<div class="input-group">
			{{ Form::label('Name:') }}
			{{ Form::text('name',null,array('id'=>'name')) }}
		</div>
		<div class="input-group">
			{{ Form::label('Gender:') }}
			@if ($animal->gender == 'Male')
				<label for="Male">Male</label>
				{{ Form::radio('gender', 'Male', true) }}
				<label for="Female">Female</label>
				{{ Form::radio('gender', 'Female', false) }}
			@else
				<label for="Male">Male</label>
				{{ Form::radio('gender', 'Male', false) }}
				<label for="Female">Female</label>
				{{ Form::radio('gender', 'Female', true) }}
			@endif
		</div>
		<div class="input-group">
			{{ Form::label('Age:') }}
			{{ Form::text('age',null,array('id'=>'age')) }}
		</div>
		<div class="input-group">
			{{ Form::label('Date rescued:') }}
			{{ Form::date('date_rescued', \Carbon\Carbon::createFromDate($animal->date_rescued)->format('Y-m-d')) }}
		</div>
		<div class="input-group">
			{{ Form::label('Place rescued:') }}
			{{ Form::text('place_rescued',null,array('id'=>'place')) }}
		</div>
		<div class="input-group">
			{{ Form::label('Rescuer:') }}
			{{ Form::select('rescuer_id', $rescuer, null, ['class'=>'dropdown', 'rescuer_id' => 'rescuer_id']) }}
		</div>
		<div class="input-group">
			{{ Form::label('Personnel:') }}
			{{ Form::select('personnel_id', $personnel, null, ['class'=>'dropdown', 'personnel_id' => 'personnel_id']) }}
		</div> 
		<div class="input-group">
			{{ Form::label('Date checked:') }}
			{{ Form::date('date_checked', \Carbon\Carbon::createFromDate($animal->date_checked)->format('Y-m-d')) }}
		</div>
		<div class="input-group">
			{{ Form::label('Disease Injury:') }}
			@foreach ($disease_injury as $id => $dis_inj)
				@if (in_array($id, $animal_condition))
					{{ Form::label('dis_inj', $dis_inj)}}
                	{{ Form::checkbox('disease_injury_id[]', $id, true, ['id'=>'dis_inj']) }}
                @else
                	{{ Form::label('dis_inj', $dis_inj)}}
                	{{ Form::checkbox('disease_injury_id[]', $id, null, ['id'=>'dis_inj']) }}
                @endif
            @endforeach
		</div> 
		<div class="input-group">
			{{ Form::submit('Edit', ['class'=>'btn']) }}
		</div>
		{{ Form::token() }}
	{!! Form::close() !!}
@endsection