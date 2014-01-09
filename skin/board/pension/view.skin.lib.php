<?php
$write_table2 = "g4_write_bbs34";
// 날짜를 입력받아 요일을 리턴
function GetDateWeek($week)
{
	switch($week) {
		case "1" :
			$weekP = "월";
			break;
		case "2" :
			$weekP = "화";
			break;
		case "3" :
			$weekP = "수";
			break;
		case "4" :
			$weekP = "목";
			break;
		case "5" :
			$weekP = "금";
			break;
		case "6" :
			$weekP = "토";
			break;
		case "0" :
			$weekP = "일";
			break;
		default :
			$weekP = "";
			break;
	}

	return $weekP;
}

function viewDateRow($sDate, $eDate, $penID)
{
	global $write_table2;

	for($rowDate = $sDate, $i = 0; $rowDate <= $eDate; $rowDate += 86400, $i++)
	{
		$viewDateRow['row'][$i] = $i;
		$viewDateRow['pDate'][$i] = $rowDate;
		$viewDateRow['pDateType'][$i] = pDateType($rowDate);

		$viewDateRow['pDateDay'][$i] = date("m/d", $rowDate);

		$weekChk[$i] = date("w", $rowDate);
		$viewDateRow['pDateWeek'][$i] = GetDateWeek($weekChk[$i]);
	}

	// 방 정보 수집
	$roomListSql = " SELECT * FROM {$write_table2}_r_info WHERE pension_id = '$penID' ORDER BY r_info_order ASC";
	$resultList = sql_query($roomListSql);

	for ($i=0; $roomList = sql_fetch_array($resultList); $i++)
	{
		$viewDateRow['rInfoIdRow'][$i] = $i;
		$viewDateRow['rInfoId'][$i] = $roomList['r_info_id'];
		$viewDateRow['rInfoName'][$i] = $roomList['r_info_name'];
		$viewDateRow['rInfoPerson1'][$i] = $roomList['r_info_person1'];
		$viewDateRow['rInfoPerson2'][$i] = $roomList['r_info_person2'];
	}
	return $viewDateRow;
}

// 날짜와 펜션ID를 입력받아 주중/주말 요금 구분
function pDateType($time)
{
	$weekChk = date("w", $time);

	switch($weekChk) {
		case "5" :
			$costType = "2"; //금요일
			break;
		case "6" :
			$costType = "3"; // 토요일
			break;
		case "0" :
			$costType = "4"; // 일요일
			break;
		default :
			$costType = "1"; //평일
			break;
	}

	return $costType;
}

function pDateType2($time)
{
	$weekChk = date("w", $time);

	switch($weekChk) {
		case "5" :
			$costType = "금요일"; //금요일
			break;
		case "6" :
			$costType = "토요일"; // 토요일
			break;
		case "0" :
			$costType = "일요일"; // 일요일
			break;
		default :
			$costType = "평일"; //평일
			break;
	}

	return $costType;
}

function viewDateType($penID, $pDate)
{
	global $write_table2;

	$dateList = sql_fetch(" SELECT * FROM {$write_table2}_r_date WHERE pension_id = '$penID' AND ('$pDate' BETWEEN r_date_sdate AND r_date_edate) LIMIT 1 ");
	if($dateList)
	{
		$pDateTypeName = $dateList['r_date_name'];
	} else {
		// 공휴일인지 체크
		$offList = sql_fetch(" SELECT * FROM {$write_table2}_r_off WHERE pension_id = '$penID' AND ('$pDate' BETWEEN r_off_date AND r_off_date2) LIMIT 1 ");

		if($offList)
		{
			$pDateTypeName = $offList['r_off_name'];
		} else {
			//$pDateTypeName = $viewDateRow['pDateType'][$i];
			$pDateTypeName = "비수기";
		}
	}

	return $pDateTypeName;
}

