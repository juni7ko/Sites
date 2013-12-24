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

<!-- 쇼앤뉴그린 객실정보 -->
<div id="s_room_box">
	<h1>쇼앤뉴그린 : VIP 펜션</h1>
	<div><a href="room4.php"><img src="./<?=$g4['path']?>/mobile/images/s1_4.jpg" width="100%" /></a></div>
	<table width="100%" cellpadding="0" cellspacing="0" class="s_room_tbl">
		<tr>
			<th width="30%">객실이름</th>
			<th width="15%">객실수</th>
			<th width="18%">객실평수</th>
			<th>객실인원</th>
		</tr>
		<tr>
			<td>쇼) VIP</td>
			<td>2개</td>
			<td>17평</td>
			<td class="left">
			기준 : 4명 / 최대 : 8명
			</td>
		</tr>
	</table>
</div>


<div id="s_room_box">
	<h1>쇼앤뉴그린 : 펜션스위트</h1>
	<div><a href="room7.php"><img src="./<?=$g4['path']?>/mobile/images/s1_8.jpg" width="100%" /></a></div>
	<table width="100%" cellpadding="0" cellspacing="0" class="s_room_tbl">
		<tr>
			<th width="30%">객실이름</th>
			<th width="15%">객실수</th>
			<th width="18%">객실평수</th>
			<th>객실인원</th>
		</tr>
		<tr>
			<td>쇼) 펜션스위트</td>
			<td>5개</td>
			<td>16평</td>
			<td class="left">
			기준 : 4명 / 최대 : 6명
			</td>
		</tr>
	</table>
</div>


<div id="s_room_box">
	<h1>쇼앤뉴그린 : 스위트 룸</h1>
	<div><a href="room1.php"><img src="./<?=$g4['path']?>/mobile/images/s1_1.jpg" width="100%" /></a></div>
	<table width="100%" cellpadding="0" cellspacing="0" class="s_room_tbl">
		<tr>
			<th width="30%">객실이름</th>
			<th width="15%">객실수</th>
			<th width="18%">객실평수</th>
			<th>객실인원</th>
		</tr>
		<tr>
			<td>쇼) 스위트</td>
			<td>10개</td>
			<td>15평</td>
			<td class="left">
			기준 : 4명 / 최대 : 6명
			</td>
		</tr>
	</table>
</div>


<div id="s_room_box">
	<h1>쇼앤뉴그린 : 럭셔리</h1>
	<div><a href="room2.php"><img src="./<?=$g4['path']?>/mobile/images/s1_2.jpg" width="100%" /></a></div>
	<table width="100%" cellpadding="0" cellspacing="0" class="s_room_tbl">
		<tr>
			<th width="30%">객실이름</th>
			<th width="15%">객실수</th>
			<th width="18%">객실평수</th>
			<th>객실인원</th>
		</tr>
		<tr>
			<td>쇼) 럭셔리</td>
			<td>10개</td>
			<td>13평</td>
			<td class="left">
			기준 : 2명 / 최대 : 5명
			</td>
		</tr>
	</table>
</div>


<div id="s_room_box">
	<h1>쇼앤뉴그린 : 디럭스</h1>
	<div><a href="room3.php"><img src="./<?=$g4['path']?>/mobile/images/s1_3.jpg" width="100%" /></a></div>
	<table width="100%" cellpadding="0" cellspacing="0" class="s_room_tbl">
		<tr>
			<th width="30%">객실이름</th>
			<th width="15%">객실수</th>
			<th width="18%">객실평수</th>
			<th>객실인원</th>
		</tr>
		<tr>
			<td>쇼) 디럭스</td>
			<td>18개</td>
			<td>8평</td>
			<td class="left">
			기준 : 2명 / 최대 : 4명
			</td>
		</tr>
	</table>
</div>


<div id="s_room_box">
	<h1>쇼앤뉴그린 : 일반룸大</h1>
	<div><a href="room5.php"><img src="./<?=$g4['path']?>/mobile/images/s1_5.jpg" width="100%" /></a></div>
	<table width="100%" cellpadding="0" cellspacing="0" class="s_room_tbl">
		<tr>
			<th width="30%">객실이름</th>
			<th width="15%">객실수</th>
			<th width="18%">객실평수</th>
			<th>객실인원</th>
		</tr>
		<tr>
			<td>쇼) 일반룸大</td>
			<td>14개</td>
			<td>14평</td>
			<td class="left">
			기준 : 4명 / 최대 : 6명
			</td>
		</tr>
	</table>
</div>


<div id="s_room_box">
	<h1>쇼앤뉴그린 : 일반룸</h1>
	<div><a href="room6.php"><img src="./<?=$g4['path']?>/mobile/images/s1_6.jpg" width="100%" /></a></div>
	<table width="100%" cellpadding="0" cellspacing="0" class="s_room_tbl">
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
</div>
<!-- /쇼앤뉴그린 객실정보 -->


<?php include_once './_tail.php';
?>

