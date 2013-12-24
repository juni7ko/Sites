<?php
include_once "./_common.php";
if($_GET['from'] == 'pc'){
    set_session("frommoblie", "");
}
$bo_table = "bbs34";
$board_skin_path = "../skin/board/reser_n2/";
include_once './_head.php';
?>

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi" > 


	<div class="booking-navi">
		<ul>
			<?php $on2 = "class=\"on\"";
				include_once "booking_menu.php";
			?>
		</ul>
	</div>


<form name='resform1' method='post' action="./res_check.php" enctype='multipart/form-data' style='margin:0px;'>
  <input type=hidden name=null>
  <input type=hidden name=type value='code' />
  <input type=hidden name=bo_table value='<?=$bo_table?>'>


	<table width="100%" cellpadding="0" cellspacing="0" class="booting-tbl">
	<caption>예약확인</caption>
	<thead>
	<tr>
		<th colspan="3">예약코드로확인</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td  width="160">예약코드</td>
		<td class="left"><input type="text" name='wr_3' size=25 maxlength=50 required itemname='예약코드' value='' class="inputbox"></td>
		<td rowspan=2  width="80"><input type='image' src='<?=$board_skin_path?>/img_n/ok.gif' accesskey='s'></td>
	</tr>
	<tr>
		<td>비밀번호</td>
		<td class="left"><input type="password" name='wr_6' size=25 maxlength=20 required itemname='비밀번호' value='' class="inputbox">
		</td>
	</tr>
	</tbody>
	</table>
</form>



<form name='resform2' method='post'  action="./res_check.php" enctype='multipart/form-data' style='margin:0px;'>
  <input type=hidden name=null>
  <input type=hidden name=type value='id' />
  <input type=hidden name=bo_table value='<?=$bo_table?>'>

	<table width="100%" cellpadding="0" cellspacing="0" class="booting-tbl">
	<caption>예약확인</caption>
	<thead>
	<tr>
		<th colspan="3">회원아이디로 확인</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td width="160">아이디</td>
		<td class="left"><input type="text" name='wr_3' size=25 maxlength=50 required itemname='아이디' value='' class="inputbox"></td>
		<td rowspan=2 width="80"><input type='image' src='<?=$board_skin_path?>/img_n/ok.gif' accesskey='s' </td>
	</tr>
	<tr>
		<td>비밀번호</td>
		<td class="left"><input type="password" name='wr_6' size=25 maxlength=20 required itemname='비밀번호' value='' class="inputbox"></td>
	</tr>
	</tbody>
	</table>
</form>

	<?php include "mfooter.php";?>



</div><!-- /mobile-wrap -->


</body>
</html>

<script language="JavaScript">
function resform_submit(f)
{
if (f.id.value == "")
		{
			alert('아이디를 입력해 주세요.         ');
			f.wr_3.focus();
			return false;
		}
		if (f.pw.value == "")
		{
			alert('비밀번호를 입력해 주세요.         ');
			f.wr_6.focus();
			return false;
		}
    f.action = "./res_check.php";
    f.submit();
}
</script>
