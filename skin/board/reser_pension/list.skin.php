<?php include_once ("$board_skin_path/config.php");

if ($view_mode == "list"){
	include_once ("$board_skin_path/list.view.php");
} else if ($view_mode == "call") {
	include_once ("$board_skin_path/list.call.php");
} else if ($view_mode == "call2") {
	include_once ("$board_skin_path/list.call2.php");
} else if ($view_mode == "cost") {
	include_once ("$board_skin_path/list.cost.php");
} else {

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


	$r_start_day = $year . sprintf("%02d",$month) . "01";
	$r_start_day_tmp = mktime(12,0,0,$month,1,$year);
	$r_end_day = $year . sprintf("%02d",$month) . $lastday[$month];
	$r_end_day_tmp = mktime(12,0,0,$month,$lastday[$month],$year);
	
	$cnt_read = sql_fetch(" SELECT count(wr_id) as cnt FROM {$write_table} WHERE pension_id = '$pension_id' and wr_4 != '예약취소' and wr_link1 <= $r_end_day and wr_link2 > $r_start_day");

	if($cnt_read[cnt] >= 100) {
		$chk_list = "0";
	} else {
		$chk_list = "1";
		include_once ("$board_skin_path/config_n.php");
	}
?>
<link rel="stylesheet" href="<?=$board_skin_path?>/jQuery/jquery-ui-1.7.1.css" type="text/css">
<link rel="stylesheet" href="<?=$board_skin_path?>/mstyle.css" type="text/css">
<script type="text/javascript" src="<?=$board_skin_path?>/jQuery/jquery.js"></script>
<script type="text/javascript" src="<?=$board_skin_path?>/jQuery/jquery-ui-1.7.1.js"></script>
<link rel="stylesheet" href="<?=$board_skin_path?>/jQuery/jtip.css" type="text/css">
<script type="text/javascript" src="<?=$board_skin_path?>/jQuery/jtip.js"></script>

<script language="javascript"> 
function viewCallPop(url,nwidth,nheight) {
	window.open(url, 'viewCallPop', 'width='+nwidth+', height='+nheight+', left='+(screen.width-nwidth)/2+', top='+(screen.height - nheight)/2+', fullscreen=0, channelmode=0, location=0, menubar=0, scrollbars=1, status=0, toolbar=0, resizable=0');
}
</script>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) left top;"></td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) right top;"></td>
    </tr>
    <tr>
        <td colspan="3" valign="top" style="background:#FFF; padding:10px;"><table width="100%" border=0 cellpadding="0" cellspacing="0" align="center">
                <tr>
                    <td align=center><table width="100%" border=0 cellpadding="0" cellspacing="0" bgcolor='#FFFFFF'>
                            <tr>
                                <td><table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
                                        <tr>
                                            <td width="150">&nbsp;</td>
                                            <td align="center"><table width="200" border="0" cellpadding="3" cellspacing="0">
                                                    <tr>
                                                        <td align="center"><a href="<?="$_SERVER[PHP_SELF]?bo_table=$bo_table"?><?php if ($month == 1) { $year_pre=$year-1; $month_pre=12; } else {$year_pre=$year; $month_pre=$month-1;} echo ("&year=$year_pre&month=$month_pre");?>" target="_self" onfocus="this.blur()"><img src="<?=$board_skin_path?>/img_n/pre.gif" width="30" height="14" /></a></td>
                                                        <td align="center"><a href="<?="$_SERVER[PHP_SELF]?bo_table=$bo_table"?>" title="오늘로" onfocus="this.blur()"><span style="font-size:16px; font-weight:bold;">
                                                            <?=$year?>
                                                            년
                                                            <?=$month?>
                                                            월</span></a></td>
                                                        <td align="center"><a href="<?="$_SERVER[PHP_SELF]?bo_table=$bo_table"?><?php if ($month == 12) { $year_pre=$year+1; $month_pre=1; } else {$year_pre=$year; $month_pre=$month+1;} echo ("&year=$year_pre&month=$month_pre");?>" target="_self" onfocus="this.blur()"><img src="<?=$board_skin_path?>/img_n/next.gif" width="30" height="14" /></a></td>
                                                    </tr>
                                                </table></td>
                                            <td width="150" align="right"><?php if ($admin_href) { 
	echo "<a href='{$g4[bbs_path]}/board.php?bo_table={$bo_table}&view_mode=list'><img src='{$board_skin_path}/img_n/list.gif' border=0></a>&nbsp;";
}
if (!$member['mb_id']) {
	echo "<a href='{$g4[bbs_path]}/login.php?url={$urlencode}'><img src='{$board_skin_path}/img_n/login.gif' border=0></a>&nbsp;";
} else {
	echo "<a href='{$g4[bbs_path]}/logout.php'><img src='{$board_skin_path}/img_n/logout.gif' border=0></a>";
}?></td>
                                        </tr>
                                    </table>
                                    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
                                        <tr>
                                            <td><img src="<?=$board_skin_path?>/img_n/ye.gif" width="11" height="11" align="absmiddle" /> 예약가능 <img src="<?=$board_skin_path?>/img_n/wan.gif" width="11" height="11" align="absmiddle" /> 예약완료 <img src="<?=$board_skin_path?>/img_n/jen.gif" width="11" height="11" align="absmiddle" /> 전화예약 <img src="<?=$board_skin_path?>/img_n/dae.gif" width="11" height="11" align="absmiddle" /> 입금대기 <img src="<?=$board_skin_path?>/img_n/jong.gif" align="absmiddle" /> 예약종료 <?php if($is_admin) {?><img src="<?=$board_skin_path?>/img_n/bool.gif" width="11" height="11" align="absmiddle" /> 예약불가<?php }?></td>
                                            <td align="right"><a href="<?=$g4['bbs_path']?>/res_form.php?bo_table=<?=$bo_table?>"><img src="<?=$board_skin_path?>/img_n/ca_rescheck.gif" width="70" height="19" /></a></td>
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
                                        <?php
