<?php
include_once "./_common.php";
if($_GET['from'] == 'pc'){
    set_session("frommoblie", "");
}
include_once './_head.php';
?>
<title>예약하기</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi" > 

<?php $bo_table='bbs34';
$write_table = 'g4_write_bbs34';

include_once ("$board_skin_path/config.php");
$nowday = $_GET['f_date'];
$nowday1 = substr($nowday,0,4);
$nowday2 = substr($nowday,4,2);
$nowday3 = substr($nowday,6,2);


	if (eregi('%', $width)) {
		$col_width = "14%"; //표의 가로 폭이 100보다 크면 픽셀값입력
	}else{
		$col_width = round($width/7); //표의 가로 폭이 100보다 작거나 같으면 백분율 값을 입력
	}
	$col_height= 100;//내용 들어갈 사각공간의 세로길이를 가로 폭과 같도록
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

	$cnt_read = sql_fetch(" SELECT count(wr_id) as cnt FROM {$write_table} WHERE wr_4 != '예약취소' and wr_link1 <= $r_end_day and wr_link2 > $r_start_day");
	if($cnt_read[cnt] >= 100) {
		$chk_list = "0";
	} else {
		$chk_list = "1";
		include_once ("mconfig_n.php");
	}



?>

<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/showmotel.css" />
<!-- 
<link rel="stylesheet" href="<?=$board_skin_path?>/jQuery/jquery-ui-1.7.1.css" type="text/css">
<script type="text/javascript" src="<?=$board_skin_path?>/jQuery/jquery.js"></script>
<script type="text/javascript" src="<?=$board_skin_path?>/jQuery/jquery-ui-1.7.1.js"></script>
<link rel="stylesheet" href="<?=$board_skin_path?>/jQuery/jtip.css" type="text/css">
<script type="text/javascript" src="<?=$board_skin_path?>/jQuery/jtip.js"></script>

 -->


<div id="mobile-wrap">

<!-- 
<div style="text-align:center;">
	<div id="subtop">
		<div id="subtoptitle">
					<?php include "subtoptitle.php";?>
		</div>
	</div>
</div>


 -->
	<!-- <h1 class="logo">쇼앤뉴그린</h1>

	<nav id="gnb">
		<ul>
			<?php include "mtopmenu.php";?>
		</ul>
	</nav>
 -->

	<div class="booking-navi">
		<ul>
			<?php $on1 = "class=\"on\"";
				include_once "booking_menu.php";
			?>
		</ul>
	</div>


<?php
/*
if ($admin_href) { 
	echo "<a href='{$g4[bbs_path]}/board.php?bo_table={$bo_table}&view_mode=list'>목록</a>&nbsp;";
}
if (!$member['mb_id']) {
	echo "<a href='{$g4[bbs_path]}/login.php?url={$urlencode}'>로그인</a>&nbsp;";
} else {
	echo "<a href='{$g4[bbs_path]}/logout.php'>로그아웃</a>";
}
*/
?>


<!-- // 캘린더 interfo design // -->
	<table width="100%" cellpadding="0" cellspacing="0" class="calendar-mob">
	<caption>예약관리</caption>
	<thead>
	<tr>
		<th colspan="7" class="month">
			<a href="<?="$_SERVER[PHP_SELF]?bo_table=$bo_table"?><?php if ($month == 1) { $year_pre=$year-1; $month_pre=12; } else {$year_pre=$year; $month_pre=$month-1;} echo ("&year=$year_pre&month=$month_pre");?>" target="_self" onfocus="this.blur()">◀</a>

		<a href="<?="$_SERVER[PHP_SELF]?bo_table=$bo_table"?>" title="오늘" onfocus="this.blur()"><?=$year?>년 <?=$month?>월</a>
 
		<a href="<?="$_SERVER[PHP_SELF]?bo_table=$bo_table"?><?php if ($month == 12) { $year_pre=$year+1; $month_pre=1; } else {$year_pre=$year; $month_pre=$month+1;} echo ("&year=$year_pre&month=$month_pre");?>" target="_self" onfocus="this.blur()">▶</a>
		</th>
	</tr>

	<tr>
		<th class="sun">일</th>
		<th>월</th>
		<th>화</th>
		<th>수</th>
		<th>목</th>
		<th>금</th>
		<th class="sat">토</th>
	</tr>
	</thead>
	<tbody>

 <?php
