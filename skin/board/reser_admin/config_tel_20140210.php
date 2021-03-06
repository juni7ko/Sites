<?php include_once "_common.php";
include_once("$g4[path]/head.sub.php");
include_once("$board_skin_path/config.php");

if(!$bo_table) alert("정상적인 접근이 아닙니다.");

$sql = "CREATE TABLE IF NOT EXISTS `{$res_table}_r_tel` (
  `r_tel_idx` int(11) NOT NULL auto_increment,
  `r_tel_name` varchar(20) NOT NULL default '',
  `r_tel_date` int(11) NOT NULL default '0',
  `r_tel_date2` int(11) NOT NULL default '0',
  `pension_id` int(11) NOT NULL,
  `r_info_id` int(11) NOT NULL,
  PRIMARY KEY  (`r_tel_idx`)
);";
sql_query($sql);

if ($board[bo_include_head]) include ("../../$board[bo_include_head]");
if ($board[bo_image_head]) echo "<img src='$g4[path]/data/file/$bo_table/$board[bo_image_head]' border='0'>";
if ($board[bo_content_head]) echo stripslashes($board[bo_content_head]);
############# 헤드
$this_page = "{$_SERVER['PHP_SELF']}?bo_table={$bo_table}";
?>
<link rel="stylesheet" href="<?=$board_skin_path?>/jQuery/jquery-ui-1.7.1.css" type="text/css">
<link rel="stylesheet" href="<?=$board_skin_path?>/mstyle.css" type="text/css">
<script type="text/javascript" src="<?=$board_skin_path?>/jQuery/jquery.js"></script>
<script type="text/javascript" src="<?=$board_skin_path?>/jQuery/jquery-ui-1.7.1.js"></script>
<script type="text/javascript">
	$(function() {
		$.datepicker.regional['ko'] = {
			closeText: '닫기',
			prevText: '이전달',
			nextText: '다음달',
			currentText: '오늘',
			monthNames: ['1월(JAN)','2월(FEB)','3월(MAR)','4월(APR)','5월(MAY)','6월(JUN)',
			'7월(JUL)','8월(AUG)','9월(SEP)','10월(OCT)','11월(NOV)','12월(DEC)'],
			monthNamesShort: ['1월(JAN)','2월(FEB)','3월(MAR)','4월(APR)','5월(MAY)','6월(JUN)',
			'7월(JUL)','8월(AUG)','9월(SEP)','10월(OCT)','11월(NOV)','12월(DEC)'],
			dayNames: ['일','월','화','수','목','금','토'],
			dayNamesShort: ['일','월','화','수','목','금','토'],
			dayNamesMin: ['일','월','화','수','목','금','토'],
			dateFormat: 'yymmdd', firstDay: 0,
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			isRTL: false};
		$.datepicker.setDefaults($.datepicker.regional['ko']);
		$("#r_tel_date").datepicker();
		$("#r_tel_date2").datepicker();
	});
</script>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr><td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) left top;"></td>
<td bgcolor="#ffffff">&nbsp;</td>
<td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) right top;"></td></tr>
<tr>
        <td colspan="3" valign="top" style="background:#FFF; padding:10px;">
<?php include_once("{$board_skin_path}/inc_top_menu.php");

$tit = "전화예약 관리";
if($u == "add") {
	$tit .= " - 추가";
} else if($u == "edit") {
	$tit .= " - 수정";
} else {
	$tit .= "";
}
$tit .=  " [".$pension_id."]";
?>
<div class="ui-state-highlight ui-corner-all" style="margin: 20px 0 5px; padding: 5px .7em;">
    <span class="ui-icon ui-icon-power" style="float: left; margin-right: .3em;"></span>
    <strong><?=$tit?></strong>
</div>
<ul style="list-style:circle;">
	<li>전화로만 예약받고자 할 경우 전화예약 기간을 설정한다.</li>
    <li>전화예약기간 중 예약불가나 완료된 객실은 완료로 표시되고 나머지 기간은 전화로 표시됨.</li>
