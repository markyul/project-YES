<?php
	require_login();

	$idx = $_POST['idx'];
	$content = $_POST['content'];
	$date = $_POST['date'];


	$notice_row = $db->query("select * from notice where idx='{$idx}' and idx_member='{$my_idx}'");
	if($notice_row->num_rows == 0)
		alert("존재하지 않는 글이거나 내 글이 아닙니다.");


	$streamer_row = $db->query("select * from streamer where idx_member='{$my_idx}'");
	if($streamer_row->num_rows == 0)
		alert("존재하지 않는 스트리머입니다.");
	$streamer_data = $streamer_row->fetch_assoc();



	$result = db_update("notice", array(
		"cont" => $content,
	)
	, "idx='{$idx}'");

	if($result){
		alert("글이 수정되었습니다.", '/youtuber_view/'.$streamer_data['idx']);
	}else{
		alert("글 수정에 실패했습니다.");
	}
 
?>