############################## 2010-07-07 Start
if($chk_list) {
	## $rd_day Start
	$read_month_sql = " SELECT * FROM {$write_table} WHERE wr_4 != '예약취소' and wr_link1 <= $r_end_day and wr_link2 > $r_start_day";
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
	$read_close_sql = " SELECT * FROM {$write_table}_r_close WHERE r_close_date <= $r_end_day_tmp AND r_close_date2 >= $r_start_day_tmp";
	$read_close = sql_query($read_close_sql);
	
	for ($i=0; $r_close = sql_fetch_array($read_close); $i++)  {
		$rd_close[$i][r_close_name] = $r_close[r_close_name];
		$rd_close[$i][r_close_date] = $r_close[r_close_date];
		$rd_close[$i][r_close_date2] = $r_close[r_close_date2];
	}
	## $rd_close End
	
	## $rd_info Start
	$read_info_sql = " SELECT * FROM {$write_table}_r_info";
	$read_info = sql_query($read_info_sql);
	
	for ($i=0; $r_info = sql_fetch_array($read_info); $i++)  {
		$rd_info[$r_info[r_info_name]][r_info_over] = $r_info[r_info_over];
		$rd_info[$r_info[r_info_name]][r_info_cnt] = $r_info[r_info_cnt];
	}
	## $rd_info End
	
	## $rd_tel Start
	$read_tel_sql = " SELECT * FROM {$write_table}_r_tel WHERE r_tel_date <= $r_end_day_tmp AND r_tel_date2 >= $r_start_day_tmp";
	$read_tel = sql_query($read_tel_sql);
	
	for ($i=0; $r_tel = sql_fetch_array($read_tel); $i++)  {
		$rd_tel[$i][r_tel_name] = $r_tel[r_tel_name];
		$rd_tel[$i][r_tel_date] = $r_tel[r_tel_date];
		$rd_tel[$i][r_tel_date2] = $r_tel[r_tel_date2];
	}
	## $rd_tel End
	
	## $rd_off Start
	$read_off_sql = " SELECT * FROM {$write_table}_r_off WHERE r_off_date <= $r_end_day_tmp AND r_off_date2 >= $r_start_day_tmp";
	$read_off = sql_query($read_off_sql);
	
	for ($i=0; $r_off = sql_fetch_array($read_off); $i++)  {
		$rd_off[$i][r_off_name] = $r_off[r_off_name];
		$rd_off[$i][r_off_date] = $r_off[r_off_date];
		$rd_off[$i][r_off_date2] = $r_off[r_off_date2];
	}
	## $rd_off End
	
	## $rd_date Start
	$read_date_sql = " SELECT * FROM {$write_table}_r_date WHERE r_date_sdate <= $r_end_day_tmp AND r_date_edate >= $r_start_day_tmp";
	$read_date = sql_query($read_date_sql);
	
	for ($i=0; $r_date = sql_fetch_array($read_date); $i++)  {
		$rd_date[$i][r_date_name] = $r_date[r_date_name];
		$rd_date[$i][r_date_sdate] = $r_date[r_date_sdate];
		$rd_date[$i][r_date_edate] = $r_date[r_date_edate];
	}
	## $rd_date End
}
############################## 2010-07-07 End

	$sql = " SELECT r_info_name, r_info_cnt FROM {$write_table}_r_info order by r_info_order ASC ";
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
		if ($b_year==$year && $b_mon==$month && $b_day==$cday) $bgcolor = "#F5E500";   // 오늘 배경
		if ($b_day>$cday && $b_mon==$month) $bgcolor = "#e3e3e3";   // 지난날 배경 
		if ($nowday3-1==$daytext) $bgcolor = "orange";

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
		
	
			$py = substr($f_date,0,4);
			$pm = substr($f_date,4,2);
			$pd = substr($f_date,6,2);
			$pdate = mktime(12,0,0,$pm,$pd,$py);
			
			if($is_admin) $daytext = "<a href='#' onclick='viewCallPop(\"{$board_skin_path}/list.call.popup2.php?bo_table={$bo_table}&pdate={$f_date}\",800,500);'>$daytext</a>";
			//if($is_admin) $daytext = "<a href='#' onclick='viewCallPop(\"{$board_skin_path}/list.call.popup2.php?bo_table={$bo_table}&pdate={$pdate}\",800,500);'>$daytext</a>";


				if($year > $b_year || ($year >= $b_year && $month == $b_mon && $cday >= $b_day) || ($year >= $b_year && $month > $b_mon)) {
                 // 클릭 시 예약가능한 방 출력
					if($chk_list) {
								if(Get_Date_Off2($pdate)) {
								//	echo  Get_Date_Off2($pdate).$daytext; //날짜 출력
									echo $daytext; //날짜 출력
								} else {
									echo "<a href='?bo_table={$bo_table}&f_date={$f_date}&t_date={$f1_date}&sca={$r_name[$c]}&year={$year}&month={$month}'>".$daytext."</a>"; //날짜 출력
								}
							} else {
								if(Get_Date_Off($pdate)) {
									echo "<span style='color:red;>" . Get_Date_Off($pdate) . "<span class='cal_sdate'>".$daytext."</span>"; //날짜 출력
								} else {
									echo "<span style='color:green;'>".Get_Date_Type_Cal($pdate)."</span> <span class='cal_sdate'>".$daytext."</span>"; //날짜 출력
								}
							}

				} else {   // 종료  클릭안되게
							
							echo  $daytext; //날짜 출력

				}

