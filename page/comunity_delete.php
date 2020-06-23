<?php
	$idx = $_GET['idx'];
	$row = $db->query("SELECT feed.*, member.name FROM feed LEFT JOIN member ON feed.idx_member = member.idx WHERE feed.idx = ".$idx);
	$data = $row->fetch_assoc();

	$result = db_delete("feed",
	"idx='{$idx}'");

	if($result){
		alert("글이 삭제되었습니다.", '/youtuber_view_comunity/'.$data['idx_streamer']);
	}else{
		alert("글 삭제에 실패했습니다.");
	}
 
?>