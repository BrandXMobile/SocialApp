var postId=0;
var bodyElement=null;

$(".show-post-modal").on('click',function(e){
	e.preventDefault();

	bodyElement=e.target.parentNode.parentNode.childNodes[1];
	var body=bodyElement.textContent;
	postId=e.target.parentNode.parentNode.dataset['postid'];
	$('#post-body').val(body);
	$("#show-modal").modal();	


});

//modal post edit/save
$("#modal-save").on('click',function(e){
	$.ajax({
		method:'POST',
		url: urlEdit,
		data: {body: $('#post-body').val(),postId:postId, _token: token }
	})
		.done(function(msg){
			//console.log(JSON.stringify(msg));
			$(bodyElement).text(msg['new-body']);
			$("#show-modal").modal('hide');
		});
});

//like functionality
$(".like").on('click',function(e){
	e.preventDefault();
	var isLike=e.target.previousElementSibling==null;
	postId=e.target.parentNode.parentNode.dataset['postid'];

	$.ajax({
		method:'POST',
		url: urlLike, 
		data: {isLike: isLike,postId:postId, _token: token }
	})
		.done(function(msg){
			//console.log(JSON.stringify(msg));
			e.target.innerText= isLike? e.target.innerText=="Like" ?"Already Liked" : "Like" :
			e.target.innerText=="Dislike" ? "Already don\'t Liked" : "Dislike" ;
			if(isLike){
				e.target.nextElementSibling.innerText='Dislike';
			}else{
				e.target.previousElementSibling.innerText='Like';
			}
		});
});