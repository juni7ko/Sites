<link rel="stylesheet" href="<?=$board_skin_path?>/jQuery/jquery-ui-1.7.1.css" type="text/css">
<link rel="stylesheet" href="<?=$board_skin_path?>/mstyle.css" type="text/css">
<script type="text/javascript" src="<?=$board_skin_path?>/jQuery/jquery.js"></script>
<script type="text/javascript" src="<?=$board_skin_path?>/jQuery/jquery-ui-1.7.1.js"></script>
<style type="text/css">
.red_bold { color:#F00; font-weight:bold; }
</style>
<script language="javascript" src="<?=$g4[path]?>/js/md5.js"></script>
<script language="javascript" src="<?=$g4[path]?>/js/sideview.js"></script>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) left top;"></td>
        <td bgcolor="#ffffff">&nbsp;</td>
        <td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) right top;"></td>
    </tr>
	<tr>
        <td colspan="3" valign="top" style="background:#FFF; padding:10px;">
    <form name=fgbform method=post action="javascript:fgbform_submit(document.fgbform);" enctype='multipart/form-data' style="margin:0; padding:0;">
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
        <?php include_once ("$board_skin_path/config.php");
$room_code = Get_Room_Info_One($bo_table, $sca, 'id');
$res_code = $room_code . mktime();
?>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF" class="conbox">
  <tr>
    <td width="150" class="consjbox">예약코드</td>
    <td bgcolor="#FBF8F6"><?php echo $res_code; ?><input type=hidden name='wr_3' itemname='예약코드' value='<?=$res_code?>'></td>
    <td width="150" class="consjbox">선택하신 방</td>
    <td bgcolor="#FBF8F6"><?=Get_Room_Info_One($bo_table, $sca, 'name')?> (기준인원 : <?=Get_Room_Info_One($bo_table, $sca, 'person1')?>명) <?php if(Get_Room_Info_One($bo_table, $sca, 'multi') == "O")  { echo " X " . $wr_9; }?>
        <input type=hidden name='ca_name' value='<?=Get_Room_Info_One($bo_table, $sca, 'name')?>'>
        <input type=hidden name='wr_9' value='<?=$wr_9?>' /></td>
  </tr>
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

$res_cnt = Get_Room_Info_One($bo_table, $sca, 'person1') + $wr_7;
?>
  <tr>
    <td class="consjbox">숙박일수</td>
    <td bgcolor="#fbf8f6"><?=$sl_day?>박 <?=$sl_day2?>일<input type=hidden name='wr_8' required itemname='숙박일수' value='<?=$sl_day?>'></td>
    <td class="consjbox">추가인원</td>
    <td bgcolor="#fbf8f6"><?=$wr_7?>명
        <input type=hidden name='wr_7' required itemname='추가인원' value='<?=$wr_7?>'>
        <input type=hidden name='wr_1' required itemname='예약인원' value='<?=$res_cnt?>'></td>
  </tr>
  <tr>
      <td class="consjbox">요금내역</td>
      <td colspan="3" align="left" style="text-align:left;"><?php $ad_price = 0;
$sum = 0;
$total_p = 0;
if($sl_day) {
	$wr_reserv_print = "<table border=0 cellpadding=0 cellspacing=0>";
} else {
	$wr_reserv_print = "";
}

for($i=0;$i<$sl_day;$i++) {
	$time=$s_time+(86400*$i);
	$times[$i]=date("Y-m-d",$time);
	
	//$wr_reserv_print = $wr_reserv_print . "<dt>".$times[$i]." 일은 <span style='color:green;'>".Get_Date_Type($time)." ".Get_Date_Week($time)."</span>이며 숙박료는 <span style='color:blue;'>".number_format(Get_Date_Cost($time,$sca))."원</span> 입니다. </dt>";
	$wr_reserv_print .= "<tr align=right>
		<td style='padding:1px 5px;'>".$times[$i]."</td>
		<td style='color:green; padding:1px 10px;' align=left>".Get_Date_Type($time)." ".Get_Date_Week($time)."</td>
		<td style='color:blue; padding:1px 5px;'>".number_format(Get_Date_Cost($time,$sca))."원</td></tr>";
	$sum += Get_Date_Cost($time,$sca);
}

