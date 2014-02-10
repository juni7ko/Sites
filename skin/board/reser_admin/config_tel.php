<?php
include_once "_common.php";
include_once("$g4[path]/head.sub.php");
include_once("$board_skin_path/config.php");
include_once("$board_skin_path/view.skin.lib.php");
if(!$bo_table) alert("정상적인 접근이 아닙니다.");

if ($board[bo_include_head]) include ("../../$board[bo_include_head]");
if ($board[bo_image_head]) echo "<img src='$g4[path]/data/file/$bo_table/$board[bo_image_head]' border='0'>";
if ($board[bo_content_head]) echo stripslashes($board[bo_content_head]);
############# 헤드
$this_page = "{$_SERVER['PHP_SELF']}?bo_table={$bo_table}";

function viewTelRoom($penID, $pDate)
{
	global $write_table2;
	// 방 정보 수집
	$roomListSql = sql_query(" SELECT * FROM {$write_table2}_r_info WHERE pension_id = '$penID' ORDER BY r_info_order ASC");

	for($i=0; $roomList = sql_fetch_array($roomListSql); $i++) {
		$rList[$i]['r_info_id']   = $roomList['r_info_id'];
		$rList[$i]['r_info_name'] = $roomList['r_info_name'];
		$closeList = sql_fetch(" SELECT * FROM {$write_table2}_r_tel WHERE r_info_id = $roomList[r_info_id] and ($pDate BETWEEN r_tel_date AND r_tel_date2) ");
		$rList[$i]['r_tel_idx'] = $closeList['r_tel_idx'];
	}
	return $rList;
}

function viewTelRoomOnly($penID, $pDate)
{
	global $write_table2;
	// 방 정보 수집
    $roomListSql = " SELECT A.r_info_id, A.r_info_name, B.r_tel_idx FROM {$write_table2}_r_info AS A INNER JOIN {$write_table2}_r_tel AS B ON
    				A.r_info_id = B.r_info_id and ($pDate BETWEEN B.r_tel_date AND B.r_tel_date2) ";
	$resultList = sql_query($roomListSql);

	for ($i=0; $roomList = sql_fetch_array($resultList); $i++)
	{
		$viewDateRow[$i]['r_info_id']   = $roomList['r_info_id'];
		$viewDateRow[$i]['r_info_name'] = $roomList['r_info_name'];
		$viewDateRow[$i]['r_tel_idx'] = $roomList['r_tel_idx'];
	}
	return $viewDateRow;
}

