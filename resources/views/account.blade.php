@extends('layouts.base')

@section('title')
	My Account
@endsection

@section('content')
	<section class="new-post row">
		<div class="col-md-6 col-md-offset-3">
			<header><h3>My Account</h3></header>
			<form action="{{ route('account.save') }}" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label for="first_name">First Name</label>
					<input type="text" name="first_name" id="first_name" class="form-control" value="{{ $user->first_name}}">
				</div>
				<div class="form-group">
					<label for="image">Image (only .jpg)</label>
					<input type="file" name="image" id="image" class="form-control">
				</div>
				<button type="submit" class="btn btn-primary">Save Account</button>
				<input type="hidden" name="_token" value="{{ Session::token() }}">
			</form>
		</div>
	</section>
	@if(Storage::disk('local')->has($user->first_name."-".$user->id.".jpg"))
		<section class="new-post row">
			<div class="col-md-6 col-md-offset-3">
				<img class="img-repsonsive" src="{{ route('account.image',['filename'=>$user->first_name."-".$user->id.".jpg"]) }}" alt="Profile Image">
			</div>
		</section>
	@endif
@endsection