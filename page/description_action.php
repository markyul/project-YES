<?php
	$description = $_POST['descript'];
	
	$result=db_update("streamer",array(
		"description"=>$description
	),"idx_member='{$my_idx}'");//idx_member가 본인idx인 테이블을 수정한다는 조건

	if($result){
		alert("소개를 저장하였습니다.");
	}else{
		alert("소개를 저장하지 못했습니다!");
	}

//됨
//저거 아이디값이랑 밑에값이랑 다른건가? 그니까는 post로 보내는건 name의 값이잔
//확인아 그리구 태그도 봐줄수있어?tag_actionㅇㅇ

?>