@extends('layouts.master')
@section('title', 'Admin Edit')
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
	{{ Form::model($user, ['method'=>'PATCH', 'route' => ['admin.update', $user->id]]) }}
		<div class="input-group">
			{{ Form::label('Name:') }}
			{{ Form::text('name',null,array('id'=>'name')) }}
		</div>
		<div class="input-group">
			{{ Form::label('Email:') }}
			{{ Form::text('email',null,array('id'=>'email')) }}
		</div>
		<div class="input-group">
			{{ Form::submit('Edit', ['class'=>'btn']) }}
		</div>
		{{ Form::token() }}
	{!! Form::close() !!}
@endsection