/*
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
					echo "<img src='{$board_skin_path}/img_n/jong.gif' align='absmiddle' class='icon' />";
				}
			}
	*/


			


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
              

	</tbody>
	</table>
	<div style="padding:5px 0 20px 0;">달력의 <font color="#FF0000">날짜</font>를 터치(선택)하시면  <font color="#FF0000">실시간예약</font>이 가능한 방이름이 나옵니다.
	</div>









<div class="tbl1">
<?php if($nowday3) echo $nowday1."년 ".$nowday2."월 ".$nowday3."일 예약가능한 객실 목록입니다.";?>



<form name="fwrite" method="post" action="1_2.php">

	<table width="100%" cellpadding="0" cellspacing="0" class="booting-calendar" >
	<caption>예약관리</caption>
	<thead>
	<tr>
		<!-- <th></th> -->
		<th>객실명</th>
		<th>기간</th>
		<th>객실수</th>
		<th>추가인원</th>
		<!-- <th>요금</th> -->
	</tr>
	</thead>
	<tbody>
<?php
## Juni7 예약 멀티 체크 & 방 리스트 출력
			$rc_date = $py . $pm . $pd;
		if($is_admin) {
				for($c=0; $c < count($r_name); $c++) {//기본 카테고리 출력
					if($chk_list) {
						echo Get_Date_Reserv2($bo_table, $r_name[$c], $nowday, "$g4[bbs_path]/1_2.php?bo_table={$bo_table}&f_date={$f_date}&t_date={$f1_date}&sca={$r_name[$c]}");
					} else {
						echo Get_Date_Reserv($bo_table, $r_name[$c], $nowday, "$g4[bbs_path]/1_2.php?bo_table={$bo_table}&f_date={$f_date}&t_date={$f1_date}&sca={$r_name[$c]}");
					}
				}// for 끝
			} else {
				if($year > $b_year || ($year >= $b_year && $month == $b_mon && $cday >= $b_day) || ($year >= $b_year && $month > $b_mon)) {
					for($c=0; $c < count($r_name)-1; $c++) {//기본 카테고리 출력
						if($chk_list) {
						//	echo $nowday;
						if($nowday)	echo Get_Date_Reserv2($bo_table, $r_name[$c], $nowday, "$g4[bbs_path]/1_2.php?bo_table={$bo_table}&f_date={$f_date}&t_date={$f1_date}&sca={$r_name[$c]}");
						} else {
							echo Get_Date_Reserv($bo_table, $r_name[$c], $nowday, "$g4[bbs_path]/1_2.php?bo_table={$bo_table}&f_date={$f_date}&t_date={$f1_date}&sca={$r_name[$c]}");
						}
					}// for 끝
				} else {
					//echo "예약종료";
					//echo "<img src='{$board_skin_path}/img_n/jong.gif' align='absmiddle' class='icon' />";
				}
			}

?>

	</tbody>
	</table>

	<table width="100%" cellpadding="0" cellspacing="0" class="booting-calendar">
	<caption>예약관리</caption>
	<thead>
	<tr>
		<th>추가옵션</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td>
			<?=Get_Option_list($bo_table, "list","&nbsp;")?>
		</td>
	</tr>
	</tbody>
	</table>


</div>

<div class="btn-area"><a href="#" class="">취소하기</a><a href="javascript:fwrite.submit();" class="">다음단계</a></div>
<?php $s_day = date("Ymd", mktime(0,0,0,$nowday2,$nowday3,$nowday1)); //글쓰기 링크에 날짜정보를 입혀서 보내자  $month,$cday,$year
	$e_day = date("Ymd", mktime(0,0,0,$nowday2,$nowday3+1,$nowday1)); //글쓰기 링크에 날짜정보를 입혀서 보내자
?>
<input type="hidden" name="f_date" value="<?=$s_day?>">	<!-- 숙박시작   -->
<input type="hidden" name="t_date" value="<?=$e_day?>">	<!-- 숙박종료   -->
<input type="hidden" name="year" value="<?=$nowday1?>">	<!--년도 -->
<input type="hidden" name="month" value="<?=$nowday2?>">	<!--월 -->
<input type="hidden" name="day" value="<?=$nowday3?>">		<!--일 -->
</form>





<?php include_once './_tail.php';
?>
