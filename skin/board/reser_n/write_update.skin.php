<?php
// 자신만의 코드를 넣어주세요.
$sql_table = "g4_write_" . $bo_table;
sql_query(" ALTER TABLE $sql_table ADD `wr_reserv` text NOT NULL ", FALSE);

$wr_res = addslashes($wr_reserv);
$sql = "UPDATE $write_table SET wr_reserv = '$wr_res', wr_password = password('$wr_6') WHERE wr_id = '$wr_id' ";
sql_query($sql);

if($wr_name2) {
	$wr_name = $wr_name2;
	$sql = "UPDATE $write_table SET wr_name='$wr_name2' WHERE wr_id = '$wr_id' ";
	sql_query($sql);
}

// 최근예약 업데이트
/*
sql_query(" insert into $g4[reserv_new_table] ( bo_table, wr_id, wr_parent, bn_datetime, mb_id, pen_id ) values ( '$bo_table', '$wr_id', '$wr_id', '$g4[time_ymdhis]', '$member[mb_id]', '$_SESSION[ss_pen_id]' ) ");
*/
?>
<script language="JavaScript">
var line0 = '---------------------------------------';
var ment1 = '정상적으로 접수처리 되었습니다.';
var ment2 = '귀하의 예약코드는 <?=$wr_3?> 입니다.';
var ment3 = '예약확인을 위해 꼭 기억하시기 바랍니다.';
var ment4 = '예약금을 결재하시면 예약이 완료됩니다.';
var ment5 = '기타 문의사항은 전화주시면 친절히 안내해 드립니다.';
alert("\n"+ment1+" \n\n"+line0+" \n"+ment2+" \n"+line0+" \n\n"+ment3+" \n\n"+ment4+" \n\n"+ment5+"");
window.location='<?=$g4[bbs_path]?>/board.php?bo_table=<?=$bo_table?>';
</script>
