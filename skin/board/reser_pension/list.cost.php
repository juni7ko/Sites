<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 7;
if ($is_checkbox) $colspan++;
// 제목이 두줄로 표시되는 경우 이 코드를 사용해 보세요.
// <nobr style='display:block; overflow:hidden; width:000px;'>제목</nobr>
?>
입금현황
<link rel="stylesheet" href="<?=$board_skin_path?>/jQuery/jquery-ui-1.7.1.css" type="text/css">
<link rel="stylesheet" href="<?=$board_skin_path?>/mstyle.css" type="text/css">
<script type="text/javascript" src="<?=$board_skin_path?>/jQuery/jquery.js"></script>
<script type="text/javascript" src="<?=$board_skin_path?>/jQuery/jquery-ui-1.7.1.js"></script>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) left top;"></td>
		<td bgcolor="#ffffff">&nbsp;</td>
		<td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) right top;"></td>
	</tr>
	<tr>
		<td colspan="3" valign="top" style="background:#FFF; padding:10px;"><!-- 게시판 목록 시작 -->
			<table width="100%" align=center cellpadding=0 cellspacing=0>
				<tr>
					<td valign=top><!-- 분류 셀렉트 박스, 게시물 몇건, 관리자화면 링크 -->
						<?php if ($admin_href) include_once("{$board_skin_path}/inc_top_menu.php");?>
						<!-- 제목 -->
						<form name="fboardlist" method="post" style="margin:0px;">
							<input type="hidden" name="bo_table" value="<?=$bo_table?>" />
							<input type="hidden" name="sfl"  value="<?=$sfl?>" />
							<input type="hidden" name="stx"  value="<?=$stx?>" />
							<input type="hidden" name="spt"  value="<?=$spt?>" />
							<input type="hidden" name="page" value="<?=$page?>" />
							<input type="hidden" name="sw"   value="" />
							<input type="hidden" name="pension_id" value="<?=$pension_id?>" />
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class=<?=$css[table]?>>
								<tr class="<?=$css[tr]?>">
									<?php if ($is_checkbox) echo "<td><INPUT onclick='if (this.checked) all_checked(true); else all_checked(false);' type=checkbox></td>"; ?>
									<td width="100">예약번호</td>
									<td>객실명</td>
									<td>예약일</td>
									<td width="100">연락처</td>
									<td width="90">예약자명</td>
									<td width="70">예약상태</td>
									<td width="80">작성일자</td>
								</tr>
								<?php for ($i=0; $i<count($list); $i++) { ?>
								<?php if($i) echo "<tr><td colspan='{$colspan}' height='1' bgcolor='#E7E7E7'></td></tr>"; ?>
								<tr class="ht center">
									<?php if ($is_checkbox) echo "<td><input type=checkbox name=chk_wr_id[] value='{$list[$i][wr_id]}'></td>"; ?>
									<td>
										<?php
											$wr3Cnt = sql_fetch("SELECT count(*) as cnt FROM g4_write_bbs34 WHERE wr_3 = '{$list[$i][wr_3]}' ");
											if( ($wr3Cnt[cnt] > 1) and ($stx != $list[$i][wr_3]) ) {
												echo "<a href='./resList.php?bo_table=$bo_table&stx={$list[$i][wr_3]}&sfl=wr_3&view_mode=list&pension_id={$pension_id}'>";
											}

											if ($wr_id == $list[$i][wr_id]) {// 현재위치
												echo "<span style='color:#2c8cb9; font-weight:bold;'>{$list[$i][wr_3]}</span>";
											} else {
												echo "<span class=m_num>{$list[$i][wr_3]}</span>";
											}

											if( ($wr3Cnt[cnt] > 1) and ($stx != $list[$i][wr_3]) ) {
												echo "<span class=m_num>({$wr3Cnt[cnt]})</span>";
												echo "</a>";
											}
										?>
									</td>
									<td>
										<!--<a href="<?=$list[$i][ca_name_href]?>&view_mode=list&pension_id=<?=$pension_id?>">-->
										<span class=small style='color:blue;'><?=$list[$i][ca_name]?></span>
										<!--</a>-->
									</td>
									<td style="word-break:break-all;">
										<a href="<?=$list[$i][href]?>" class="m_sub">
										<?=date("Y-m-d", $list[$i][wr_link2])?>
										<?=($wr3Cnt[cnt] > 1) ? " [{$wr3Cnt[cnt]}건]":""; ?>
										</a>
									</td>
									<td class="m2_name" align="center"><?=$list[$i][wr_2]?></td>
									<td class="m2_name" align="center"><?=$list[$i][wr_name]?></td>
									<td class="m2_name" align="center" style="color:#FF0000;"><?=get_rResult($list[$i][rResult])?></td>
									<td align=center class="m2"><?=$list[$i][datetime]?></td>
								</tr>
								<?php }?>
								<?php if (count($list) == 0) { echo "<tr><td colspan='$colspan' height=100 class='center'>게시물이 없습니다.</td></tr>"; } ?>
							</table>
						</form>
						<!-- 페이지 -->
						<?php if (count($list)) { ?>
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td width="100%" height="30" align="center" valign=bottom><?php if ($prev_part_href) { echo "<a href='{$prev_part_href}&view_mode=list&pension_id={$pension_id}'><img src='$board_skin_path/img/btn_search_prev.gif' border=0 align=absmiddle title='이전검색'></a>"; } ?>
									<?php
// 기본으로 넘어오는 페이지를 아래와 같이 변환하여 이미지로도 출력할 수 있습니다.
//echo $write_pages;
$write_pages2 = str_replace($bo_table, $bo_table."&view_mode=list", $write_pages);
$write_pages2 = str_replace("처음", "<img src='$board_skin_path/img/y_prev.gif' border='0' align='absmiddle' title='처음'>", $write_pages2);
$write_pages2 = str_replace("이전", "<img src='$board_skin_path/img/m_prev.gif' border='0' align='absmiddle' title='이전'>", $write_pages2);
$write_pages2 = str_replace("다음", "<img src='$board_skin_path/img/m_next.gif' border='0' align='absmiddle' title='다음'>", $write_pages2);
$write_pages2 = str_replace("맨끝", "<img src='$board_skin_path/img/y_next.gif' border='0' align='absmiddle' title='맨끝'>", $write_pages2);
$write_pages2 = preg_replace("/<span>([0-9]*)<\/span>/", "<b><font style=\"font-family:돋움; font-size:9pt; color:#797979\">$1</font></b>", $write_pages2);
$write_pages2 = preg_replace("/<b>([0-9]*)<\/b>/", "<b><font style=\"font-family:돋움; font-size:9pt; color:orange;\">$1</font></b>", $write_pages2);
//$write_pages2 = str_replace($bo_table, $bo_table."&view_mode=list", $write_pages2);
?>
									<?=$write_pages2?>
									<?php if ($next_part_href) { echo "<a href='$next_part_href&view_mode=list&pension_id={$pension_id}'><img src='$board_skin_path/img/btn_search_next.gif' border=0 align=absmiddle title='다음검색'></a>"; } ?></td>
							</tr>
						</table>
						<?php } ?>
						<!-- 버튼 링크 -->
						<form name=fsearch method=get style="margin:0px; padding:0px;">
							<input type=hidden name=view_mode value="list" />
							<input type=hidden name=bo_table value="<?=$bo_table?>" />
							<input type=hidden name=sca      value="<?=$sca?>" />
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td width="50%"><?php if ($list_href) { ?>
										<a href="<?=$list_href?>&view_mode=list"><img src="<?=$board_skin_path?>/img/btn_list.gif" border="0"></a>
										<?php } ?>
										<?php if ($is_checkbox) { ?>
										<a href="javascript:select_delete();"><img src='<?=$board_skin_path?>/img/btn_select_delete.gif' border=0></a>
										<!--
										<a href="javascript:select_copy('copy');"><img src='<?=$board_skin_path?>/img/btn_select_copy.gif' border="0"></a>
										<a href="javascript:select_copy('move');"><img src='<?=$board_skin_path?>/img/btn_select_move.gif' border='0'></a>
										-->
										<?php } ?></td>
									<td width="50%" align="right"><select name=sfl>
											<option value='wr_name'>이름</option>
											<option value='mb_id'>회원아이디</option>
											<option value='ca_name'>객실명</option>
											<option value='wr_2'>연락처</option>
											<option value='wr_3'>예약번호</option>
											<option value='wr_link1'>입실일</option>
											<option value='rResult'>예약상태</option>
											<option value='wr_10'>숙박요금</option>
										</select>
										<input name=stx maxlength=20 size=20 itemname="검색어" required value="<?=$stx?>">
										<input name=sop type=hidden value=and />
										<input type=image src="<?=$board_skin_path?>/img/search_btn.gif" border=0 align=absmiddle></td>
								</tr>
							</table>
						</form></td>
				</tr>
			</table>
			<script language="JavaScript">
