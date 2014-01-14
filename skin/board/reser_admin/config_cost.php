<?php include_once "_common.php";
include_once("$g4[path]/head.sub.php");
include_once("$board_skin_path/config.php");

if($is_admin != 'super') alert("관리자만 접근이 가능합니다.");

if(!$bo_table) alert("정상적인 접근이 아닙니다.");

if ($board[bo_include_head]) include ("../../$board[bo_include_head]");
if ($board[bo_image_head]) echo "<img src='$g4[path]/data/file/$bo_table/$board[bo_image_head]' border='0'>";
if ($board[bo_content_head]) echo stripslashes($board[bo_content_head]);
############# 헤드
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

show_list(); // 방 목록 보여주기
?>
<form name="process" method="POST"  action="<?=$PHP_SELF?>" style="margin:0; padding:0;">
<input type="hidden" name="bo_table" value="<?=$bo_table?>" />
<input type="hidden" name="u" value="edit">
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="pension_id" value="<?=$pension_id?>">

<?php $room_info = sql_fetch(" SELECT * FROM {$write_table}_r_info WHERE r_info_id='$id' ");
$cost_info = sql_fetch(" SELECT * FROM {$write_table}_r_cost WHERE r_info_id='$id' ");
if($u == "edit") {
	// 할인율에 따른 객실가격 계산 : 100원이하 단위 절사
	if($r_cost_21) $r_cost_31 = round( $r_cost_11 - ($r_cost_11 * ($r_cost_21 * 0.01)), -2 );
		else $r_cost_31 = $r_cost_11;
	if($r_cost_22) $r_cost_32 = round( $r_cost_12 - ($r_cost_12 * ($r_cost_22 * 0.01)), -2 );
		else $r_cost_32 = $r_cost_12;
	if($r_cost_23) $r_cost_33 = round( $r_cost_13 - ($r_cost_13 * ($r_cost_23 * 0.01)), -2 );
		else $r_cost_33 = $r_cost_13;
	if($r_cost_24) $r_cost_34 = round( $r_cost_14 - ($r_cost_14 * ($r_cost_24 * 0.01)), -2 );
		else $r_cost_34 = $r_cost_14;
	if($r_cost_25) $r_cost_35 = round( $r_cost_15 - ($r_cost_15 * ($r_cost_25 * 0.01)), -2 );
		else $r_cost_35 = $r_cost_15;

	if($cost_info) {
		$sql = "UPDATE {$write_table}_r_cost SET r_cost_11 = '$r_cost_11',
			r_cost_12 = '$r_cost_12',
			r_cost_13 = '$r_cost_13',
			r_cost_14 = '$r_cost_14',
			r_cost_15 = '$r_cost_15',
			pension_id = '$pension_id',
			r_cost_21 = '$r_cost_21',
			r_cost_22 = '$r_cost_22',
			r_cost_23 = '$r_cost_23',
			r_cost_24 = '$r_cost_24',
			r_cost_25 = '$r_cost_25',
			r_cost_31 = '$r_cost_31',
			r_cost_32 = '$r_cost_32',
			r_cost_33 = '$r_cost_33',
			r_cost_34 = '$r_cost_34',
			r_cost_35 = '$r_cost_35'
			WHERE r_info_id ='$id' LIMIT 1 ;";
	} else {
		$sql = "INSERT INTO {$write_table}_r_cost (
				r_info_id,
				r_cost_11,
				r_cost_12,
				r_cost_13,
				r_cost_14,
				r_cost_15,
				pension_id,
				r_cost_21,
				r_cost_22,
				r_cost_23,
				r_cost_24,
				r_cost_25,
				r_cost_31,
				r_cost_32,
				r_cost_33,
				r_cost_34,
				r_cost_35
			)VALUES (
				'$id',
				'$r_cost_11',
				'$r_cost_12',
				'$r_cost_13',
				'$r_cost_14',
				'$r_cost_15',
				'$pension_id',
				'$r_cost_21',
				'$r_cost_22',
				'$r_cost_23',
				'$r_cost_24',
				'$r_cost_25',
				'$r_cost_31',
				'$r_cost_32',
				'$r_cost_33',
				'$r_cost_34',
				'$r_cost_35'
			);";
	}

	$result = sql_fetch($sql);

	// 데이터 저장시 펜션정보에 최대 할인율과 최저 가격 입력 - Start
	include "lowCost.lib.php";
	// 데이터 저장시 펜션정보에 최대 할인율과 최저 가격 입력 - End


	alert("수정완료!!","{$board_skin_path}/config_room.php?bo_table={$bo_table}&pension_id={$pension_id}");
	//if(!$result) $u_result = "수정 완료!!";
	//$cost_info = sql_fetch(" SELECT * FROM {$write_table}_r_cost WHERE r_info_id='$id' ");
}
?>
<div class="ui-state-highlight ui-corner-all" style="margin: 20px 0 5px; padding: 5px .7em;">
    <span class="ui-icon ui-icon-power" style="float: left; margin-right: .3em;"></span>
    <strong><?=$room_info[r_info_name]?></strong> 기본요금 <?=$u_result?>
