<?php include_once "_common.php";
include_once("$board_skin_path/config.php");

if($is_admin != 'super' || $is_auth) alert("관리자만 접근이 가능합니다.");

if(!$bo_table) alert("정상적인 접근이 아닙니다.");

############# 헤드
$this_page = "{$_SERVER['PHP_SELF']}?bo_table={$bo_table}";
?>
<link rel="stylesheet" href="<?=$board_skin_path?>/jQuery/jquery-ui-1.7.1.css" type="text/css">
<link rel="stylesheet" href="<?=$board_skin_path?>/mstyle.css" type="text/css">
<script type="text/javascript" src="<?=$board_skin_path?>/jQuery/jquery.js"></script>
<script type="text/javascript" src="<?=$board_skin_path?>/jQuery/jquery-ui-1.7.1.js"></script>
<script language="javascript" src="<?=$g4[path]?>/js/md5.js"></script>
<script language="javascript" src="<?=$g4[path]?>/js/sideview.js"></script>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) left top;"></td>
        <td bgcolor="#ffffff">&nbsp;</td>
        <td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) right top;"></td>
    </tr>
    <tr>
        <td colspan="3" valign="top" style="background:#FFF; padding:10px;"><?php include_once("{$board_skin_path}/inc_top_menu.php"); ?>
<div class="ui-state-highlight ui-corner-all" style="margin: 20px 0 5px; padding: 5px .7em;">
    <span class="ui-icon ui-icon-power" style="float: left; margin-right: .3em;"></span>
    <strong>예약내용 수정</strong>
</div>

<form name=fgbform method=post action="javascript:fgbform_submit(document.fgbform);" enctype='multipart/form-data'>
  <input type=hidden name=null>
  <!-- 삭제하지 마십시오. -->
  <input type=hidden name=w        value="<?=$w?>">
  <input type=hidden name=bo_table value="<?=$bo_table?>">
  <input type=hidden name=wr_id    value="<?=$wr_id?>">
  <input type=hidden name=sca      value="<?=$sca?>">
  <input type=hidden name=sfl      value="<?=$sfl?>">
  <input type=hidden name=stx      value="<?=$stx?>">
  <input type=hidden name=spt      value="<?=$spt?>">
  <input type=hidden name=sst      value="<?=$sst?>">
  <input type=hidden name=sod      value="<?=$sod?>">
  <input type=hidden name=page     value="<?=$page?>">
	<?php if($write[wr_4]) { ?>
  <input type=hidden name=wr_4     value="<?=$write[wr_4]?>">
  <?php } else { ?>
  <input type=hidden name=wr_4     value="예약확인중">
  <?php } ?>

<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF" class="conbox">
  <tr>
    <td width="150" class="consjbox">예약코드</td>
    <td bgcolor="#FBF8F6"><?=$write[wr_3]?><input type=hidden name='wr_3' itemname='예약코드' value='<?=$write[wr_3]?>'></td>
    <td width="150" class="consjbox">선택하신 방</td>
    <td bgcolor="#FBF8F6"><?=$write[ca_name]?> (기준인원 : <?=Get_Room_Info_One($bo_table, $write[ca_name], 'person1')?>명) <?php if(Get_Room_Info_One($bo_table, $write[ca_name], 'multi') == "O")  { echo " X " . $write[wr_9]; }?>
        <input type=hidden name='ca_name' value='<?=Get_Room_Info_One($bo_table, $write[ca_name], 'name')?>'>
        <input type=hidden name='wr_9' value='<?=$wr_9?>' /></td>
  </tr>
<?php $f_year = substr($write[wr_link1],0,4);
 $f_mon = substr($write[wr_link1],4,2);
 $f_day = substr($write[wr_link1],6,2);
 $t_year = substr($write[wr_link2],0,4);
 $t_mon = substr($write[wr_link2],4,2);
 $t_day = substr($write[wr_link2],6,2);
?>
  <tr>
    <td class="consjbox">입실일자</td>
    <td><?=$f_year?>년 <?=$f_mon?>월 <?=$f_day?>일<input type=hidden name='wr_link1' itemname='입실일자' value='<?=$wr_link1?>'></td>
    <td class="consjbox">퇴실일자</td>
    <td><?=$t_year?>년 <?=$t_mon?>월 <?=$t_day?>일<input type=hidden name='wr_link2' itemname='퇴실일자' value='<?=$wr_link2?>'></td>
  </tr>
<?php $s_time=mktime( "00", "00", "00",$f_mon,$f_day,$f_year);
$e_time=mktime( "23", "59", "59",$t_mon,$t_day,$t_year);

$cnt=$e_time-$s_time;
$sl_day=floor($cnt/86400);

$sl_day2 = $sl_day+1;

