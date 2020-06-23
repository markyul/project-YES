$(function(){
	$('.profile_popup_trigger').hover(function(){
		$(this).append('<div class="profile_popup_wrap"></div>');
		if($(this).data('idx'))
			$('.profile_popup_wrap').load("/ajax/profile_popup.php?idx="+$(this).data('idx'));
		else if($(this).data('channel_id'))
			$('.profile_popup_wrap').html("<div class='text-center'><a class='btn btn-lg btn-danger' target='_blank' href='https://www.youtube.com/channel/"+$(this).data('channel_id')+"'>유튜브 채널</a></div>");
			
	},function(){
		$('.profile_popup_wrap').remove();
	});
	
	$(".menu-toggle-btn").click(function() {
		$(".gnb").stop().slideToggle("fast");
	});

	// $("input[type='checkbox']").click(function(){
	// 	$("p").toggle();
	// });


});


function showHide(){
	location.href='/streamer_action';
	// $.ajax({
	// 	url:"/ajax/streamer_action.php",
	// 	success:function(data){
	// 		if(data == 1)
	// 			alert("스트리머가 비활성화 되었습니다.");
	// 		else if(data == 2)
	// 			alert("스트리머가 활성화 되었습니다.");
	// 		else
	// 			alert("오류");
	// 	}
	// });


	// if(document.getElementById("streamer_menu").style.display =='none')
	// 	$('#streamer_menu').show();
	// else
	// 	$('#streamer_menu').hide();
}

function f_motion(idx, this_el){
	$.ajax({
		url:"/ajax/follow_action.php",
		data:{'idx':idx},
		method:"POST",
		success:function(data){
			if(data == 1)
			{
				alert("팔로우 되었습니다.");
				$(this_el).addClass('following');
			}
			else if(data == 2)
			{
				alert("팔로우를 해제합니다.");
				$(this_el).removeClass('following');
			}
			else if(data == 4)
			{
				alert("로그인을 해주세요");
			}
			else if(data == 5)
			{
				alert("파라미터를 받지 못했습니다.");
			}
			else
			{
				alert("오류");
			}
		}

	});	
}

function m_motion(count){
	var plus=count+5;
	if(document.getElementById("show"+count).style.display =='none'){	
		$('#button'+count).hide();
		$('#button'+plus).show();
		while(count<plus){
		$('#show'+(count)).show();
		count++;
		}	
		
	}

}
