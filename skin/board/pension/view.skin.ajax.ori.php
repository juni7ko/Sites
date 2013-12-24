<?php
include_once("_common.php");
## 예약 시스템 시작
## 금일 기준으로 14일의 날짜와 데이터를 가져온다.
include_once("view.skin.lib.php");
$nDate = getdate();
$nDateY = $nDate['year'];
$nDateM = $nDate['mon'];
$nDateD = $nDate['mday'];
$nDateTmp = mktime(12,0,0,$nDateM,$nDateD,$nDateY);

	if(!$sDate)
	{
		$sDate = getdate();
		$sDateY = $sDate['year'];
		$sDateM = $sDate['mon'];
		$sDateD = $sDate['mday'];
		$sDateTmp = mktime(12,0,0,$sDateM,$sDateD,$sDateY);
	} else {
		$sDateTmp = $sDate;
		$sDateY = date("Y", $sDateTmp);
		$sDateM = date("m", $sDateTmp);
		$sDateD = date("d", $sDateTmp);
		$sDateYMD = date("Ymd", $sDateTmp);
	}
	// 월별 마지막 날짜 계산
	$lastday = array(0,31,28,31,30,31,30,31,31,30,31,30,31);
	if ($sDateY%4 == 0) $lastday[2] = 29;

	$eDateTmp = $sDateTmp + (86400 * 13);
	$eDateY = date("Y", $eDateTmp);
	$eDateM = date("m", $eDateTmp);
	$eDateD = date("d", $eDateTmp);
	$eDateYMD = date("Ymd", $eDateTmp);

	// 이전/다음 버튼의 링크 생성
	$prevDay = $sDateTmp - (86400 * 14);
	$nextDay = $eDateTmp + 86400;
	$prevLink = "$_SERVER[PHP_SELF]?pension_id={$view[pension_id]}&bo_table=$bo_table&wr_id=$wr_id&sDate=$prevDay";
	$nextLink = "$_SERVER[PHP_SELF]?pension_id={$view[pension_id]}&bo_table=$bo_table&wr_id=$wr_id&sDate=$nextDay";

$viewDateRow = viewDateRow($sDateTmp, $eDateTmp, $pension_id);
?>
			<table class="tbl-condition" id="resForm">
			<caption></caption>
			<tr>
				<th colspan="15">
					<input type="button" value="이전" onClick="location.href='<?=$prevLink?>'" />
					<a href="<?="$_SERVER[PHP_SELF]?bo_table=$bo_table&wr_id=$wr_id"?>" title="오늘로" onfocus="this.blur()">
						<span style="font-size:16px; font-weight:bold;">
						<?=$sDateY?>년 <?=$sDateM?>월 <?=$sDateD?>일 ~ <?=$eDateY?>년 <?=$eDateM?>월 <?=$eDateD?>일
						</span>
					</a>
					<input type="button" value="다음" onClick="location.href='<?=$nextLink?>'" />
				</th>
			</tr>
			<tr>
				<td rowspan="2">객실명</td>
				<?php
				foreach($viewDateRow['row'] as $i)
				{
					$pDateTypeName = viewDateType($pension_id, $viewDateRow['pDate'][$i]);
					echo "<td>".$pDateTypeName."</td>";
				}
				?>
			</tr>
			<tr>
				<?php
				foreach($viewDateRow['row']  as $i)
				{
					if($viewDateRow['pDateWeek'][$i] == "토")
						echo "<td class='blue'>";
					else if($viewDateRow['pDateWeek'][$i] == "일")
						echo "<td class='red'>";
					else
						echo "<td>";

					echo $viewDateRow['pDateDay'][$i] . "<br />";
					echo "(" . $viewDateRow['pDateWeek'][$i] . ")";
					echo "</td>";
				}
				?>
			</tr>

<?php
foreach($viewDateRow['rInfoIdRow'] as $j) :
	$costID = $viewDateRow['rInfoId'][$j];
?>
			<tr class="pay">
				<td rowspan="2">
					<h3 class="title">
						<?=$viewDateRow['rInfoName'][$j]?>
					</h3>
					<span>기준<?=$viewDateRow['rInfoPerson1'][$j]?>/최대<?=$viewDateRow['rInfoPerson2'][$j]?></span>
					<input type="hidden" name="rInfoId" value="<?=$costID?>" />
				</td>
				<?php foreach($viewDateRow['row'] as $i) : // 해당 날짜의 기본 가격 우선 출력 ?>
				<td>
					<?php
						$viewCostRow = viewCostRow($costID, $pension_id, $viewDateRow['pDateType'][$i], $viewDateRow['pDate'][$i]);
						if($viewCostRow['typeCost2'])
						{
							echo "<div class='dc'>" . $viewCostRow['typeCost2'] . "%</div>";
							echo "<div class='not_rate'>" . number_format($viewCostRow['typeCost1']) . "</div>";
						}
						echo "<div>" . number_format($viewCostRow['typeCost3']) . "</div>";
					?>
				</td>
				<?php endforeach; ?>
			</tr>
			<tr class="check">
				<?php foreach($viewDateRow['row'] as $i) :?>
<?php
// 예약 가능 여부를 검색하여 체크박스/완료 출력
$resCheck = resCheck($pension_id, $viewDateRow['pDate'][$i], $costID);
?>
				<td>
				<?php
				if($nDateTmp > $viewDateRow['pDate'][$i])
				{
					echo "종료";
				} else if($resCheck['close']['r_close_name']) // 1차 예약불가 검사
				{
					echo "완료";
				} else if($res_check['rResult']) {
					// 예약완료가 되었을 경우
					echo "예완";
				} else if($resCheck['tel']['r_tel_name']) { // 3차 전화예약 검사
					echo "전화";
				} else {
					echo "<input type='checkbox' name='checkRoom' id='checkRoom' value='{$costID}_{$viewDateRow['pDate'][$i]}' />";
				}
				?>
				</td>
				<?php endforeach; ?>
			</tr>
<?php endforeach; ?>
			</table>

<?php include_once('./tail.sub.php');?>