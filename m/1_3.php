<?php
include_once "./_common.php";
if($_GET['from'] == 'pc'){
    set_session("frommoblie", "");
}
$bo_table = "bbs34";
$board_skin_path = "../skin/board/reser_n2/";
include_once './_head.php';

$query = "select * from g4_write_$bo_table WHERE wr_id = '$wr_id'  "; 
$result = mysql_query($query); 
$row = mysql_fetch_array($result); 
?>

<div id="mobile-wrap">




	<div class="booking-navi">
		<ul>
			<?php $on3 = "class=\"on\"";
				include_once "booking_menu.php";
			?>
		</ul>
	</div>
	
	<table width="100%" cellpadding="0" cellspacing="0" class="booting-tbl">
	<caption>예약관리</caption>
	<tr>
		<th>처리진행상황</th>
		<th>예약코드</th>
	</tr>
	<tr>
		<td style="color:red"><strong >
			<?=$row['wr_4'];?></strong>
		</td>
		<td>	<?=$row['wr_3'];?></td>
	</tr>
	<tr>
		<th>예약하신방</th>
		<th>예약인원</th>
	</tr>
	<tr>
		<td><?=$row['ca_name'];?></td>
		<td><?=$row['wr_1'];?>명</td>
	</tr>
	<tr>
		<th colspan="2">예약일정</th>
	</tr>
	<tr>
		<td colspan="2"><?=$row['wr_link1'];?> ~ <?=$row['wr_link2'];?> (<?=$row['wr_8'];?>박 <?=$row['wr_8']+1;?>일)</td>
	</tr>
	<tr>
		<th colspan="2">예약구분</th>
	</tr>
	<tr>
		<td colspan="2" class="left">
		<ul>
			<li><?=$row['wr_reserv'];?></li>
		</ul>
		</td>
	</tr>
	<tr>
		<th>총 숙박요금</th>
		<th>메일주소</th>
	</tr>
	<tr>
		<td><?=number_format($row['wr_10']);?>원</td>
		<td><?=$row['wr_email'];?></td>
	</tr>
	<tr>
		<th>휴대폰번호</th>
		<th>추가사항</th>
	</tr>
	<tr>
		<td><?=$row['wr_2'];?></td>
		<td><?=$row['wr_content'];?></td>
	</tr>
	</tbody>
	</table>



	<div class="btn-area"><a href="<?php echo $g4['url']?>/m/index.php" class="">확인</a></div>



	<?php include "mfooter.php";?>



</div><!-- /mobile-wrap -->

</body>
</html>
