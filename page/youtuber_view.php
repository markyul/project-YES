<?php 
	if(!defined('AFTER_CONFIG')){exit('no config');} 

	// /youtuber_view/13 이런식으로 들어와야함


	if(!isset($_GET['idx']))//isset 설정함수 $_GET가 설정되어있으면 true 아니면 false
		alert('비정상적인 주소입니다.');

	$idx = $_GET['idx'];
	$row = $db->query("SELECT * from notice ORDER BY idx desc");//정렬
	$streamer_row = $db->query("SELECT streamer.*, member.name, member.picture FROM streamer LEFT JOIN member ON streamer.idx_member = member.idx WHERE streamer.idx = '{$idx}'");//streamer의 idx값을 row
	$streamer_data = $streamer_row->fetch_assoc();
	$follow_num_row = $db->query("SELECT COUNT(*) FROM following WHERE idx_streamer = '{$idx}'");
	$follow_num = $follow_num_row->fetch_assoc();
	
	if($streamer_row->num_rows == 0)
		alert('존재하지 않는 스트리머입니다.');

	include_once($_SERVER['DOCUMENT_ROOT'] . "/page/youtuber_view_head.php");
?>
<link rel="stylesheet" href="/css/style_notice.css">

	<!-- 공지 -->
	<div id="bottom_page">
		<div id="blank" class="row">
			<div class="col-2"></div>
			<div class="col-8">
				<div class="row">
					<div class="col-10">
						<div class="header">
							공지사항
						</div>
					</div>
					<?php
						if($streamer_data['idx_member'] == $my_idx){
					?>
					<button type="button" class="btn btn-light btn-sm" onclick="location.href='/notice_write'">
						글쓰기
					</button>
					<?php
						}
					?>
				</div>
			</div>
			<div class="col-2"></div>
		</div>
		<div class="row">
			<div class="col-2"></div>
			<div class="col-8">
				<?php
					while($data = $row->fetch_assoc()){
						if($data['idx_member'] == $streamer_data['idx_member']) {
				?>
				<div class="notice_content">
					<div class="row">
							<div class ="profile_img_box">
								<div class="profile_img" style="background-image:url(<?=$streamer_data['picture']?>)"></div>
							</div>
							<div class="col-10">
								<div class="content_name">
									<strong><?=$streamer_data['name']?></strong>
								</div>
								<div class = notice_info>
									<?php echo date("y-m-d", strtotime($data['dt_write']));?>
									<?php
										if($streamer_data['idx_member'] == $my_idx){
									?>
									<a href="/notice_modify?idx=<?=$data['idx']?>">수정</a>
									<a href="/notice_delete?idx=<?=$data['idx']?>">삭제</a>
									<?php
										}
									?>
								</div>
								<?php echo str_replace("\n", "<br>", $data['cont']);?>
							</div>
						<div class="col-1"></div>
					</div>
				</div>
				<?php }} ?>
			</div>
			<div class="col-2"></div>
		</div>
	</div>
</div>