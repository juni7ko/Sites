<?php //  엑셀
include_once("./_common.php");
//include_once("./admin.head.php");

$filename = "";
if($r_year != "All")
	$filename .= $r_year;
if($r_month != "All")
	$filename .= $r_month;
if($r_day != "All")
	$filename .= $r_day;
$filename .= "reserve_list";

header("Content-type: application/vnd.ms-excel");
header("Content-type: charset=utf8");
header("Content-Disposition: attachment; filename={$filename}.xls");
header("Content-Description: PHP3 Generated Data");
header("Pragma: no-cache");
header("Expires: 0");
header("Cache-Control: idx-store, idx-cache, must-revalidate");


$mode = 'day';

$room_info = "g4_write_bbs34_r_info";
$room_base = "g4_write_bbs34";
$room_reserv = "g4_write_bbs34";

if(!$r_year && !$r_month && !$r_day) {
	$r_year = date("Y") ;
	$r_month = date("m") ;
	$r_day = date("d") ;
	$today = $r_year."-".$r_month."-".$r_day;
}

$where =  "where  rResult = '0020' ";

if($member[mb_level] >= 5)
	$where .= " and pension_id = '$member[mb_1]' ";

if($r_info_id)
	$where .= " and r_info_id = '$r_info_id' ";

if($r_month == "All" or !$r_month) {
	$searchDate = $r_year . "%";
} else {
	if( ($r_day == "All") or !$r_day) {
		$searchDate = $r_year . $r_month . "%";
	} else {
		$searchDate = $r_year . $r_month . $r_day;
	}
}

if($r_year != "All") {
	//$where .= " and  wr_link1 like '$r_year%' ";
	$where .= " and  wr_link1 like '$searchDate' ";
}

$search_SQL = "SELECT * from $room_reserv  $where  order by wr_link1 asc ";  //group by ca_name
$search_DB =  mysql_query($search_SQL);
$dayCnt = '0';
?>
<table border=1>
	<tr>
		<th>번호</th>
		<th>입금일</th>
		<th>객실명</th>
		<th>입실일 ~ 퇴실일</th>
		<th>예약일</th>
		<th>신청인</th>
		<th>예약금액</th>
		<th>입금액</th>
	</tr>
	<?php
	$no = '1';
	$insPay = $pay2['wr_9'];
	while ($pay2 = sql_fetch_array($search_DB))   {
		$Charge += $pay2['wr_9'];
		?>
		<tr>
			<td><?=$no?></td>
			<td><?=$pay2['wr_link1']?></td>
			<td><?=$pay2['ca_name']?></td>
			<td><?=$pay2['wr_link1']?></td>
			<td><?=$pay2['wr_datetime']?></td>
			<td><?=$pay2['wr_name']?></td>
			<td><?=($insedPay)?"<font style='color:#999999 ; font-size:11px'>" . number_format($pay2[wr_9]) . "</font><br />":''?><?=number_format($pay2[wr_9] - $insedPay)?></td>
			<td><?=number_format($pay2[wr_9])?></td>
		</tr>
		<?php
		$no++;
	}
	?>
	<tr><td style="height:2px" colspan="8"></td></tr>
	<tr style="font-weight:bold">
		<td colspan="3" align="center"><?php if($r_year && $r_year != "All"){echo $r_year . "년";}?> <?php if($r_month && $r_month != "All"){echo $r_month . "월";}?> <?php if($r_day && $r_day != "All" && $mode == "day"){echo $r_day . "일";}?></td>
		<td colspan="3" align="center">총 계</td>
		<td><?=number_format($Charge)?></td>
		<td><?=number_format($Charge)?></td>
	</tr>
</table>
