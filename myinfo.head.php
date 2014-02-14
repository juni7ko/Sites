<?php
$nowdate = date("Y-m-d"); //오늘날짜
$sql_search = ""; //전체

$sql = "SELECT sum(po_point) as sum_point
			from $g4[point_table]
			where mb_id = '$member[mb_id]'
			AND po_datetime > '$nowdate'
			$sql_search
			group by mb_id ";
$row = sql_fetch($sql);
$sum_point = number_format(intval($row[sum_point]));
?>

<style type="text/css">
	.STYLE3 {color: #FFFFFF; font-weight: bold; }
	.STYLE4 {	color: #0066FF;
		font-weight: bold;
		font-size: 18px;
	}
	.STYLE6 {color: #0066FF}
	.STYLE8 {color: #0066FF; font-size: 11px; }
	.STYLE9 {
		color: #7c88a2;
		font-weight: bold;
		font-size: 16px;
	}
	.STYLE11 {color: #0066FF; font-weight: bold; }
	.STYLE12 {font-size: 16px}
</style>
<table width="988" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="3"><img src="<?=$g4['path']?>/images/mypage.jpg"/></td>
	</tr>
	<tr>
		<td height="10" colspan="3"></td>
	</tr>
	<tr>
		<td width="150" align="center" valign="top"><table width="100" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td><A href="<?=$g4['bbs_path']?>/myinfo.php?gr_id=&view=&mb_id=<?=$member[mb_id]?>"><IMG onmouseover="this.src='<?=$g4['path']?>/images/my_menu2_01.jpg'" onmouseout="this.src='<?=$g4['path']?>/images/my_menu1_01.jpg'" border=0 src="<?=$g4['path']?>/images/my_menu1_01.jpg"></A></td>
			</tr>
			<tr>
				<td><A href="<?=$g4['bbs_path']?>/point.php"><IMG onmouseover="this.src='<?=$g4['path']?>/images/my_menu2_02.jpg'" onmouseout="this.src='<?=$g4['path']?>/images/my_menu1_02.jpg'" border=0 src="<?=$g4['path']?>/images/my_menu1_02.jpg"></A></td>
			</tr>
			<tr>
				<td><A href="<?=$g4['bbs_path']?>/member_confirm.php?url=register_form.php"><IMG onmouseover="this.src='<?=$g4['path']?>/images/my_menu2_03.jpg'" onmouseout="this.src='<?=$g4['path']?>/images/my_menu1_03.jpg'" border=0 src="<?=$g4['path']?>/images/my_menu1_03.jpg"></A></td>
			</tr>
			<tr>
				<td><A href="<?=$g4['bbs_path']?>/member_confirm.php?url=register_form.php"><IMG onmouseover="this.src='<?=$g4['path']?>/images/my_menu2_04.jpg'" onmouseout="this.src='<?=$g4['path']?>/images/my_menu1_04.jpg'" border=0 src="<?=$g4['path']?>/images/my_menu1_04.jpg"></A></td>
			</tr>
		</table></td>
		<td width="10"></td>
		<td width="828" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td align="center" valign="top"><table width="828" border="0" cellpadding="0" cellspacing="0" background="<?=$g4['path']?>/images/my_bg.jpg">
					<tr>
						<td width="232" height="118" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td height="30" style='padding:0 0px 0 10px;'><span class="STYLE3">MY개인등급</span></td>
							</tr>
							<tr>
								<td width="232" height="88" style='padding:0 0px 0 50px;'>아이디&nbsp;:&nbsp;<span class="STYLE6">
									<?=$member[mb_id]?>
								</span><br/>
								닉네임&nbsp;:&nbsp;<span class="STYLE6">
								<?=$member[mb_nick]?>
							</span><br/>
							레&nbsp;&nbsp;&nbsp;벨&nbsp;:&nbsp;<span class="STYLE6">[
							<?=$member[mb_level]?>
							등급]</span></td>
						</tr>
					</table></td>
					<td width="183"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td height="30" style='padding:0 0px 0 10px;'><span class="STYLE3">가입및 접속정보 </span></td>
						</tr>
						<tr>
							<td width="183" height="88" style='padding:0 0px 0 10px;'>회원가입:&nbsp;<span class="STYLE8">
								<?=$member[mb_datetime]?>
							</span><br/>
							최종접속:&nbsp;<span class="STYLE8">
							<?=$member[mb_today_login]?>
						</span></td>
					</tr>
				</table></td>
				<td width="183"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td height="30" style='padding:0 0px 0 10px;'><span class="STYLE3">TODAY 포인트 </span></td>
					</tr>
					<tr>
						<td width="183" height="88" align="center" style='padding:0 0px 0 0px;'><span class="STYLE9"><?=$nowdate?></span><span class="STYLE12"><br/>총<span class="STYLE11"><?=$sum_point?></span>포인트&nbsp;</span></td>
					</tr>
				</table></td>
				<td width="233"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td height="30" style='padding:0 0px 0 10px;'><span class="STYLE3">MY 포인트&amp;레벨 </span></td>
					</tr>
					<tr>
						<td width="233" height="88" align="center" style='padding:0 0px 0 0px;'>포인트&nbsp;:&nbsp;<span class="STYLE4">
							<?=$member[mb_point]?>
						</span></td>
					</tr>
				</table></td>
			</tr>
		</table></td>
	</tr>
	<tr>
		<td height="10" align="center" valign="top"></td>
	</tr>
	<tr>
		<td align="center" valign="top">