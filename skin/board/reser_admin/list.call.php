<?php
include_once ("$board_skin_path/config.php");

if (eregi('%', $width)) {
	$col_width = "14%"; //표의 가로 폭이 100보다 크면 픽셀값입력
}else{
	$col_width = round($width/7); //표의 가로 폭이 100보다 작거나 같으면 백분율 값을 입력
}
$col_height= 70 ;//내용 들어갈 사각공간의 세로길이를 가로 폭과 같도록
$today = getdate();
$b_mon = $today['mon'];
$b_day = $today['mday'];
$b_year = $today['year'];

if ($day != "") {   $month = $month;   $day = $day;   $year = $year;}
else if ($year < 1) {   $month = $b_mon;   $day = $b_day;   $year = $b_year;}


$lastday = array(0,31,28,31,30,31,30,31,31,30,31,30,31);
if ($year%4 == 0) $lastday[2] = 29;
$dayoftheweek = date("w", mktime (0,0,0,$month,1,$year));
?>
<link rel="stylesheet" href="<?=$board_skin_path?>/jQuery/jquery-ui-1.7.1.css" type="text/css">
<link rel="stylesheet" href="<?=$board_skin_path?>/mstyle.css" type="text/css">
<script type="text/javascript" src="<?=$board_skin_path?>/jQuery/jquery.js"></script>
<script type="text/javascript" src="<?=$board_skin_path?>/jQuery/jquery-ui-1.7.1.js"></script>
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
        <?php if ($admin_href) include_once("{$board_skin_path}/inc_top_menu.php");?>
<div id="PrintBox">
        <table width="100%" border=0 cellpadding="0" cellspacing="0" align="center">
                <tr>
                    <td align=center><table width="100%" border=0 cellpadding="0" cellspacing="0" bgcolor='#FFFFFF'>
                            <tr>
                                <td><table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
                                        <tr>
                                            <td width="150"></td>
                                            <td align="center"><table width="200" border="0" cellpadding="3" cellspacing="0">
                                                    <tr>
                                                        <td align="center"><a href="<?="$_SERVER[PHP_SELF]?bo_table=$bo_table&view_mode=call"?><?php if ($month == 1) { $year_pre=$year-1; $month_pre=12; } else {$year_pre=$year; $month_pre=$month-1;} echo ("&year=$year_pre&month=$month_pre");?>" target="_self" onfocus="this.blur()"><img src="<?=$board_skin_path?>/img_n/pre.gif" width="30" height="14" /></a></td>
                                                        <td align="center"><a href="<?="$_SERVER[PHP_SELF]?bo_table=$bo_table&view_mode=call"?>" title="오늘로" onfocus="this.blur()"><span style="font-size:16px; font-weight:bold;">
                                                            <?=$year?>
                                                            년
                                                            <?=$month?>
                                                            월</span></a></td>
                                                        <td align="center"><a href="<?="$_SERVER[PHP_SELF]?bo_table=$bo_table&view_mode=call"?><?php if ($month == 12) { $year_pre=$year+1; $month_pre=1; } else {$year_pre=$year; $month_pre=$month+1;} echo ("&year=$year_pre&month=$month_pre");?>" target="_self" onfocus="this.blur()"><img src="<?=$board_skin_path?>/img_n/next.gif" width="30" height="14" /></a></td>
                                                    </tr>
                                                </table></td>
                                            <td width="150" align="right"><a href="#" onclick="printArea()">인쇄하기</a></td>
                                        </tr>
                                    </table>
                                    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
                                        <tr>
                                            <td><img src="<?=$board_skin_path?>/img_n/wan.gif" width="11" height="11" align="absmiddle" /> 예약완료 <img src="<?=$board_skin_path?>/img_n/dae.gif" width="11" height="11" align="absmiddle" /> 입금대기 <img src="<?=$board_skin_path?>/img_n/jong.gif" width="11" height="11" align="absmiddle" /> 예약종료 <?php if($is_admin) {?><img src="<?=$board_skin_path?>/img_n/bool.gif" width="11" height="11" align="absmiddle" /> 예약불가<?php }?></td>
                                            <td align="right"><a href="<?=$g4[bbs_path]?>/board.php?bo_table=<?=$bo_table?>&view_mode=cost">매출</a> | <a href="<?=$g4[bbs_path]?>/board.php?bo_table=<?=$bo_table?>&view_mode=call"><strong>입실일</strong></a> | <a href="<?=$g4[bbs_path]?>/board.php?bo_table=<?=$bo_table?>&view_mode=call2">숙박기간</a></td>
                                        </tr>
                                    </table></td>
                            </tr>
                        </table>
                        <table cellSpacing=0 cellPadding=0 bgcolor=#FFFFFF width='100%' align=center border=0>
                            <tr>
                                <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
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
                                        <?php $sql = " SELECT * FROM {$write_table}_r_info order by r_info_order ASC ";
	$result = sql_query($sql);
	$r_total = 0;

	for ($i=0; $r_info = sql_fetch_array($result); $i++)  {
		$r_name[] = $r_info[r_info_name];
		$r_cnt[] = $r_info[r_info_cnt];
		$r_total++;
	}

