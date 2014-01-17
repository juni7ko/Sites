<?php
include_once "_common.php";
include_once("$g4[path]/head.sub.php");
include_once("$board_skin_path/config.php");

if(!$bo_table) alert("정상적인 접근이 아닙니다.");

if ($board[bo_include_head]) include ("../../$board[bo_include_head]");
if ($board[bo_image_head]) echo "<img src='$g4[path]/data/file/$bo_table/$board[bo_image_head]' border='0'>";
if ($board[bo_content_head]) echo stripslashes($board[bo_content_head]);
############# 헤드
$this_page = "{$_SERVER['PHP_SELF']}?bo_table={$bo_table}";
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
			<?php
			include_once("{$board_skin_path}/inc_top_menu.php");

			$tit = "기간별요금";
			if($u == "add") {
				$tit .= " - 추가";
			} else if($u == "edit") {
				$tit .= " - 수정";
			} else if($u == "copy") {
				$tit .= " - 복사";
			} else {
				$tit .= "";
			}
			$tit .=  " [".$pension_id."]";

			function show_list() {
				global $g4, $write_table, $css, $pension_id;
## 리스트 시작
				$sql = " SELECT * FROM {$write_table}_r_date where pension_id = '$pension_id' ORDER BY r_date_sdate ASC ";
//	echo $sql;
				$result = sql_query($sql);
				?>
				<table width='100%' border='0' cellpadding='3' cellspacing='1' class='<?=$css[table]?>'>
					<tr class='<?=$css[tr]?>'>
						<td>No</td>
						<td>기간명</td>
						<td>시작일</td>
						<td>종료일</td>
						<td width=180>관리</td>
					</tr>
					<?php
					for ($i=0; $r_date = sql_fetch_array($result); $i++)  {
						$j = $i+1;
						$rlist = $i%2;
						?>
						<tr class="list<?=$rlist?> ht center">
							<td><?=$j?></td>
							<td><?=$r_date[r_date_name]?></td>
							<td><?=date("Y-m-d", $r_date[r_date_sdate])?></td>
							<td><?=date("Y-m-d", $r_date[r_date_edate])?></td>
							<td>
								<input type=button class='<?=$css[btn]?>' value="수정" onClick="Process('edit',<?=$r_date[r_date_idx]?>); return false;">
								<input type=button class='<?=$css[btn]?>' value="삭제" onClick="Process('del',<?=$r_date[r_date_idx]?>); return false;">
								<input type=button class='<?=$css[btn]?>' value="복사" onClick="Process('copy',<?=$r_date[r_date_idx]?>); return false;">
							</td>
						</tr>

						<?php
					}

					if($i == 0) echo "<tr><td colspan='5' align=center height=100 bgcolor=#ffffff>자료가 없습니다.</td></tr>";
					?>
				</table>
				<div style='margin-top:5px; text-align:right;'><input type=button class='<?=$css[btn]?>' value='추가' onClick="Process('add',<?=$pension_id?>); return false;"></div>
				<?php
## 리스트 끝
			}
			?>
		<div class="ui-state-highlight ui-corner-all" style="margin: 20px 0 5px; padding: 5px .7em;">
			<span class="ui-icon ui-icon-power" style="float: left; margin-right: .3em;"></span>
			<strong><?=$tit?></strong>
		</div>
		<form name="process" method="POST" style="margin:0; padding:0;">
			<input type="hidden" name="bo_table" value="<?=$bo_table?>" />
			<input type="hidden" name="u" value="">
			<input type="hidden" name="id" value="">
			<input type="hidden" name="pension_id" value="<?=$pension_id?>">
			<?php
			if($u == "add")
			{
				?>
				<table width='100%' border='0' cellpadding='0' cellspacing='1' class='<?=$css[table]?>'>
					<colgroup width="30%"></colgroup>
					<colgroup width="20%"></colgroup>
					<colgroup width="20%"></colgroup>
					<colgroup width="15%"></colgroup>
					<colgroup width="15%"></colgroup>
					<tr class='<?=$css[tr]?>'>
						<td>기간명</td>
						<td>시작일</td>
						<td>종료일</td>
						<td colspan=2>전체적용</td>
					</tr>
					<tr class="ht center">
						<td><input type='text' name='r_date_name' required size=30></td>
						<td>
							<input class=m_text id=r_date_sdate type=text required numeric itemname=시작일 size=13 name=r_date_sdate value='<?=date("Ymd", mktime())?>' readonly title='옆의 달력 아이콘을 클릭하여 날짜를 입력하세요.'>
							<a href="javascript:win_calendar('r_date_sdate', document.getElementById('r_date_sdate').value, '');"><img src='./img/calendar.gif' border=0 align=absmiddle title='달력 - 날짜를 선택하세요'></a>
						</td>
						<td>
							<input class=m_text id=r_date_edate type=text required numeric itemname=종료일 size=13 name=r_date_edate value='<?=date("Ymd", mktime())?>' readonly title='옆의 달력 아이콘을 클릭하여 날짜를 입력하세요.'>
							<a href="javascript:win_calendar('r_date_edate', document.getElementById('r_date_edate').value, '');"><img src='./img/calendar.gif' border=0 align=absmiddle title='달력 - 날짜를 선택하세요'></a>
						</td>
						<td>가격 <input type="input" name="allCost" id="allCost" size="8" maxlength="7" /></td>
						<td>할인율 <input type="input" name="allRate" id="allRate" size="4" maxlength="3" />%</td>
					</tr>
				</table>
				<table width='100%' border='0' cellpadding='0' cellspacing='1' class='<?=$css[table]?>'>
					<colgroup width="20%"></colgroup>
					<colgroup width="16%"></colgroup>
					<colgroup width="16%"></colgroup>
					<colgroup width="16%"></colgroup>
					<colgroup width="16%"></colgroup>
					<colgroup width="16%"></colgroup>
					<tr class="<?=$css[tr]?>">
						<td colspan="2">객실명</td>
						<td>평일(월~목)</td>
						<td>금요일</td>
						<td>토요일</td>
						<td>일요일</td>
						<td>공휴일전날</td>
					</tr>
					<?php
// 방 갯수마다 모두 요금을 입력받는다.
					$sql_room = " SELECT * FROM {$write_table}_r_info where pension_id = '$pension_id' order by r_info_order ASC ";
					$result_room = sql_query($sql_room);

					for ($ri=0; $r_info = sql_fetch_array($result_room); $ri++)
					{
						$rlist = $ri%2;
						?>
						<tr class="ht center list<?=$rlist?>">
							<td rowspan="2" class="<?=$css[td]?>">
								<input type="hidden" name="r_info_id[]" value="<?=$r_info[r_info_id]?>">
								<?=$r_info[r_info_name]?>
							</td>
							<td>기본요금</td>
							<td><input type=input size=7 name=r_date_cost_1[] class="costValue" /></td>
							<td><input type=input size=7 name=r_date_cost_2[] class="costValue" /></td>
							<td><input type=input size=7 name=r_date_cost_3[] class="costValue" /></td>
							<td><input type=input size=7 name=r_date_cost_4[] class="costValue" /></td>
							<td><input type=input size=7 name=r_date_cost_5[] class="costValue" /></td>
						</tr>
						<tr class="ht center list<?=$rlist?>">
							<td>할인율</td>
							<td><input type=input size=7 name=r_date_cost_11[] class="costRate" /></td>
							<td><input type=input size=7 name=r_date_cost_12[] class="costRate" /></td>
							<td><input type=input size=7 name=r_date_cost_13[] class="costRate" /></td>
							<td><input type=input size=7 name=r_date_cost_14[] class="costRate" /></td>
							<td><input type=input size=7 name=r_date_cost_15[] class="costRate" /></td>
						</tr>
						<?php
					}

					if ($ri == 0) echo "<tr><td colspan='6' align=center height=100>등록된 객실이 없습니다.</td></tr>";
					?>
				</table>
				<div style="margin-top:5px; text-align:right">
					<input type=button class='<?=$css[btn]?>' value="추가" onClick="Process('insert',0); return false;">
					<input type=button class='<?=$css[btn]?>' value="취소" onClick="history.back(-1); return false;">
				</div>
				<?php
			} else if($u == "edit") {
	## 업데이트 리스트
				$r_date = sql_fetch(" SELECT * FROM {$write_table}_r_date WHERE r_date_idx='$id'  and pension_id = '$pension_id'  ");
				?>

				<table width='100%' border='0' cellpadding='0' cellspacing='1' class='<?=$css[table]?>'>
					<colgroup width="30%"></colgroup>
					<colgroup width="20%"></colgroup>
					<colgroup width="20%"></colgroup>
					<colgroup width="15"></colgroup>
					<colgroup width="15%"></colgroup>
					<tr class='<?=$css[tr]?>'>
						<td>기간명</td>
						<td>시작일</td>
						<td>종료일</td>
						<td colspan=2>전체적용</td>
					</tr>
					<tr class='ht center'>
						<td><input type='text' name='r_date_name' required size=25 value='<?=$r_date[r_date_name]?>'></td>
						<td>
							<input class=m_text id=r_date_sdate type=text required numeric itemname=시작일 size=9 name=r_date_sdate value='<?=date("Ymd", $r_date[r_date_sdate])?>' readonly title='옆의 달력 아이콘을 클릭하여 날짜를 입력하세요.'>
							<a href="javascript:win_calendar('r_date_sdate', document.getElementById('r_date_sdate').value, '');"><img src='./img/calendar.gif' border=0 align=absmiddle title='달력 - 날짜를 선택하세요'></a>
						</td>
						<td>
							<input class=m_text id=r_date_edate type=text required numeric itemname=종료일 size=9 name=r_date_edate value='<?=date("Ymd", $r_date[r_date_edate])?>' readonly title='옆의 달력 아이콘을 클릭하여 날짜를 입력하세요.'>
							<a href="javascript:win_calendar('r_date_edate', document.getElementById('r_date_edate').value, '');"><img src='./img/calendar.gif' border=0 align=absmiddle title='달력 - 날짜를 선택하세요'></a>
						</td>
						<td>가격 <input type="input" name="allCost" id="allCost" size="8" maxlength="7" /></td>
						<td>할인율 <input type="input" name="allRate" id="allRate" size="4" maxlength="3" />%</td>
					</tr>
				</table>
				<table width='100%' border='0' cellpadding='0' cellspacing='1' class='<?=$css[table]?>'>
					<colgroup width="20%"></colgroup>
					<colgroup width="16%"></colgroup>
					<colgroup width="16%"></colgroup>
					<colgroup width="16%"></colgroup>
					<colgroup width="16%"></colgroup>
					<colgroup width="16%"></colgroup>
					<colgroup width="16%"></colgroup>
					<tr class="<?=$css[tr]?>">
						<td colspan=2>객실명</td>
						<td>평일(월~목)</td>
						<td>금요일</td>
						<td>토요일</td>
						<td>일요일</td>
						<td>공휴일전날</td>
					</tr>
					<?php
// 방 갯수마다 모두 요금을 입력받는다.
					$sql_room = " SELECT * FROM {$write_table}_r_info where pension_id = '$pension_id' order by r_info_order ASC ";
					$result_room = sql_query($sql_room);

					for ($ri=0; $r_info = sql_fetch_array($result_room); $ri++)
					{
						$rlist = $ri%2;
						$date_cost = sql_fetch("SELECT * FROM {$write_table}_r_date_cost WHERE pension_id = '$pension_id' and r_date_idx = '$r_date[r_date_idx]' and r_info_id = '$r_info[r_info_id]'");
						?>
						<tr class="ht center list<?=$rlist?>">
							<td rowspan="3" class="<?=$css[td]?>">
								<input type=hidden name=r_dcost_idx[] value="<?=$date_cost[r_dcost_idx]?>">
								<input type=hidden name=r_info_id[] value="<?=$r_info[r_info_id]?>">
								<?=$r_info[r_info_name]?>
							</td>
							<td>기본요금</td>
							<td><input type=input size=7 name=r_date_cost_1[] value="<?=$date_cost[r_date_cost_1]?>" class="costValue" /></td>
							<td><input type=input size=7 name=r_date_cost_2[] value="<?=$date_cost[r_date_cost_2]?>" class="costValue" /></td>
							<td><input type=input size=7 name=r_date_cost_3[] value="<?=$date_cost[r_date_cost_3]?>" class="costValue" /></td>
							<td><input type=input size=7 name=r_date_cost_4[] value="<?=$date_cost[r_date_cost_4]?>" class="costValue" /></td>
							<td><input type=input size=7 name=r_date_cost_5[] value="<?=$date_cost[r_date_cost_5]?>" class="costValue" /></td>
						</tr>
						<tr class="ht center list<?=$rlist?>">
							<td>할인율</td>
							<td><input type=input size=7 name=r_date_cost_11[] value="<?=$date_cost[r_date_cost_11]?>" class="costRate" /></td>
							<td><input type=input size=7 name=r_date_cost_12[] value="<?=$date_cost[r_date_cost_12]?>" class="costRate" /></td>
							<td><input type=input size=7 name=r_date_cost_13[] value="<?=$date_cost[r_date_cost_13]?>" class="costRate" /></td>
							<td><input type=input size=7 name=r_date_cost_14[] value="<?=$date_cost[r_date_cost_14]?>" class="costRate" /></td>
							<td><input type=input size=7 name=r_date_cost_15[] value="<?=$date_cost[r_date_cost_15]?>" class="costRate" /></td>
						</tr>
						<tr class="ht center list<?=$rlist?>">
							<td>할인가격</td>
							<td><?=number_format($date_cost[r_date_cost_21])?></td>
							<td><?=number_format($date_cost[r_date_cost_22])?></td>
							<td><?=number_format($date_cost[r_date_cost_23])?></td>
							<td><?=number_format($date_cost[r_date_cost_24])?></td>
							<td><?=number_format($date_cost[r_date_cost_25])?></td>
						</tr>
						<?php
					}

					if ($ri == 0) echo "<tr><td colspan='6' align=center height=100>등록된 객실이 없습니다.</td></tr>";
					?>
				</table>
				<div style='margin-top:5px; text-align:right;'>
					<input type=button class='<?=$css[btn]?>' value="수정" onClick="Process('update',<?=$id?>); return false;">
					<input type=button class='<?=$css[btn]?>' value="취소" onClick="history.back(-1); return false;">
				</div>
				<?php
			} else if($u == "copy") {
	## 업데이트 리스트
				$r_date = sql_fetch(" SELECT * FROM {$write_table}_r_date WHERE pension_id = '$pension_id' and r_date_idx='$id' ");
				?>

				<table width='100%' border='0' cellpadding='0' cellspacing='1' class='<?=$css[table]?>'>
					<colgroup width="30%"></colgroup>
					<colgroup width="20%"></colgroup>
					<colgroup width="20%"></colgroup>
					<colgroup width="15"></colgroup>
					<colgroup width="15%"></colgroup>
					<tr class='<?=$css[tr]?>'>
						<td>기간명</td>
						<td>시작일</td>
						<td>종료일</td>
						<td colspan=2>전체적용</td>
					</tr>
					<tr class='ht center'>
						<td><input type='text' name='r_date_name' required size=30 value='<?=$r_date[r_date_name]?>'></td>
						<td>
							<input class=m_text id=r_date_sdate type=text required numeric itemname=시작일 size=13 name=r_date_sdate value='<?=date("Ymd", $r_date[r_date_sdate])?>' readonly title='옆의 달력 아이콘을 클릭하여 날짜를 입력하세요.'>
							<a href="javascript:win_calendar('r_date_sdate', document.getElementById('r_date_sdate').value, '');"><img src='./img/calendar.gif' border=0 align=absmiddle title='달력 - 날짜를 선택하세요'></a>
						</td>
						<td>
							<input class=m_text id=r_date_edate type=text required numeric itemname=종료일 size=13 name=r_date_edate value='<?=date("Ymd", $r_date[r_date_edate])?>' readonly title='옆의 달력 아이콘을 클릭하여 날짜를 입력하세요.'>
							<a href="javascript:win_calendar('r_date_edate', document.getElementById('r_date_edate').value, '');"><img src='./img/calendar.gif' border=0 align=absmiddle title='달력 - 날짜를 선택하세요'></a>
						</td>
						<td>가격 <input type="input" name="allCost" id="allCost" size="8" maxlength="7" /></td>
						<td>할인율 <input type="input" name="allRate" id="allRate" size="4" maxlength="3" />%</td>
					</tr>
				</table>
				<table width='100%' border='0' cellpadding='0' cellspacing='1' class='<?=$css[table]?>'>
					<colgroup width="20%"></colgroup>
					<colgroup width="16%"></colgroup>
					<colgroup width="16%"></colgroup>
					<colgroup width="16%"></colgroup>
					<colgroup width="16%"></colgroup>
					<colgroup width="16%"></colgroup>
					<tr class="<?=$css[tr]?>">
						<td colspan="2">객실명</td>
						<td>평일(월~목)</td>
						<td>금요일</td>
						<td>토요일</td>
						<td>일요일</td>
						<td>공휴일전날</td>
					</tr>
					<?php
// 방 갯수마다 모두 요금을 입력받는다.
					$sql_room = " SELECT * FROM {$write_table}_r_info where pension_id = '$pension_id' order by r_info_order ASC ";
					$result_room = sql_query($sql_room);

					for ($ri=0; $r_info = sql_fetch_array($result_room); $ri++)
					{
						$rlist = $ri%2;
						$date_cost = sql_fetch("SELECT * FROM {$write_table}_r_date_cost WHERE pension_id = '$pension_id' and r_date_idx = '$r_date[r_date_idx]' and r_info_id = '$r_info[r_info_id]'");
						?>
						<tr class="ht center list<?=$rlist?>">
							<td rowspan="2" class="<?=$css[td]?>">
								<input type=hidden name=r_dcost_idx[] value="<?=$date_cost[r_dcost_idx]?>">
								<input type=hidden name=r_info_id[] value="<?=$r_info[r_info_id]?>">
								<?=$r_info[r_info_name]?>
							</td>
							<td>기본요금</td>
							<td><input type=input size=7 name=r_date_cost_1[] value="<?=$date_cost[r_date_cost_1]?>" class="costValue" /></td>
							<td><input type=input size=7 name=r_date_cost_2[] value="<?=$date_cost[r_date_cost_2]?>" class="costValue" /></td>
							<td><input type=input size=7 name=r_date_cost_3[] value="<?=$date_cost[r_date_cost_3]?>" class="costValue" /></td>
							<td><input type=input size=7 name=r_date_cost_4[] value="<?=$date_cost[r_date_cost_4]?>" class="costValue" /></td>
							<td><input type=input size=7 name=r_date_cost_5[] value="<?=$date_cost[r_date_cost_5]?>" class="costValue" /></td>
						</tr>
						<tr class="ht center list<?=$rlist?>">
							<td>할인율</td>
							<td><input type=input size=7 name=r_date_cost_11[] value="<?=$date_cost[r_date_cost_11]?>" class="costRate" /></td>
							<td><input type=input size=7 name=r_date_cost_12[] value="<?=$date_cost[r_date_cost_12]?>" class="costRate" /></td>
							<td><input type=input size=7 name=r_date_cost_13[] value="<?=$date_cost[r_date_cost_13]?>" class="costRate" /></td>
							<td><input type=input size=7 name=r_date_cost_14[] value="<?=$date_cost[r_date_cost_14]?>" class="costRate" /></td>
							<td><input type=input size=7 name=r_date_cost_15[] value="<?=$date_cost[r_date_cost_15]?>" class="costRate" /></td>
						</tr>
						<?php
					}

					if ($ri == 0) echo "<tr><td colspan='6' align=center height=100>등록된 객실이 없습니다.</td></tr>";
					?>
				</table>
				<div style='margin-top:5px; text-align:right;'>
					<input type=button class='<?=$css[btn]?>' value="수정" onClick="Process('insert',0); return false;">
					<input type=button class='<?=$css[btn]?>' value="취소" onClick="history.back(-1); return false;">
				</div>


				<?php
## 업데이트 리스트 끝
			} else {
				if($u == "del") {
					$sql = "DELETE FROM {$write_table}_r_date WHERE pension_id = '$pension_id' and r_date_idx = '$id'";
					sql_query($sql);
					$sql2 = "DELETE FROM {$write_table}_r_date_cost WHERE pension_id = '$pension_id' and r_date_idx = '$id'";
					sql_query($sql2);
				} else if($u == "update") {
					$sy = substr($r_date_sdate,0,4);
					$sm = substr($r_date_sdate,4,2);
					$sd = substr($r_date_sdate,6,2);
					$sdate = mktime(12,0,0,$sm,$sd,$sy);

					$ey = substr($r_date_edate,0,4);
					$em = substr($r_date_edate,4,2);
					$ed = substr($r_date_edate,6,2);
					$edate = mktime(12,0,0,$em,$ed,$ey);

					$chk_date = sql_fetch( " SELECT * FROM {$write_table}_r_date WHERE ( r_date_idx != '$id' AND pension_id = '$pension_id' ) AND ( ($sdate BETWEEN r_date_sdate AND r_date_edate) OR ($edate BETWEEN r_date_sdate AND r_date_edate) ) LIMIT 1" );
					if($chk_date) alert("중복되는 기간이 있습니다. 기간을 확인해 주세요!!");

					$sql = "UPDATE {$write_table}_r_date SET
					r_date_name = '$r_date_name',
					r_date_sdate = '$sdate',
					r_date_edate = '$edate'
					WHERE pension_id = '$pension_id' and r_date_idx ='$id' LIMIT 1 ;";
					$result = sql_query($sql);

					for($i=0; $i < count($r_dcost_idx); $i++ ) {
						if($r_date_cost_11[$i]) $r_date_cost_21[$i] = round( $r_date_cost_1[$i] - ($r_date_cost_1[$i] * ($r_date_cost_11[$i] * 0.01)), -2 );
						else $r_date_cost_21[$i] = $r_date_cost_1[$i];
						if($r_date_cost_12[$i]) $r_date_cost_22[$i] = round( $r_date_cost_2[$i] - ($r_date_cost_2[$i] * ($r_date_cost_12[$i] * 0.01)), -2 );
						else $r_date_cost_22[$i] = $r_date_cost_2[$i];
						if($r_date_cost_13[$i]) $r_date_cost_23[$i] = round( $r_date_cost_3[$i] - ($r_date_cost_3[$i] * ($r_date_cost_13[$i] * 0.01)), -2 );
						else $r_date_cost_23[$i] = $r_date_cost_3[$i];
						if($r_date_cost_14[$i]) $r_date_cost_24[$i] = round( $r_date_cost_4[$i] - ($r_date_cost_4[$i] * ($r_date_cost_14[$i] * 0.01)), -2 );
						else $r_date_cost_24[$i] = $r_date_cost_4[$i];
						if($r_date_cost_15[$i]) $r_date_cost_25[$i] = round( $r_date_cost_5[$i] - ($r_date_cost_5[$i] * ($r_date_cost_15[$i] * 0.01)), -2 );
						else $r_date_cost_25[$i] = $r_date_cost_5[$i];

						if($r_dcost_idx[$i]) {
							$sql = "UPDATE {$write_table}_r_date_cost SET
							r_date_cost_1 = '$r_date_cost_1[$i]',
							r_date_cost_2 = '$r_date_cost_2[$i]',
							r_date_cost_3 = '$r_date_cost_3[$i]',
							r_date_cost_4 = '$r_date_cost_4[$i]',
							r_date_cost_5 = '$r_date_cost_5[$i]',
							r_date_cost_11 = '$r_date_cost_11[$i]',
							r_date_cost_12 = '$r_date_cost_12[$i]',
							r_date_cost_13 = '$r_date_cost_13[$i]',
							r_date_cost_14 = '$r_date_cost_14[$i]',
							r_date_cost_15 = '$r_date_cost_15[$i]',
							r_date_cost_21 = '$r_date_cost_21[$i]',
							r_date_cost_22 = '$r_date_cost_22[$i]',
							r_date_cost_23 = '$r_date_cost_23[$i]',
							r_date_cost_24 = '$r_date_cost_24[$i]',
							r_date_cost_25 = '$r_date_cost_25[$i]'
							WHERE pension_id = '$pension_id' and r_dcost_idx = '$r_dcost_idx[$i]'";
							$result = sql_query($sql);
						} else {
							$sql = " SELECT r_date_idx FROM {$write_table}_r_date WHERE pension_id = '$pension_id' AND r_date_name = '$r_date_name' AND r_date_sdate = '$sdate' AND r_date_edate = '$edate' ";
							$r_date_idx = sql_fetch($sql);

							$sql = "INSERT INTO {$write_table}_r_date_cost (
								r_info_id,
								r_date_idx,
								r_date_cost_1,
								r_date_cost_2,
								r_date_cost_3,
								r_date_cost_4,
								r_date_cost_5,
								pension_id,
								r_date_cost_11,
								r_date_cost_12,
								r_date_cost_13,
								r_date_cost_14,
								r_date_cost_15,
								r_date_cost_21,
								r_date_cost_22,
								r_date_cost_23,
								r_date_cost_24,
								r_date_cost_25
								) VALUES (
								'$r_info_id[$i]',
								'$r_date_idx[r_date_idx]',
								'$r_date_cost_1[$i]',
								'$r_date_cost_2[$i]',
								'$r_date_cost_3[$i]',
								'$r_date_cost_4[$i]',
								'$r_date_cost_5[$i]',
								'$pension_id',
								'$r_date_cost_11[$i]',
								'$r_date_cost_12[$i]',
								'$r_date_cost_13[$i]',
								'$r_date_cost_14[$i]',
								'$r_date_cost_15[$i]',
								'$r_date_cost_21[$i]',
								'$r_date_cost_22[$i]',
								'$r_date_cost_23[$i]',
								'$r_date_cost_24[$i]',
								'$r_date_cost_25[$i]'
								);";
							sql_query($sql);
						}
					}
				} else if($u == "insert") {
					$sy = substr($r_date_sdate,0,4);
					$sm = substr($r_date_sdate,4,2);
					$sd = substr($r_date_sdate,6,2);
					$sdate = mktime(12,0,0,$sm,$sd,$sy);

					$ey = substr($r_date_edate,0,4);
					$em = substr($r_date_edate,4,2);
					$ed = substr($r_date_edate,6,2);
					$edate = mktime(12,0,0,$em,$ed,$ey);

					$chk_date = sql_fetch("SELECT * FROM {$write_table}_r_date WHERE
						pension_id = '$pension_id' AND
						( ($sdate BETWEEN r_date_sdate AND r_date_edate) OR
							($edate BETWEEN r_date_sdate AND r_date_edate) ) LIMIT 1");
					if($chk_date) alert("중복되는 기간이 있습니다. 기간을 확인해 주세요!!");

					$sql = " INSERT INTO {$write_table}_r_date (
						r_date_name,
						r_date_sdate,
						r_date_edate,
						pension_id
						) VALUES (
						'$r_date_name',
						'$sdate',
						'$edate',
						'$pension_id'
						);";
					sql_query($sql);

		// r_date_idx 값을 읽어와서 요금 정보를 저장한다.
					$sql = " SELECT r_date_idx FROM {$write_table}_r_date WHERE pension_id = '$pension_id' and r_date_name = '$r_date_name' AND r_date_sdate = '$sdate' AND r_date_edate = '$edate' ";
					$r_date_idx = sql_fetch($sql);

					for($i=0; $i < count($r_info_id); $i++) {
						if($r_date_cost_11[$i]) $r_date_cost_21[$i] = round( $r_date_cost_1[$i] - ($r_date_cost_1[$i] * ($r_date_cost_11[$i] * 0.01)), -2 );
						else $r_date_cost_21[$i] = $r_date_cost_1[$i];
						if($r_date_cost_12[$i]) $r_date_cost_22[$i] = round( $r_date_cost_2[$i] - ($r_date_cost_2[$i] * ($r_date_cost_12[$i] * 0.01)), -2 );
						else $r_date_cost_22[$i] = $r_date_cost_2[$i];
						if($r_date_cost_13[$i]) $r_date_cost_23[$i] = round( $r_date_cost_3[$i] - ($r_date_cost_3[$i] * ($r_date_cost_13[$i] * 0.01)), -2 );
						else $r_date_cost_23[$i] = $r_date_cost_3[$i];
						if($r_date_cost_14[$i]) $r_date_cost_24[$i] = round( $r_date_cost_4[$i] - ($r_date_cost_4[$i] * ($r_date_cost_14[$i] * 0.01)), -2 );
						else $r_date_cost_24[$i] = $r_date_cost_4[$i];
						if($r_date_cost_15[$i]) $r_date_cost_25[$i] = round( $r_date_cost_5[$i] - ($r_date_cost_5[$i] * ($r_date_cost_15[$i] * 0.01)), -2 );
						else $r_date_cost_25[$i] = $r_date_cost_5[$i];

						$sql = "INSERT INTO {$write_table}_r_date_cost (
							r_info_id,
							r_date_idx,
							r_date_cost_1,
							r_date_cost_2,
							r_date_cost_3,
							r_date_cost_4,
							r_date_cost_5,
							r_date_cost_11,
							r_date_cost_12,
							r_date_cost_13,
							r_date_cost_14,
							r_date_cost_15,
							r_date_cost_21,
							r_date_cost_22,
							r_date_cost_23,
							r_date_cost_24,
							r_date_cost_25,
							pension_id
							) VALUES (
							'$r_info_id[$i]',
							'$r_date_idx[r_date_idx]',
							'$r_date_cost_1[$i]',
							'$r_date_cost_2[$i]',
							'$r_date_cost_3[$i]',
							'$r_date_cost_4[$i]',
							'$r_date_cost_5[$i]',
							'$r_date_cost_11[$i]',
							'$r_date_cost_12[$i]',
							'$r_date_cost_13[$i]',
							'$r_date_cost_14[$i]',
							'$r_date_cost_15[$i]',
							'$r_date_cost_21[$i]',
							'$r_date_cost_22[$i]',
							'$r_date_cost_23[$i]',
							'$r_date_cost_24[$i]',
							'$r_date_cost_25[$i]',
							'$pension_id'
							);";
						sql_query($sql);
					}
				}

	// 데이터 저장시 펜션정보에 최대 할인율과 최저 가격 입력 - Start
				include "lowCost.lib.php";
	// 데이터 저장시 펜션정보에 최대 할인율과 최저 가격 입력 - End
				show_list();
			}