$res_cnt = Get_Room_Info_One($bo_table, $write[ca_name], 'person1') + $write[wr_7];
?>
  <tr>
    <td class="consjbox">숙박일수</td>
    <td bgcolor="#fbf8f6"><?=$sl_day?>박 <?=$sl_day2?>일<input type=hidden name='wr_8' required itemname='숙박일수' value='<?=$sl_day?>'></td>
    <td class="consjbox">추가인원</td>
    <td bgcolor="#fbf8f6"><?=$write[wr_7]?>명
        <input type=hidden name='wr_7' required itemname='추가인원' value='<?=$write[wr_7]?>'>
        <input type=hidden name='wr_1' required itemname='예약인원' value='<?=$write[wr_1]?>'></td>
  </tr>
  <tr>
      <td class="consjbox">요금내역</td>
      <td colspan="3" align="left" style="text-align:left;"><?=stripslashes($write[wr_reserv])?>
          <textarea name='wr_reserv' style="visibility:hidden; height:0; line-height:0;"><?=stripslashes($write[wr_reserv])?></textarea>
          <input type=hidden name='wr_10' required itemname='토탈요금' value='<?=$write[wr_10]?>'></td>
  </tr>
  <tr>
      <td class="consjbox">예약자성명</td>
      <td colspan="3" align="left" bgcolor="#FBF8F6"><input type=text name='wr_name' size=30 maxlength=20 required itemname='이름' value='<?=$write[wr_name]?>'> <span style="color:red;">* 예약자명은 입금자명과 동일해야 합니다.</span></td>
  </tr>
  <tr>
    <td class="consjbox">E-Mail 주소</td>
    <td colspan="3" align="left"><input type=text name='wr_email' size=30 maxlength=100 itemname='E-MAIL' value='<?=$write[wr_email]?>'></td>
  </tr>
  <tr>
    <td class="consjbox">비밀번호</td>
    <td colspan="3" align="left" bgcolor="#FBF8F6"><input type=password id=wr_6 name='wr_6' size=20 maxlength=10 minlength=4 required itemname='비밀번호' value='<?=$write[wr_6]?>'>
        ※ 예약확인시에 이용됩니다. (숫자만 4~10자리이내)</td>
  </tr>
<?php $tel = explode("-", $write[wr_2]);?>
	<tr>
    <td class="consjbox">휴대전화</td>
    <td colspan="3" align="left">
      <input name='tel1' value='<?=$tel[0]?>' type='text' size='5' maxlength='3'> -
      <input name='tel2' value='<?=$tel[1]?>' type='text' size='7' maxlength='4'> -
      <input name='tel3' value='<?=$tel[2]?>' type='text' size='7' maxlength='4'></td>
  </tr>
  <tr>
    <td class="consjbox">추가사항</td>
    <td colspan="3" align="left" bgcolor="#FBF8F6"><textarea name='wr_content' required style='word-break:break-all;'  cols=70 rows=10 itemname='내용'><?=$write[wr_content]?>
</textarea></td>
  </tr>
</table>
<?php if ($is_secret) { ?>
<input type=hidden value="secret" name="secret" <?=$secret_checked?>>
<?php } ?>
<input type=hidden name='wr_subject' itemname='제목' value='예약내용'>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="50" align="center">
    	<img src="<?=$board_skin_path?>/img_n/pre2.gif" onclick="history.back()" style="cursor:pointer;" /> &nbsp;
      <input name="btnsubmit" type="image" src="<?=$board_skin_path?>/img_n/next3.gif" /></td>
  </tr>
</table>
</form>
<script language='Javascript'>
function fgbform_submit(f)
{
	var f = document.fgbform;
	// 김선용 2006.3 - 전화번호(휴대폰) 형식 검사 : 123-123(4)-5678

	function wrestTelnumber(fld) {
		if (!wrestTrim(fld)) return;

		var pattern = /^[0-9]{2,3}-[0-9]{3,4}-[0-9]{4}$/;
		if(!pattern.test(fld.value)) {
			if(wrestFld == null){
				wrestMsg = wrestItemname(fld)+" : 전화번호 형식이 올바르지 않습니다.\n\n하이픈(-)을 포함하여 입력해 주십시오.\n";
				wrestFld = fld;
				fld.select();
			}
		}
	}

	// 이메일주소 형식 검사
	function wrestEmail(fld) {
		if (!wrestTrim(fld)) return;

		//var pattern = /(\S+)@(\S+)\.(\S+)/; 이메일주소에 한글 사용시
		var pattern = /([0-9a-zA-Z_-]+)@([0-9a-zA-Z_-]+)\.([0-9a-zA-Z_-]+)/;
		if (!pattern.test(fld.value)) {
			if (wrestFld == null) {
				wrestMsg = wrestItemname(fld) + " : 이메일주소 형식이 아닙니다.\n";
				wrestFld = fld;
			}
		}
	}

	f.action = "<?=$board_skin_path?>/modify_update.skin.php";
	f.submit();
}

</script>
</td>
    </tr>
<tr><td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) left bottom;"></td>
<td bgcolor="#ffffff">&nbsp;</td>
<td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) right bottom;"></td></tr>
</table>