############################## 2010-07-07 Start
if($chk_list) {
	## $rd_day Start
	$read_month_sql = " SELECT * FROM {$write_table} WHERE pension_id = $pension_id and  wr_4 != '예약취소' and wr_link1 <= $r_end_day and wr_link2 > $r_start_day";
	$read_month = sql_query($read_month_sql);
	
	for ($i=0; $r_month = sql_fetch_array($read_month); $i++)  {
		$rd_day[$i][wr_id] = $r_month[wr_id];
		$rd_day[$i][ca_name] = $r_month[ca_name];
		$rd_day[$i][wr_link1] = $r_month[wr_link1];
		$rd_day[$i][wr_link2] = $r_month[wr_link2];
		$rd_day[$i][wr_4] = $r_month[wr_4];
		$rd_day[$i][wr_9] = $r_month[wr_9];
	}
	## $rd_day End
	
	## $rd_close Start
	$read_close_sql = " SELECT * FROM {$write_table}_r_close WHERE pension_id = $pension_id and  r_close_date <= $r_end_day_tmp AND r_close_date2 >= $r_start_day_tmp";
	$read_close = sql_query($read_close_sql);
	
	for ($i=0; $r_close = sql_fetch_array($read_close); $i++)  {
		$rd_close[$i][r_close_name] = $r_close[r_close_name];
		$rd_close[$i][r_close_date] = $r_close[r_close_date];
		$rd_close[$i][r_close_date2] = $r_close[r_close_date2];
	}
	## $rd_close End
	
	## $rd_info Start
	$read_info_sql = " SELECT * FROM {$write_table}_r_info where pension_id = $pension_id ";
	$read_info = sql_query($read_info_sql);
	
	for ($i=0; $r_info = sql_fetch_array($read_info); $i++)  {
		$rd_info[$r_info[r_info_name]][r_info_over] = $r_info[r_info_over];
		$rd_info[$r_info[r_info_name]][r_info_cnt] = $r_info[r_info_cnt];
	}
	## $rd_info End
	
	## $rd_tel Start
	$read_tel_sql = " SELECT * FROM {$write_table}_r_tel WHERE pension_id = $pension_id and  r_tel_date <= $r_end_day_tmp AND r_tel_date2 >= $r_start_day_tmp";
	$read_tel = sql_query($read_tel_sql);
	
	for ($i=0; $r_tel = sql_fetch_array($read_tel); $i++)  {
		$rd_tel[$i][r_tel_name] = $r_tel[r_tel_name];
		$rd_tel[$i][r_tel_date] = $r_tel[r_tel_date];
		$rd_tel[$i][r_tel_date2] = $r_tel[r_tel_date2];
	}
	## $rd_tel End
	
	## $rd_off Start
	$read_off_sql = " SELECT * FROM {$write_table}_r_off WHERE pension_id = $pension_id and  r_off_date <= $r_end_day_tmp AND r_off_date2 >= $r_start_day_tmp";
	$read_off = sql_query($read_off_sql);
	
	for ($i=0; $r_off = sql_fetch_array($read_off); $i++)  {
		$rd_off[$i][r_off_name] = $r_off[r_off_name];
		$rd_off[$i][r_off_date] = $r_off[r_off_date];
		$rd_off[$i][r_off_date2] = $r_off[r_off_date2];
	}
	## $rd_off End
	
	## $rd_date Start
	$read_date_sql = " SELECT * FROM {$write_table}_r_date WHERE pension_id = $pension_id and  r_date_sdate <= $r_end_day_tmp AND r_date_edate >= $r_start_day_tmp";
	$read_date = sql_query($read_date_sql);
	
	for ($i=0; $r_date = sql_fetch_array($read_date); $i++)  {
		$rd_date[$i][r_date_name] = $r_date[r_date_name];
		$rd_date[$i][r_date_sdate] = $r_date[r_date_sdate];
		$rd_date[$i][r_date_edate] = $r_date[r_date_edate];
	}
	## $rd_date End
}
############################## 2010-07-07 End
																				
																				
	$sql = " SELECT r_info_name, r_info_cnt FROM {$write_table}_r_info where pension_id = $pension_id order by r_info_order ASC ";
	$result = sql_query($sql);
	$r_total = 0;

	for ($i=0; $r_info = sql_fetch_array($result); $i++)  {
		$r_name[] = $r_info[r_info_name];
		$r_cnt[] = $r_info[r_info_cnt];
		$r_total++;
	}
	
	$cday = 1;

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
			
			if($is_admin) $daytext = "<a href='#' onclick='viewCallPop(\"{$board_skin_path}/list.call.popup2.php?bo_table={$bo_table}&pdate={$f_date}\",800,500);'>$daytext</a>";
			//if($is_admin) $daytext = "<a href='#' onclick='viewCallPop(\"{$board_skin_path}/list.call.popup2.php?bo_table={$bo_table}&pdate={$pdate}\",800,500);'>$daytext</a>";
			if($chk_list) {
				if(Get_Date_Off2($pdate)) {
					echo "<span style='color:red; padding:2px;'>" . Get_Date_Off2($pdate) . "<span class='cal_sdate'>".$daytext."</span>"; //날짜 출력
				} else {
					echo "<span style='color:green;'>".Get_Date_Type_Cal2($pdate)."</span> <span class='cal_sdate'>".$daytext."</span>"; //날짜 출력
				}
			} else {
				if(Get_Date_Off($pdate)) {
					echo "<span style='color:red; padding:2px;'>" . Get_Date_Off($pdate) . "<span class='cal_sdate'>".$daytext."</span>"; //날짜 출력
				} else {
					echo "<span style='color:green;'>".Get_Date_Type_Cal($pdate)."</span> <span class='cal_sdate'>".$daytext."</span>"; //날짜 출력
				}
			}
			echo "</div>";
			echo "";

