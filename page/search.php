<?php if(!defined('AFTER_CONFIG')){exit('no config');} ?>
<?php
	$search = $_GET['search'];
?>

<style>
	.container{
		margin-top:30px;
	}
	.sub_title2{padding:15px; border-bottom:2px solid #333;}
	
	.card_wrap_wide{}
	.card_wrap_wide>.card_wrapper{padding:10px 0;box-sizing:border-box;}
	.card_wrap_wide>.card_wrapper>.cards_1{position:relative;width:100%;background-color:white;padding:15px;}
	.card_wrap_wide>.card_wrapper>.cards_2{position:relative;width:100%;background-color:white;padding:15px;}
	
		.card_wrap_wide>.card_wrapper>.cards_1>div{float:left;}
		.card_wrap_wide>.card_wrapper>.cards_2>div{float:left;}
		.card_wrap_wide>.card_wrapper>.cards_1::after{content:'';display:block;float:none;clear:both;}
		.card_wrap_wide>.card_wrapper>.cards_2::after{content:'';display:block;float:none;clear:both;}
		.card_wrap_wide>.card_wrapper>.cards_1>.thumb_wrap{width:250px; position:relative;}
			.card_wrap_wide>.card_wrapper>.cards_1>.thumb_wrap>.thumb{display:block;width:100%;padding-top:50%;background-repeat:no-repeat;background-position:50%;background-size:cover;}
			.card_wrap_wide>.card_wrapper>.cards_1>.thumb_wrap>.icon_live{position:absolute;top: 6px; right: 7px;}
		.card_wrap_wide>.card_wrapper>.cards_1>.content_wrap{width:calc( 100% - 250px );padding-left:15px; box-sizing:border-box;line-height:1.5}
			.card_wrap_wide>.card_wrapper>.cards_1>.content_wrap>.title{font-size:16px; font-weight:bold;display:inline-block; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis; max-height: 60px;}
			.card_wrap_wide>.card_wrapper>.cards_1>.content_wrap>.streamer{font-size:14px;font-weight:bold;}
				.card_wrap_wide>.card_wrapper>.cards_1>.content_wrap>.streamer>a{color:#666;}
			.card_wrap_wide>.card_wrapper>.cards_1>.content_wrap>.info{font-size:14px;color:#666;}
			.card_wrap_wide>.card_wrapper>.cards_1>.content_wrap>.bottom{font-size:13px;color:#bbb;}
	.card_wrap_wide a{color:black;text-decoration:none;}
	
	.rounded-circle{width:70px;}
	.thumb_profile{margin-right:7%}
	.name{font-size:20px; font-weight:bold;}
	.subscriber{font-size:12px;color:#bbb;}
	.info{font-size:14px;display:inline-block; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis; height: 20px;width:135px;}
	.tag{font-size:14px;}
	.tag span{margin-right:3px;}
	.more{float:right;}
	.col-sm-3{width:100%;}
	

	@media(max-width:700px){
		.card_wrap_wide>.card_wrapper>.cards_1>*{width: 100% !important; padding: 10px;}
		.info{font-size:14px;display:inline-block; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis; width:250px;}
		
	}
</style>
<div class="container">
	<div class="row">

		<div class="col-md-9">
			<h2 class="sub_title2">생방송</h2>
			
			<div class="card_wrap_wide">
				<?php 
				$count=0;
				$search_rows = $db->query("select * from youtube_streaming where stream_title like '%$search%' or channel_name like '%$search%' order by idx desc");
				while($search_data=$search_rows->fetch_assoc()){
					$streamer_rows = $db->query("select * from streamer where channel_id='{$search_data['channel_id']}'");
					$streamer_data = $streamer_rows->fetch_assoc();
					
				
					
					
				?>
			<?php if($count==5){?>
				<div class="more" id="button<?=$count?>" ><button onclick="m_motion(<?=$count?>);">+더보기</button></div>
				<?}?>
				<?php if($count%5==0&&$count!=0&&$count!=5){?>
				<div class="more" id="button<?=$count?>" style="display:none;"><button onclick="m_motion(<?=$count?>);">+더보기</button></div>
				<?}?>
					<div class="card_wrapper">
						
						<div class="cards_1" id="show<?=$count?>" <?=($count++>=5?"style='display:none;'":"")?>>
							
							<div class="thumb_wrap">
								<a class="thumb" href="/view_live/<?=$search_data['v_id']?>" style="background-image:url(<?=$search_data['url_thumbnail']?>);"></a><!--방송화면 썸네일, 생방송이동-->
								<span class="icon_live"></span>
							</div>
							<div class="content_wrap">
								<div class="title"><a href="/view_live/<?=$search_data['v_id']?>"><?=$search_data['stream_title']?></a></div><!--방송이름, 생방송이동-->
								<div class="streamer"><a href="/youtuber_view/<?=$streamer_data['idx']?>"><?=$search_data['channel_name']?></a></div><!--채널이름, 스트리머페이지이동-->
								<div class="info"><?=$streamer_data['description']?></div><!--소개-->
								
								
							</div>
						</div>
						
					</div>
				<? } ?>
				
			</div>
			
		</div>

		<div class="col-md-3">
			<h2 class="sub_title2">채널</h2>
			<div class="card_wrap_wide">
				<?php 
					$search_tag_rows = $db->query("select * from genres where name_genre like '%{$search}%'");
					if($search_tag_rows->num_rows) //일치하는 데이터가 있으면
						$search_tag = $search_tag_rows->fetch_assoc()['idx'];
					else
						$search_tag = '-1'; 
					
					$search_streamer_rows = $db->query("select * , streamer.idx as idx_streamer from streamer left join member on streamer.idx_member=member.idx where streamer.idx_genres like '%{$search_tag}%' or member.name like '%{$search}%'");
					while($search_streamer_data = $search_streamer_rows->fetch_assoc()) // streamer이랑 member이랑 $search_streamer_data 변수에 한번에 다 들어감.
					{
						
						$follow_num_rows = $db->query("SELECT COUNT(*) FROM following WHERE idx_streamer='{$search_streamer_data['idx_streamer']}'");
						$follow_num = $follow_num_rows->fetch_assoc();
						
						$genres_rows = $db->query("select * from genres");
						$arr_genres = array();
						while($genres_data = $genres_rows->fetch_assoc()){
							$arr_genres[$genres_data['idx']] = $genres_data['name_genre'];
						}
						
						?>

						<div class="card_wrapper">
							<div class="cards_2">
								<div class="thumb_profile">
									<a href="/youtuber_view/<?=$search_streamer_data['idx_streamer']?>"><!--멤버 idx값 불러져옴.-->
									<img src="<?=$search_streamer_data['picture']?>" class="rounded-circle" alt="thumbnail" ><!--계정사진-->
									</a></div>
								<div class="content">
									<a href="/youtuber_view/<?=$search_streamer_data['idx_streamer']?>">
									<div class="name"><?=$search_streamer_data['name']?></div><!--채널이름, 스트리머페이지이동-->
									<div class="tag"><?$explode_genres = explode("/", $search_streamer_data['idx_genres']);
													foreach($explode_genres as $genre){
														if($genre == 0)
															continue;
														?><span><?=$arr_genres[$genre]?></span><?
													}?></div>
									<div class="info"><?=$search_streamer_data['description']?></div><!--소개-->
									<div class="subscriber">팔로잉 <?=$follow_num['COUNT(*)']?>명</div><!--구독자수-->
									</a>	
									<button class="btn btn_follow <?=is_following($search_streamer_data['idx_streamer'])?"following":""?>" onclick="f_motion('<?=$search_streamer_data['idx_streamer']?>', this);"></button>
								</div>
							</div>
						</div>
						<?
					}
				?>

			</div>
		</div>
	</div>
</div>