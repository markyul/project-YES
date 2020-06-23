<?php if(!defined('AFTER_CONFIG')){exit('no config');} ?>
<?
	if(isset($_GET['idx_genre']) && is_numeric($_GET['idx_genre']))
		$idx_genre = $_GET['idx_genre'];
	else
		$idx_genre = 0;
?>
<style>
	body{background-color:#f1f1f1;}
	#sub_header{text-align:center;color:white;background-color:#f54f4a;padding: 70px 20px;}
	#sub_header>h2{font-size:35px;font-weight:bold;}
	#sub_header>p{margin-top:10px;font-weight:300;}
	
	ul.hlist{text-align:center; margin-top:30px;}
	ul.hlist>li{display:inline-block;}
	ul.hlist>li>a{
		display: inline-block;
		color: #666;
		font-size: 18px;
		font-weight: bold;
		border-bottom: 3px solid rgba(0,0,0,0);
		text-decoration: none;
		padding: 3px 0px;
		margin: 0 10px;
		min-width: 20px;
		box-sizing: border-box;
	}
	ul.hlist>li>a:hover{color:black;}
	ul.hlist>li>a.active{color:black;border-bottom-color:#f54e4a;}
	
	
	.card_wrap{margin-top: 30px; }
	/* .card_wrap::after{content:'';display:block;float:none;clear:both;} */
	/* .card_wrap>.card_wrapper{float:left;width:25%; padding: 10px;} */
	@media(max-width:700px){
		/* .card_wrap>.card_wrapper{width:100%;} */
	}
	.card_wrap>.card_wrapper>.cards{background-color:white;border-radius:5px;box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);}
		.card_wrap>.card_wrapper>.cards>div{box-sizing:border-box;position:relative;}
		.card_wrap>.card_wrapper>.cards>.header{padding:10px 15px;}
			.card_wrap>.card_wrapper>.cards>.header>div>.thumb{display:inline-block;border-radius:50%;width:30px;height:30px;background-repeat:no-repeat;background-position:50%;background-size:cover;vertical-align:middle;}
			.card_wrap>.card_wrapper>.cards>.header>div>.nick{text-decoration:none;color:#444;margin-left:5px;font-size:14px;font-weight:bold;display: inline-block;text-overflow: ellipsis;max-width: calc( 100% - 90px);white-space: nowrap;overflow: hidden;vertical-align: middle;}
			.card_wrap>.card_wrapper>.cards>.header>.icon_live{position:absolute;right: 12px;top:50%;margin-top: -13px;}
		.card_wrap>.card_wrapper>.cards>.thumb{display:block;padding-top:50%;background-repeat:no-repeat;background-position:50%;background-size:cover;border-top:1px solid #eee;border-bottom:1px solid #eee;}
		.card_wrap>.card_wrapper>.cards>.content{padding:15px 15px;font-size:14px; }
			.card_wrap>.card_wrapper>.cards>.content>a{color:black;text-decoration:none;display:inline-block; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis; height: 42px;}
		.card_wrap>.card_wrapper>.cards>.bottom{padding:10px 15px;text-align:right;color:#aaa;font-size:13px;border-top:1px solid #ddd;}

	

</style>
<?php ?>
<div id="sub_header">
	<h2>실시간 스트리밍</h2>
	<p>현재 스트리밍 중인 방송을 한 눈에 볼 수 있습니다.</p>
</div>
<div class="wrapper">
	<ul class="hlist">
		<li><a <?=($idx_genre=='0')?"class='active'":''?> href="/">인기</a></li>
		<?
			$genres_rows = $db->query("select * from genres");
			while($genres_data = $genres_rows->fetch_assoc())
			{
				?><li><a <?=($idx_genre==$genres_data['idx'])?"class='active'":''?> href="/?idx_genre=<?=$genres_data['idx']?>"><?=$genres_data['name_genre']?></a></li><?
			}
		?>
	</ul>
	<div class="card_wrap row">
		<div class="card_wrapper col-lg-3 col-md-6 my-2" style="display:none;">
			<div class="cards">
				<div class="header">
					<div class="profile_popup_trigger" data-idx="55">
						<div class="thumb" style="background-image:url(https://yt3.ggpht.com/a/AATXAJwRIM-Pth7MDGEJm52AfSP-0BTox9uN-7LlnQ=s100-c-k-c0xffffffff-no-rj-mo);"></div>
						<a class="nick">김성태</a>
					</div>
					<span class="icon_live"></span>
				</div>
				<a href="/view_live/U_sYIKWhJvk" class="thumb" style="background-image:url(https://i.ytimg.com/vi/eE4a-8szGbc/hqdefault_live.jpg);"></a>
				<div class="content"><a href="/view_live/U_sYIKWhJvk">실시간 방송입니다~</a></div>
				<!-- <div class="bottom">23만명 시청중</div> -->
			</div>
		</div>


		<?php
			// if($idx_genre==0)
			// 	$row = $db->query("select * from youtube_streaming");
			// else
		
			$row = $db->query("select * from youtube_streaming where idx_genre='{$idx_genre}'");
			while($data = $row->fetch_assoc()){
				$streamer_rows = $db->query("select * from streamer where channel_id='{$data['channel_id']}'");
				$is_registered = $streamer_rows->num_rows != 0;
				if($is_registered){ $streamer_data = $streamer_rows->fetch_assoc(); }
				?>
				<div class="card_wrapper col-lg-3 col-md-6 my-2">
					<div class="cards">
						<div class="header">
							<div class="<?=(($is_registered)?"profile_popup_trigger":"profile_popup_trigger")?>" <?=(($is_registered)?"data-idx=".$streamer_data['idx']:"data-channel_id=".$data['channel_id'])?>>
								<div class="thumb" style="background-image:url(<?=$data['url_youtuber_thumb']?>);"></div>
								<a class="nick"><?=$data['channel_name']?></a> <!-- href="/youtuber_view/16" -->
							</div>
							<span class="icon_live"></span>
						</div>
						<a href="/view_live/<?=$data['v_id']?>" class="thumb" style="background-image:url(<?=$data['url_thumbnail']?>);"></a>
						<div class="content"><a href="/view_live/<?=$data['v_id']?>"><?=$data['stream_title']?></a></div>
						<!-- <div class="bottom">23만명 시청중</div> -->
					</div>
				</div>
			<? } ?>
		<?  ?>
		
	</div>
</div>