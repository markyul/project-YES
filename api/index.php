<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
	include_once($_SERVER['DOCUMENT_ROOT'] . "/config/api_config.php");
?>
<link rel="stylesheet" href="/css/bootstrap.min.css">

<div class="container shadow mt-5 p-5 text-center">
	<a class="btn btn-secondary" href="<?=$authUrl?>">구글 토큰 재인증</a>

	
	
	
	<div>
		<a class="btn btn-primary btn-sm my-1" href="/api?api_page=load_lives&idx_genre=0">인기 카테고리 불러오기</a>
	</div>
	<div>
		<a class="btn btn-primary btn-sm my-1" href="/api?api_page=load_lives&idx_genre=1">게임 카테고리 불러오기</a>
	</div>
	<div>
		<a class="btn btn-primary btn-sm my-1" href="/api?api_page=load_lives&idx_genre=2">토크 카테고리 불러오기</a>
	</div>
	<div>
		<a class="btn btn-primary btn-sm my-1" href="/api?api_page=load_lives&idx_genre=3">먹방 카테고리 불러오기</a>
	</div>
	<div>
		<a class="btn btn-primary btn-sm my-1" href="/api?api_page=load_lives&idx_genre=4">음악 카테고리 불러오기</a>
	</div>
	<div>
		<a class="btn btn-primary btn-sm my-1" href="/api?api_page=load_lives&idx_genre=5">스포츠 카테고리 불러오기</a>
	</div>
	<!-- <div>
		<a class="btn btn-primary btn-sm my-1" href="/api?api_page=load_lives&idx_genre=5">생방송 불러오기 장르:기타</a>
	</div> -->
</div>
<div class="container shadow mt-5 p-5 text-center">
<?php
	
	if(isset($_GET['api_page']))
		include_once($_SERVER['DOCUMENT_ROOT'] . "/api/".$_GET['api_page'].".php");

	//$_SESSION[$tokenSessionKey] = $client->getAccessToken();
?>
</div>