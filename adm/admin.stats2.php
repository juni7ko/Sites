<?php
$sub_menu = "400310";
include_once("./_common.php");
include_once("./admin.head.php");

$pension_info = "g4_write_pension_info";
$room_info    = "g4_write_bbs34_r_info";
$room_base    = "g4_write_bbs34";
$room_reserv  = "g4_write_bbs34";

if( !$sDate && !$eDate ) {
	$r_year   = date("Y");
	$r_month  = date("m");
	$r_day    = date("d");

	$sDate = $r_year . $r_month . $r_day;
	$eDate = $sDate;
}

$where =  "WHERE  rResult = '0020' " ;
if($pension_id)
	$where .= " and pension_id = '$pension_id' ";

if($r_info_id)
	$where .= " and r_info_id = '$r_info_id' ";

$where .= " and (wr_link1 BETWEEN $sDate AND $eDate) ";

$sc_SQL = " SELECT * FROM $room_reserv $where order by wr_link1 asc ";
$select_DB = sql_query($sc_SQL);

$TotalCost = 0;
for ($i=0; $clist = sql_fetch_array($select_DB); $i++) {
	$rid[$i]['r_info_id'] = $clist['r_info_id'];
	if($rid[$i]['r_info_id'] == $rid[$i-1]['r_info_id']) {
		$list[$i]['r_info_name'] = $list[$i-1]['r_info_name'];
	} else {
		$rName_SQL = " SELECT r_info_name FROM $room_info WHERE r_info_id='$clist[r_info_id]' LIMIT 1 ";
		$rName = sql_fetch($rName_SQL);
		$list[$i]['r_info_name'] = $rName['r_info_name'];
	}

	$list[$i]['wr_link1'] = $clist['wr_link1'];
	$list[$i]['wr_datetime'] = $clist['wr_datetime'];
	$list[$i]['wr_name'] = $clist['wr_name'];
	$list[$i]['wr_9'] = $clist['wr_9'];
	$TotalCost += $list[$i]['wr_9'];
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
	$excelQuery = "pension_id={$pension_id}";
}

//echo $excelQuery;
?>
<script src="<?=$g4[path]?>/js/jquery-ui.min.js"></script>
<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.4/themes/base/jquery-ui.css" rel="stylesheet" />

<style type="text/css">
	@charset "utf-8";
    #formTable { width: 100%; margin: 0; padding: 0; border-collapse: collapse; }
    #formTable.box { border-top: 1px solid #d8e5eb; border-bottom: 2px solid #d8e5eb; }
    #formTable td { padding-top: 5px; border: 0px #d8e5eb solid; height: 22px; background: #EEEEEE; line-height: 22px; }
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
<form id="SearchForm" NAME="SearchForm" METHOD="post" ACTION="<?=$PHP_SELF ?>" />
	<table WIDTH="100%" CELLPADDING="0" CELLSPACING="0" height="30" id="formTable">
		<input type="hidden" name="pension_id" value="<?=$pension_id?>" class="pension_id" />
		<tr>
			<td>
				객실별
				<select name="r_info_id" id="r_info_id">
					<option value=""> 전체 </option>
					<?php
					while($rN = mysql_fetch_row($Re_rN))
						echo "<option value='${rN[0]}'>{$rN[1]}</option>";
					?>
				</select>
				<span style='margin:0 20px 0 30px;'>검색 기간 : </span>
				<input type="text" name="sDate" id="sDate" value="<?=$sDate?>" size=8 maxlength=8 minlength=8 numeric readonly title="옆의 달력 아이콘을 클릭하여 날짜를 입력하세요." style="width:70px;" />
				~
				<input type="text" name="eDate" id="eDate" value="<?=$eDate?>" size=8 maxlength=8 minlength=8 numeric readonly title="옆의 달력 아이콘을 클릭하여 날짜를 입력하세요." style="width:70px;" />
				<!-- <input type="submit" value=" 검 색 " class="btn_black" style="margin-left:20px;" onClick="dateSearch()"> -->
				<input type="button" value=" 검 색 " class="btn_black" style="margin-left:20px;" onClick="dateSearch()">
				<input type="button" value=" ←뒤로 " class="btn_black" onclick="history.back()">
				<input type="button" value=" EXCEL " class="btn_black" onclick="location.href='admin.stats2.excel.php?<?=$excelQuery?>'">
			</td>
		</tr>
	</table>
