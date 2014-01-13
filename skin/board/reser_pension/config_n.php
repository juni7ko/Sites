<?php
function Get_Date_Type_Cal2($time) {
	global $rd_date;

	$date_type = "";
	for ($i=0; $i < count($rd_date); $i++)  {
		if($rd_date[$i][r_date_sdate] <= $time && $rd_date[$i][r_date_edate] >= $time) {
			$date_type = $rd_date[$i][r_date_name];
			break;
		}
	}

	return $date_type;
}

function Get_Date_Off2($time) {
	global $rd_off;

	$weektype = "";
	for ($i=0; $i < count($rd_off); $i++)  {
		if($rd_off[$i][r_off_date] <= $time && $rd_off[$i][r_off_date2] >= $time) {
			$weektype = $rd_off[$i][r_off_name];
			break;
		}
	}

	return $weektype;
}

function Get_Date_Tel2($time,$r_name) {
	global $rd_tel;

	$tel_name = "";
	for ($i=0; $i < count($rd_tel); $i++)  {
		if($rd_tel[$i][r_tel_name] == $r_name && $rd_tel[$i][r_tel_date] <= $time && $rd_tel[$i][r_tel_date2] >= $time) {
			$tel_name = $r_name;
			break;
		}
	}
	return $tel_name;
}

function Get_Room_Info_One2($bo_table, $r_name, $info_field) {
	global $rd_info;

	$ss = "r_info_" . $info_field;

	return $rd_info[$r_name][$ss];
}

function Get_Date_Close2($time,$r_name) {
	global $rd_close;

	$close_name = "";
	for ($i=0; $i < count($rd_close); $i++)  {
		if($rd_close[$i][r_close_name] == $r_name && $rd_close[$i][r_close_date] <= $time && $rd_close[$i][r_close_date2] >= $time) {
			$close_name = $r_name;
			break;
		}
	}
	return $close_name;
}

