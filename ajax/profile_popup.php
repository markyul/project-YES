<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
	if(!defined('AFTER_CONFIG'))
		exit('no config');

	if(!isset($_GET['idx']))
		exit("");

	$idx = $_GET["idx"]; 
	$streamer_row = $db->query("select * from streamer where idx='{$idx}' limit 1");
	
	if($streamer_row->num_rows==0){
		exit('등록되지 않는 스트리머입니다.');
	}
	$streamer_data = $streamer_row->fetch_assoc();

	$member_data = $db->query("select * from member where idx='{$streamer_data['idx_member']}'")->fetch_assoc();
?>
<div class='profile'>
	<a href="/youtuber_view/<?=$streamer_data['idx']?>">
		<div class="thumb" style="background-image:url(<?=$member_data['picture']?>);"></div>
		<span class="name"><?=$member_data['name']?></span>
	</a>
	<button class="btn btn_follow <?=is_following($streamer_data['idx'])?"following":""?>" onclick="f_motion('<?=$streamer_data['idx']?>', this);"></button>
</div>
<div class='description'>
	<?=$streamer_data['description']?>
</div>