## Juni7 예약 멀티 체크 & 방 리스트 출력
			$rc_date = $py . $pm . $pd;
			if($is_admin) {
				for($c=0; $c < count($r_name); $c++) {//기본 카테고리 출력
					if($chk_list) {
						echo Get_Date_Reserv2($bo_table, $r_name[$c], $rc_date, "$g4[bbs_path]/step2.php?bo_table={$bo_table}&f_date={$f_date}&t_date={$f1_date}&sca={$r_name[$c]}");
					} else {
						echo Get_Date_Reserv($bo_table, $r_name[$c], $rc_date, "$g4[bbs_path]/step2.php?bo_table={$bo_table}&f_date={$f_date}&t_date={$f1_date}&sca={$r_name[$c]}");
					}
				}// for 끝

			} else {
				if($year > $b_year || ($year >= $b_year && $month == $b_mon && $cday >= $b_day) || ($year >= $b_year && $month > $b_mon)) {
					for($c=0; $c < count($r_name); $c++) {//기본 카테고리 출력
						if($chk_list) {
							echo Get_Date_Reserv2($bo_table, $r_name[$c], $rc_date, "$g4[bbs_path]/step2.php?bo_table={$bo_table}&f_date={$f_date}&t_date={$f1_date}&sca={$r_name[$c]}");
						} else {
							echo Get_Date_Reserv($bo_table, $r_name[$c], $rc_date, "$g4[bbs_path]/step2.php?bo_table={$bo_table}&f_date={$f_date}&t_date={$f1_date}&sca={$r_name[$c]}");
						}
						
					}// for 끝



				} else {
					//echo "예약종료";
					echo "<img src='{$board_skin_path}/img_n/jong.gif' align='absmiddle' />";
				}
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
                <tr>
                    <td height="35" bgcolor='#FFFFFF'>달력의 <font color="#FF0000">객실명</font>을 클릭(선택)하면 실시간 <font color="#FF0000">예약</font>이 가능합니다. </td>
                </tr>
            </table></td>
    </tr>
    <tr>
        <td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) left bottom;"></td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) right bottom;"></td>
    </tr>
</table>
<?php }
?>
