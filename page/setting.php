<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
	if(!defined('AFTER_CONFIG'))
		exit('no config');

	if(!$is_logged_in)
		alert('로그인이 필요합니다.');

	
	$streamer_count = $db->query("select * from streamer where idx_member='{$my_idx}'");
	$streamer_data = $streamer_count->fetch_assoc();
?>

<div class="wrapper mt-5" id="setting_wrap">
	<br>
	<div>유튜버
		<label class="switch"><!--on/off버튼-->
			<input id="streamer_do" type="checkbox" onclick="showHide();" <?=($streamer_count->num_rows>0)?'checked="checked"':""?> >
			<span class="slider round"></span>
		</label>
	</div>
	<?php if($streamer_count->num_rows==0){?>
	<br>
	<?}?>
	<?php if($streamer_count->num_rows>0): ?>
		<div class="counts mt-5">
			<table class="table text-center">
				<tbody>
					<tr>
						<th>조회수</th>
						<th>댓글 개수</th>
						<th>구독자 수</th>
						<th>영상 개수</th>
					</tr>
					<tr>
						<td><?=$streamer_data['youtube_viewCount']?></td>
						<td><?=$streamer_data['youtube_commentCount']?></td>
						<td><?=$streamer_data['youtube_subscriberCount']?></td>
						<td><?=$streamer_data['youtube_videoCount']?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div>
			<a href="/streamer_update" class="btn btn-primary">새로 불러오기</a>
		</div>
		<div id="streamer_menu">
			<div>
				<h4 class="mt-5">소개설정</h4>
				<form method="POST" action="/description_action">
					<div class="form-group">
						<input type="text" class=form-control name="descript" placeholder="소개를 입력해 주세요." maxlength="20" value="<?=$streamer_data['description']?>">
					</div>
					<button type="submit" class="btn btn-primary">확인</button>
				</form>
			</div>
			<div>
				<h4 class="mt-5">태그설정</h4>
				<form method="POST" action="/tag_action">
					<?php
						$genres_rows = $db->query("select * from genres");
						while($genres_data = $genres_rows->fetch_assoc())
						{
							if(strpos($streamer_data['idx_genres'], $genres_data['idx']) !== false)
								$is_checked = "checked";
							else
								$is_checked = "";
							
							?>
								<label class='mr-3'>
									<input type="checkbox" name="tag[]" value="<?=$genres_data['idx']?>" <?=$is_checked?>>
									<?=$genres_data['name_genre']?>
								</label>
							<?php
						}
					?>
					<script>
						$('#streamer_menu input[type=checkbox]').click(function(e){
							if($('#streamer_menu input[type=checkbox]:checked').length>3)
							{
								e.preventDefault();
								alert("최대 3개만 지정 가능합니다.");
							}
						});
					</script>
					<button type="submit" class="btn btn-primary">확인</button>
				</form>
			</div>
			<br>
		</div>
	<?php endif ?>
</div>