</div>
<?php echo "<table width='100%' border='0' cellpadding='0' cellspacing='1' class='$css[table]'>";
echo "<tr class='$css[tr]'>
		<td>구분</td>
		<td>평일(월~목)</td>
		<td>금요일</td>
		<td>토요일</td>
		<td>일요일</td>
		<td>공휴일</td>
		<td>전체적용</td>
	</tr>";
if($room_info) {
	echo "<tr class='ht center'>";
	echo "<td>기본요금</td>";
	echo "<td><input type=input size=7 name=r_cost_11 value='" . $cost_info[r_cost_11] . "' class='costValue' /></td>";
	echo "<td><input type=input size=7 name=r_cost_12 value='" . $cost_info[r_cost_12] . "' class='costValue' /></td>";
	echo "<td><input type=input size=7 name=r_cost_13 value='" . $cost_info[r_cost_13] . "' class='costValue' /></td>";
	echo "<td><input type=input size=7 name=r_cost_14 value='" . $cost_info[r_cost_14] . "' class='costValue' /></td>";
	echo "<td><input type=input size=7 name=r_cost_15 value='" . $cost_info[r_cost_15] . "' class='costValue' /></td>";
	echo "<td><input type=input size=7 name=allCost id=allCost /></td>";
	echo "</tr>";
	echo "<tr class='ht center'>";
	echo "<td>할인율</td>";
	echo "<td><input type=input size=7 name=r_cost_21 value='" . $cost_info[r_cost_21] . "' class='costRate' /></td>";
	echo "<td><input type=input size=7 name=r_cost_22 value='" . $cost_info[r_cost_22] . "' class='costRate' /></td>";
	echo "<td><input type=input size=7 name=r_cost_23 value='" . $cost_info[r_cost_23] . "' class='costRate' /></td>";
	echo "<td><input type=input size=7 name=r_cost_24 value='" . $cost_info[r_cost_24] . "' class='costRate' /></td>";
	echo "<td><input type=input size=7 name=r_cost_25 value='" . $cost_info[r_cost_25] . "' class='costRate' /></td>";
	echo "<td><input type=input size=7 name=allRate id=allRate /></td>";
	echo "</tr>";
	echo "<tr class='ht center'>";
	echo "<td>할인가격</td>";
	echo "<td>". number_format($cost_info[r_cost_31]) . "</td>";
	echo "<td>". number_format($cost_info[r_cost_32]) . "</td>";
	echo "<td>". number_format($cost_info[r_cost_33]) . "</td>";
	echo "<td>". number_format($cost_info[r_cost_34]) . "</td>";
	echo "<td>". number_format($cost_info[r_cost_35]) . "</td>";
	echo "<td></td>";
	echo "</tr>";
}
echo "</table>";

