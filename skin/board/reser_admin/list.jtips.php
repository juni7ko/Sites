<?php include_once("_common.php");
include_once("$g4[path]/head.sub.php");

//if($is_admin != 'super' || $is_auth) alert("관리자만 접근이 가능합니다.");
if(!$bo_table) alert("잘못된 접근입니다.");

$board_skin_path = ".";
$write_table = $g4[write_prefix] . $bo_table;

include_once("$board_skin_path/config.php");
?>
<body style="background:#FFF; padding:0; margin:0;">
<?php
//$f_date = date("Ymd", $pdate);
$f_date = $pdate;
$py = substr($f_date,0,4);
$pm = substr($f_date,4,2);
$pd = substr($f_date,6,2);
$rc_date = $py . $pm . $pd;

//echo Get_Date_Reserv_List_Pop($bo_table, $r_name, $rc_date);
$sql = " SELECT * FROM {$write_table} WHERE wr_link1 <= '$rc_date' and wr_link2 > '$rc_date' and ca_name='$r_name' ORDER BY wr_name, wr_datetime, wr_4 DESC ";
$result = sql_query($sql);

$r_print .= "<table width='90%' border='0' cellpadding='3' cellspacing='1' bgcolor='#FFFFFF' class='conbox'>\n";
for ($i=0; $r_list = sql_fetch_array($result); $i++)  {
	$j=($i)%2;
	$u_name = substr($r_list[wr_name],0,2);
	$u_tel = explode('-', $r_list[wr_2], 3);

	$r_print .= "<tr class='n_list{$j}'>\n";
	if($is_admin) $r_print .= "<td>{$r_list[wr_name]}"; //예약자명
		else $r_print .= "<td>{$u_name}**"; //예약자명
	if($r_list[wr_8] > 1) //숙박일
		$r_print .= "({$r_list[wr_8]}박)";
	$r_print .= "</td>";
	if($is_admin) $r_print .= "<td>{$r_list[wr_2]}</td>"; //연락처
		else $r_print .= "<td>{$u_tel[0]}-{$u_tel[2]}-****</td>"; //연락처
	if($r_list[wr_4] == "예약완료") $r_print .= "<td>완료</td>"; //예약상태
		else if($r_list[wr_4] == "예약취소") $r_print .= "<td>취소</td>"; //예약상태
		else $r_print .= "<td>대기</td>"; //예약상태
	$r_print .= "</tr>\n";
}
$r_print .= "</table>\n";

if($i) {
	echo $r_print;
} else {
	echo "정보가 없습니다.";
}
include_once("$g4[path]/tail.sub.php");
?>
