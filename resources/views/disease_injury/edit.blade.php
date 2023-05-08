@extends('layouts.master')
@section('title', 'Dis Inj Edit')
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
	{{ Form::model($di_t,['method'=>'PATCH', 'route' => ['disease_injury.update', $di_t->id]]) }}
		<div class="input-group">
			{{ Form::label('Type:') }}
			@if ($di_t->type == 'Disease')
				<label for="Disease">Disease</label>
				{{ Form::radio('type', 'Disease', true) }}
				<label for="Injury">Injury</label>
				{{ Form::radio('type', 'Injury', false) }}
			@else
				<label for="Disease">Disease</label>
				{{ Form::radio('type', 'Disease', false) }}
				<label for="Injury">Injury</label>
				{{ Form::radio('type', 'Injury', true) }}
			@endif
		</div>
		<div class="input-group">
			{{ Form::label('Name:') }}
			{{ Form::text('dis_inj',null,array('id'=>'dis_inj')) }}
		</div>
		<div class="input-group">
			{{ Form::label('Description:') }}
			{{ Form::text('description',null,array('id'=>'description')) }}
		</div>
		<div class="input-group">
			{{ Form::submit('Edit', ['class'=>'btn']) }}
		</div>
		{{ Form::token() }}
	{!! Form::close() !!}
@endsection