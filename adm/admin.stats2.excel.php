<?php //  엑셀
include_once("./_common.php");

$pension_info = "g4_write_pension_info";
$room_info    = "g4_write_bbs34_r_info";
$room_base    = "g4_write_bbs34";
$room_reserv  = "g4_write_bbs34";

if( !$sDate && !$eDate ) {
	$r_year   = date("Y");
	$r_month  = date("m");
	$r_day    = date("d");

	$sDate = $r_year . $r_month . $r_day;
	$eDate = $sDate;
}

$filename = $sDate . "-" . $eDate;
$filename .= "reserve_list";

date_default_timezone_set("Asia/Seoul");
header("Cache-Control: private");
header("Content-Type: application/vnd.ms-excel");
header("Content-Type: charset=euc-kr");
header("Content-Disposition: attachment; filename={$filename}.xls;");
header("Content-Description: PHP");
header("Pragma: no-cache");
header("Expires: 0");
header("Cache-Control: idx-store, idx-cache, must-revalidate");

$where =  "WHERE  rResult = '0020' " ;
if($pension_id)
	$where .= " and pension_id = '$pension_id' ";

if($r_info_id)
	$where .= " and r_info_id = '$r_info_id' ";

$where .= " and (wr_link1 BETWEEN $sDate AND $eDate) ";

$sc_SQL = " SELECT * FROM $room_reserv $where order by wr_link1 asc ";
$select_DB = sql_query($sc_SQL);

$TotalCost = 0;
for ($i=0; $clist = sql_fetch_array($select_DB); $i++) {
	$rid[$i]['r_info_id'] = $clist['r_info_id'];
	if($rid[$i]['r_info_id'] == $rid[$i-1]['r_info_id']) {
		$list[$i]['r_info_name'] = $list[$i-1]['r_info_name'];
	} else {
		$rName_SQL = " SELECT r_info_name FROM $room_info WHERE r_info_id='$clist[r_info_id]' LIMIT 1 ";
		$rName = sql_fetch($rName_SQL);
		$list[$i]['r_info_name'] = $rName['r_info_name'];
	}

	$list[$i]['wr_link1'] = $clist['wr_link1'];
	$list[$i]['wr_datetime'] = $clist['wr_datetime'];
	$list[$i]['wr_name'] = $clist['wr_name'];
	$list[$i]['wr_9'] = $clist['wr_9'];
	$TotalCost += $list[$i]['wr_9'];
}
?>
<table border=1>
	<tr>
		<th>번호</th>
		<th>입금일</th>
		<th>객실명</th>
		<th>입실일</th>
		<th>예약일</th>
		<th>신청인</th>
		<th>예약금액</th>
		<th>입금액</th>
	</tr>
<?php for($i=0; $i < count($list); $i++) : ?>
	<tr>
		<td><?=$i+1?></td>
		<td><?=iconv("UTF-8","EUC-KR",$list[$i]['wr_link1'])?></td>
		<td><?=iconv("UTF-8","EUC-KR",$list[$i]['r_info_name'])?></td>
		<td><?=iconv("UTF-8","EUC-KR",$list[$i]['wr_link1'])?></td>
		<td><?=iconv("UTF-8","EUC-KR",$list[$i]['wr_datetime'])?></td>
		<td><?=iconv("UTF-8","EUC-KR",$list[$i]['wr_name'])?></td>
		<td><?=number_format($list[$i][wr_9])?></td>
		<td><?=number_format($list[$i][wr_9])?></td>
	</tr>
<?php endfor; ?>
	<tr><td style="height:2px" colspan="8"></td></tr>
	<tr style="font-weight:bold">
		<td rowspan="2" colspan="3" align="center">
			<?=substr($sDate,0,4)?>년 <?=substr($sDate,4,2)?>월 <?=substr($sDate,6,2)?>일
			~
			<?=substr($eDate,0,4)?>년 <?=substr($eDate,4,2)?>월 <?=substr($eDate,6,2)?>일
		</td>
		<td colspan="3" align="center">총 계</td>
		<td><?=number_format($TotalCost)?></td>
		<td><?=number_format($TotalCost)?></td>
	</tr>
	<tr style="font-weight:bold">
		<td colspan="4" align="center">15% 공제금액</td>
		<td class="income"><?=number_format( $TotalCost - ceil( ( ($TotalCost * 0.15)) / 100) * 100 )?></td>
	</tr>
</table>
