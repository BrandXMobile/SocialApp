@extends('layouts.base')

@section('content')
	@include('includes.info-block')
	<section class="row new-post">
		<div class="col-md-6 col-md-offset-3">
			<header><h3>What's going on?</h3></header>
			<form action="{{route('post.create')}}" method="post">
				<div class="form-group">
					<textarea class="form-control" name="body" id="new-post" rows="5" placeholder="Write something...">
					</textarea>
					{{ csrf_field() }}
					<br/>
					<button type="submit" class="btn btn-primary">Post</button>
				</div>
			</form>
		</div>
	</section>
	<section class="row posts">
		<div class="col-md-6 col-md-offset-3">
			<header><h3>Other people posts: </h3></header>
			<article class="post">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus eos vel quas, consequatur sapiente officia eaque sequi debitis impedit error ipsa sint, reiciendis cum dolore eum vitae, ullam quis cumque!</p>
				<div class="info">
					Posted by Max on 12 Feb 2016				
				</div>
				<div class="interaction">
					<a href="#">Like</a>
					<a href="#">Dislike</a>
					<a href="#">Edit</a>
					<a href="#">Delete</a>
				</div>
			</article>
			<br><br>
			<article class="post">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus eos vel quas, consequatur sapiente officia eaque sequi debitis impedit error ipsa sint, reiciendis cum dolore eum vitae, ullam quis cumque!</p>
				<div class="info">
					Posted by Max on 12 Feb 2016				
				</div>
				<div class="interaction">
					<a href="#">Like</a>
					<a href="#">Dislike</a>
					<a href="#">Edit</a>
					<a href="#">Delete</a>
				</div>
			</article>
		</div>
	</section>
@endsection