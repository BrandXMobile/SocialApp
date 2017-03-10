@extends('layouts.base')

@section('title')
	Welcome to Social App
@endsection

@section('content')
	@include('includes.info-block')
	<div class="row">
		<div class="col-md-6">
			<h2>-- Sign Up --</h2>
			<form action="{{ route('signup') }}" method="POST">
				<div class="form-group {{$errors->has('email')? 'has-error':''}}">
					<label for="email">Type your email address:</label>
					<input class="form-control" type="text" id="email" name="email" value="{{ Request::old('email')}}">
				</div>
				<div class="form-group {{$errors->has('first_name')? 'has-error':''}}">
					<label for="first_name">Type First Name:</label>
					<input class="form-control" type="text" id="first_name" name="first_name" value="{{ Request::old('first_name')}}">
				</div>
				<div class="form-group {{$errors->has('password')? 'has-error':''}}">
					<label for="password">Type your password:</label>
					<input class="form-control" type="password" id="password" name="password" value="{{ Request::old('password')}}">
				</div>
				<button class="btn btn-primary" type="submit">Submit</button>
				<input type="hidden" name="_token" value="{{ Session::token() }}">
			</form>
		</div>
		<div class="col-md-6">
			<h2>-- Sign In --</h2>
			<form action="{{route('login')}}" method="POST">
				<div class="form-group {{$errors->has('email')? 'has-error':''}}">
					<label for="email">Type your email address:</label>
					<input class="form-control" type="text" id="email" name="email" value="{{ Request::old('email')}}">
				</div>
				<div class="form-group {{$errors->has('password')? 'has-error':''}}">
					<label for="password">Type your password:</label>
					<input class="form-control" type="password" id="password" name="password" value="{{ Request::old('password')}}">
				</div>
				<button class="btn btn-primary" type="submit">Submit</button>
				<input type="hidden" name="_token" value="{{ Session::token() }}">
			</form>
		</div>
	</div>
@endsection