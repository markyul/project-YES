<?php if(!defined('AFTER_CONFIG')){exit('no config');} ?>
<?php
	if(!isset($_GET['v_id']))
		alert("파라미터를 받지 못했습니다.");

	$v_id = addslashes($_GET['v_id']);
?>
<style>
	#player_main{height:100vh;padding-top:60px;margin-top:-60px;box-sizing:border-box;}
		#player_main>.player{width:calc( 100% - 400px );position:relative;height:100%;}
			#player_main>.player>iframe{position:absolute;left:0;top:0;width:100%;height:100%;}
		#player_main>.chat{width:400px;height:100%;}
			#player_main>.chat>iframe{width:100%;height:100%;}
	
	
	@media(max-width:900px){
		#player_main>.player>.ratio_box{padding-top:50%;}
		#player_main>.player{float:none;width:100%;height:auto;}
		#player_main>.chat{float:none;width:100%;height:500px;}
	}
</style>
<!-- todo: 플레이어페이지 전용 상단바 만들기, 퍼가기 비허용 영상은 안불러오기 -->
<div id="player_main" class="clearfix">
	<div class="player">
		<div class="ratio_box"></div>
		<iframe src="https://www.youtube.com/embed/<?=$v_id?>?autoplay=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	</div>
	<div class="chat" id="player_chat_wrap">
	</div>
</div>

<script>  
 let frame = document.createElement("iframe");  
 frame.referrerPolicy = "origin";  
 frame.src = "https://www.youtube.com/live_chat?v=<?=$v_id?>&embed_domain=" + window.location.hostname;  
 frame.frameBorder = "0";  
 frame.id = "chat-embed";  
 let wrapper = document.getElementById("player_chat_wrap");  
 wrapper.appendChild(frame); 
</script>