if($sl_day)
	$wr_reserv_print .= "</table>";
else
	$wr_reserv_print = "";

$ad_price = Get_Room_Info_One($bo_table, $sca, 'person_add') * $wr_7 * $sl_day;

$wr_reserv_print = $wr_reserv_print . "<br><dt>추가요금 -> 추가인원:".$wr_7."명 X 요금:".number_format(Get_Room_Info_One($bo_table, $sca, 'person_add'))."원 X 숙박일수:".$sl_day."박 = ".number_format($ad_price)."원 추가</dt>";

$total_p = $sum + $ad_price;

$wr_reserv_print = $wr_reserv_print . "<br><dt>숙박료 : ".number_format($sum)."원 + ".number_format($ad_price)."원 = <span style='color:#F00;'>".number_format($total_p)."원";

if($wr_9 > 1) {
	$total_p = $total_p * $wr_9;
	$wr_reserv_print = $wr_reserv_print . " X " . $wr_9 . "(객실수) = ".number_format($total_p)."원";
}
$wr_reserv_print = $wr_reserv_print . "</span></dt><br>";

$wr_reserv_print = $wr_reserv_print . Get_Option_list($bo_table, "chk_list",$_POST[chk_wr_op]);

$total_p = $total_p + Get_Option_list($bo_table, "total_cost",$_POST[chk_wr_op]);
$wr_reserv_print = $wr_reserv_print . "<br><dt><strong>전체 요금 합계 : <span style='color:#F00;'>" . number_format($total_p) . "원</span></strong></dt>";

echo $wr_reserv_print;
?>
          <textarea name='wr_reserv' style="visibility:hidden; height:0; line-height:0;"><?=$wr_reserv_print?></textarea>
          <input type=hidden name='wr_10' required itemname='토탈요금' value='<?=$total_p?>'></td>
  </tr>
  <?php if($is_admin || $name) {?>
  <input type=hidden name='wr_name' value='<?=$name?>'>
  <tr>
      <td class="consjbox">예약자성명</td>
      <td colspan="3" align="left" bgcolor="#FBF8F6"><input type=text name='wr_name2' size=30 maxlength=20 required itemname='이름' value='<?=$name?>'> <span style="color:red;">* 예약자명은 입금자명과 동일해야 합니다.</span></td>
  </tr>
  <?php } else { ?>
  <tr>
      <td class="consjbox">예약자성명</td>
      <td colspan="3" align="left" bgcolor="#FBF8F6"><input type=text name='wr_name' size=30 maxlength=20 required itemname='이름' value='<?=$name?>'> <span style="color:red;">* 예약자명은 입금자명과 동일해야 합니다.</span></td>
  </tr>
  <?php } ?>
  <?php if ($is_email) { ?>
  <tr>
    <td class="consjbox">E-Mail 주소</td>
    <td colspan="3" align="left"><input type=text name='wr_email' size=30 maxlength=100 email itemname='E-MAIL' value='<?=$email?>' onclick='wrestEmail(fld)'></td>
  </tr>
  <?php } ?>
  <tr>
    <td class="consjbox">비밀번호</td>
    <td colspan="3" align="left" bgcolor="#FBF8F6"><input type=text id=wr_6 name='wr_6' size=20 maxlength=10 minlength=4 required itemname='비밀번호' value='<?=$write[wr_6]?>'>
        ※ 예약확인시에 이용됩니다. (숫자만 4~10자리이내)</td>
  </tr>
  <tr>
    <td class="consjbox">휴대전화</td>
    <td colspan="3" align="left"><input name='tel1' value='<?=$tel1?>' type='text' size='5' maxlength='3' onkeydown='onlyNumber(this);'  itemname='전화번호 첫번째자리' required> - 
      <input name='tel2' value='<?=$tel2?>' type='text' size='7' maxlength='4' onkeydown='onlyNumber(this);'  itemname='전화번호 두번째자리' required> - 
      <input name='tel3' value='<?=$tel3?>' type='text' size='7' maxlength='4' onkeydown='onlyNumber(this);'  itemname='전화번호 세번째자리' required></td>
  </tr>
  <tr>
    <td class="consjbox">추가사항</td>
    <td colspan="3" align="left" bgcolor="#FBF8F6"><textarea name='wr_content' required style='word-break:break-all;'  cols=70 rows=10 itemname='내용'><?=$content?>
