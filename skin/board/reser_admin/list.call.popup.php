<?php include_once("_common.php");
include_once("$g4[path]/head.sub.php");

if($is_admin != 'super' || $is_auth) alert("관리자만 접근이 가능합니다.");
if(!$bo_table) alert("잘못된 접근입니다.");

$board_skin_path = ".";
$write_table = $g4[write_prefix] . $bo_table;

include_once("$board_skin_path/config.php");
?>
<body style="background:#FFF; margin:10px 10px 30px 10px; padding:0px; overflow-y:auto; overflow-x:hidden;">
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
			dateFormat: 'yy-mm-dd', firstDay: 0,
			isRTL: false};
		$.datepicker.setDefaults($.datepicker.regional['ko']);
		$("#pdate").datepicker({
			dateFormat: 'yymmdd',
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true
		});
		$("#pdate").change(function(){
			location.href = "<?=$_SERVER['PHP_SELF']?>?bo_table=<?=$bo_table?>&pdate="+$(this).attr("value");
		});
	});
</script>
<?php
//$f_date = date("Ymd", $pdate);
$f_date = $pdate;
$py = substr($f_date,0,4);
$pm = substr($f_date,4,2);
$pd = substr($f_date,6,2);
$rc_date = $py . $pm . $pd;

echo "<div style='text-align:left; margin-bottom:10px;'>날짜선택:<input type=text name=pdate id=pdate required value='$pdate' size=10 maxlength=8 /></div>";
echo "<dt style='font-weight:bold; font-size:13px; color:#000000; margin-bottom:15px;'>{$py}-{$pm}-{$pd} 예약현황(입실일)</dt>";

$sql = " SELECT * FROM {$write_table}_r_info order by r_info_order ASC ";
$result = sql_query($sql);

for ($r_info_cnt=0; $r_info = sql_fetch_array($result); $r_info_cnt++)  {
	echo Get_Date_Reserv_List_Start_Pop($bo_table, $r_info[r_info_name], $rc_date);
}
?>
<br style="clear:both;">
<div style="text-align:center; margin-top:20px;"><input type="button" onClick="print()" value="인쇄" > <input type="button" onClick="window.close();" value="창닫기"></div>
<?php include_once("$g4[path]/tail.sub.php");
?>
