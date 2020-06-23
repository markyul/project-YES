<?php
	if(!defined('AFTER_CONFIG')){exit('no config');}
	require_login();

	$post_idx = $_GET['post_idx'];
	$row = $db->query("SELECT feed.*, member.name FROM feed LEFT JOIN member ON feed.idx_member = member.idx WHERE feed.idx = ".$post_idx);
	$data = $row->fetch_assoc();
	$row2 = $db->query("SELECT feed_comment.*, member.name FROM feed_comment LEFT JOIN member ON feed_comment.idx_member = member.idx WHERE feed_comment.idx_feed = ".$post_idx ." ORDER BY feed_comment.idx desc");

	$streamer_row=$db->query("SELECT streamer.*, member.name, member.picture FROM streamer LEFT JOIN member ON streamer.idx_member = member.idx WHERE streamer.idx = '{$data['idx_streamer']}'");//streamer의 idx값을 row
	$streamer_data = $streamer_row->fetch_assoc();

	$follow_num_row = $db->query("SELECT COUNT(*) FROM following WHERE idx_streamer = '{$data['idx_streamer']}'");
	$follow_num = $follow_num_row->fetch_assoc();

	$idx = $data['idx_streamer'];

	include_once($_SERVER['DOCUMENT_ROOT'] . "/page/youtuber_view_head.php");
?>
<link rel="stylesheet" href="/css/style_post.css">
	<!-- 게시물 내용 -->
	<div id="bottom_page">
		<div id="post_view" class="row align-items-start">
			<div class="col-2"></div>
			<div class="col-8">
				<div id="post_header">
					<?=$data['title']?>
				</div>
				<div id="post_info">
					<?=date("Y-m-d h:i", strtotime($data['dt_write']))?> <span><?=$data['name']?></span>
				</div>
				<div id="post_content">
					<?php echo str_replace("\n", "<br>", $data['cont']);?>
				</div>
				<?php
				while($data2 = $row2->fetch_assoc()){
				?>
				
				<div id="comment_box">
					<div class="comment_name">
						<strong><?=$data2['name']?></strong>
					</div>
					<div class ="comment_info">
						<?php echo date("y-m-d", strtotime($data2['dt_write']));?>
						<?php if($data2['idx_member'] == $my_idx) { ?>
						<a href="/comment_delete?idx=<?=$data2['idx']?>">삭제</a>
						<?php }?>
					</div>
					<?php echo str_replace("\n", "<br>", $data2['cont']);?>
					<!-- 댓글 수정 폼 dialog -->
					<div class="dat_edit">
						<form method="post" action="rep_modify_ok.php">
							<input type="hidden" name="rno" value="<?=$data2['idx']?>" /><input type="hidden" name="b_no" value="<?=$post_idx?>">
							<textarea name="content" class="dap_edit_t"><?=$data2['cont']?></textarea>
							<input type="submit" value="수정하기" class="re_mo_bt">
						</form>
					</div>
				</div>
			
				<?php } ?>
				<div id="comment_insert">
					<form method = "POST" action="/post_comment_action?post_idx=<?=$post_idx?>">
						<div>
							<textarea name="content" id="exampleFormControlTextarea1" class="form-control" rows="3" placeholder="댓글을 달아주세요." required></textarea>
							<button type="submit" class="btn btn-secondary">작성</button>
						</div>
					</form>
				</div>
			</div>
			<?php
				if($_SESSION['member']['idx'] == $data['idx_member']){
			?>
			<div id="up_del_btn" class="col-2">
				<button type="button" class="btn btn-light btn-sm" onclick="location.href='/comunity_modify?idx=<?=$post_idx?>'">
					수정
				</button>
				<button type="button" class="btn btn-light btn-sm" onclick="location.href='/comunity_delete?idx=<?=$post_idx?>'">
					삭제
				</button>
			</div>
			<?php
				}
			?>
		</div>
	</div>