</form>
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

	<?php for($i=0; $i < count($list); $i++) : ?>
			<tr>
				<td><?=$i+1?></td>
				<td><?=substr($list[$i]['wr_link1'],0,4)?>년 <?=substr($list[$i]['wr_link1'],4,2)?>월 <?=substr($list[$i]['wr_link1'],6,2)?>일</td>
				<td><?=$list[$i]['r_info_name']?></td>
				<td><?=$list[$i]['wr_link1']?></td>
				<td><?=$list[$i]['wr_datetime']?></td>
				<td><?=$list[$i]['wr_name']?></td>
				<td><?=number_format($list[$i]['wr_9'])?></td>
				<td class="income"><?=number_format($list[$i]['wr_9'])?></td>
			</tr>
	<?php endfor; ?>

	<tr><td style="height:2px" colspan="8"></td></tr>

	<tr style="font-weight:bold">
		<td colspan="3" align="center">
			<?=substr($sDate,0,4)?>년 <?=substr($sDate,4,2)?>월 <?=substr($sDate,6,2)?>일
			~
			<?=substr($eDate,0,4)?>년 <?=substr($eDate,4,2)?>월 <?=substr($eDate,6,2)?>일
		</td>
		<td colspan="3" align="center">총 계</td>
		<td><?=number_format($TotalCost)?></td>
		<td class="income"><?=number_format($TotalCost)?></td>
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

	function dateSearch() {
		var sDate = $('#sDate').val();
		var eDate = $('#eDate').val();

		if( parseInt(sDate) > parseInt(eDate) ) {
			alert("날짜 지정이 잘못되었습니다.");
			return false;
		}
		$('#SearchForm').submit();
	}

	$("#penID").change(function() {
		pId = $(this).val();
		$('.pension_id').val(pId);
		$('#SearchForm').submit();
	});

	$("#r_info_id").change(function() {
		rId = $(this).val();
		$('#r_info_id').val(rId);
		$('#SearchForm').submit();
	});

	$.datepicker.regional['ko'] = {
		closeText: '닫기',
		prevText: '이전달',
		nextText: '다음달',
		currentText: '오늘',
		monthNames: ['1월(JAN)','2월(FEB)','3월(MAR)','4월(APR)','5월(MAY)','6월(JUN)',
		'7월(JUL)','8월(AUG)','9월(SEP)','10월(OCT)','11월(NOV)','12월(DEC)'],
		monthNamesShort: ['1월','2월','3월','4월','5월','6월',
		'7월','8월','9월','10월','11월','12월'],
		dayNames: ['일','월','화','수','목','금','토'],
		dayNamesShort: ['일','월','화','수','목','금','토'],
		dayNamesMin: ['일','월','화','수','목','금','토'],
		weekHeader: 'Wk',
		dateFormat: 'yymmdd',
		firstDay: 0,
		isRTL: false,
		showMonthAfterYear: true,
		yearSuffix: ''
	};
	$.datepicker.setDefaults($.datepicker.regional['ko']);

    $('#sDate').datepicker({
        showOn: 'button',
		buttonImage: '<?=$g4[path]?>/img/calendar.gif',
		buttonImageOnly: true,
        buttonText: "달력",
        changeMonth: true,
		changeYear: true,
        showButtonPanel: true,
        yearRange: 'c-99:c+99',
        maxDate: '+60d',
        minDate: '20130101'
    });

    $('#eDate').datepicker({
        showOn: 'button',
		buttonImage: '<?=$g4[path]?>/img/calendar.gif',
		buttonImageOnly: true,
        buttonText: "달력",
        changeMonth: true,
		changeYear: true,
        showButtonPanel: true,
        yearRange: 'c-99:c+99',
        maxDate: '+60d',
        minDate: '20130101'
    });

	$("select#penID").val('<?=$pension_id?>').attr('selected','selected');
	$("select#r_info_id").val('<?=$r_info_id?>').attr('selected','selected');
</SCRIPT>

<?php
include_once ("./admin.tail.php");
?>
