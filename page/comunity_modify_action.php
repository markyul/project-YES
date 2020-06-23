<?php
	$idx = $_POST['idx'];
	$title = $_POST['title'];
	$content = $_POST['content'];


	$result = db_update("feed", array(
		"title" => $title,
		"cont" => $content
	)
	, "idx='{$idx}'");

	if($result){
		alert("글이 수정되었습니다.", '/youtuber_post?post_idx='.$idx);
	}else{
		alert("글 수정에 실패했습니다.");
	}
 
?>