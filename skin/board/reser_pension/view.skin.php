<?php if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

include_once ("$board_skin_path/config.php");
?>
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
		<td colspan="3" valign="top" style="background:#FFF; padding:10px;">
			<?php include_once("{$board_skin_path}/inc_top_menu.php"); ?>
			<div class="ui-state-highlight ui-corner-all" style="margin: 20px 0 5px; padding: 5px .7em;">
				<span class="ui-icon ui-icon-power" style="float: left; margin-right: .3em;"></span>
				<strong><span style='color:#000;'><?=$view[subject]?> - 작성자 : <?=$view[wr_name]?></strong>
			</div>
			<!-- 원글 내용 -->
			<table width="100%" border="0" cellpadding="3" cellspacing="1" align="center" class="<?=$css[table]?>">
				<tr>
					<td>
<?php
$from_date = str_replace("http://","",$view[link][1]);
$to_date = str_replace("http://","",$view[link][2]);
$from_date = substr($from_date,0,4)."년 ".sprintf("%2d",substr($from_date,4,2))."월 ".sprintf("%2d",substr($from_date,6,2))."일";
$to_date   = substr($to_date,0,4)."년 ".sprintf("%2d",substr($to_date,4,2))."월 ".sprintf("%2d",substr($to_date,6,2))."일";
?>
						<table width="100%" border=0 cellpadding=3 cellspacing=1 class="<?=$css[table]?>">
							<tr class="ht">
								<td class="<?=$css[tr]?>" width="100">처리상태</td>
								<td><?php if($is_admin) { ?>
									<SCRIPT LANGUAGE="javascript">
									function fwrite_check(f)
									{
										document.getElementById('btn_submit').disabled = true;

										if(confirm('정말로 수정 하시겠습니다.?')) {
											f.action = '<?=$board_skin_path?>/res_update.php';
											f.submit();
										}

										document.getElementById('btn_submit').disabled = false;
									}
									</SCRIPT>
									<form name="fwrite" method="post" action="javascript:fwrite_check(document.fwrite);" enctype="multipart/form-data" style="margin:0px; padding:0px;">
										<input type=hidden name=null />
										<input type=hidden name=bo_table value="<?=$bo_table?>" />
										<input type=hidden name=wr_id value="<?=$wr_id?>" />
										<input type=hidden name=wr_3 value='<?=$view[wr_3]?>' />
										<input type=hidden name=wr_link1 value='<?=$view[wr_link1]?>' />
										<select name=rResult itemname="처리진행상황">
											<option value="0010"<?=($view[rResult] == "0010" ? " selected":"")?>>예약대기</option>
											<option value="0020"<?=($view[rResult] == "0020" ? " selected":"")?>>예약완료</option>
											<option value="0030"<?=($view[rResult] == "0030" ? " selected":"")?>>예약취소</option>
											<option value="0040"<?=($view[rResult] == "0040" ? " selected":"")?>>관리자예약</option>
										</select>
										<input type=image id="btn_submit" src="<?=$board_skin_path?>/img/btn_wr_9.gif" border=0 accesskey='s' align="absmiddle" />
									</form>
									<?php } else { ?>
									<font color=red>
									<?=$view[rResult]?>
									</font>
									<?php } ?>
								</td>
							</tr>
							<tr>
								<td class="<?=$css[tr]?>">예약내용</td>
								<td>
									<table width="100%" border=0 cellpadding=3 cellspacing=1>
										<thead>
											<tr>
												<th class="first">객실명</th>
												<th>기준/최대</th>
												<th>이용일</th>
												<th>성인</th>
												<th>아동</th>
												<th>유아</th>
												<th>요금타입</th>
												<th>이용요금</th>
												<th class="last">결제액</th>
											</tr>
										</thead>
										<tbody>