if($room_info) {
	echo "<div style='margin-top:5px; text-align:right;'>
		<input type=button class='$css[btn]' value=\"수정\" onClick='form.submit();'>
		<input type=button class='$css[btn]' value=\"취소\" onClick='history.back(-1);'></div>";
}
?>
</form>

<?php
function show_list() {
	global $g4, $write_table, $css, $pension_id;
	$colspan = 11;
## 리스트 시작
	$sql = " SELECT * FROM {$write_table}_r_info where pension_id = '$pension_id' order by r_info_order ASC ";
	$result = sql_query($sql);
//	echo $sql;
	echo "<table width='100%' border='0' cellpadding='0' cellspacing='1' class='$css[table]'>";
	echo "<tr class='$css[tr]'>
			<td>No</td>
			<td>방이름</td>
			<td>면적</td>
			<td>기본인원</td>
			<td>최대인원</td>
			<td>추가요금</td>
			<td>객실수</td>
			<td>복수접수</td>
			<td>다중예약</td>
			<td>출력순서</td>
			<td>관리</td>
		</tr>";
	for ($i=0; $r_info = sql_fetch_array($result); $i++)  {
		$j = $i+1;
		$list = $i%2;
		echo "<tr class='list$list ht center'>";
		echo "<td>" . $j . "</td>";
		echo "<td>" . $r_info[r_info_name] . "</td>";
		echo "<td>" . $r_info[r_info_area] . "</td>";
		echo "<td>" . number_format($r_info[r_info_person1]) . "</td>";
		echo "<td>" . number_format($r_info[r_info_person2]) . "</td>";
		echo "<td>" . number_format($r_info[r_info_person_add]) . "</td>";
		echo "<td>" . number_format($r_info[r_info_cnt]) . "</td>";
		echo "<td>" . $r_info[r_info_over] . "</td>";
		echo "<td>" . $r_info[r_info_multi] . "</td>";
		echo "<td>" . number_format($r_info[r_info_order]) . "</td>";
		echo "<td><input type=button class='$css[btn]' value=\"요금\" onClick=\"Process('cost',{$r_info[r_info_id]}); return false;\"></td>";
		echo "</tr>";
	}
	if ($i == 0)
		echo "<tr><td colspan='$colspan' align=center height=100 bgcolor=#ffffff>자료가 없습니다.</td></tr>";

	echo "</table>";
## 리스트 끝
}
?>
<form name="go_cost" method="POST" style="margin:0; padding:0;">
<input type="hidden" name="bo_table" value="<?=$bo_table?>" />
<input type="hidden" name="u" value="">
<input type="hidden" name="id" value="">
</form>
	</td>
</tr>
<tr><td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) left bottom;"></td>
<td bgcolor="#ffffff">&nbsp;</td>
<td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) right bottom;"></td></tr>
</table>
<script type="text/javascript">
	$(function(){
		$('#allRate').keyup(function(){
			var rate = $(this).val();
			$('.costRate').val(rate);
		});
		$('#allCost').keyup(function(){
			var cost = $(this).val();
			$('.costValue').val(cost);
		});
	});

	function Process(u,id) {
		f = document.go_cost;
		if(u == "cost") {
			f.action = "./config_cost.php?bo_table=<?=$bo_table?>&pension_id=<?=$pension_id?>";
		} else {
			return false;
		}

		f.u.value = u;
		f.id.value = id;
		f.submit();
	}
</script>
<?php
############# 푸터
if ($board[bo_content_tail]) echo stripslashes($board[bo_content_tail]);
if ($board[bo_image_tail]) echo "<img src='$g4[path]/data/file/$bo_table/$board[bo_image_tail]' border='0'>";
if ($board[bo_include_tail]) @include ("../../$board[bo_include_tail]");

include_once("$g4[path]/tail.sub.php");
?>