##################################### 기존내용
	// 방목록 카테고리로 뽑기
	$query = "SELECT * FROM `g4_board` WHERE ( `bo_table` = '$bo_table' ) ORDER BY `bo_table` ASC ";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$catlist = explode("|",$row[bo_category_list]);
	$default_cat = explode("|",$row[bo_category_list]); // 기본카테고리

	$cday = 1;
	$sel_mon = sprintf("%02d",$month);
	$sel_mon2 = date("Ym", mktime(0,0,0,$month,0,$year));
	$query1 = "SELECT * FROM $write_table WHERE left(wr_link1,6) <= '$year$sel_mon'  and left(wr_link2,6) >= '$year$sel_mon' ORDER BY wr_id ASC";
	$result1 = mysql_query($query1);

	// 내용을 보여주는 부분
	while ($row1 = mysql_fetch_array($result1)) {

			$aaaa = substr($row1[wr_link1],0,4);
			$aaab = substr($row1[wr_link1],4,2);
			$aaba = substr($row1[wr_link2],0,4);
			$aabb = substr($row1[wr_link2],4,2);

			$acaa = $aaaa.$aaab;
			$acbb = $aaba.$aabb;

	 if( $acaa < $year.$sel_mon ) {
		 $start_day = 1;
		 $start_day = (int)$start_day;
	 } else {
		 $start_day = substr($row1[wr_link1],6,2);
		 $start_day = (int)$start_day;
	 }

	 if( $acbb > $year.$sel_mon ) {
		 $end_day = $lastday[$month];
		 $end_day = (int)$end_day;
	 } else {
		 $end_day = substr($row1[wr_link2],6,2);
		 $end_day = (int)$end_day-1;
	 }


		for ($i = $start_day ; $i <= $end_day;  $i++) {
			$html_day[$i] .= "<dt><a href='$g4[bbs_path]/board.php?bo_table=$bo_table&wr_id=$row1[wr_id]'> <font color=blue style='font-size:10pt;font-family:굴림'>".$row1[wr_name]."</font><font color=black style='font-size:9pt;font-family:굴림'>님 ".$row1[ca_name]." : 예약</a></dt>"."\n";
			//if($row1[wr_comment] >= '1') {
			if($row1[wr_4] == "예약완료") {
				$fontcolor = "green";
				$sang = "완료";
			} else {
				$fontcolor = "red";
				$sang = "대기";
			}
			$res_day[$i] .= "<dt style='color:{$fontcolor}; font-size:9pt;font-family:굴림'>".$row1[ca_name]." : ".$sang."</dt>"."\n";
			$tArray[$i] .= $row1[ca_name] . ':';
			$bArray[$i] .= $row1[ca_name] . '<br>';
		}
	}

	// 달력의 틀을 보여주는 부분
	$temp = 7- (($lastday[$month]+$dayoftheweek)%7);

	if ($temp == 7) $temp = 0;
		$lastcount = $lastday[$month]+$dayoftheweek + $temp;

	for ($iz = 1; $iz <= $lastcount; $iz++) {
		$bgcolor = "#FFFFFF";
		if ($b_year==$year && $b_mon==$month && $b_day==$cday) $bgcolor = "#f3f3f3";
		if (($iz%7) == 1) echo ("<tr>\n"); // 주당 7개씩 한쎌씩을 쌓는다.
		if ($dayoftheweek < $iz  &&  $iz <= $lastday[$month]+$dayoftheweek)	{ // 전체 루프안에서 숫자가 들어가는 셀들만 해당됨. 즉 11월 달에서 1일부터 30 일까지
			if ($cday < 10 ) {
				 $daytext = "0$cday";
			} else {
				 $daytext = "$cday";   // $cday 는 숫자 예> 11월달은 1~ 30일 까지//$daytext 은 셀에 써질 날짜 숫자 넣을 공간
			}

			if ($iz%7 == 1) $daytext = "<span style='color:red'>$daytext</span>"; // 일요일
			if ($iz%7 == 0) $daytext = "<span style='color:blue'>$daytext</span>"; // 토요일
			// 여기까지 숫자와 들어갈 내용에 대한 변수들의 세팅이 끝나고
			// 이제 여기 부터 직접 셀이 그려지면서 그 안에 내용이 들어 간다.
			if (($iz%7) == 0) {
				echo "<td width=$col_width height=$col_height bgcolor=$bgcolor align=left valign=top class='dsat'>\n";
			} else {
				echo "<td width=$col_width height=$col_height bgcolor=$bgcolor align=left valign=top class='day'>\n";
			}

			$f_date = date("Ymd", mktime(0,0,0,$month,$cday,$year)); //글쓰기 링크에 날짜정보를 입혀서 보내자
			$f1_date = date("Ymd", mktime(0,0,0,$month,$cday+1,$year)); //글쓰기 링크에 날짜정보를 입혀서 보내자
			echo "<div align='right'>";

			$py = substr($f_date,0,4);
			$pm = substr($f_date,4,2);
			$pd = substr($f_date,6,2);
			$pdate = mktime(12,0,0,$pm,$pd,$py);

			//$daytext = "<a href='#' onclick='viewCallPop(\"{$board_skin_path}/list.call.popup.php?bo_table={$bo_table}&pdate={$pdate}\",800,500);'>$daytext</a>";
			$daytext = "<a href='#' onclick='viewCallPop(\"{$board_skin_path}/list.call.popup.php?bo_table={$bo_table}&pdate={$f_date}\",800,500);'>$daytext</a>";

			if(Get_Date_Off($pdate)) {
				echo "<span style='color:red; padding:2px;'>" . Get_Date_Off($pdate) . "<span class='cal_sdate'>".$daytext."</span>"; //날짜 출력
			} else {
				echo "<span style='color:green;'>".Get_Date_Type_Cal($pdate)."</span> <span class='cal_sdate'>".$daytext."</span>"; //날짜 출력
			}
			//echo $html_day[$cday]; //예약된 카테고리 출력
			echo "</div>";
			echo "";

## Juni7 예약 멀티 체크 & 방 리스트 출력
			$rc_date = $py . $pm . $pd;
			for($c=0; $c<count($r_name); $c++) {//기본 카테고리 출력
				echo Get_Date_Reserv_List_Start($bo_table, $r_name[$c], $rc_date, "");
			}
			echo ("</td>\n");  // 한칸을 마무리
			$cday++; // 날짜를 카운팅
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
                                    </table></td>
                            </tr>
                        </table></td>
                </tr>
            </table>
</div>
    	</td>
    </tr>
    <tr>
        <td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) left bottom;"></td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) right bottom;"></td>
    </tr>
</table>
