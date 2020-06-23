<?php
	$idx = $_GET['idx'];
	$row = $db->query("SELECT * FROM feed_comment WHERE idx = ".$idx);
	$data = $row->fetch_assoc();

	$result = db_delete("feed_comment",
	"idx='{$idx}'");

	if($result){
		alert("글이 삭제되었습니다.", '/youtuber_post?post_idx='.$data['idx_feed']);
	}else{
		alert("글 삭제에 실패했습니다.");
	}
 
?>