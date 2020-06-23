<?php
	$tag=$_POST['tag'];

	$tags = implode('/',$tag);
	$tags = "/" . $tags . "/";

		
	$result=db_update("streamer",array(
		"idx_genres"=>$tags
	), "idx_member='{$my_idx}'");	
	if($result){
		alert("태그를 저장하였습니다.");
	}else{
		alert("태그를 저장하지 못했습니다!");
	}

?>
