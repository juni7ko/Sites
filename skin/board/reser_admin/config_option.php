<?php include_once "_common.php";
include_once("$g4[path]/head.sub.php");
include_once("$board_skin_path/config.php");

if($is_admin != 'super' || $is_auth) alert("관리자만 접근이 가능합니다.");

if(!$bo_table) alert("정상적인 접근이 아닙니다.");

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
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr><td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) left top;"></td>
<td bgcolor="#ffffff">&nbsp;</td>
<td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) right top;"></td></tr>
<tr>
        <td colspan="3" valign="top" style="background:#FFF; padding:10px;">
<?php include_once("{$board_skin_path}/inc_top_menu.php");

$tit = "추가옵션 관리";
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
<?php
function show_list() {
	global $g4, $write_table, $css, $pension_id;
## 리스트 시작
	$sql = " SELECT * FROM {$write_table}_r_option where pension_id = '$pension_id'   order by r_op_name ASC ";
	$result = sql_query($sql);

	echo "<table width='100%' border='0' cellpadding='3' cellspacing='1' class='$css[table]'>";
	echo "<tr class='$css[tr]'>
			<td width=40>No</td>
			<td>옵션명</td>
			<td width=100>가격</td>
			<td width=150>관리</td>
		</tr>";
	for ($i=0; $r_option = sql_fetch_array($result); $i++)  {
		$j = $i+1;
		echo "<tr class='ht center'>";
		echo "<td>" . $j . "</td>";
		echo "<td>" . $r_option[r_op_name] . "</td>";
		echo "<td>" . number_format($r_option[r_op_cost]) . "</td>";
		echo "<td><input type=button class='$css[btn]' value=\"수정\" onClick=\"Process('edit',{$r_option[r_op_id]}); return false;\">
			<input type=button class='$css[btn]' value=\"삭제\" onClick=\"Process('del',{$r_option[r_op_id]}); return false;\"></td>";
		echo "</tr>";
	}
	if ($i == 0)
		echo "<tr><td colspan='4' align=center height=100 bgcolor=#ffffff>자료가 없습니다.</td></tr>";

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

	if((u == "update" || u == "insert") && !f.r_op_name.value) {
		alert("옵션명을 입력해 주세요!!");
		f.r_op_name.focus();
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
	echo "<table width='100%' border='0' cellpadding='3' cellspacing='1' class='$css[table]'>";
	echo "<tr class='$css[tr]'>
			<td>옵션명</td>
			<td width=100>가격</td>
			<td width=150>관리</td>
		</tr>";
	echo "<tr class='ht center'>";
	echo "<td><input type=text style='width:90%;' name=r_op_name required itemname=옵션명></td>";
	echo "<td><input type=text size=10 name=r_op_cost required itemname=가격></td>";
	echo "<td><input type=button class='$css[btn]' value=\"추가\" onClick=\"Process('insert',0); return false;\"></td>";
	echo "</tr>";
	echo "</table>";
} else if($u == "edit") {
	## 업데이트 리스트
	$r_option = sql_fetch(" SELECT * FROM {$write_table}_r_option WHERE r_op_id='$id' ");
	echo "<table width='100%' border='0' cellpadding='3' cellspacing='1' class='$css[table]'>";
	echo "<tr class='$css[tr]'>
			<td>옵션명</td>
			<td width=100>가격</td>
			<td width=150>관리</td>
		</tr>";
	echo "<tr class='ht center'>";
	echo "<td><input type=text style='width:90%;' name=r_op_name required itemname=옵션명 value='" . $r_option[r_op_name] . "'></td>";
	echo "<td><input type=text size=10 name=r_op_cost required itemname=가격 value='" . $r_option[r_op_cost] . "'></td>";
	echo "<td><input type=button class='$css[btn]' value=\"수정\" onClick=\"Process('update',$id); return false;\"></td>";
	echo "</tr>";
	echo "</table>";
	## 업데이트 리스트 끝
} else {
	if($u == "del") {
		$sql = "DELETE FROM {$write_table}_r_option WHERE r_op_id ='$id'";
		sql_query($sql);
	} else if($u == "update") {
		$sql = "UPDATE {$write_table}_r_option SET r_op_name = '$r_op_name',
			r_op_cost = '$r_op_cost' WHERE r_op_id ='$id' LIMIT 1 ;";

		$result = sql_query($sql);
	} else if($u == "insert") {
		$sql = "INSERT INTO {$write_table}_r_option (r_op_name, r_op_cost, pension_id) VALUES ('$r_op_name', '$r_op_cost', '$pension_id');";
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
