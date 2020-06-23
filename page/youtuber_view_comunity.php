<?php
	if(!defined('AFTER_CONFIG')){exit('no config');}

	if(!isset($_GET['idx']))//isset 설정함수 $_GET가 설정되어있으면 true 아니면 false
		alert('비정상적인 주소입니다.');

	$idx = $_GET['idx'];

	$row = $db->query("SELECT feed.*, member.name FROM feed LEFT JOIN member ON feed.idx_member = member.idx where idx_streamer = '{$idx}' ORDER BY feed.idx desc");

	$streamer_row = $db->query("SELECT streamer.*, member.name, member.picture FROM streamer LEFT JOIN member ON streamer.idx_member = member.idx WHERE streamer.idx = '{$idx}'");//streamer의 idx값을 row
	$streamer_data = $streamer_row->fetch_assoc();

	$follow_num_row = $db->query("SELECT COUNT(*) FROM following WHERE idx_streamer = '{$idx}'");
	$follow_num = $follow_num_row->fetch_assoc();
	
	if($streamer_row->num_rows == 0)
		alert('존재하지 않는 스트리머입니다.');

	include_once($_SERVER['DOCUMENT_ROOT'] . "/page/youtuber_view_head.php");
?>
<link rel="stylesheet" href="/css/style_comunity.css">

	<!-- 커뮤니티 -->
	<div id="bottom_page">
		<div id="blank" class="row">
			<div class="col-2"></div>
			<div class="col-8">
				<div id="post_header" class="row">
					<div class="col-9">
						<div id="post_name">
							제목
						</div>
					</div>
					<div id="post_nick" class="col-2">닉네임</div>
					<div class="col-1">날짜</div>
				</div>
			</div>
			<div class="col-2">
				<?php
					if($is_logged_in){
				?>
				<button type="button" class="btn btn-light btn-sm" onclick="location.href='/comunity_write?idx_channel=<?=$idx?>' ">
					글쓰기
				</button>
				<?php
					}
				?>
			</div>
		</div>
		<div class="row">
			<div class="col-2"></div>
			<div class="col-8">
				<?php
				
				while($data = $row->fetch_assoc()){
				?>
				<div id="post_box" class="row">
					<div class="col-9">
						<div id="post_name">
							<a href="/youtuber_post?post_idx=<?=$data['idx']?>"><?php echo $data['title'];?></a>
						</div>
						<div id="post_info">
							<?php echo $data['name'];?> <?=date("y-m-d", strtotime($data['dt_write']))?>
						</div>
					</div>
					<div id="post_nick">
						<?php echo $data['name'];?>
					</div>
					<div id="post_date">
						<?php echo date("m-d", strtotime($data['dt_write']));?>
					</div>
				</div>
				<?php } ?>
			</div>
			<div class="col-2"></div>
		</div>
		<?php
			if($is_logged_in){
		?>
		<button type="button" class='btn-floating' onclick="location.href='/comunity_write?idx_channel=<?=$idx?>'"><div>+</div></button> 
		<?php
			}
		?>
	</div>
</div>