</ul>
<?php
function show_list() {
	global $g4, $write_table, $css, $pension_id;
	$colspan = 5;
## 리스트 시작
	$sql = " SELECT * FROM {$write_table}_r_tel where pension_id = '$pension_id'  order by r_tel_date ASC ";
	$result = sql_query($sql);

	echo "<table width='100%' border='0' cellpadding='3' cellspacing='1' class='$css[table]'>";
	echo "<tr class='$css[tr]'>
			<td>No</td>
			<td>방이름</td>
			<td>시작일</td>
			<td>종료일</td>
			<td width=150>관리</td>
		</tr>";
	for ($i=0; $r_date = sql_fetch_array($result); $i++)  {
		$j = $i+1;
		echo "<tr class='list$i ht center'>";
		echo "<td>" . $j . "</td>";
		echo "<td>" . $r_date[r_tel_name] . "</td>";
		echo "<td>" . date("Y-m-d", $r_date[r_tel_date]) . "</td>";
		echo "<td>" . date("Y-m-d", $r_date[r_tel_date2]) ."</td>";
		echo "<td><input type=button class='$css[btn]' value=\"수정\" onClick=\"Process('edit',{$r_date[r_tel_idx]}); return false;\">
			<input type=button class='$css[btn]' value=\"삭제\" onClick=\"Process('del',{$r_date[r_tel_idx]}); return false;\"></td>";
		echo "</tr>";
	}
	if ($i == 0)
		echo "<tr><td colspan='$colspan' align=center height=100 bgcolor=#ffffff>자료가 없습니다.</td></tr>";

	echo "</table>";

	echo "<div style='margin-top:5px; text-align:right;'><input type=button class='$css[btn]' value='추가' onClick=\"Process('add',0); return false;\"></div>";
## 리스트 끝
}
?>
<script type="text/javascript">
<!--
function Process(u,id) {
	f = document.process;
	if(u == "del") {
		var Result = confirm("자료가 영구히 삭제됩니다. 정말로 삭제하시겠습니까?");
		if(Result)
			f.action = "<?=$this_page?>";
		else
			return false;
	}
	f.action = "<?=$this_page?>";
	f.u.value = u;
	f.id.value = id;
	f.submit();
}
-->
</script>
<form name="process" method="POST" style="margin:0; padding:0;">
<input type="hidden" name="bo_table" value="<?=$bo_table?>" />
<input type="hidden" name="u" value="">
<input type="hidden" name="id" value="">
<input type="hidden" name="pension_id" value="<?=$pension_id?>">
<?php if($u == "add") {
	$colspan = 3;
	echo "<table width='100%' border='0' cellpadding='0' cellspacing='1' class='$css[table]'>";
	echo "<tr class='$css[tr]'>
			<td>방이름</td>
			<td>시작일</td>
			<td>종료일</td>
			<td width=150>관리</td>
		</tr>";
	echo "<tr align=center height=30>";
	echo "<td>".Get_Room_Select2($pen_id,'r_info_id','')."</td>";
	echo "<td><input class=m_text id=r_tel_date type=text required numeric itemname=시작일 size=13 name=r_tel_date value='" . date("Ymd", mktime()) . "' readonly title='옆의 달력 아이콘을 클릭하여 날짜를 입력하세요.'> <a href=\"javascript:win_calendar('r_tel_date', document.getElementById('r_tel_date').value, '');\"><img src='./img/calendar.gif' border=0 align=absmiddle title='달력 - 날짜를 선택하세요'></a></td>";
	echo "<td><input class=m_text id=r_tel_date2 type=text required numeric itemname=종료일 size=13 name=r_tel_date2 value='" . date("Ymd", mktime()) . "' readonly title='옆의 달력 아이콘을 클릭하여 날짜를 입력하세요.'> <a href=\"javascript:win_calendar('r_tel_date2', document.getElementById('r_tel_date2').value, '');\"><img src='./img/calendar.gif' border=0 align=absmiddle title='달력 - 날짜를 선택하세요'></a></td>";
	echo "<td><input type=button class='btn1 ui-button ui-state-default ui-corner-all' value=\"추가\" onClick=\"Process('insert',0); return false;\"> <input type=button class='btn1 ui-button ui-state-default ui-corner-all' value=\"취소\" onClick=\"history.back(-1); return false;\"></td>";
	echo "</tr>";
	echo "</table>";
} else if($u == "edit") {
	$colspan = 4;
	## 업데이트 리스트
	$r_date = sql_fetch(" SELECT * FROM {$write_table}_r_tel WHERE r_tel_idx='$id' ");

	echo "<table width='100%' border='0' cellpadding='0' cellspacing='1' class='$css[table]'>";
	echo "<tr class='$css[tr]'>
			<td>방이름</td>
			<td>시작일</td>
			<td>종료일</td>
			<td width=150>관리</td>
		</tr>";
	echo "<tr align=center height=30>";
	echo "<td>".$r_date[r_tel_name]."</td>";
	echo "<td><input class=m_text id=r_tel_date type=text required numeric itemname=시작일 size=13 name=r_tel_date value='" . date("Ymd", $r_date[r_tel_date]) . "' readonly title='옆의 달력 아이콘을 클릭하여 날짜를 입력하세요.'> <a href=\"javascript:win_calendar('r_tel_date', document.getElementById('r_tel_date').value, '');\"><img src='./img/calendar.gif' border=0 align=absmiddle title='달력 - 날짜를 선택하세요'></a></td>";
	echo "<td><input class=m_text id=r_tel_date2 type=text required numeric itemname=종료일 size=13 name=r_tel_date2 value='" . date("Ymd", $r_date[r_tel_date2]) . "' readonly title='옆의 달력 아이콘을 클릭하여 날짜를 입력하세요.'> <a href=\"javascript:win_calendar('r_tel_date2', document.getElementById('r_tel_date2').value, '');\"><img src='./img/calendar.gif' border=0 align=absmiddle title='달력 - 날짜를 선택하세요'></a></td>";
	echo "<td><input type=button class='$css[btn]' value=\"수정\" onClick=\"Process('update',$id); return false;\">
		<input type=button class='$css[btn]' value=\"취소\" onClick=\"history.back(-1); return false;\"></td>";
	echo "</tr>";
	echo "</table>";
	## 업데이트 리스트 끝
} else {
	if($u == "del") {
		$sql = "DELETE FROM {$write_table}_r_tel WHERE r_tel_idx ='$id'";
		sql_query($sql);
	} else if($u == "update") {
		$sy = substr($r_tel_date,0,4);
		$sm = substr($r_tel_date,4,2);
		$sd = substr($r_tel_date,6,2);
		$sdate = mktime(12,0,0,$sm,$sd,$sy);

		$sy2 = substr($r_tel_date2,0,4);
		$sm2 = substr($r_tel_date2,4,2);
		$sd2 = substr($r_tel_date2,6,2);
		$sdate2 = mktime(12,0,0,$sm2,$sd2,$sy2);

		$sql = "UPDATE {$write_table}_r_tel SET r_tel_date = '$sdate', r_tel_date2 = '$sdate2' WHERE r_tel_idx ='$id' LIMIT 1 ;";

		$result = sql_query($sql);
	} else if($u == "insert") {
		$sy = substr($r_tel_date,0,4);
		$sm = substr($r_tel_date,4,2);
		$sd = substr($r_tel_date,6,2);
		$sdate = mktime(12,0,0,$sm,$sd,$sy);

		$sy2 = substr($r_tel_date2,0,4);
		$sm2 = substr($r_tel_date2,4,2);
		$sd2 = substr($r_tel_date2,6,2);
		$sdate2 = mktime(12,0,0,$sm2,$sd2,$sy2);

		$sql1 = "SELECT r_info_name FROM {$write_table}_r_info where pension_id = '$pension_id' AND r_info_id = '$r_info_id' LIMIT 1 ;";
		$info = sql_fetch($sql1);

		$sql = "INSERT INTO {$write_table}_r_tel (r_tel_name, r_tel_date, r_tel_date2, pension_id, r_info_id) VALUES ('$info[r_info_name]', '$sdate', '$sdate2', '$pension_id', '$r_info_id' );";
		sql_query($sql);
	}

	show_list();
}
?>
</form>
</td>
    </tr>
<tr><td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) left bottom;"></td>
<td bgcolor="#ffffff">&nbsp;</td>
<td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) right bottom;"></td></tr>
</table>
<?php
############# 푸터
if ($board[bo_content_tail]) echo stripslashes($board[bo_content_tail]);
if ($board[bo_image_tail]) echo "<img src='$g4[path]/data/file/$bo_table/$board[bo_image_tail]' border='0'>";
if ($board[bo_include_tail]) @include ("../../$board[bo_include_tail]");

include_once("$g4[path]/tail.sub.php");
?>
