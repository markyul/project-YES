<?
	include_once($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");

	$api_redirect = 'http://' . $_SERVER['HTTP_HOST'].'/streamer_action';
	include_once($_SERVER['DOCUMENT_ROOT'] . "/config/api_config.php");
	if(!defined('AFTER_CONFIG'))
		exit('no config');

	if(!$is_logged_in)
		alert('로그인 되어있지 않습니다.');

	$streamer_row = $db->query("select * from streamer where idx_member='{$my_idx}'");

	$is_streamer = ($streamer_row->num_rows == 1);
	
	if ($is_streamer == 0)
	{
		$api_row = $youtube->channels->listChannels('id, statistics, brandingSettings', array(
			'mine'=>'true',
			'fields'=>"items(id,statistics(viewCount, commentCount, subscriberCount, videoCount),brandingSettings(image(bannerImageUrl)))"
		));
		
		if(isset($api_row['items'][0]['id'])){$channel_id = $api_row['items'][0]['id'];}else{$channel_id = '';}
		if(isset($api_row['items'][0]['brandingSettings']['image']['bannerImageUrl'])){$img_back = $api_row['items'][0]['brandingSettings']['image']['bannerImageUrl'];}else{$img_back = '';}
		if(isset($api_row['items'][0]['statistics']))
		{
			$api_data = $api_row['items'][0]['statistics'];
			if(isset($api_data['viewCount'])){$youtube_viewCount = $api_data['viewCount'];}else{$youtube_viewCount = '0';}
			if(isset($api_data['commentCount'])){$youtube_commentCount = $api_data['commentCount'];}else{$youtube_commentCount = '0';}
			if(isset($api_data['subscriberCount'])){$youtube_subscriberCount = $api_data['subscriberCount'];}else{$youtube_subscriberCount = '0';}
			if(isset($api_data['videoCount'])){$youtube_videoCount = $api_data['videoCount'];}else{$youtube_videoCount = '0';}
		}
		else
		{
			$youtube_viewCount = 0;
			$youtube_commentCount = 0;
			$youtube_subscriberCount = 0;
			$youtube_videoCount = 0;
		}
		
		$result = db_insert("streamer", array(
			"idx_member" => $my_idx,
			"channel_id" => $channel_id,
			'youtube_viewCount' => $youtube_viewCount,
			'youtube_commentCount' => $youtube_commentCount,
			'youtube_subscriberCount' => $youtube_subscriberCount,
			'youtube_videoCount' => $youtube_videoCount,
			'img_back' => $img_back,
		));
	}
	else{
		$streamer_data = $streamer_row->fetch_assoc();
		$result = db_delete("streamer","idx_member='{$my_idx}'");
		$result = db_delete("following","idx_streamer='{$streamer_data['idx']}'");
	}
	


	if($result)
	{
		if($is_streamer)
			alert("스트리머가 비활성화 되었습니다.", '/setting');
		else
			alert("스트리머가 활성화 되었습니다.", '/setting');
	}
	else
		alert("오류입니다.");

?>