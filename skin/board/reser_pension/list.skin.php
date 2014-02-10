<?php
if($is_admin != 'super' && $member[mb_level] < 5) alert("관리자만 접근이 가능합니다.");
include_once("$board_skin_path/view.skin.lib.php");

if ($view_mode == "list"){
	include_once ("$board_skin_path/list.view.php");
} else if ($view_mode == "call") {
	include_once ("$board_skin_path/list.call.php");
} else if ($view_mode == "call2") {
	include_once ("$board_skin_path/list.call2.php");
} else if ($view_mode == "cost") {
	include_once ("$board_skin_path/list.cost.php");
} else {

	function viewCloseRoomOnly($penID, $pDate)
	{
		global $write_table2;
		// 방 정보 수집
	    $roomListSql = " SELECT A.r_info_id, A.r_info_name, B.r_close_idx FROM {$write_table2}_r_info AS A INNER JOIN {$write_table2}_r_close AS B ON
	    				A.r_info_id = B.r_info_id and ($pDate BETWEEN B.r_close_date AND B.r_close_date2) ";
		$resultList = sql_query($roomListSql);

		for ($i=0; $roomList = sql_fetch_array($resultList); $i++)
		{
			$viewDateRow[$i]['r_info_id']   = $roomList['r_info_id'];
			$viewDateRow[$i]['r_info_name'] = $roomList['r_info_name'];
			$viewDateRow[$i]['r_close_idx'] = $roomList['r_close_idx'];
		}
		return $viewDateRow;
	}

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
	$prevLink = "$_SERVER[PHP_SELF]?bo_table=$bo_table&pension_id=$pension_id&wr_id=$wr_id&sDate=$prevDay";
	$nextLink = "$_SERVER[PHP_SELF]?bo_table=$bo_table&pension_id=$pension_id&wr_id=$wr_id&sDate=$nextDay";

	if (eregi('%', $width)) {
		$col_width = "14%"; //표의 가로 폭이 100보다 크면 픽셀값입력
	}else{
		$col_width = round($width/7); //표의 가로 폭이 100보다 작거나 같으면 백분율 값을 입력
	}
	$col_height= 70 ;//내용 들어갈 사각공간의 세로길이를 가로 폭과 같도록

	$chk_list = "1";
	?>
	<link rel="stylesheet" href="<?=$board_skin_path?>/jQuery/jquery-ui-1.7.1.css" type="text/css">
	<link rel="stylesheet" href="<?=$board_skin_path?>/mstyle.css" type="text/css">
	<style type="text/css">
		span.dae { background-color:green; color:#FFFFFF; padding:0 1px; margin-right:2px; line-height:15px; }
		span.wan { background-color:red; color:#FFFFFF; padding:0 1px; margin-right:2px; line-height:15px; }
		span.cancel { background-color:black; color:#FFFFFF; padding:0 1px; margin-right:2px; line-height:15px; }
		span.bool { background-color:orange; color:#FFFFFF; padding:0 1px; margin-right:2px; line-height:15px; }
		span.ye { background-color:blue; color:#FFFFFF; padding:0 1px; margin-right:2px; line-height:15px; }
	</style>
	<script type="text/javascript" src="<?=$board_skin_path?>/jQuery/jquery.js"></script>
	<script type="text/javascript" src="<?=$board_skin_path?>/jQuery/jquery-ui-1.7.1.js"></script>
	<link rel="stylesheet" href="<?=$board_skin_path?>/jQuery/jtip.css" type="text/css">
	<script type="text/javascript" src="<?=$board_skin_path?>/jQuery/jtip.js"></script>

	<script language="javascript">
		function viewCallPop(url,nwidth,nheight) {
			window.open(url, 'viewCallPop', 'width='+nwidth+', height='+nheight+', left='+(screen.width-nwidth)/2+', top='+(screen.height - nheight)/2+', fullscreen=0, channelmode=0, location=0, menubar=0, scrollbars=1, status=0, toolbar=0, resizable=0');
		}

		var initBody;
		function beforePrint() {
			boxes = document.body.innerHTML;
			document.body.innerHTML = PrintBox.innerHTML;
		}

		function afferPrint() {
			document.body.innerHTML = boxes;
		}

		function printArea() {
			window.print();
		}

		window.onbeforeprint = beforePrint;
		window.onafferprint = afterPrint;
	</script>
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) left top;"></td>
			<td bgcolor="#FFFFFF">&nbsp;</td>
			<td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) right top;"></td>
		</tr>
		<tr>
			<td colspan="3" valign="top" style="background:#FFF; padding:10px;">
				<table width="100%" border=0 cellpadding="0" cellspacing="0" align="center">
					<tr>
						<td align=center>
							<table width="100%" border=0 cellpadding="0" cellspacing="0" bgcolor='#FFFFFF'>
								<tr>
									<td>
										<div style="text-align:center; margin:0 auto 10px;">
											<span style="margin-right:20px;"><a href="<?=$prevLink?>" target="_self" onfocus="this.blur()"><img src="<?=$board_skin_path?>/img_n/pre.gif" width="30" height="14" /></a></span>
											<a href="<?="$_SERVER[PHP_SELF]?bo_table=$bo_table&pension_id=$pension_id"?>" title="오늘로" onfocus="this.blur()">
												<span style="font-size:16px; font-weight:bold;"><?=$sDateY?>년 <?=$sDateM?>월</span>
											</a>
											<span style="margin-left:20px;"><a href="<?=$nextLink?>" target="_self" onfocus="this.blur()"><img src="<?=$board_skin_path?>/img_n/next.gif" width="30" height="14" /></a></span>
										</div>
										<div>
											<!-- <span class="ye">예</span>예약가능 -->
											<span class="wan">완</span>예약완료
											<span class="dae">대</span>입금대기
											<span class="cancel">취</span>예약취소
											<span class="bool">관</span>관리자예약
										</div>
									</td>
								</tr>
							</table>
							<table cellSpacing=0 cellPadding=0 bgcolor=#FFFFFF width='100%' align=center border=0>
								<tr>
									<td>
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
											//$viewDateRow = viewDateRow($sDateTmp, $eDateTmp, $pension_id);

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

													// 예약체크 출력
													$reserDay = reserDay($pension_id, $tDateTmp);

													while($resData = sql_fetch_array($reserDay)) {
														switch ($resData['rResult']) {
															case '0010':
																$tImgText = "dae";
																$tImgText2 = "대";
																$tImg = "dae.gif";
																break;
															case '0020':
																$tImgText = "wan";
																$tImgText2 = "완";
																$tImg = "wan.gif";
																break;
															case '0030':
																$tImgText = "cancel";
																$tImgText2 = "취";
																$tImg = "cancel.gif";
																break;
															case '0040':
																$tImgText = "wan";
																$tImgText2 = "완";
																$tImg = "wan.gif";
																break;
															default:
																$tImgText = "dae";
																$tImgText2 = "대";
																$tImg = "dae.gif";
																break;
														}
														echo "<div><img src='{$board_skin_path}/img_n/ico_home.gif' width=10 height=10 align=absmiddle />{$resData[ca_name]}</div>";
														echo "<div style='padding-left:3px;'>&middot; ";
														echo "<span class='{$tImgText}'>{$tImgText2}</span>";
														echo "<a href='$_SERVER[PHP_SELF]?bo_table=$bo_table&pension_id=$pension_id&wr_id={$resData[wr_id]}'>";
														echo "{$resData[wr_name]}";
														//echo " <img src='{$board_skin_path}/img_n/{$tImg}' width=11 height=11 align=absmiddle />";
														echo "</a></div>";
													}

													$cList = viewCloseRoomOnly($pension_id, $tDateTmp);
													for($ttm=0; $ttm < count($cList); $ttm++) {
														echo "<div>";
														//echo "<img src='{$board_skin_path}/img_n/ico_home.gif' width=10 height=10 align=absmiddle />";
														echo "<span class='bool'>관</span>";
														echo $cList[$ttm]['r_info_name'];
														echo "</div>";
													}

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
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td height="35" bgcolor='#FFFFFF'>달력의 <font color="#FF0000">객실명</font>을 클릭(선택)하면 실시간 <font color="#FF0000">예약</font>이 가능합니다. </td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) left bottom;"></td>
			<td bgcolor="#FFFFFF">&nbsp;</td>
			<td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) right bottom;"></td>
		</tr>
	</table>
	<?php
}
?>
