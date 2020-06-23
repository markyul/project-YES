<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
	if(!defined('AFTER_CONFIG'))
		exit('no config');

	if(!$is_logged_in)
		exit("4");

	if(!isset($_POST['idx']))
		exit("5");

	$streamer_idx=$_POST["idx"]; 
	$streamer_follow=$db->query("select * from following where idx_streamer='{$streamer_idx}' and idx_member='{$my_idx}'");//스트리머가 팔로우되어있는지 확인
	
	if($streamer_follow->num_rows==0){//자신의 idx값에 대해서 스트리머 값이 저장되어있지 않으면 데이터를 넣음.
		$result = db_insert("following",array(
			"idx_member"=>$my_idx,
			"idx_streamer"=>$streamer_idx
		));	
	}
	else{
		$result = db_delete("following","idx_member='{$my_idx}' and idx_streamer='{$streamer_idx}'");
	}
	
	if($result){
		if($streamer_follow->num_rows == 0)
			echo "1";
		else
			echo "2";
	}
	else{
		echo "3";
	}

?>