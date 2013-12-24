<link rel="stylesheet" href="<?=$board_skin_path?>/jQuery/jquery-ui-1.7.1.css" type="text/css">
<link rel="stylesheet" href="<?=$board_skin_path?>/mstyle.css" type="text/css">
<script type="text/javascript" src="<?=$board_skin_path?>/jQuery/jquery.js"></script>
<script type="text/javascript" src="<?=$board_skin_path?>/jQuery/jquery-ui-1.7.1.js"></script>

<script language="javascript" src="<?=$g4[path]?>/js/md5.js"></script>
<script language="javascript" src="<?=$g4[path]?>/js/sideview.js"></script>
<script>
function check(it) {
  tr = it.parentNode.parentNode;
  tr.style.backgroundColor = (it.checked) ? "c8d8e0" : "white";
}
</script>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) left top;"></td>
        <td bgcolor="#ffffff">&nbsp;</td>
        <td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) right top;"></td>
    </tr>
    <tr>
        <td colspan="3" valign="top" style="background:#FFF; padding:10px;"><form name=fgbform method=post action="javascript:fgbform_submit(document.fgbform);" enctype='multipart/form-data' style="margin:0; padding:0;">
                <input type=hidden name=null>
                <!-- 삭제하지 마십시오. -->
                <input type=hidden name=w        value="<?=$w?>">
                <input type=hidden name=bo_table value="<?=$bo_table?>">
                <!--<input type=hidden name=wr_id    value="<?=$wr_id?>"> -->
                <input type=hidden name=sca      value="<?=$sca?>">
                <input type=hidden name=sfl      value="<?=$sfl?>">
                <input type=hidden name=stx      value="<?=$stx?>">
                <input type=hidden name=spt      value="<?=$spt?>">
                <input type=hidden name=sst      value="<?=$sst?>">
                <input type=hidden name=sod      value="<?=$sod?>">
                <input type=hidden name=page     value="<?=$page?>">
                <input type=hidden name=ca_name  value="<?=$sca?>">
                <?php include_once ("$board_skin_path/config.php"); ?>
                <table width='100%' align=center>
                    <tr>
                        <td>
<div class="sjbox">객실정보</div>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF" class="conbox">
  <tr>
    <td class="consjbox">방이름</td>
    <td width="15%" class="consjbox">타입</td>
    <td width="15%" class="consjbox">기준인원</td>
    <td width="15%" class="consjbox">최대인원</td>
    <td width="15%" class="consjbox">추가가능인원</td>
    <td width="15%" class="consjbox">추가요금</td>
  </tr>
  <tr>
    <td><?=Get_Room_Info_One($bo_table, $sca, 'name')?></td>
    <td><?=Get_Room_Info_One($bo_table, $sca, 'area')?></td>
    <td><?=number_format(Get_Room_Info_One($bo_table, $sca, 'person1'))?></td>
    <td><?=number_format(Get_Room_Info_One($bo_table, $sca, 'person2'))?></td>
    <td><?=number_format(Get_Room_Info_One($bo_table, $sca, 'person3'))?></td>
    <td><?=number_format(Get_Room_Info_One($bo_table, $sca, 'person_add'))?></td>
  </tr>
</table>

<div class="sjbox">요금정보</div>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF" class="conbox">
  <tr>
    <td class="consjbox">구분</td>
    <td width="15%" class="consjbox">평일 (월~목)</td>
    <td width="15%" class="consjbox">금요일</td>
    <td width="15%" class="consjbox">토요일</td>
    <td width="15%" class="consjbox">일요일</td>
    <td width="15%" class="consjbox">공휴일 전날</td>
  </tr>
  <tr>
    <td>기본요금</td>
    <td><?=number_format(Get_Room_Cost_One($bo_table, $sca, 11))?></td>
    <td><?=number_format(Get_Room_Cost_One($bo_table, $sca, 12))?></td>
    <td><?=number_format(Get_Room_Cost_One($bo_table, $sca, 13))?></td>
    <td><?=number_format(Get_Room_Cost_One($bo_table, $sca, 14))?></td>
    <td><?=number_format(Get_Room_Cost_One($bo_table, $sca, 15))?></td>
  </tr>
<?php $sql = " SELECT * FROM {$write_table}_r_date ORDER BY r_date_sdate ASC ";
$result = sql_query($sql);
for ($i=0; $r_date = sql_fetch_array($result); $i++)  {
	$info_id = sql_fetch("SELECT r_info_id FROM {$write_table}_r_info WHERE r_info_name='$sca'");
	$date_cost = sql_fetch("SELECT * FROM {$write_table}_r_date_cost WHERE r_date_idx = '$r_date[r_date_idx]' and r_info_id = '$info_id[r_info_id]'");
	$j=($i+1)%2;
?>
  <tr class="n_list<?=$j?>">
    <td><?=$r_date[r_date_name]?>
        <div><?=date("Y.m.d", $r_date[r_date_sdate])?>-<?=date("Y.m.d", $r_date[r_date_edate])?></div></td>
    <td><?=number_format($date_cost[r_date_cost_1])?></td>
    <td><?=number_format($date_cost[r_date_cost_2])?></td>
    <td><?=number_format($date_cost[r_date_cost_3])?></td>
    <td><?=number_format($date_cost[r_date_cost_4])?></td>
    <td><?=number_format($date_cost[r_date_cost_5])?></td>
  </tr>
<?php }?>
</table>

<div class="sjbox">추가옵션</div>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="0" class="conbox2">
  <tr>
    <td width="100" align="center" bgcolor="#F3F3F3">추가옵션</td>
    <td bgcolor="#F3F3F3"><?=Get_Option_list($bo_table, "list","&nbsp;")?></td>
  </tr>
