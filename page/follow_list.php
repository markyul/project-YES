<?php if(!defined('AFTER_CONFIG')){exit('no config');} 


?>


<link rel="stylesheet" href="/css/youtuber_list.css">
<div class="wrapper">
	<div class="container">
		<div class="row">
		<?php
			
			$following_rows = $db->query("select * from following where idx_member='{$my_idx}'");
				while($following_data = $following_rows->fetch_assoc()){
					$streamer_data = $db->query("select * from streamer where idx='{$following_data['idx_streamer']}'")->fetch_assoc();
					$member_data = $db->query("select * from member where idx='{$streamer_data['idx_member']}'")->fetch_assoc();
				
				$genres_rows = $db->query("select * from genres");
				$arr_genres = array();
				while($genres_data = $genres_rows->fetch_assoc()){
					$arr_genres[$genres_data['idx']] = $genres_data['name_genre'];
				}
			
				?>
				<div class="col-lg-4">
					<div class="col"><!--한 블록-->
						<a href="/youtuber_view/<?=$streamer_data['idx']?>"><!--유튜버 링크-->
							<div class="row">
								<div class="col-4">
									<a href="/youtuber_view/<?=$streamer_data['idx']?>">
									<img src="<?=$member_data['picture']?>" class="rounded-circle" alt="thumbnail">
									</a></div>
								<div class="col-8">
									<ul>
										<a href="/youtuber_view/<?=$streamer_data['idx']?>">
										<li id="name"><!--이름-->
											
											<?=$member_data['name']?>
											
										</li>
										<li id="tag"><!--태그쓰기-->
										
											<?
												$explode_genres = explode("/", $streamer_data['idx_genres']);
												foreach($explode_genres as $genre){
													if($genre == 0)
														continue;
													?><span class="tag"><?=$arr_genres[$genre]?></span><?
												}
											?>
										</li>
										<li id="introduce"><!--간단소개-->
					
											<?=$streamer_data['description']?>
											<?php
										if($streamer_data['description']==NULL)
	echo "<br/>";
											?>
										</li>
										</a>
										<button class="btn btn_follow <?=is_following($streamer_data['idx'])?"following":""?>" onclick="f_motion('<?=$streamer_data['idx']?>', this);"></button>
									</ul>
								</div>
							</div>
						</a>
					</div><!--여기까지-->
				</div>
				
				<?php
			}
		?>
	</div>
	</div>
</div>