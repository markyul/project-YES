<?php
	if(!defined('AFTER_CONFIG')){exit('no config');}

	require_once($_SERVER['DOCUMENT_ROOT'] . "/config/oauth_config.php");

	if($is_logged_in)
		alert('이미 로그인 되어있습니다.');

	if(isset($_GET["code"]))
	{
		$token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
		if(!isset($token['error']))
		{
			$_SESSION['access_token'] = $token['access_token'];
			
			$google_client->setAccessToken($_SESSION['access_token']);
			$google_service = new Google_Service_Oauth2($google_client);

			$data = $google_service->userinfo->get();
			
			
			if(empty($data['name']) || empty($data['email']) || empty($data['picture']))
				alert('데이터를 모두 불러오지 못했습니다.');
			
			$member_rows = $db->query("select * from member where email='".addslashes($data['email'])."'");
			
			if($member_rows->num_rows != 0) // 이메일이 데이터베이스에 존재하는 경우(로그인)
			{
				$member_data = $member_rows->fetch_assoc();
				
				$_SESSION['member'] = array(
					"name"=> $member_data['name'],
					"email"=> $member_data['email'],
					"picture"=> $member_data['picture']
				);
				$_SESSION['member']['idx'] = $member_data['idx'];
				alert('로그인 되었습니다!', '/');
			}
			else // (회원가입)
			{
				$member = array(
					"name"=> addslashes($data['name']),
					"email"=> addslashes($data['email']),
					"picture"=> addslashes($data['picture'])
				);

				$idx_member = db_insert('member', $member);

				$_SESSION['member'] = $member;
				$_SESSION['member']['idx'] = $idx_member;
				alert('로그인 되었습니다!', '/');
			}
			
		}
		else
			echo "토큰 오류입니다.";
	}
	

?>