@extends('layouts.master')
@section('title', 'Adopter Create')
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
	{!! Form::open(['route' => 'adopter.store', 'method' => 'POST']) !!}
		<div class="input-group">
			{{ Form::label('First name:') }}
			{{ Form::text('a_fname') }}
		</div>
		<div class="input-group">
			{{ Form::label('Last name:') }}
			{{ Form::text('a_lname') }}
		</div>
		<div class="input-group">
			{{ Form::label('Date adopted:') }}
			{{ Form::date('date_adopted', \Carbon\Carbon::now()->format('Y-m-d')) }}
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
			{{ Form::label('Animal:') }}			
			@foreach ($animal as $id => $name)
				{{ Form::label('name', $name)}}
                {{ Form::checkbox('animal_id[]', $id, null, ['id'=>'name']) }}
            @endforeach
		</div>
		<div class="input-group">
			{{ Form::submit('Create', ['class'=>'btn']) }}
		</div>
		{{ Form::token() }}
	{!! Form::close() !!}
@endsection