</textarea></td>
  </tr>
  <?php if ($is_guest) { ?>
  <tr>
    <td class="consjbox"><img id='kcaptcha_image' border='0' width=120 height=60 onclick="imageClick();" title="글자가 잘안보이는 경우 클릭하시면 새로운 글자가 나옵니다." style="cursor:pointer;" ></td>
    <td colspan="3" align="left"><input class='ed' type=input size=10 name=wr_key itemname="자동등록방지" required>
    왼쪽의 글자를 입력하여 주세요.</td>
  </tr>
            <script type="text/javascript"> var md5_norobot_key = ''; </script>
            <script type="text/javascript" src="<?="$g4[path]/js/prototype.js"?>"></script>
            <script type="text/javascript">
<!--
function imageClick() {
var url = "<?=$g4[bbs_path]?>/kcaptcha_session.php";
var para = "";
var myAjax = new Ajax.Request(
	url,
	{
		method: 'post',
		asynchronous: true,
		parameters: para,
		onComplete: imageClickResult
	});
}
function imageClickResult(req) {
	var result = req.responseText;
	var img = document.createElement("IMG");
	img.setAttribute("src", "<?=$g4[bbs_path]?>/kcaptcha_image.php?t=" + (new Date).getTime());
	document.getElementById('kcaptcha_image').src = img.getAttribute('src');
	md5_norobot_key = result;
}
Event.observe(window, "load", imageClick);
-->
</script>
<?php } ?>
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

    if (f.w.value == 'i' && typeof(f.wr_name) != 'undefined') {
        f.wr_name.focus();
    } else if (f.w.value == 'u') {
        f.wr_subject.focus();
        if (typeof(f.ca_name) != 'undefined') {
            f.ca_name.value = '<?=$write[ca_name]?>';
        }
    }


    function html_auto_br(obj)
    {
        if (obj.checked) {
            result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
            if (result) {
                obj.value = 2;
            } else {
                obj.value = 1;
            }
        } else {
            obj.value = 1;
        }
    }
    

    // 김선용 2006.3 - 전화번호(휴대폰) 형식 검사 : 123-123(4)-5678
	function wrestTelnumber(fld){

		if (!wrestTrim(fld)) return;

		var pattern = /^[0-9]{2,3}-[0-9]{3,4}-[0-9]{4}$/;
		if(!pattern.test(fld.value)){ 
            if(wrestFld == null){
				wrestMsg = wrestItemname(fld)+" : 전화번호 형식이 올바르지 않습니다.\n\n하이픈(-)을 포함하여 입력해 주십시오.\n";
                wrestFld = fld;
				fld.select();
            }
		}
	}

    // 이메일주소 형식 검사
    function wrestEmail(fld) 
    {
        if (!wrestTrim(fld)) return;

        //var pattern = /(\S+)@(\S+)\.(\S+)/; 이메일주소에 한글 사용시
        var pattern = /([0-9a-zA-Z_-]+)@([0-9a-zA-Z_-]+)\.([0-9a-zA-Z_-]+)/;
        if (!pattern.test(fld.value)) 
        {
            if (wrestFld == null) 
            {
                wrestMsg = wrestItemname(fld) + " : 이메일주소 형식이 아닙니다.\n";
                wrestFld = fld;
            }
        }
    }

    f.action = "./write_update.php";
    f.submit();
}
</script></td>
    </tr>
    <tr>
        <td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) left bottom;"></td>
        <td bgcolor="#ffffff">&nbsp;</td>
        <td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) right bottom;"></td>
    </tr>
</table>