if ("<?=$sca?>") document.fsearch.sca.value = "<?=$sca?>";
if ("<?=$stx?>") {
	document.fsearch.sfl.value = "<?=$sfl?>";
	document.fsearch.sop.value = "<?=$sop?>";
}
</script>
			<?php if ($is_checkbox) { ?>
			<script language="JavaScript">
function all_checked(sw) {
	var f = document.fboardlist;

	for (var i=0; i<f.length; i++) {
		if (f.elements[i].name == "chk_wr_id[]")
			f.elements[i].checked = sw;
	}
}

function check_confirm(str) {
	var f = document.fboardlist;
	var chk_count = 0;

	for (var i=0; i<f.length; i++) {
		if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
			chk_count++;
	}

	if (!chk_count) {
		alert(str + "할 게시물을 하나 이상 선택하세요.");
		return false;
	}
	return true;
}

// 선택한 게시물 삭제
function select_delete() {
	var f = document.fboardlist;

	str = "삭제";
	if (!check_confirm(str))
		return;

	if (!confirm("선택한 게시물을 정말 "+str+" 하시겠습니까?\n\n한번 "+str+"한 자료는 복구할 수 없습니다"))
		return;

	f.action = "./delete_reserv.php";
	f.submit();
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
	var f = document.fboardlist;

	if (sw == "copy")
		str = "복사";
	else
		str = "이동";

	if (!check_confirm(str))
		return;

	var sub_win = window.open("", "move", "left=50, top=50, width=396, height=550, scrollbars=1");

	f.sw.value = sw;
	f.target = "move";
	f.action = "./move.php";
	f.submit();
}
</script>
			<?php } ?>
			<!-- 게시판 목록 끝 --></td>
	</tr>
	<tr>
		<td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) left bottom;"></td>
		<td bgcolor="#ffffff">&nbsp;</td>
		<td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) right bottom;"></td>
	</tr>
</table>
