@extends('layouts.master')
@section('title', 'Dis Inj Create')
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
	{!! Form::open(['route' => 'disease_injury.store', 'method' => 'POST']) !!}
		<div class="input-group">
			{{ Form::label('Type:') }}
			<label for="Disease">Disease</label>
			{{ Form::radio('type', 'Disease', false) }}
			<label for="Injury">Injury</label>
			{{ Form::radio('type', 'Injury', false) }}
		</div>
		<div class="input-group">
			{{ Form::label('Name:') }}
			{{ Form::text('dis_inj') }}
		</div>
		<div class="input-group">
			{{ Form::label('Description:') }}
			{{ Form::text('description') }}
		</div>
		<div class="input-group">
			{{ Form::submit('Create', ['class'=>'btn']) }}
		</div>
		{{ Form::token() }}
	{!! Form::close() !!}
@endsection