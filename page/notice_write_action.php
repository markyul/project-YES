<?php
	require_login();
	$content = $_POST['content'];
	$member_idx = $_SESSION['member']['idx'];



	$streamer_row = $db->query("select * from streamer where idx_member='{$member_idx}'");
	if($streamer_row->num_rows == 0)
		alert("존재하지 않는 스트리머입니다.");
	$streamer_data = $streamer_row->fetch_assoc();


	$result = db_insert("notice", array(
		"idx_member" => $member_idx,
		"cont" => $content
	));

	if($result){
		alert("글이 등록되었습니다.", '/youtuber_view/'.$streamer_data['idx']);
	}else{
		alert("글 작성에 실패했습니다.");
	}
 
?>