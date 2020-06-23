<?
	include_once($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");

	if(!defined('AFTER_CONFIG'))
		exit('no config');
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1, user-scalable=no">

	<meta property="og:description" content="현재 스트리밍 중인 방송을 한 눈에 볼 수 있습니다!"/>
	<meta property="og:title" content="YES - 유튜브 생방송을 한눈에"/>
	<title>YES - 유튜브 생방송을 한눈에</title>

	<link href="https://fonts.googleapis.com/css?family=Nanum+Gothic" rel="stylesheet">

	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/reset.css">
	<link rel="stylesheet" href="/css/style.css">
	<link rel="stylesheet" href="/css/button.css">

	<script src="/js/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/script.js"></script>
	
	<style>
		
	</style>
	<script>
		$(function(){
			$('#toggle-m-navbar').click(function(){
				$('.m_nav').show();
			})
			
			$('.m_nav .bg').click(function(){
				$('.m_nav').hide();
			})
		})
	</script>

</head>
<body>
	<div class="m_nav">
		<div class="bg"></div>
		<ul>
			<li><a href="/">생방송 목록</a></li>
			<li><a href="/youtuber_list">유튜버</a></li>
			<li><a href="/follow_list">팔로우</a></li>
			
			
				<?php if(!$is_logged_in): ?>
				<li>
					<a href="/google_login_ready">로그인</a>
				</li>
				<?php else: ?>
					<?php $header_streamer_row = $db->query("select * from streamer where idx_member='{$my_idx}'"); ?>
					<?php if($header_streamer_row->num_rows):
						$header_streamer_data = $header_streamer_row->fetch_assoc();
					?>
						<li>
							<a href="/youtuber_view/<?=$header_streamer_data['idx']?>">내 스트리머 페이지</a>
						</li>
					<?php endif ?>

					<li>
						<a href="/setting">설정</a>
					</li>

					<li>
						<a href="/logout">로그아웃</a>
					</li>
				<?php endif ?>
			
			
			
		</ul>
	</div>
	<header id="header">
		<div class="state_bar">	</div>
		<nav class="wrapper clearfix">
			<div id="header_logo">
				<a href="/"><img src="/images/logo.png" alt="logo"></a>
			</div>
			<button type="button" id="toggle-m-navbar">
				<div></div>
				<div></div>
				<div></div>
			</button>
			<ul id="header_nav" class="clearfix">
				<li><a <?=(($page=='main')?"class='active'":"")?> href="/">생방송 목록</a></li>
				<li><a <?=(($page=='youtuber_list')?"class='active'":"")?> href="/youtuber_list">유튜버</a></li>
				<li><a <?=(($page=='follow_list')?"class='active'":"")?> href="/follow_list">팔로우</a></li>
			</ul>
			<form id="search_blank" method="GET" action="/search">
				<input type="text" name="search" class="header_search_input" placeholder="검색어를 입력해주세요...">
						
			</form>
			<ul id="header_right" class="clearfix">
				<?php if(!$is_logged_in): ?>
				<li>
					<a class="btn btn-primary btn_login" href="/google_login_ready">로그인</a>
				</li>
				<?php else: ?>
				<li>			
					<div class="dropdown">
  						<div class='picture_wrap' style="background-image:url(<?=$_SESSION['member']['picture']?>)" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
 						</div>
  						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<ul>
								<?php $header_streamer_row = $db->query("select * from streamer where idx_member='{$my_idx}'"); ?>
								<?php if($header_streamer_row->num_rows):
									$header_streamer_data = $header_streamer_row->fetch_assoc();
								?>
									<li>
										<a class="dropdown-item" href="/youtuber_view/<?=$header_streamer_data['idx']?>">내 스트리머 페이지</a>
									</li>
								<?php endif ?>

								<li>
									<a class="dropdown-item" href="/setting">설정</a>
								</li>

								<li>
									<a class="dropdown-item" href="/logout">로그아웃</a>
								</li>
							</ul>
						</div>
					</div>
				</li>
				<?php endif ?>
			</ul>
		</nav>
	</header>
	<div id="content">
		<? 
			// 예) 주소.com/main => /page/main.php
			include($_SERVER['DOCUMENT_ROOT'] . "/page/" . $page . ".php");
		?>
	</div>
</body>
</html>