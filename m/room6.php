<?php
include_once "./_common.php";
if($_GET['from'] == 'pc'){
    set_session("frommoblie", "");
}
include_once './_head.php';
?>

<div id="s_room_box" style="margin:0; padding:0;">

	<h1>쇼앤뉴그린 : 일반룸</h1>

	<div class="s_room_box_ps_view">객실가격은 요금안내를 참조하세요</div>

	<table width="100%" cellpadding="0" cellspacing="0" class="s_room_tbl view-no-margin">
		<tr>
			<th width="30%">객실이름</th>
			<th width="15%">객실수</th>
			<th width="18%">객실평수</th>
			<th>객실인원</th>
		</tr>
		<tr>
			<td>쇼) 일반룸</td>
			<td>46개</td>
			<td>11평</td>
			<td class="left">
			기준 : 2명 / 최대 : 5명
			</td>
		</tr>
	</table>

	<div class="gallery">
	<img src="./images/room/show_6_01.jpg" width="100%" /><br>
	<img src="./images/room/show_6_02.jpg" width="100%" />
	</div>

</div>

<?php include_once './_tail.php';
?>
