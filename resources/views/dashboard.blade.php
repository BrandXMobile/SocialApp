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
			@foreach($posts as $post)
				<article class="post" data-postid='{{ $post->id}}'>
					<p>{!! $post->body !!}</p>
					<div class="info">
						Posted by {{ $post->user->first_name }} on {{ $post->created_at }}				
					</div>
					<div class="interaction">
						<a href="#" class="like">{{Auth::user()->likes()->where('post_id',$post->id)->first()? Auth::user()->likes()->where('post_id',$post->id)->first()->like==1 ? 'Already Liked':'Like' :'Like' }}</a> |
						<a href="#" class="like">{{Auth::user()->likes()->where('post_id',$post->id)->first()? Auth::user()->likes()->where('post_id',$post->id)->first()->like==0 ? 'Already don\'t Liked':'Dislike' :'Dislike' }}</a>
						@if(Auth::user()== $post->user)
							|
							<a class="show-post-modal edit" href="#">Edit</a> |
							<a href="{{ route('post.delete',['post_id'=>$post->id]) }}">Delete</a>
						@endif
					</div> 
				</article>
				<br><br>
			@endforeach
		</div>
	</section>

		<div class="modal fade" tabindex="-1" role="dialog" id="show-modal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Edit post</h4>
	      </div>
	      <div class="modal-body">
	        <form action="">
	        	<div class="form-group">
	        		<label for="post-body">Edit post</label>
	        		<textarea class="form-control" name="post-body" id="post-body"  rows="7"></textarea>
	        	</div>
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<script src="{{ URL::to('js/tinymce/tinymce.min.js') }}"></script>
	<script>
		var token='{{ Session::token() }}';
		var urlEdit='{{ route('edit') }}';
		var urlLike='{{ route('like') }}'; 
    
	    var editor_config = {
	        path_absolute : "{{ URL::to('/') }}/",
	        selector: "#new-post",
	        plugins: [
	            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
	            "searchreplace wordcount visualblocks visualchars code fullscreen",
	            "insertdatetime media nonbreaking save table contextmenu directionality",
	            "emoticons template paste textcolor colorpicker textpattern"
	        ],
	        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
	        relative_urls: false,
	        file_browser_callback : function(field_name, url, type, win) {
	            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
	            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
	            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
	            if (type == 'image') {
	                cmsURL = cmsURL + "&type=Images";
	            } else {
	                cmsURL = cmsURL + "&type=Files";
	            }
	            tinyMCE.activeEditor.windowManager.open({
	                file : cmsURL,
	                title : 'Filemanager',
	                width : x * 0.8,
	                height : y * 0.8,
	                resizable : "yes",
	                close_previous : "no"
	            });
	        }
	    };
	    tinymce.init(editor_config);
	</script>

@endsection