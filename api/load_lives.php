<?php
	if(isset($_GET['idx_genre']))
		$idx_genre = addslashes($_GET['idx_genre']);
	else
		alert("idx_genre 파라미터가 없습니다.");


	//todo: videoEmbeddable:true 속성

	$default_arr = array( //실시간 불러오는 공통설정
		'eventType' => "live",
		'type' => "video",
		'maxResults' => 50,
		'order'=>'viewCount',
		'regionCode'=>"KR",
		'relevanceLanguage'=>"ko",
		//'location'=>'36.641977814705946,128.0126953125',
		//'locationRadius'=>'300km',
		'fields'=>"items(snippet(title,thumbnails(high(url)),channelTitle,channelId),id(videoId))"
	);	


	function load_by_q($q){
		global $youtube;
		global $default_arr;
		$new_arr = array_merge($default_arr, array(
			'q'=>$q,
		));
		
		return $youtube->search->listSearch('snippet,id', $new_arr);
	}

	function load_by_order(){
		global $youtube;
		global $default_arr;
		
		$new_arr = array_merge($default_arr, array(
			
		));
		
		return $youtube->search->listSearch('snippet,id', $new_arr);
	}
	function load_by_category($category){
		global $youtube;
		global $default_arr;
		
		$new_arr = array_merge($default_arr, array(
			'videoCategoryId'=>$category,
		));
		
		return $youtube->search->listSearch('snippet,id', $new_arr);
	}
		
	
	switch($idx_genre){
		case 0:
			//$response = load_by_order();
			$response = load_by_q('실시간');
			db_delete("youtube_streaming","idx_genre='{$idx_genre}'");
			break;
		case 1:
			$response = load_by_q('게임');
			//$response = load_by_category(20);
			db_delete("youtube_streaming","idx_genre='{$idx_genre}'");
			break;
		case 2:
			$response = load_by_q('토크');
			db_delete("youtube_streaming","idx_genre='{$idx_genre}'");
			break;
		case 3:
			$response = load_by_q('먹방');
			db_delete("youtube_streaming","idx_genre='{$idx_genre}'");
			break;
		case 4:
			$response = load_by_q('음악');
			db_delete("youtube_streaming","idx_genre='{$idx_genre}'");
			break;
		case 5:
			$response = load_by_category(17);
			db_delete("youtube_streaming","idx_genre='{$idx_genre}'");
			break;
		default:
			alert("해당 idx_genre에 대한 불러오기 기능이 없습니다.");
			break;
	}
	// print_r($response);
	// exit();

	

	$i = 1;
	foreach($response['items'] as $data)
	{
		//todo: 비연결 유튜버 테이블 추가
		$streamer_thumb_row = $youtube->channels->listChannels('snippet', array('id' => $data['snippet']['channelId'], 'fields'=>"items(snippet(thumbnails(default(url))))"));
		if(!$streamer_thumb = $streamer_thumb_row['items'][0]['snippet']['thumbnails']['default']['url'])
			$streamer_thumb = $no_img;
		
		
		db_insert("youtube_streaming", array(
			"stream_title" => 		$data['snippet']['title'],
			"url_thumbnail" => 		$data['snippet']['thumbnails']['high']['url'],
			"v_id" => 				$data['id']['videoId'],
			"idx_genre" => 			$idx_genre,
			"channel_name" => 		$data['snippet']['channelTitle'],
			"channel_id" => 		$data['snippet']['channelId'],
			"url_youtuber_thumb" => $streamer_thumb,
		));
		echo $i++ . " ok <br> ";
	}

?>