</table>

<div class="sjbox">예약정보</div>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="0" class="conbox2">
  <tr>
    <td align="center">입실일자</td>
    <td>:&nbsp;<span style="color:red;">
        <?php $fy = substr($f_date,0,4);
	$fm = substr($f_date,4,2);
	$fd = substr($f_date,6,2);
	
	echo "{$fy}년 {$fm}월 {$fd}일";
?>
        <input type="hidden" name='wr_link1' itemname='입실일자' value='<?=$f_date?>' class='input' size="60" />
    </span></td>
  </tr>

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
		$("#wr_link2").datepicker({
			dateFormat: 'yymmdd'
		});
	});
</script>
  <tr>
  	<td align="center" bgcolor="#f3f3f3">퇴실일자</td>
    <td bgcolor="#f3f3f3">:&nbsp;<input type="text" name=wr_link2 id="wr_link2" required value="<?=$t_date?>" size="10" maxlength="8"/> 
    <a href="javascript:win_calendar('wr_link2', document.getElementById('wr_link2').value, '');"><img src='<?=$board_skin_path?>/img/calendar.gif' border=0 align=absmiddle title='달력 - 날짜를 선택하세요'></a>
    퇴실일자를 선택해 주세요!!</td>
	</tr>
<!--
  <tr>
    <td align="center" bgcolor="#f3f3f3">퇴실일자</td>
    <td bgcolor="#f3f3f3">:&nbsp;<input class=m_text id=wr_link2 type=text required numeric itemname=퇴실일자 size=13 name=wr_link2 value='<?=$t_date?>' readonly title='옆의 달력 아이콘을 클릭하여 날짜를 입력하세요.'>
                                    <a href="javascript:win_calendar('wr_link2', document.getElementById('wr_link2').value, '');"><img src='<?=$board_skin_path?>/img/calendar.gif' border=0 align=absmiddle title='달력 - 날짜를 선택하세요'></a> 퇴실일자를 선택해 주세요!!</td>
  </tr>
-->
  <tr>
    <td align="center">객 실 수</td>
    <td>:&nbsp;<select name='wr_9' size='1' value='<?=$wr_9?>'>
            <option value='1' selected='selected'>1</option>
<?php if(Get_Room_Info_One($bo_table, $sca, 'multi') == "O") {
	for($j=2; $j <= Get_Room_Info_One($bo_table, $sca, 'cnt'); $j++) echo "<option value='$j'>$j</option>\n";
}
?>
        </select></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#F3F3F3">추가인원</td>
    <td bgcolor="#F3F3F3">:&nbsp;<select name='wr_7' size='1' value='<?=$wr_7?>'>
        <option value='0' selected='selected'>0</option>
        <?php for($j=1; $j <= Get_Room_Info_One($bo_table, $sca, 'person3'); $j++) echo "<option value='$j'>$j</option>\n"; ?>
        </select>
        (기준인원에 추가 1인당
        <?=number_format(Get_Room_Info_One($bo_table, $sca, 'person_add'))?>
        원이 추가됩니다.)</td>
  </tr>
  <tr>
    <td width="100" align="center">비 고</td>
    <td>예약신청 후 숙박료가 입금확인되어야 예약신청이 완료됩니다. <br />
    	예약신청 후 <span style="color:#F00;">24시간이내 숙박료를 입금</span>하지 않으면 신청내역이 삭제됩니다.<br />
      <span style="color:#F00;">올바른 예약문화 정착을 위하여 예약취소시 환불수수료가 있습니다. 꼭! 확인하시고 예약해주세요!<br />
      날짜변경이나 예약취소시 수수료가 있습니다. 꼭! 확인하시고 예약해 주세요!</span></td>
  </tr>
</table>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30" align="center"><label><input name="agree" id="agree" type="checkbox" value="1" required>위 내용에 동의하시면 체크하신후 다음단계로 진행해 주세요!</label></td>
  </tr>
</table>
<?php if ($is_secret) { ?>
<input type=hidden value="secret" name="secret" <?=$secret_checked?>>
<?php } ?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="50" align="center"><img src="<?=$board_skin_path?>/img_n/pre2.gif" onclick="history.back();" style="cursor:pointer;" />&nbsp;
        <input type=image src="<?=$board_skin_path?>/img_n/next2.gif"></td>
  </tr>
</table>
						</td>
                    </tr>
                </table>
            </form></td>
    </tr>
    <tr>
        <td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) left bottom;"></td>
        <td bgcolor="#ffffff">&nbsp;</td>
        <td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) right bottom;"></td>
    </tr>
</table>
<script language='Javascript'>
function fgbform_submit(f) {
	var f = document.fgbform;
	
	if (f.w.value == 'i' && typeof(f.wr_name) != 'undefined') {
		f.wr_name.focus();
	} else if (f.w.value == 'u') {
		f.wr_subject.focus();
		if (typeof(f.ca_name) != 'undefined') {
			f.ca_name.value = '<?=$write[ca_name]?>';
		}
	}
	
	if(f.agree.checked == false) {
		alert('유의사항 및 환불기준에 동의하셔야 합니다.');
		return;
	}
	
	if (f.wr_link2.value-f.wr_link1.value<=0) {
		alert("입실일자와 퇴실일자가 같거나\n퇴실일자가 입실일자보다 빠릅니다.\n확인 후 다시 입력하시기 바랍니다.");
		return;
	}
	
	f.action = "./write.php";
	f.submit();
}
</script>