function Get_Date_Reserv2($bo_table, $r_name, $time, $link_url) {
	global $g4, $bo_table, $is_admin, $board_skin_path, $rd_day;

	$rstate_ye = "<img src='{$board_skin_path}/img_n/ye.gif' align='absmiddle' /> ";
	$rstate_wan = "<img src='{$board_skin_path}/img_n/wan.gif' align='absmiddle' /> ";
	$rstate_jen = "<img src='{$board_skin_path}/img_n/jen.gif' align='absmiddle' /> ";
	$rstate_dae = "<img src='{$board_skin_path}/img_n/dae.gif' align='absmiddle' /> ";
	$rstate_jong = "<img src='{$board_skin_path}/img_n/jong.gif' align='absmiddle' /> ";
	$rstate_bool = "<img src='{$board_skin_path}/img_n/bool.gif' align='absmiddle' /> ";

	$r_name2 = "<span class='col_r_name'>{$r_name}</span>";
	$r_name_wan = "<span class='col_wan'>{$r_name}</span>";
	$r_name_dae = "<span class='col_dae'>{$r_name}</span>";

	$py = substr($time,0,4);
	$pm = substr($time,4,2);
	$pd = substr($time,6,2);
	$pdate = mktime(12,0,0,$pm,$pd,$py);

	$r_state = 0;

	if(Get_Date_Close2($pdate,$r_name) == $r_name) {

		if($is_admin) $r_print = "{$rstate_bool}{$r_name2}";
			else $r_print = "{$rstate_wan}{$r_name_wan}";

	} else {

		$row[cnt] = 0;
		$row_wan[cnt] = 0;
		$row2[rResult] = "";
		for($i=0; $i < count($rd_day); $i++) {
			if($rd_day[$i][ca_name] == $r_name && $rd_day[$i][wr_link1] <= $time && $rd_day[$i][wr_link2] > $time) {
				$row[cnt] += $rd_day[$i][wr_9];
				if($rd_day[$i][rResult] == "0020")
					$row_wan[cnt] += $rd_day[$i][wr_9];
				$row2[rResult] = $rd_day[$i][rResult];
			}
		}

		if(Get_Room_Info_One2($bo_table, $r_name, 'over') == "O") {
			$r_state = Get_Room_Info_One2($bo_table, $r_name, 'cnt') - $row[cnt]; // 예약취소를 제외한 갯수

			if($r_state >= 1) {
				//if($is_admin)
				//	$r_print = "{$rstate_ye}<a href='{$link_url}'>{$r_name2}({$r_state})</a>";
				//else
					$r_print = "{$rstate_ye}<a href='{$link_url}'>{$r_name2}</a>";

				if(Get_Date_Tel2($pdate,$r_name) == $r_name) {
					if($is_admin) $r_print = "{$rstate_jen}<a href='{$link_url}'>{$r_name2}</a>";
						else $r_print = "{$rstate_jen}{$r_name2}";
				}
			} else {
				## 예약완료 갯수 Start
				$r_state2 = Get_Room_Info_One2($bo_table, $r_name, 'cnt') - $row_wan[cnt]; // 예약완료 갯수
				## 예약완료갯수 End

				if($r_state2 <= 0) {
					$r_print = "{$rstate_wan}{$r_name_wan}";
				} else {
					$r_print = "{$rstate_dae}{$r_name_dae}";
				}
			}
		} else {
			if($row[cnt]) {
				if($row2[rResult] == "0010") {
					$r_print = "{$rstate_dae}{$r_name_dae}";
				} else if($row2[rResult] == "0020") {
					$r_print = "{$rstate_wan}{$r_name_wan}";
				} else {
					$r_print = "{$rstate_wan}{$r_name_wan}";
				}
			} else {
				$r_print = "{$rstate_ye}<a href='{$link_url}'>{$r_name2}</a>";
				if(Get_Date_Tel2($pdate,$r_name) == $r_name) {
					if($is_admin) $r_print = "{$rstate_jen}<a href='{$link_url}'>{$r_name2}</a>";
						else $r_print = "{$rstate_jen}{$r_name2}";
				}
			}
		}

	}

	if($is_admin && $row[cnt]) $r_print .= "<a href='{$g4[bbs_path]}/board.php?view_mode=list&bo_table={$bo_table}&sca={$r_name}&sfl=wr_link1&sop=and&stx={$time}' style='color:blue;'>[" . $row[cnt] . "]</a>";

	$r_print = "<dt>" . $r_print . "</dt>";

	return $r_print;
}

function Get_Room_Select2($bo_table,$f_name,$r_name) {
	global $bo_table, $write_table, $pension_id;

	$sql1 = "SELECT r_info_name, r_info_id FROM {$write_table}_r_info where pension_id = '$pension_id' ORDER BY r_info_order DESC ;";
	$up_cate = "";
	$result = sql_query($sql1);

	for ($i=0; $r_info = sql_fetch_array($result); $i++)  {
		/*
		if($r_info[r_info_name] == $r_name)
			$up_cate .= "<option value='{$r_info[r_info_id]}' selected>$r_info[r_info_name]</option>";
		else
			$up_cate .= "<option value='{$r_info[r_info_id]}'>$r_info[r_info_name]</option>";
		*/
		$up_cate .= "<option value='{$r_info[r_info_id]}'>$r_info[r_info_name]</option>";
	}

	$r_value = "<select name='{$f_name}'>" . $up_cate . "</select>";
	return $r_value;
}

function getRoomName($r_info_id) {
	global $write_table;
	$sql = " SELECT * FROM {$write_table}_r_info WHERE r_info_id = '$r_info_id' LIMIT 1; ";
	$result = sql_fetch($sql);
	return $result;
}

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

function alert_and_back($msg){
    echo("<script type='text/javascript'>
            alert('$msg');
            history.back();
        </script>");
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
		switch ($read_complete[rResult]) {
			case '0020' :
				$resCheck['rResult'] = "완료";
				break;
			case '0010' :
				$resCheck['rResult'] = "대기";
				break;
			case '0040' :
				$resCheck['rResult'] = "완료";
				break;
			default:
				$resCheck['rResult'] = NULL;
				break;
		}
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