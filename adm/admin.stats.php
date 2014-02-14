<?php
$sub_menu = "400310";
include_once("./_common.php");
include_once("./admin.head.php");

$pension_info = "g4_write_pension_info";
$room_info = "g4_write_bbs34_r_info";
$room_base = "g4_write_bbs34";
$room_reserv = "g4_write_bbs34";

if(!$r_year && !$r_month && !$r_day) {
	$r_year = date("Y") ;
	$r_month = date("m") ;
	//	$r_day = date("d") ;
	$today = $r_year."-".$r_month."-".$r_day;
}

$where =  "where  rResult = '0020' " ;
if($pension_id)
	$where .= " and pension_id = '$pension_id' ";

if($r_year && $r_year != "All")	 {
	if($r_month && $r_month != "All")	 {
		if($r_day && $r_day != "All") {
			$mode = "day";
			$tday = $r_year.$r_month.$r_day."%";
			$where = $where . " and (wr_link1 like '$tday' )" ;
			if($r_info_id)	 $where .= " and r_info_id = '" . $r_info_id . "'" ;
			$day_SQL = "SELECT * from $room_reserv $where order by wr_link1 asc ";
			$select_DB =  mysql_query($day_SQL);
		}else{
			$mode = "month";
			$tday = $r_year.$r_month."%";
			$where = $where . " and (wr_link1 like '$tday' )" ;
			if($r_info_id)	 $where .= " and r_info_id = '" . $r_info_id . "'" ;
			$month_SQL = "SELECT * , count(*) as cnt, sum(wr_9) as tmoney from $room_reserv $where group by wr_link1 order by wr_link1 asc ";
			$select_DB =  mysql_query($month_SQL);
		}
	}else{
		$mode = "year";
		$tday = $r_year."%";
		$where = $where . " and (wr_link1 like '$tday' ) " ;
		if($r_info_id) $where .= " and r_info_id = '" . $r_info_id . "'" ;
		$year_SQL = "SELECT * from $room_reserv $where order by wr_link1 asc ";
		$select_DB =  mysql_query($year_SQL);
	}
}else{
	$mode = "all";
	if($r_info_id)	 $where .= " and r_info_id = '" . $r_info_id . "'" ;
	$all_SQL = "SELECT * from $room_reserv  $where   order by wr_link1 asc ";
	$select_DB =  mysql_query($all_SQL);
}

$search_SQL = "SELECT * from $room_reserv  $where  order by wr_link1 asc ";  //group by ca_name

$search_DB =  mysql_query($search_SQL);

$dayCnt = '0';
while ($Data = sql_fetch_array($search_DB))   {

	if($r_year && $r_year != "All")	 {
		if($r_month && $r_month != "All")	 {
			if($r_day && $r_day != "All") {
				//	$mode = "day";
				$dayCnt++ ;
			}else{
				$dayCnt++ ;
			}
		}else{
			//	$mode = "year";
			$pay[substr($Data[wr_link1],0,4)."년".substr($Data[wr_link1],4,2)."월"] = $Data ;
			$dayTotalAmount[substr($Data[wr_link1],0,4)."년".substr($Data[wr_link1],4,2)."월"] += $Data[wr_9] ;
			$dayNego[substr($Data[wr_link1],0,4)."년".substr($Data[wr_link1],4,2)."월"] += $Data[wr_9] ;
			$mon = substr($Data[wr_link1],0,4).substr($Data[wr_link1],4,2);
			$ddayCnt[$mon]++ ;
		}
	}else{
		$mode = "all";
		$pay[substr($Data[wr_link1],0,4)."년"] = $Data ;
		$dayTotalAmount[substr($Data[wr_link1],0,4)."년"] += $Data[wr_9] ;
		$dayNego[substr($Data[wr_link1],0,4)."년"] += $Data[wr_9] ;
		$mon = substr($Data[wr_link1],0,4);
		$ddayCnt[$mon]++ ;
	}

	$Charge += $Data['wr_9'];
}

if($pension_id) {
	// 펜션을 선택했을 경우 펜션 객실명 검색
	$sql_r = "SELECT r_info_id , r_info_name  from $room_info WHERE pension_id = '$pension_id' order by r_info_name, r_info_id";
	$Re_rN = mysql_query($sql_r);
} else {
	$sql_r = "SELECT r_info_id , r_info_name  from $room_info order by pension_id, r_info_name";
	$Re_rN = mysql_query($sql_r);
}

// 펜션리스트 검색
$sql_pension = "SELECT pension_id , wr_subject  from $pension_info order by wr_subject asc";
$Re_rNP = mysql_query($sql_pension);

