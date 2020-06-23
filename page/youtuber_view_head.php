
<link rel="stylesheet" href="/css/youtuber_view.css">

<div class="wrapper">
	<!-- 유튜버 페이지 배경 이미지 -->
	<div id="channel_art" style="background-image:url(<?=$streamer_data['img_back']?>);"></div>
	<!-- 유튜버 정보 -->
	<div id="middle_profile">
		<div id="profile" class="row">
				<div class="row" id="profile_box">
					<div class="col-3">
						<div class="M_profile_img_box">
							<div class="M_profile_img" style="background-image:url(<?=$streamer_data['picture']?>)"></div>
						</div>
					</div>
					<div class="col-9">
						<div id="profile_name">
							<strong style="font-size:1.3em">
								<?=$streamer_data['name']?>
							</strong>
						</div>
						<span>구독자 <?=$streamer_data['youtube_subscriberCount']?>명</span>
						<span>팔로잉 <?=$follow_num['COUNT(*)']?>명</span>
					</div>
				</div>
				<div class="col">
					<button class="btn btn_follow <?=is_following($streamer_data['idx'])?"following":""?>" onclick="f_motion('<?=$streamer_data['idx']?>', this);" style="margin-top:22px;"></button>
				</div>	
		</div>
	</div>
	<!-- 공지, 커뮤니티 선택 부분 -->
	<div id="middle_category">
		<div id="category" class="row">
			
			<div id="notice_button" class="col-2">
				<strong>
					<a class="<?=($page=='youtuber_view')?"notice_button_true":"notice_button_false"?>" href="/youtuber_view/<?=$idx?>">공지</a>
				</strong>
			</div>
			<div id="comunity_button" class="col-2">
				<strong>
					<a class="<?=($page=='youtuber_view_comunity' || $page=='youtuber_post')?"comunity_button_true":"comunity_button_false"?>" href="/youtuber_view_comunity/<?=$idx?>">커뮤니티</a>
				</strong>
			</div>
			
		</div>
	</div>