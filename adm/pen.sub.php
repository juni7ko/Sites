<?php if (!defined("_GNUBOARD_")) exit;

include_once("$g4[path]/lib/visit.lib.php");

if (empty($fr_date)) $fr_date = $g4[time_ymd];
if (empty($to_date)) $to_date = $g4[time_ymd];

$qstr = "fr_date=$fr_date&to_date=$to_date";
?>



<table width=100% cellpadding=3 cellspacing=1 class="adm_navi">
<form name=fvisit method=get>
<input type="hidden" name="pension_id" value="<?=$pension_id?>">
<tr>
		<?php if($pension_id){?>
		<td style="color:#FFFF00;font-weight:bold;"><?echo $write['wr_subject'] ? $write['wr_subject'] : '  등록  '; ?><!-- 기본정보 --></td>
		<td><a href="./pen_admin.php?mode=reserhome&pension_id=<?=$pension_id?>">예약홈</a></td>
		<td><a href="./pen_admin.php?mode=list&pension_id=<?=$pension_id?>">리스트</a></td>
		<td><a href="./pen_admin.php?mode=room&pension_id=<?=$pension_id?>">객실/기본요금</a></td>
		<td><a href="./pen_admin.php?mode=date&pension_id=<?=$pension_id?>">기간별요금</a></td>
		<td><a href="./pen_admin.php?mode=off&pension_id=<?=$pension_id?>">공휴일</a></td>
		<td><a href="./pen_admin.php?mode=close&pension_id=<?=$pension_id?>">예약불가</a></td>
		<td><a href="./pen_admin.php?mode=tel&pension_id=<?=$pension_id?>">전화예약</a></td>
		<td><a href="./pen_admin.php?mode=option&pension_id=<?=$pension_id?>">추가옵션</a></td>
		<?php }?>
</tr>
</form>
</table>

<script type='text/javascript'>
function fvisit_submit(act) 
{
    var f = document.fvisit;
    f.action = act;
    f.submit();
}
</script>