if($u) {
	$sql1 = "SELECT r_info_name FROM g4_write_bbs34_r_info where pension_id = '$pension_id' AND r_info_id = '$ridx' LIMIT 1 ;";
	$info = sql_fetch($sql1);

	if($cidx) {
		$sql = " DELETE FROM g4_write_bbs34_r_tel WHERE pension_id = '$pension_id' AND r_tel_idx ='$cidx' and r_info_id = '$ridx' and ($pDate BETWEEN r_tel_date AND r_tel_date2) ";
		sql_query($sql);
	} else {
		$sql = "INSERT INTO g4_write_bbs34_r_tel (r_tel_name, r_tel_date, r_tel_date2, pension_id, r_info_id) VALUES ('$info[r_info_name]', '$pDate', '$pDate', '$pension_id', '$ridx' );";
		sql_query($sql);
	}
}
?>
<link rel="stylesheet" href="<?=$board_skin_path?>/jQuery/jquery-ui-1.7.1.css" type="text/css">
<link rel="stylesheet" href="<?=$board_skin_path?>/mstyle.css" type="text/css">
<style type="text/css">
	ul.resCloseUl { list-style: none; }
	ul.resCloseUl li.resCloseLi { cursor: pointer; }
	span.resClose1 { background-color:#5eb917; color:#FFFFFF; padding:0 1px; margin-right:2px; line-height:15px; }
	span.resClose2 { background-color:#ff6666; color:#FFFFFF; padding:0 1px; margin-right:2px; line-height:15px; }
</style>
<script type="text/javascript">
	function changeState(pDate, ridx, cidx) {
		f = document.process;
		f.pDate.value = pDate;
		f.ridx.value = ridx;
		f.cidx.value = cidx;
		f.action = "<?=$this_page?>";
		f.submit();
	}
</script>
<?php
$tit = "전화 예약";
if($u) {
	$editDate = date("Ymd", $pDate);
	$tit .= " : {$info[r_info_name]} [{$editDate}] ";
	if($cidx) {
		$tit .= " - 삭제완료";
	} else {
		$tit .= " - 추가완료";
	}
}
?>
<div class="ui-state-highlight ui-corner-all" style="margin: 20px 0 5px; padding: 5px .7em;">
    <span class="ui-icon ui-icon-power" style="float: left; margin-right: .3em;"></span>
    <strong><?=$tit?></strong>
</div>
<?php
	include_once("{$board_skin_path}/inc_top_menu.php");

	$nDate = getdate();
	$nDateY = (int)$nDate['year'];
	$nDateM = (int)$nDate['mon'];
	$nDateD = (int)$nDate['mday'];
	$nDateTmp = mktime(12,0,0,$nDateM,$nDateD,$nDateY);


	$lastDay = array(0,31,28,31,30,31,30,31,31,30,31,30,31);
	if ($nDateY%4 == 0) $lastDay[2] = 29;
	$dayoftheweek = date("w", mktime (0,0,0,$nDateM,1,$nDateY));

	if(!$sDate)
	{
		$sDateTmp = mktime(12,0,0,$nDateM,1,$nDateY);
		$sDate = date("Ymd", $sDateTmp);
		$sDateY = (int)date("Y", $sDateTmp);
		$sDateM = (int)date("m", $sDateTmp);

		$eDateTmp = mktime(12,0,0,$sDateM,$lastDay[$sDateM],$sDateY);
		$eDate = date("Ymd", $eDateTmp);
	} else {
		$sDateY = (int)date("Y", $sDate);
		$sDateM = (int)date("m", $sDate);
		$sDateTmp = mktime(12,0,0,$sDateM,1,$sDateY);
		$sDate = date("Ymd", $sDateTmp);
		$sDateYMD = date("Ymd", $sDateTmp);

		$eDateTmp = mktime(12,0,0,$sDateM,$lastDay[$sDateM],$sDateY);
		$eDate = date("Ymd", $eDateTmp);
	}

	// 이전/다음 버튼의 링크 생성 - 1개월 단위로 이동하도록 수정
	$prevDay = $sDateTmp - (86400 * 1);
	$nextDay = $sDateTmp + (86400 * 33);
	$prevLink = "$_SERVER[PHP_SELF]?bo_table=$bo_table&pension_id=$pension_id&sDate=$prevDay";
	$nextLink = "$_SERVER[PHP_SELF]?bo_table=$bo_table&pension_id=$pension_id&sDate=$nextDay";

	if (eregi('%', $width)) {
		$col_width = "14%"; //표의 가로 폭이 100보다 크면 픽셀값입력
	}else{
		$col_width = round($width/7); //표의 가로 폭이 100보다 작거나 같으면 백분율 값을 입력
	}
	$col_height= 70 ;//내용 들어갈 사각공간의 세로길이를 가로 폭과 같도록
?>
	<div style="text-align:center; margin:0 auto 10px;">
		<span style="margin-right:20px;"><a href="<?=$prevLink?>" target="_self" onfocus="this.blur()"><img src="<?=$board_skin_path?>/img_n/pre.gif" width="30" height="14" /></a></span>
		<a href="<?="$_SERVER[PHP_SELF]?bo_table=$bo_table&pension_id=$pension_id"?>" title="오늘로" onfocus="this.blur()">
			<span style="font-size:16px; font-weight:bold;"><?=$sDateY?>년 <?=$sDateM?>월</span>
		</a>
		<span style="margin-left:20px;"><a href="<?=$nextLink?>" target="_self" onfocus="this.blur()"><img src="<?=$board_skin_path?>/img_n/next.gif" width="30" height="14" /></a></span>
	</div>
	<div>
		<span class="resClose1">일</span>일반예약
		<span class="resClose2">전</span>전화예약
	</div>
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		<?php $text_no = "2"; ?>
		<tr>
			<td class="wsun"><img src="<?=$board_skin_path?>/img_n/sunday.gif" width="70" height="7" /></td>
			<td class="week"><img src="<?=$board_skin_path?>/img_n/monday.gif" width="70" height="7" /></td>
			<td class="week"><img src="<?=$board_skin_path?>/img_n/tuesday.gif" width="70" height="7" /></td>
			<td class="week"><img src="<?=$board_skin_path?>/img_n/wednesday.gif" width="70" height="7" /></td>
			<td class="week"><img src="<?=$board_skin_path?>/img_n/tuesday.gif" width="70" height="7" /></td>
			<td class="wfri"><img src="<?=$board_skin_path?>/img_n/friday.gif" width="70" height="7" /></td>
			<td class="wsat"><img src="<?=$board_skin_path?>/img_n/saturday.gif" width="70" height="7" /></td>
		</tr>
		<tr>
			<td height="5" colspan="7"></td>
		</tr>
		<tr>
			<td height="2" colspan="7" bgcolor="#CCCCCC"></td>
		</tr>
		<?php
		$cday = 1;
		$tDate = $sDate;
		$tDateTmp = $sDateTmp;

		// 달력의 틀을 보여주는 부분
		$temp = 7- (($lastDay[$sDateM]+$dayoftheweek)%7);

		if ($temp == 7) $temp = 0;
		$lastcount = $lastDay[$sDateM]+$dayoftheweek + $temp;

		for ($iz = 1; $iz <= $lastcount; $iz++) {
			$bgcolor = "#FFFFFF";
			if ($nDateY==$sDateY && $nDateM==$sDateM && $nDateD==$cday)
				$bgcolor = "#f3f3f3";
			if (($iz%7) == 1)
				echo ("<tr>\n"); // 주당 7개씩 한쎌씩을 쌓는다.

			if ($dayoftheweek < $iz  &&  $iz <= $lastDay[$sDateM]+$dayoftheweek) {
				// 전체 루프안에서 숫자가 들어가는 셀들만 해당됨. 즉 11월 달에서 1일부터 30 일까지
				$daytext = date("d", $tDateTmp);

				if ($iz%7 == 1) $daytext = "<span style='color:red'>$daytext</span>"; // 일요일
				if ($iz%7 == 0) $daytext = "<span style='color:blue'>$daytext</span>"; // 토요일
				// 여기까지 숫자와 들어갈 내용에 대한 변수들의 세팅이 끝나고
				// 이제 여기 부터 직접 셀이 그려지면서 그 안에 내용이 들어 간다.
				if (($iz%7) == 0) {
					echo "<td width=$col_width height=$col_height bgcolor=$bgcolor align=left valign=top class='dsat'>\n";
				} else {
					echo "<td width=$col_width height=$col_height bgcolor=$bgcolor align=left valign=top class='day'>\n";
				}

				echo "<div align='right'>";

				switch(viewDateType($pension_id, $tDateTmp)) {
					case "비수기" :
					$typeColor = "green";
					break;
					case "성수기" :
					$typeColor = "orange";
					break;
					default :
					$typeColor = "red";
					break;
				}

				echo "<span style='color:$typeColor; padding:2px;'>" . viewDateType($pension_id, $tDateTmp) . "<span class='cal_sdate'>".$daytext."</span>"; //날짜 출력
				echo "</div>";
				echo "";

				// 관리자예약 출력
				echo "<div><ul class='resCloseUl'>";
				$rList = viewTelRoom($pension_id, $tDateTmp);
				for($rcnt = 0; $rcnt < count($rList); $rcnt++) {
					$resClass = ( $rList[$rcnt]['r_tel_idx'] ) ? "resClose2" : "resClose1";
					?>
						<li class="resCloseLi" onClick="changeState('<?=$tDateTmp?>','<?=$rList[$rcnt][r_info_id]?>','<?=$rList[$rcnt][r_tel_idx]?>')">
							<span class="<?=$resClass?>"><?=($rList[$rcnt]['r_tel_idx'])?"전":"일";?></span><?=$rList[$rcnt]['r_info_name']?>
						</li>
					<?php
				}
				echo "</div></ul>";

				echo ("</td>\n");  // 한칸을 마무리
				$cday++; // 날짜를 카운팅
				$tDate++;
				$tDateTmp += 86400;
			} else { // 11월에서 1일부터 30일에 해당되지 않으면 그냥 회색을 칠한다.
				if (($iz%7) == 0) {
					echo ("<td width=$col_width height=$col_height valign=top class='dsat'>&nbsp;</td>\n");
				} else {
					echo ("<td width=$col_width height=$col_height valign=top class='day'>&nbsp;</td>\n");
				}
			}

			if (($iz%7) == 0) echo ("  </tr>\n");
		} // 반복구문이 끝남
		?>
	</table>
	<form name="process" method="POST" style="margin:0; padding:0;">
	<input type="hidden" name="bo_table" value="<?=$bo_table?>" />
	<input type="hidden" name="pension_id" value="<?=$pension_id?>">
	<input type="hidden" name="sDate" value="<?=$sDateTmp?>" />
	<input type="hidden" name="pDate" value="" />
	<input type="hidden" name="ridx" value="" />
	<input type="hidden" name="cidx" value="" />
	<input type="hidden" name="u" value="action" />
	</form>
<?php
############# 푸터
if ($board[bo_content_tail]) echo stripslashes($board[bo_content_tail]);
if ($board[bo_image_tail]) echo "<img src='$g4[path]/data/file/$bo_table/$board[bo_image_tail]' border='0'>";
if ($board[bo_include_tail]) @include ("../../$board[bo_include_tail]");

include_once("$g4[path]/tail.sub.php");
?>
