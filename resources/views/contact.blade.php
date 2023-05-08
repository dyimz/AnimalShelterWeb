@extends('layouts.app')
@section('content')
	<div class="container pt-5" style="max-width: 300px;">
        @if(Session::has('success'))
            <div class="alert alert-success" style="text-align: center;">
                {{Session::get('success')}}
            </div>
        @endif
        {!! Form::open(['route' => 'contact.store', 'method' => 'POST']) !!}
            {{ Form::token() }}
            <div class="form-group">
                {{ Form::label('Name') }}
                {{ Form::text('name', null, ['id' => 'name', 'class' => 'form-control']) }}
                @if ($errors->has('name'))
                    <div class="alert alert-danger" style="text-align: center;">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                {{ Form::label('Email') }}
                {{ Form::email('email', null, ['id' => 'email', 'class' => 'form-control']) }}
                @if ($errors->has('email'))
                    <div class="alert alert-danger" style="text-align: center;">
                        {{ $errors->first('email') }}
                    </div>
                @endif                
            </div>
            <div class="form-group">
                {{ Form::label('Phone') }}
                {{ Form::text('phone', null, ['id' => 'phone', 'class' => 'form-control']) }}
                @if ($errors->has('phone'))
                    <div class="alert alert-danger" style="text-align: center;">
                        {{ $errors->first('phone') }}
                    </div>
                @endif                                
            </div>
            <div class="form-group">
                {{ Form::label('Subject') }}
                {{ Form::text('subject', null, ['id' => 'subject', 'class' => 'form-control']) }}
                @if ($errors->has('subject'))
                    <div class="alert alert-danger" style="text-align: center;">
                        {{ $errors->first('subject') }}
                    </div>
                @endif                 
            </div>
            <div class="form-group">
                {{ Form::label('Message') }}
                {{ Form::textarea('message', null, ['id' => 'message', 'class' => 'form-control', 'rows' => 5]) }}
                @if ($errors->has('message'))
                    <div class="alert alert-danger" style="text-align: center;">
                        {{ $errors->first('message') }}
                    </div>
                @endif                    
            </div>
            {{ Form::submit('Send', ['value' => 'Send', 'class'=>'btn btn-dark btn-block']) }}
        {!! Form::close() !!}
    </div>
@endsection