<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">
<head>
<title>예약하기</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi" > 
<meta http-equiv="content-type" content="text/html; charset=utf-8">
</head>
<?php $bo_table='bbs34';
$write_table = 'g4_write_bbs34';
$g4_path = ".."; // common.php 의 상대 경로
include_once("$g4_path/common.php");
include_once ("$board_skin_path/config.php");
//	print_r($_POST);

$chkno = 0;
for($i=0; $i < count($r_name); $i++){
	if($date[$i]){ 
		$roomno = $i;   // 방번호 체크
		$chkno +=1;
	}
}
if(!$chkno) alert('숙박기간을 선택해 주세요');   // 숙박일을 선택하지않으면 back
if($chkno >= 2) alert('룸을 하나만 선택해 주세요');   // 숙박일을 선택하지않으면 back
$i = $roomno;    // 선택된방 no.
?>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<body>

<div id="mobile-wrap">

	<h1 class="logo">쇼앤뉴그린</h1>

	<nav id="gnb">
		<ul>
			<?php include_once "mtopmenu.php";?>
		</ul>
	</nav>

	<div class="clear-bottom"></div>


	<div class="booking-navi">
		<ul>
			<?php $on1 = "class=\"on\"";
				include_once "booking_menu.php";
			?>
		</ul>
	</div>



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







	<table width="100%" cellpadding="10" cellspacing="0" class="booting-tbl">
	<caption>예약관리</caption>
	<thead>
<?php
// 선택된 방 요금계산  roop



//for($i=0; $i < count($r_name); $i++){      // 무한 루프로 삭제함.

if($date[$i]){


$trueday =$date[$i];  // 숙박기간
$out_date = mktime(0,0,0,$month,$day+$trueday,$year);  // 퇴실일자

$sca = $r_name[$i];
$wr_7 =   $p2[$i] ; // 추가인원
include_once ("$board_skin_path/config.php");
$room_code = Get_Room_Info_One($bo_table, $sca, 'id');
$res_code = $room_code . mktime();

$s_time=mktime( "00", "00", "00",$month,$day,$year);   // 입실
$e_time=mktime( "23", "59", "59",$month,$day+$trueday,$year);   //퇴실

$cnt=$e_time-$s_time;
$sl_day=floor($cnt/86400);

$sl_day2 = $sl_day+1;

$res_cnt = Get_Room_Info_One($bo_table, $sca, 'person1') + $wr_7;








$t_date = date("Y년 m월 d일", $out_date);
$wr_link1 = $f_date;   //입실일자
$wr_link2 = date("Ymd", $out_date);   //퇴실일자
$wr_9 = $p1[$i];
?>

<input type=hidden name='wr_link1' itemname='입실일자' value='<?=$wr_link1?>'>
<input type=hidden name='wr_link2' itemname='퇴실일자' value='<?=$wr_link2?>'>
<input type=hidden name='wr_8' required itemname='숙박일수' value='<?=$sl_day?>'>
<input type=hidden name='wr_7' required itemname='추가인원' value='<?=$wr_7?>'>
<input type=hidden name='wr_1' required itemname='예약인원' value='<?=$res_cnt?>'>
<input type=hidden name='wr_3' itemname='예약코드' value='<?=$res_code?>'>

	<tr>
		<th>예약코드</th>
		<th>선택하신방</th>
		<th>추가인원</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td><?php echo $res_code; ?></td>
		<td><?=Get_Room_Info_One($bo_table, $sca, 'name')?> (기준인원 :  <?=Get_Room_Info_One($bo_table, $sca, 'person1')?>명) X <?=$wr_9?></td>
		<td><?=$p2[$i]?>명</td>
	</tr>

<input type=hidden name='ca_name' value='<?=Get_Room_Info_One($bo_table, $sca, 'name')?>'>
<input type=hidden name='wr_9' value='<?=$wr_9?>' />

	<tr>
		<th>입실일자</th>
		<th>퇴실일자</th>
		<th>숙박기간</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td><?echo "$year";?>년 <?echo "$month";?>월 <?echo "$day";?>일</td>
		<td><?echo "$t_date";?></td>
		<td><?echo "$trueday";?>박 <?echo "$trueday"+1;?>일</td>
	</tr>



	<tr>
		<th colspan="3">요금내역</th>

	</tr>

	<tr>
		<td colspan="3">
		
		
		






<?php $ad_price = 0;
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
          <input type=hidden name='wr_10' required itemname='토탈요금' value='<?=$total_p?>'>















		
		
		</td>
		
	</tr>

	<tr>
		<td colspan="3" height="30">&nbsp;<br>&nbsp;</th>
	</tr>

<?php $roop++;
	}  // if end
//} //  for end


?>



	</tbody>
	</table>


	
	<table width="100%" cellpadding="0" cellspacing="0" class="booting-tbl">
	<caption>예약관리</caption>
	<tbody>

  <?php if($is_admin || $name) {?>
  <input type=hidden name='wr_name' value='<?=$name?>'>

	<tr>
		<td >예약자성명</td>
		<td class="left"><input type="text" name='wr_name2' size=15 maxlength=20 required itemname='이름'  value='<?=$name?>'> ※ 입금자명과 동일해야 함</td>
	</tr>

  <?php } else { ?>

	<tr>
		<td>예약자성명</td>
		<td class="left"><input type="text" name='wr_name' size=15 maxlength=20 required itemname='이름'  value='<?=$name?>'> ※ 입금자명과 동일해야 함</td>
	</tr>
  <?php } ?>


<!-- 
	<tr>
		<td width="150">메일주소</td>
		<td class="left"><input type="text" name='wr_email' size=30 maxlength=100 email itemname='E-MAIL' value='<?=$email?>' onclick='wrestEmail(fld)'></td>
	</tr>
 -->
	<tr>
		<td>비밀번호</td>
		<td class="left"><input type="password" id=wr_6 name='wr_6' size=15 maxlength=10 minlength=4 required itemname='비밀번호' value='<?=$write[wr_6]?>'> ※ 예약확인시에 이용됨 (4~10자리 숫자)</td>
	</tr>
	<tr>
		<td>휴대전화</td>
		<td class="left">
			<input name='tel1'  value='<?=$tel1?>' type='text' size='5' maxlength='3' onkeydown='onlyNumber(this);'  itemname='전화번호 첫번째자리' required> - 
			<input name='tel2'  value='<?=$tel2?>' type='text' size='7' maxlength='4' onkeydown='onlyNumber(this);'  itemname='전화번호 두번째자리' required> - 
			<input name='tel3'  value='<?=$tel3?>' type='text' size='7' maxlength='4' onkeydown='onlyNumber(this);'  itemname='전화번호 세번째자리' required>
		</td>
	</tr>
	<tr>
		<td>추가사항</td>
		<td class="left"><textarea name='wr_content' required style='word-break:break-all;'  cols=30 rows=10 itemname='내용'><?=$content?></textarea></td>
	</tr>
	</tbody>
	</table>


	<div class="btn-area"><a href="javascript:history.back(-1);" class="">취소하기</a><a href="javascript: fgbform_submit(this.form);" class="">다음단계</a></div>


<?php if ($is_secret) { ?>
<input type=hidden value="secret" name="secret" <?=$secret_checked?>>
<?php } ?>
<input type=hidden name='wr_subject' itemname='제목' value='예약내용'>


</form>

	<?php include "mfooter.php";?>



</div><!-- /mobile-wrap -->


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

    f.action = "<?=$g4['path']?>/bbs/write_update_m.php";
    f.submit();
}
</script>



</body>
</html>
