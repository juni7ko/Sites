<?php if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
echo "<script type='text/javascript'> location.replace('/adm/'); </script>";
?>

<!-- 로그인 후 외부로그인 시작 -->
<div style="margin-left:50%; margin-top:100px;">
	<div style="width:500px; border:1px solid #bbb; margin-left:-250px;">
	<table width="500" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="500" colspan="5"><img src="<?=$outlogin_skin_path?>/img/login_ing_top.gif" width="500" height="110"></td>
	</tr>
	<tr height="40"></tr>
	<tr>
		<td width="50" rowspan="4"></td>
		<td width="400" colspan="3"></td>
		<td width="50" rowspan="4"></td>
	</tr>
	<tr>
		<td colspan="3" align="center">
			<table width="400" height="40" border="0" cellpadding="0" cellspacing="0" align="center">
			<tr>
				<td width="30" height="30"><img src="<?=$outlogin_skin_path?>/img/login_ing_icon.gif" width="25" height="27"></td>
				<td width="220" height="30"><span class='member'><strong><?=$nick?></strong></span>님</td>
				<td width="150" height="30"><?php if ($is_admin == "super" || $is_auth) { ?><a href="<?=$g4['admin_path']?>/"><img src="<?=$outlogin_skin_path?>/img/admin.gif" width="150" height="30" border="0" align="absmiddle"></a><?php } ?></td>
			</tr>
		  </table></td>
	</tr>
	<tr height="40"></tr>
	<!-- <tr>
		<td width="25"></td>
		<td width="160" height="25" align="center" bgcolor="#F9F9F9"><a href="javascript:win_point();"><font color="#737373">포인트 : <?=$point?>점</font></a></td>
		<td width="25"></td>
	</tr> --><!-- 포인트 -->
	<tr>
		<td colspan="3">
			<table width="400" height="40" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td>
					<table width="400" border="0" cellpadding="0" cellspacing="0" >
						<tr height="50" >
							<td width="175"><a href="<?=$g4['bbs_path']?>/logout.php"><img src="<?=$outlogin_skin_path?>/img/logout_button.gif" width="150" height="30" border="0"></a></td>
							<td width="175"><a href="<?=$g4['bbs_path']?>/member_confirm.php?url=register_form.php"><img src="<?=$outlogin_skin_path?>/img/login_modify.gif" width="150" height="30" border="0"></a></td>
						</tr>
						<tr height="50">
							<td align="center"><a href="javascript:win_memo();"><FONT color="#ff8871;"><B>쪽지 (<?=$memo_not_read?>)</B></FONT></a></td>
							<td><a href="javascript:win_scrap();"><img src="<?=$outlogin_skin_path?>/img/scrap_button.gif" width="150" height="30" border="0"></a></td>
						</tr>
					</table></td>
			</tr>
			</table></td>
	</tr>
	<tr>
		<td height="20" colspan="5"></td>
	</tr>
	</table>
	</div>
</div>
<script type="text/javascript">
// 탈퇴의 경우 아래 코드를 연동하시면 됩니다.
function member_leave()
{
    if (confirm("정말 회원에서 탈퇴 하시겠습니까?"))
            location.href = "<?=$g4['bbs_path']?>/member_confirm.php?url=member_leave.php";
}
</script>
<!-- 로그인 후 외부로그인 끝 -->
