<?php
	$idx = $_GET['idx'];
	$title = $_POST['title'];
	$content = $_POST['content'];

	$result = db_insert("feed", array(
		"idx_streamer" => $idx,
		"idx_member" => $my_idx,
		"title" => $title,
		"cont" => $content
	));

	if($result){
		alert("글이 등록되었습니다.", '/youtuber_view_comunity?idx='.$idx);
	}else{
		alert("글 작성에 실패했습니다.");
	}
 
?>