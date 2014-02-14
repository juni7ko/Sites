<?php
include_once("./_common.php");

if (!$member[mb_id])
	alert_close("회원만 조회하실 수 있습니다.");

$g4[title] = $member[mb_nick] . "님의 포인트 내역";
include_once("$g4[path]/_head.php");


$list = array();

$sql_common = " from $g4[point_table] where mb_id = '".mysql_escape_string($member[mb_id])."' ";
$sql_order = " order by po_id desc ";

$sql = " select count(*) as cnt $sql_common ";
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = $config[cf_page_rows];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if (!$page) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함
include_once("$g4[path]/myinfo.head.php");
?>
<style type="text/css">
	.STYLE3 {color: #FFFFFF; font-weight: bold; }
</style>

<table width="828" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td bgcolor="#6a7690"><table width="100%" border="0" cellspacing="1" cellpadding="0">
			<tr>
				<td height="30" bgcolor="#7C88A2" class="STYLE3" style='padding:0 0px 0 10px;'>MY 포인트 내역 </td>
			</tr>
		</table></td>
	</tr>
	<tr>
		<td height="200" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td bgcolor="#cbccce"><table width="100%" border="0" cellspacing="1" cellpadding="0">
					<tr>
						<td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td height="1" bgcolor="#6a7690"></td>
							</tr>
							<tr>
								<td width="828" bgcolor="#FFFFFF"><table width="100%" cellpadding="0" cellspacing="0" border="0">
									<tr align="center">
										<td width="1" bgcolor="#6a7690"></td>
										<td width="100" bgcolor="#eeeeee"><strong>회원아이디</strong></td>
										<td width="100" bgcolor="#eeeeee"><strong>별명</strong></td>
										<td width="130" height="30" bgcolor="#eeeeee"><b>일시</b></td>
										<td width="" bgcolor="#eeeeee"><b>포인트 내용</b></td>
										<td width="70" bgcolor="#eeeeee"><b>지급</b></td>
										<td width="70" bgcolor="#eeeeee"><b>사용</b></td>
										<td width="50" bgcolor="#eeeeee"><strong>합계</strong></td>
										<td width="1" bgcolor="#6a7690"></td>
									</tr>
									<tr align="center">
										<td height="1" colspan="9" bgcolor="#6a7690"></td>
									</tr>
									<?php
									$sum_point1 = $sum_point2 = 0;

									$sql = " select *
									$sql_common
									$sql_order
									limit $from_record, $rows ";
									$result = sql_query($sql);
									for ($i=0; $row=sql_fetch_array($result); $i++) {
										$point1 = $point2 = 0;
										if ($row[po_point] > 0) {
											$point1 = "+" . number_format($row[po_point]);
											$sum_point1 += $row[po_point];
										} else {
											$point2 = number_format($row[po_point]);
											$sum_point2 += $row[po_point];
										}

										echo <<<HEREDOC
										<tr height=30 align="center">
											<td width="1"></td>
											<td height="24">$member[mb_id]</td>
											<td height="24">$member[mb_nick]</td>
											<td height="24" align="center">$row[po_datetime]</td>
											<td align="left" title='$row[po_content]'><nobr style='display:block; overflow:hidden; width:250px;'>{$row[view]}&nbsp;$row[po_content]</td>
											<td align=center>{$point1}&nbsp;</td>
											<td align=center>{$point2}&nbsp;</td>
											<td align=center>$member[mb_point]</td>
											<td width="1"></td>
										</tr>
HEREDOC;
									}

									if ($i == 0)
										echo "<tr><td colspan=5 align=center height=100>자료가 없습니다.</td></tr>";
									?>
								</table></td>
							</tr>
						</table></td>
					</tr>
				</table></td>
			</tr>
		</table></td>
	</tr>
	<tr>
		<td height="30" align="center"><?=get_paging($config[cf_write_pages], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page=");?></td>
	</tr>
</table>
<br>
<?php
include_once("$g4[path]/myinfo.tail.php");
include_once("$g4[path]/_tail.php");
?>