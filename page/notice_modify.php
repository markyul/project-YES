<?php
	if(!defined('AFTER_CONFIG')){exit('no config');}

	$idx = $_GET['idx'];
	$row = $db->query("SELECT * FROM notice WHERE idx = ".$idx);
	$data = $row->fetch_assoc();
?>

<style>
	table.table2{
		border-collapse: separate;
		border-spacing: 1px;
		text-align: left;
		line-height: 1.5;
		border-top: 1px solid #ccc;
		margin-top:20px;
	}
	table.table2 tr {
		width: 100%;
		padding: 10px;
		font-weight: bold;
	}
	table.table2 td {
		width: 100px;
		padding: 10px;
		vertical-align: top;
		border-bottom: 1px solid #ccc;
	}
	button{
		margin: 5px;
	}
</style>
<div class="wrapper">
	<form method = "POST" action = "/notice_modify_action">
		<table style="width:100%" align = center>
			<tr>
				<td style="padding:5px" align=center bgcolor=#ccc>
					<font color=white>
						글쓰기
					</font>
				</td>
			</tr>
			<tr>
				<td bgcolor=white>
					<table class = "table2" style="width:100%">
						<tr>
							<td>작성자</td>
							<td><?=$_SESSION['member']['name']?> </td>
						</tr>
						<tr>
							<td>내용</td>
							<td>
								<textarea name=content cols=85 rows=15><?=$data['cont']?></textarea>	
							</td>
						</tr>
					</table>
					<center>
						<input type="hidden" name="idx" value="<?=$idx?>">
						<input type="hidden" name="date" value="<?=$data['dt_write']?>">
						<button type="submit" class="btn btn-secondary">
							작성
						</button> 
					</center>
				</td>
			</tr>
		</table>
	</form>
</div>