if($_POST) {
	$kv = array();
	foreach ($_POST as $key => $value) {
		if($key != 'pension_id')
			$kv[] = "$key=$value";
	}
	$excelQuery = join("&", $kv);
	$excelQuery .= "&pension_id={$pension_id}";
} else {
	if($r_year != "All") {
		$excelQuery = "r_year={$r_year}";
		$excelQuery .= "&r_month={$r_month}";
		$excelQuery .= "&pension_id={$pension_id}";
	} else {
		$excelQuery = "pension_id={$pension_id}";
	}
}

//echo $excelQuery;
?>

<style type="text/css">
	@charset "utf-8";
    #formTable { width: 100%; margin: 0; padding: 0; border-collapse: collapse; }
    #formTable.box { border-top: 1px solid #d8e5eb; border-bottom: 2px solid #d8e5eb; }
    #formTable td { padding-top: 5px; border: 1px #d8e5eb solid; height: 22px; background: #FFFFFF; line-height: 22px; }
    #formTable td.title { padding: 3px 10px 0 0; height: 30px; color: #3d7a99; font-weight: bold; letter-spacing: -1px; text-align: right; background: #F8FBFC; }
    #formTable td.input { padding: 0 0 0 10px; }
    #formTable td.input input { height: 18px; background: #f6f6f6; border: 1px solid #cccccc; }
    #formTable td.input textarea { background: #f6f6f6; border: 1px solid #cccccc; }

    #listTable { width: 100%; margin: 0; padding: 0; border-collapse: collapse; }
    #listTable.box { border-top: 1px solid #d8e5eb; border-bottom: 2px solid #d8e5eb; background: #F8FBFC; }
    #listTable td { padding-top: 5px; text-align: center; border: 1px #d8e5eb solid; height: 22px; }
    #listTable td a { border-bottom: 1px #CC3333 dashed; }
    #listTable td.red { color: #FF5555; }
    #listTable td.blue { color: #1F82BC; }
    #listTable th { border: 1px #d8e5eb solid; border-top: 2px #d8e5eb solid; padding: 3px 0 0 0; height: 25px; color: #3d7a99; font-weight: bold; letter-spacing: -1px; text-align: center; background: #F8FBFC; }
    #listTable td.text { padding: 3px 0 0 0; height: 25px; border-bottom: 1px solid #e7e7e7; text-align: center; }

    .btn01 { background: #FFFFFF; border-bottom: 2px solid #999; border-right: 2px solid #999; border-left: 1px solid #cccccc; border-top: 1px solid #cccccc; padding: 3px 5px 0 6px; }

    .btn_blue, #formTable td input.btn_blue { font-family: 돋움; font-size: 11px; border: 1px solid #314E84; background: #257EA5; color: #FFFFFF; height: 17px; padding: 1px 0 0 0; cursor: pointer; }
    .btn_red, #formTable td input.btn_red { font-family: 돋움; font-size: 11px; border: 1px solid #72351F; background: #C15B35; color: #FFFFFF; height: 17px; padding: 1px 0 0 0; cursor: pointer; }
    .btn_grey, #formTable td input.btn_grey { font-family: 돋움; font-size: 11px; border: 1px solid #404B4D; background: #5C6B6D; color: #FFFFFF; height: 17px; padding: 1px 0 0 0; cursor: pointer; }
    .btn_green, #formTable td input.btn_green { font-family: 돋움; font-size: 11px; border: 1px solid #2D4E27; background: #5C7B53; color: #FFFFFF; height: 17px; padding: 1px 0 0 0; cursor: pointer; }
    .btn_black, #formTable td input.btn_black { font-family: 돋움; font-size: 11px; border: 1px solid #777777; background: #FFFFFF; color: #777777; height: 17px; padding: 1px 0 0 0; cursor: pointer; margin:3px 10px; }
    .income { color: #f00; }
</style>

<select name="pension_id" id="penID" style="float:left;">
	<option value="" class="penSelect"> 전체 펜션 </option>
	<?php
	while($rNP = mysql_fetch_row($Re_rNP)) {
		echo "<option value='${rNP[0]}'>{$rNP[1]}</option>";
	}
	?>
</select>
<div style="float:right; text-align:right;">
	<a href="<?=$g4[admin_path]?>/admin.stats.php?pension_id=<?=$pension_id?>">검색1</a>
	/
	<a href="<?=$g4[admin_path]?>/admin.stats2.php?pension_id=<?=$pension_id?>">검색2</a>
</div>
<br style="clear:both;" />
<!-- 날짜별검색 -->
<FORM id="SearchForm" NAME="SearchForm" METHOD="post" ACTION="<?=$PHP_SELF ?>" />
	<TABLE WIDTH="100%" CELLPADDING="0" CELLSPACING="0" height="30" id="formTable">
		<input type="hidden" name="pension_id" value="<?=$pension_id?>" class="pension_id" />
		<TR>
			<TD align="center">
				<input type="button" value="이번달 " class="btn_black" onclick="dateSelect('<?=date('Y')?>','<?=date('m')?>','')">
				객실별
				<select name="r_info_id" id="r_info_id">
					<option value=""> 전체 </option>
					<?php
					while($rN = mysql_fetch_row($Re_rN))
						echo "<option value='${rN[0]}'>{$rN[1]}</option>";
					?>
				</select>
				<span style='margin-left:20px;'>년도별 입금 현황</span>
				<select name="r_year" id="r_year" onChange="if(!this.selectedIndex) this.form.r_month.selectedIndex=0;dateSelect(this.value,'','')">
				<option value="All" <?php if($r_year == "All") echo "selected";?>>전체</option>
				<?php
				for($Y=2013 ;$Y<=(date("Y"));$Y++){
					echo "<option value='$Y'>$Y</option>";
				}?>
				</select>
				년
				<select name="r_month" id="r_month" onChange="if(!this.form.r_year.selectedIndex) this.selectedIndex=0;dateSelect('<?=$r_year?>',this.value,'')">
					<option value="All"> 전체 </option>
					<?php
					for($i=101;$i<=112;$i++){
						$M = substr($i , -2) ;
						echo "<option value='$M'>$M</option>";
					}?>
				</select>
				월
				<select name="r_day" id="r_day" onChange="if(!this.form.r_month.selectedIndex) this.selectedIndex=0;submit();">
					<option value="All"> 전체 </option>
					<?php
					for($i=101;$i<=131;$i++){
						$D = substr($i , -2) ;
						echo "<option value='$D'>$D</option>";
					}?>
				</select>
				일
				<input type="submit" value=" 검 색 " class="btn_black" style="margin-left:20px;">
				<input type="button" value=" ←뒤로 " class="btn_black" onclick="history.back()">
				<input type="button" value=" EXCEL " class="btn_black" onclick="location.href='admin.stats.excel.php?<?=$excelQuery?>'">
			</TD>
		</TR>
	</TABLE>
</FORM>
<!-- 날짜별검색 끝 -->
<br />
<table id="listTable">
	<tr>
		<th>번호</th>
		<th>입금일</th>
		<th>객실명</th>
		<th>입실일</th>
		<th>예약일</th>
		<th>신청인</th>
		<th>예약금액</th>
		<th>입금액</th>
		<!-- <th>미수</th> -->
	</tr>

	<?php
	$no = '1';

	$insPay = $pay2['wr_9'];
	if($mode == 'year'){
		foreach($pay as $date => $pay2) {
			?>
			<tr>
				<td><?=$no?></td>
				<td><a href="javascript:void(dateSelect('<?=substr($pay2['wr_link1'],0,4)?>','<?=substr($pay2['wr_link1'],4,2)?>',''))"><?=substr($pay2['wr_link1'],0,4)?>년 <?=substr($pay2['wr_link1'],4,2)?>월 </a></td>
				<td><?=$pay2['ca_name']?>  <span style='color:#3D7A99'> (<?=$ddayCnt[substr($pay2['wr_link1'],0,4).substr($pay2['wr_link1'],4,2)]?>건) </td>
				<td><?=$pay2['wr_link1']?></td>
				<td><?=$pay2['wr_datetime']?></td>
				<td><?=$pay2['wr_name']?>..</td>
				<td><?=number_format($dayTotalAmount[$date])?></td>
				<td  class="income"><?=number_format($dayTotalAmount[$date])?></td>
				<!-- <td><?=number_format($dayTotalAmount[$date] - $dayTotalAmount[$date])?></td> -->
			</tr>

			<?php
			$no++;
		}
	}else if($mode == 'month'){
		while ($pay2 = sql_fetch_array($select_DB))   {
			?>
			<tr>
				<td><?=$no?></td>
				<td><a href="javascript:void(dateSelect('<?=substr($pay2['wr_link1'],0,4)?>','<?=substr($pay2['wr_link1'],4,2)?>','<?=substr($pay2['wr_link1'],6,2)?>'))"><?=substr($pay2['wr_link1'],0,4)?>년 <?=substr($pay2['wr_link1'],4,2)?>월 <?=substr($pay2['wr_link1'],6,2)?>일</a></td>
				<td><?=$pay2['ca_name']?>  <?php if($pay2['cnt']-1){ echo "  <span style='color:#3D7A99'> (".$pay2['cnt']." 건)</span>"; }?> </td>
				<td><?=$pay2['wr_link1']?></td>
				<td><?=$pay2['wr_datetime']?></td>
				<td><?=$pay2['wr_name']?> ..</td>
				<td><?=($insedPay)?"<font style='color:#999999 ; font-size:11px'>" . number_format($pay2[tmoney]) . "</font><br />":''?><?=number_format($pay2[tmoney] - $insedPay)?></td>
				<td  class="income"><?=number_format($pay2[tmoney])?></td>
				<!-- <td><?=number_format($pay2['wr_9'] - $insedPay - $insPay)?></td> -->
			</tr>

			<?php
			$no++;
		}
	}else if($mode == 'day'){

		while ($pay2 = sql_fetch_array($select_DB)) {
			?>

			<tr>
				<td><?=$no?></td>
				<td><a onClick="win_stats('<?=$g4['path']?>/bbs/resList.php?bo_table=bbs34&wr_id=<?=$pay2['wr_id']?>&pension_id=<?=$pay2['pension_id']?>&ap=1')" style="cursor:pointer;"><?=$pay2['wr_link1']?></a></td>
				<td><?=$pay2['ca_name']?></td>
				<td><?=$pay2['wr_link1']?></td>
				<td><?=$pay2['wr_datetime']?></td>
				<td><?=$pay2['wr_name']?></td>
				<td><?=($insedPay)?"<font style='color:#999999 ; font-size:11px'>" . number_format($pay2[wr_9]) . "</font><br />":''?><?=number_format($pay2[wr_9] - $insedPay)?></td>
				<td><?=number_format($pay2[wr_9])?></td>
				<!-- <td><?=number_format($pay2['wr_9'] - $insedPay - $insPay)?></td> -->
			</tr>

			<?php
			$no++;
		}
	}else{
// all
		foreach($pay as $date => $pay2) {
			?>

			<tr>
				<td><?=$no?></td>
				<td><a href="javascript:void(dateSelect('<?=substr($pay2['wr_link1'],0,4)?>','',''))"><?=substr($pay2['wr_link1'],0,4)?>년 </a></td>
				<td><?=$pay2['ca_name']?> <span style='color:#3D7A99'> (<?=$ddayCnt[substr($pay2['wr_link1'],0,4)]?>건) </td>
				<td><?=$pay2['wr_link1']?></td>
				<td><?=$pay2['wr_datetime']?></td>
				<td><?=$pay2['wr_name']?></td>
				<td><?=number_format($dayTotalAmount[$date])?></td>
				<td  class="income"><?=number_format($dayTotalAmount[$date])?></td>
				<!-- <td><?=number_format($dayTotalAmount[$date] - $dayTotalAmount[$date])?></td> -->
			</tr>
			<?php
		}
	}
// if end
	?>


	<tr><td style="height:2px" colspan="8"></td></tr>

	<tr style="font-weight:bold">
		<td rowspan="2" colspan="3" align="center"><?php if($r_year && $r_year != "All"){echo $r_year . "년";}?> <?php if($r_month && $r_month != "All"){echo $r_month . "월";}?> <?php if($r_day && $r_day != "All" && $mode == "day"){echo $r_day . "일";}?></td>
		<td colspan="3" align="center">총 계</td>
		<td><?=number_format($Charge)?></td>
		<td class="income"><?=number_format($Charge)?></td>
	</tr>
	<tr style="font-weight:bold">
		<td colspan="4" align="center">15% 공제금액</td>
		<td class="income"><?=number_format( $Charge - ceil( ( ($Charge * 0.15)) / 100) * 100 )?></td>
	</tr>
</table>

<SCRIPT LANGUAGE="JavaScript">
	function win_stats(url)
	{
	    win_open(url, "winStats", "left=50, top=50, width=800, height=600, scrollbars=1");
	}

	function dateSelect(year , month , day) {
		f = document.SearchForm ;
		if(year) f.r_year.value=year.replace('년' , '') ;
		if(month) f.r_month.value=month ;
		else f.r_month.value='All' ;
		if(day) f.r_day.value=day ;
		else f.r_day.value='All' ;
		f.submit() ;
	}

	$("#penID").change(function() {
		// pId = $(this).val();
		// uri2 = "<?=$_SERVER[PHP_SELF]?>?pension_id="+pId;
		// $(location).attr('href',uri2);

		pId = $(this).val();
		$('.pension_id').val(pId);
		$('#SearchForm').submit();
	});

	$("#r_info_id").change(function() {
		rId = $(this).val();
		$('#r_info_id').val(rId);
		$('#SearchForm').submit();
	});

	$("select#penID").val('<?=$pension_id?>').attr('selected','selected');
	$("select#r_info_id").val('<?=$r_info_id?>').attr('selected','selected');
	$("select#r_year").val('<?=$r_year?>').attr('selected','selected');
	$("select#r_month").val('<?=$r_month?>').attr('selected','selected');
	$("select#r_day").val('<?=$r_day?>').attr('selected','selected');
</SCRIPT>

<?php
include_once ("./admin.tail.php");
?>