function viewCostRow($costID, $penID, $pDateType, $pDate)
{
	global $write_table2;
	$pDate2 = $pDate + 86400;

	// 다음날이 공휴일인지를 체크
	//$offInfoSql = " SELECT * FROM g4_write_bbs34_r_off WHERE pension_id = '$penID' AND r_off_date <= '$pDate2' AND r_off_date2 >= '$pDate2' LIMIT 1 ";
	$offList = sql_fetch(" SELECT * FROM {$write_table2}_r_off WHERE pension_id = '$penID' AND ('$pDate2' BETWEEN r_off_date AND r_off_date2) LIMIT 1 ");
	if($offList) $pDateType = 5;

	// 기간별 요금이 있는지 체크하여 가격 계산
	$dateList = sql_fetch(" SELECT * FROM {$write_table2}_r_date WHERE pension_id = '$penID' AND ('$pDate' BETWEEN r_date_sdate AND r_date_edate) LIMIT 1 ");
	if($dateList)
	{
		$costList = sql_fetch(" SELECT * FROM {$write_table2}_r_date_cost WHERE r_date_idx = '$dateList[r_date_idx]'  AND r_info_id = '$costID' AND pension_id = '$penID' LIMIT 1 ");

		switch($pDateType) {
			case "2" : // 금요일
				$viewCostRow['typeCost1'] = $costList['r_date_cost_2'];
				$viewCostRow['typeCost2'] = $costList['r_date_cost_12'];
				$viewCostRow['typeCost3'] = $costList['r_date_cost_22'];
				break;
			case "3" : // 토요일
				$viewCostRow['typeCost1'] = $costList['r_date_cost_3'];
				$viewCostRow['typeCost2'] = $costList['r_date_cost_13'];
				$viewCostRow['typeCost3'] = $costList['r_date_cost_23'];
				break;
			case "4" : // 일요일
				$viewCostRow['typeCost1'] = $costList['r_date_cost_4'];
				$viewCostRow['typeCost2'] = $costList['r_date_cost_14'];
				$viewCostRow['typeCost3'] = $costList['r_date_cost_24'];
				break;
			case "5" :
				$viewCostRow['typeCost1'] = $costList['r_date_cost_5'];
				$viewCostRow['typeCost2'] = $costList['r_date_cost_15'];
				$viewCostRow['typeCost3'] = $costList['r_date_cost_25'];
				break;
			default : // 평일
				$viewCostRow['typeCost1'] = $costList['r_date_cost_1'];
				$viewCostRow['typeCost2'] = $costList['r_date_cost_11'];
				$viewCostRow['typeCost3'] = $costList['r_date_cost_21'];
				break;
		}
	} else {
		// 객실 가격 추출
		$costList = sql_fetch(" SELECT * FROM {$write_table2}_r_cost WHERE r_info_id = '$costID' AND pension_id = '$penID' LIMIT 1 ");

		switch($pDateType) {
			case "2" : // 금요일
				$viewCostRow['typeCost1'] = $costList['r_cost_12'];
				$viewCostRow['typeCost2'] = $costList['r_cost_22'];
				$viewCostRow['typeCost3'] = $costList['r_cost_32'];
				break;
			case "3" : // 토요일
				$viewCostRow['typeCost1'] = $costList['r_cost_13'];
				$viewCostRow['typeCost2'] = $costList['r_cost_23'];
				$viewCostRow['typeCost3'] = $costList['r_cost_33'];
				break;
			case "4" : // 일요일
				$viewCostRow['typeCost1'] = $costList['r_cost_14'];
				$viewCostRow['typeCost2'] = $costList['r_cost_24'];
				$viewCostRow['typeCost3'] = $costList['r_cost_34'];
				break;
			case "5" :
				$viewCostRow['typeCost1'] = $costList['r_cost_15'];
				$viewCostRow['typeCost2'] = $costList['r_cost_25'];
				$viewCostRow['typeCost3'] = $costList['r_cost_35'];
				break;
			default : // 평일
				$viewCostRow['typeCost1'] = $costList['r_cost_11'];
				$viewCostRow['typeCost2'] = $costList['r_cost_21'];
				$viewCostRow['typeCost3'] = $costList['r_cost_31'];
				break;
		}
	}

	return $viewCostRow;
}

function resCheck($penID, $pDate, $costID)
{
	global $write_table2;
	// 1. 예약불가인지 전화예약인지 판별
	//   - 1순위 : 예약불가
	//   - 2순위 : 예약 여부 체크
	//   - 3순위 : 전화예약

	// 예약불가 체크
	$read_close = sql_fetch(" SELECT * FROM {$write_table2}_r_close WHERE pension_id = '$penID' AND r_info_id = '$costID' AND ('$pDate' BETWEEN r_close_date AND r_close_date2) LIMIT 1");
	if($read_close)
	{
		$resCheck['close']['r_close_name'] = $read_close['r_close_name'];
		$resCheck['close']['r_close_date'] = $read_close['r_close_date'];
		$resCheck['close']['r_close_date2'] = $read_close['r_close_date2'];
	}

    // 예약 여부 체크 시작 - 예약취소가 아닌 데이터 추출.
    $read_complete = sql_fetch(" SELECT * FROM {$write_table2} WHERE pension_id = '$penID' AND r_info_id = '$costID' AND wr_link2 = '$pDate' AND rResult != '0030' LIMIT 1 ");
    if($read_complete)
    {
    	$resCheck['rResult'] = $read_complete[rResult];
    }

	// 전화예약 체크
	$read_tel = sql_fetch(" SELECT * FROM {$write_table2}_r_tel WHERE pension_id = '$penID' AND r_info_id = '$costID' AND ('$pDate' BETWEEN r_tel_date AND r_tel_date2) LIMIT 1");
	if($read_tel)
	{
		$resCheck['tel']['r_tel_name'] = $read_tel['r_tel_name'];
		$resCheck['tel']['r_tel_date'] = $read_tel['r_tel_date'];
		$resCheck['tel']['r_tel_date2'] = $read_tel['r_tel_date2'];
	}

	return $resCheck;
}
?>
