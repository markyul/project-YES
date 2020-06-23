<?php
	$post_idx = $_GET['post_idx'];
	$content = $_POST['content'];

	$result = db_insert("feed_comment", array(
		"idx_feed" => $post_idx,
		"idx_member" => $my_idx,
		"cont" => $content
	));

	if($result){
		alert("댓글이 등록되었습니다.", '/youtuber_post?post_idx='.$post_idx);
	}else{
		alert("댓글 작성에 실패했습니다.");
	}
?>