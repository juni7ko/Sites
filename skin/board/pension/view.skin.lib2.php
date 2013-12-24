<?php
$write_table = "g4_write_bbs34";
$pension_id = $view[pension_id];

	## $rd_off Read off data
	$read_off_sql = " SELECT * FROM {$write_table}_r_off WHERE pension_id != '$pension_id' AND r_off_date <= '$eDateTmp' AND r_off_date2 >= '$sDateTmp'";
	echo $read_off_sql;
	$read_off = sql_query($read_off_sql);

	for ($i=0; $r_off = sql_fetch_array($read_off); $i++)  {
		$rd_off[$i][r_off_name] = $r_off[r_off_name];
		$rd_off[$i][r_off_date] = $r_off[r_off_date];
		$rd_off[$i][r_off_date2] = $r_off[r_off_date2];
	}
	## $rd_off End

//
	## $rd_day Start
	$read_month_sql = " SELECT * FROM {$write_table} WHERE pension_id != '$pension_id' AND wr_4 != '예약취소' and wr_link1 <= '$eDateYMD' and wr_link2 > '$sDateYMD'";
	$read_month = sql_query($read_month_sql);
	
	for ($i=0; $r_month = sql_fetch_array($read_month); $i++)  {
		$rd_day[$i][wr_id] = $r_month[wr_id];
		$rd_day[$i][ca_name] = $r_month[ca_name];
		$rd_day[$i][wr_link1] = $r_month[wr_link1];
		$rd_day[$i][wr_link2] = $r_month[wr_link2];
		$rd_day[$i][wr_4] = $r_month[wr_4];
		$rd_day[$i][wr_9] = $r_month[wr_9];
	}
	## $rd_day End
	
	## $rd_close Start
	$read_close_sql = " SELECT * FROM {$write_table}_r_close WHERE pension_id != '$pension_id' AND r_close_date <= '$eDateTmp' AND r_close_date2 >= '$sDateTmp'";
	$read_close = sql_query($read_close_sql);
	
	for ($i=0; $r_close = sql_fetch_array($read_close); $i++)  {
		$rd_close[$i][r_close_name] = $r_close[r_close_name];
		$rd_close[$i][r_close_date] = $r_close[r_close_date];
		$rd_close[$i][r_close_date2] = $r_close[r_close_date2];
	}
	## $rd_close End
	
	## $rd_info Start
	$read_info_sql = " SELECT * FROM {$write_table}_r_info WHERE pension_id != '$pension_id'";
	$read_info = sql_query($read_info_sql);
	
	for ($i=0; $r_info = sql_fetch_array($read_info); $i++)  {
		$rd_info[$r_info[r_info_name]][r_info_over] = $r_info[r_info_over];
		$rd_info[$r_info[r_info_name]][r_info_cnt] = $r_info[r_info_cnt];
	}
	## $rd_info End
	
	## $rd_tel Start
	$read_tel_sql = " SELECT * FROM {$write_table}_r_tel WHERE pension_id != '$pension_id' AND r_tel_date <= '$eDateTmp' AND r_tel_date2 >= '$sDateTmp'";
	$read_tel = sql_query($read_tel_sql);
	
	for ($i=0; $r_tel = sql_fetch_array($read_tel); $i++)  {
		$rd_tel[$i][r_tel_name] = $r_tel[r_tel_name];
		$rd_tel[$i][r_tel_date] = $r_tel[r_tel_date];
		$rd_tel[$i][r_tel_date2] = $r_tel[r_tel_date2];
	}
	## $rd_tel End
	
	## $rd_date Start
	$read_date_sql = " SELECT * FROM {$write_table}_r_date WHERE pension_id != '$pension_id' AND r_date_sdate <= '$eDateTmp' AND r_date_edate >= '$sDateTmp'";
	$read_date = sql_query($read_date_sql);
	
	for ($i=0; $r_date = sql_fetch_array($read_date); $i++)  {
		$rd_date[$i][r_date_name] = $r_date[r_date_name];
		$rd_date[$i][r_date_sdate] = $r_date[r_date_sdate];
		$rd_date[$i][r_date_edate] = $r_date[r_date_edate];
	}
	## $rd_date End
//

	function GetDateOff($time) {
		global $rd_off;
		
		$weektype = "";
		for ($i=0; $i < count($rd_off); $i++)  {
			if($rd_off[$i][r_off_date] <= $time && $rd_off[$i][r_off_date2] >= $time) {
				$weektype = $rd_off[$i][r_off_name];
				break;
			}
		}
		//if(!$weektype) $weektype = "비수기";
		return $weektype;
	}

	function GetDateTypeCal($time) {
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
?>
