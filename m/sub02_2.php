<?php
include_once "./_common.php";
//pc버전에서 모바일가기 링크 타고 들어올 경우 세션을 삭제한다. 세션이 삭제되면 모바일 기기에서 PC버전 접속시 자동으로 모바일로 이동된다. /extend/g4m.config.php 파일 참고.
if($_GET['from'] == 'pc'){
    set_session("frommoblie", "");
}
include_once './_head.php';


?>

<div class="main-btn" style="margin-bottom:20px">
<a href="<?php echo $g4['url']?>/m/sub02_1.php">쇼앤뉴그린 객실보기</a> / <a href="<?php echo $g4['url']?>/m/sub02_2.php">빅토리아 객실보기</a>
</div>

<div class="s_room_box_ps">객실가격은 요금안내를  참조하세요</div>

<!-- 빅토리아 객실정보 -->
<div id="s_room_box">
	<h1>빅토리아 : VIP 펜션</h1>
	<div><a href="vroom1.php"><img src="./<?=$g4['path']?>/mobile/images/v1_1.jpg" width="100%" /></a></div>
	<table width="100%" cellpadding="0" cellspacing="0" class="s_room_tbl">
		<tr>
			<th width="30%">객실이름</th>
			<th width="15%">객실수</th>
			<th width="18%">객실평수</th>
			<th>객실인원</th>
		</tr>
		<tr>
			<td>빅) VIP 펜션</td>
			<td>1개</td>
			<td>20평</td>
			<td class="left">
			기준 : 6명 / 최대 : 12명
			</td>
		</tr>
	</table>
</div>


<div id="s_room_box">
	<h1>빅토리아 : 특대 펜션</h1>
	<div><a href="vroom2.php"><img src="./<?=$g4['path']?>/mobile/images/v2_1.jpg" width="100%" /></a></div>
	<table width="100%" cellpadding="0" cellspacing="0" class="s_room_tbl">
		<tr>
			<th width="30%">객실이름</th>
			<th width="15%">객실수</th>
			<th width="18%">객실평수</th>
			<th>객실인원</th>
		</tr>
		<tr>
			<td>빅) 특대형</td>
			<td>4개</td>
			<td>20평</td>
			<td class="left">
			기준 : 8명 / 최대 : 15명
			</td>
		</tr>
	</table>
</div>

<div id="s_room_box">
	<h1>빅토리아 : 투룸 펜션</h1>
	<div><a href="vroom6.php"><img src="./<?=$g4['path']?>/mobile/images/v6_1.jpg" width="100%" /></a></div>
	<table width="100%" cellpadding="0" cellspacing="0" class="s_room_tbl">
		<tr>
			<th width="30%">객실이름</th>
			<th width="15%">객실수</th>
			<th width="18%">객실평수</th>
			<th>객실인원</th>
		</tr>
		<tr>
			<td>빅) 투룸 펜션</td>
			<td>5개</td>
			<td>20평</td>
			<td class="left">
			기준 : 4명 / 최대 : 10명
			</td>
		</tr>
	</table>
</div>


<div id="s_room_box">
	<h1>빅토리아 : 더블 스위트룸</h1>
	<div><a href="vroom3.php"><img src="./<?=$g4['path']?>/mobile/images/v3_1.jpg" width="100%" /></a></div>
	<table width="100%" cellpadding="0" cellspacing="0" class="s_room_tbl">
		<tr>
			<th width="30%">객실이름</th>
			<th width="15%">객실수</th>
			<th width="18%">객실평수</th>
			<th>객실인원</th>
		</tr>
		<tr>
			<td>빅) 더블 스위트룸</td>
			<td>10개</td>
			<td>13평</td>
			<td class="left">
			기준 : 2명 / 최대 : 4명
			</td>
		</tr>
	</table>
</div>


<div id="s_room_box">
	<h1>빅토리아 : 침대룸</h1>
	<div><a href="vroom4.php"><img src="./<?=$g4['path']?>/mobile/images/v4_1.jpg" width="100%" /></a></div>
	<table width="100%" cellpadding="0" cellspacing="0" class="s_room_tbl">
		<tr>
			<th width="30%">객실이름</th>
			<th width="15%">객실수</th>
			<th width="18%">객실평수</th>
			<th>객실인원</th>
		</tr>
		<tr>
			<td>빅) 침대룸</td>
			<td>13개</td>
			<td>13평</td>
			<td class="left">
			기준 : 2명 / 최대 : 4명
			</td>
		</tr>
	</table>
</div>


<div id="s_room_box" style="margin:0; padding:0;">
	<h1>빅토리아 : 온돌大</h1>
	<div><a href="vroom5.php"><img src="./<?=$g4['path']?>/mobile/images/v5_1.jpg" width="100%" /></a></div>
	<table width="100%" cellpadding="0" cellspacing="0" class="s_room_tbl">
		<tr>
			<th width="30%">객실이름</th>
			<th width="15%">객실수</th>
			<th width="18%">객실평수</th>
			<th>객실인원</th>
		</tr>
		<tr>
			<td>빅) 일반온돌大</td>
			<td>49개</td>
			<td>13평</td>
			<td class="left">
			기준 : 4명 / 최대 : 6명
			</td>
		</tr>
	</table>
</div>
<!-- 빅토리아 객실정보 -->


<?php include_once './_tail.php';
?>

