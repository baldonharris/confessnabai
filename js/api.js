$(function(){
	// function from the jquery form plugin
	 $('#post_confession').ajaxForm({
	 	beforeSend:function(){
	 		$(".progress").show();
	 	},
	 	uploadProgress:function(event,position,total,percentComplete){
	 		$(".progress").width(percentComplete+'%');
	 	},
	 	success:function(){
	 		$(".progress").hide();
	 	},
	 	complete:function(response){
	 		var totalpost = parseInt($("#totalpost").val());
			totalpost = totalpost+1;
			console.log(totalpost);
	 		$("#confession_wall").prepend(response.responseText).hide().fadeIn("slow");
			$("#total_post").html(totalpost).hide().fadeIn("slow");
				
			$("#confess").val("");
			$("#category_me").val("0");
			$("#uploadBtn").val("");
	 	}
	 });
	 $(".progress").hide();
});

$(function(){
	 $('#submit_comment').ajaxForm({
	 	beforeSend:function(){
	 	},
	 	uploadProgress:function(event,position,total,percentComplete){
	 	},
	 	success:function(){
	 	},
	 	complete:function(response){
	 		$("#throwcomment").append(response.responseText).hide().fadeIn("slow");
			console.log(response.responseText);
			$("#comment").val("");
	 	}
	 });
});

$(document).ready(function()
{
	var load = 0;
	var limit = 0;
	var total = $("#harris").val();
	var url = $("#pass").val();
	var temp_url = $("#pass").val();
	var deletemode = $("#delete").val();
	var current_me = $("#current_me").val();

	console.log(url);
	console.log(deletemode);

	if(total <= 10)
		$("#scrolling").hide();

	$(window).scroll(function()
	{
		var catcher = $(window).scrollTop();
		var docElement = $(document)[0].documentElement;
        var winElement = $(window)[0];

        if((docElement.scrollHeight - winElement.innerHeight) == winElement.pageYOffset)
		{
			load++;
			limit = 10*load;

			url = url+limit+"/"+deletemode+"/"+current_me; 
			console.log(url);

			if(limit >= total)
				$("#scrolling").hide();
			else
			{
				var posting = $.post(url, {load:load});

				posting.done(function(data)
				{
					$("#isolate_me").append(data).hide().fadeIn("slow");
				});
			}

			//console.log(url);
			url = temp_url;
			catcher = 0;
			// console.log("?");
		}
	});
});

function refreshMyDiv()
{
	var get_url = $("#pass").val();
	var total_post = $("#total_post").val();
	$("#total_post").val(parseInt(total_post)+1);
	console.log(total_post);
	console.log(get_url);
	$("#isolate_me").load(get_url).hide().fadeIn("slow");
}

//setInterval('refreshMyDiv()', 5000);