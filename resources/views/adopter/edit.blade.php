@extends('layouts.master')
@section('title', 'Adopter Edit')
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
	{{ Form::model($adopter,['method'=>'PATCH', 'route' => ['adopter.update', $adopter->id]]) }}
		<div class="input-group">
			{{ Form::label('First name:') }}
			{{ Form::text('a_fname',null,array('id'=>'fname')) }}
		</div>
		<div class="input-group">
			{{ Form::label('Last name:') }}
			{{ Form::text('a_lname',null,array('id'=>'lname')) }}
		</div>
		<div class="input-group">
			{{ Form::label('Address:') }}
			{{ Form::text('address',null,array('id'=>'address')) }}
		</div>
		<div class="input-group">
			{{ Form::label('Date adopted:') }}
			{{ Form::date('date_adopted', \Carbon\Carbon::createFromDate($adopter->date_adopted)->format('Y-m-d')) }}
		</div>
		<div class="input-group">
			{{ Form::label('Phone:') }}
			{{ Form::text('phone',null,array('id'=>'phone')) }}
		</div>
		<div class="input-group">
			{{ Form::label('Animal:') }}
			@foreach ($animal as $id => $name)
				@if (in_array($id, $adopted_animal))
					{{ Form::label('name', $name)}}
                	{{ Form::checkbox('animal_id[]', $id, true, ['id'=>'name']) }}
                @else
                	{{ Form::label('name', $name)}}
                	{{ Form::checkbox('animal_id[]', $id, null, ['id'=>'name']) }}
                @endif
            @endforeach
		</div> 
		<div class="input-group">
			{{ Form::submit('Edit', ['class'=>'btn']) }}
		</div>
		{{ Form::token() }}
	{!! Form::close() !!}
@endsection