?>
			</form>
		</td>
	</tr>
	<tr>
		<td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) left bottom;"></td>
		<td bgcolor="#ffffff">&nbsp;</td>
		<td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) right bottom;"></td>
	</tr>
</table>
<script type="text/javascript">
	$(function(){
		$('#allRate').keyup(function(){
			var rate = $(this).val();
			$('.costRate').val(rate);
		});
		$('#allCost').keyup(function(){
			var cost = $(this).val();
			$('.costValue').val(cost);
		});
	});

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
			dateFormat: 'yymmdd', firstDay: 0,
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			isRTL: false};
			$.datepicker.setDefaults($.datepicker.regional['ko']);
			$("#r_date_sdate").datepicker();
			$("#r_date_edate").datepicker();
		});

	function Process(u,id) {
		f = document.process;
		if(u == "del") {
			var Result = confirm("자료가 영구히 삭제됩니다. 정말로 삭제하시겠습니까?");
			if(Result)
				f.action = "<?=$this_page?>";
			else
				return false;
		}

		if((u == "update" || u == "insert") && !f.r_date_name.value) {
			alert("기간명을 입력해 주세요!!");
			f.r_date_name.focus();
			return false;
		}

		f.action = "<?=$this_page?>";
		f.u.value = u;
		f.id.value = id;
		f.submit();
	}
</script>
<?php
############# 푸터
if ($board[bo_content_tail]) echo stripslashes($board[bo_content_tail]);
if ($board[bo_image_tail]) echo "<img src='$g4[path]/data/file/$bo_table/$board[bo_image_tail]' border='0'>";
if ($board[bo_include_tail]) @include ("../../$board[bo_include_tail]");

include_once("$g4[path]/tail.sub.php");
?>