<?php
	$query = " SELECT * from $write_table WHERE wr_3 = '$view[wr_3]' AND wr_name = '$view[wr_name]' ORDER BY wr_link1 ASC ";
	$resultList = sql_query($query);

	for ($i=0; $rList = sql_fetch_array($resultList); $i++)
	{
		$rList2[$i] = getRoomName($rList['r_info_id']);
		$rList2['wr_name'] = $rList['wr_name'];
		$rList2['wr_10'] = $rList['wr_10'];
		$rList2['wr_2'] = $rList['wr_2'];
		$rList2['wr_8'] = $rList['wr_8']
	?>
											<tr>
												<td class="first"><?=$rList2[$i][r_info_name]?></td>
												<td><?=$rList2[$i][r_info_person1]?>명/<?=$rList2[$i][r_info_person2]?>명</td>
												<td><span class="highlight-pink"><?=date("Y-m-d", $rList['wr_link2']);?>(<?=GetDateWeek(date("w", $rList['wr_link2']))?>)</span></td>
												<td>
													<?=$rList['person1']?> 명
												</td>
												<td>
													<?=$rList['person2']?> 명
												</td>
												<td>
													<?=$rList['person3']?> 명
												</td>
												<td><?=$rList['costType']?></td>
												<td>
													<div>기본가 <?=number_format($rList['cost1'])?>원</div>
													<?php if($rList['cost2']) { ?><div><span class="highlight-blue">기본 객실할인</span> - <?=number_format($rList['cost2'])?>원</div><?php } ?>
													<?php if($rList['overCount']) { ?><div><span class="highlight-blue">추가인원 <?=$rList['overCount']?> +</span> <?=number_format($rList['overCost'])?>원</div><?php } ?>
												</td>
												<td class="last"><?=number_format($rList['cost3'] + $rList['overCost'])?>원</td>
											</tr>
<?php
	}
?>
										</tbody>
									</table>
								</td>
							</tr>
							<tr class="ht list1">
								<td class="<?=$css[tr]?>">예약번호</td>
								<td><?=$view[wr_3]?></td>
							</tr>
							<tr class="ht list1">
								<td class="<?=$css[tr]?>">예약자명</td>
								<td><?=$view[wr_name]?></td>
							</tr>
							<tr class="ht list1">
								<td class="<?=$css[tr]?>">결제자명</td>
								<td><?=$view[wr_8]?></td>
							</tr>
							<tr class="ht">
								<td class="<?=$css[tr]?>">결제금액</td>
								<td><span class="highlight-blue"><?=number_format($view[wr_10]);?></span> 원</td>
							</tr>
							<tr class="ht list1">
								<td class="<?=$css[tr]?>">결제방법</td>
								<td><?=get_payMent($view[wr_7])?></td>
							</tr>
							<tr class="ht list1">
								<td class="<?=$css[tr]?>">출발지역</td>
								<td><?=$view[wr_5]?></td>
							</tr>
							<tr class="ht list1">
								<td class="<?=$css[tr]?>">E-mail주소</td>
								<td><?=$view[wr_email]?></td>
							</tr>
							<tr class="ht">
								<td class="<?=$css[tr]?>">휴대폰 번호</td>
								<td><?=$view[wr_2]?></td>
							</tr>
							<tr class="ht list1">
								<td class="<?=$css[tr]?>">추 가 사 항</td>
								<td><span class=content>
									<?=$view[content];?>
									</span></td>
							</tr>
						</TABLE>


						<?php include_once ("./view_comment.php");
?>
						<!-- 링크 -->
						<table width=100% align=center border=0 cellpadding=3 cellspacing=0>
							<tr>
								<td height=25><?php if ($search_href) { echo "<a href=\"{$search_href}&view_mode=list\"><img src='$board_skin_path/img/searchlist.gif' border=0 alt='검색목록'></a>"; } ?>
<?php if($is_admin) {
	echo "<a href=\"{$list_href}&view_mode=list\"><img src='$board_skin_path/img/list.gif' border=0 alt='목록'></a>";
} else {
	echo "<a href=\"{$list_href}\">완료</a>";
}

if ($write_href) { /*echo "<a href=\"$write_href&sca=$view[ca_name]\"><img src='$board_skin_path/img/write.gif' border=0 alt='글쓰기'></a>";*/ }

if ($reply_href && $admin_href) { /*echo "<a href=\"$reply_href&sca=$view[ca_name]\"><img src='$board_skin_path/img/reply.gif' border=0 alt='답변'></a>";*/ }

if ($update_href && $admin_href) { echo "<a href=\"res_modify.php?bo_table={$bo_table}&wr_id={$wr_id}&sca=$view[ca_name]\"><img src='$board_skin_path/img/edit.gif' border=0 alt='수정'></a>"; }
//if ($update_href && $admin_href) { echo "<a href=\"$update_href&sca=$view[ca_name]\"><img src='$board_skin_path/img/edit.gif' border=0 alt='수정'></a>"; }
if ($delete2_href && $admin_href) { echo "<a href=\"$delete2_href\"><img src='$board_skin_path/img/delete.gif' border=0 alt='삭제'></a>"; }
?></td>
							</tr>
						</table></TD>
				</TR>
			</TABLE></td>
	</tr>
	<tr>
		<td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) left bottom;"></td>
		<td bgcolor="#ffffff">&nbsp;</td>
		<td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) right bottom;"></td>
	</tr>
</table>
