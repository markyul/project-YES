<?php
 $i=1;
    while($i<7){
	if($i==1){
	echo "<style>.add{display:none;}</style>";
	}
	
?>
<p class="add" style="display:block;">가</p>					
<?
  $i++;}
?>
display: inline-block;height: 40px; white-space: nowrap;overflow: hidden;text-overflow: ellipsis;white-space: normal;line-height: 1.2; height: 3.6em; text-align: left;word-wrap: break-word;display: -webkit-box;-webkit-line-clamp: 2-webkit-box-orient: vertical;

$idx=$search_streamer_data("select * from ");
						$follow_rows = $db->query("select COUNT(*) from following WHERE idx_streamer ='{$idx}'");
						$follow_num = $follow_rows->fetch_assoc();
팔로잉 <?=$follow_num['COUNT(*)']?>명