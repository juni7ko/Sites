<?php if(strlen($wr_link1)>0 && strlen($wr_link2)>0) {  // 받은 날짜 argument 가 있을때..
 $f_year = substr($wr_link1,0,4);
 $f_mon = substr($wr_link1,4,2);
 $f_day = substr($wr_link1,6,2);
 $t_year = substr($wr_link2,0,4);
 $t_mon = substr($wr_link2,4,2);
 $t_day = substr($wr_link2,6,2);
 $f_date = date("Ymd", mktime(0,0,0,$f_mon,$f_day,$f_year));
 $t_date = date("Ymd", mktime(0,0,0,$t_mon,$t_day,$t_year));
 
}  elseif(strlen($f_date)>0 && strlen($t_date)>0) { // 받은 날짜 argument 가 없거나, 이상할 때 오늘날짜로 세팅...
 $f_year = substr($f_date,0,4);
 $f_mon = substr($f_date,4,2);
 $f_day = substr($f_date,6,2);
 $t_year = substr($t_date,0,4);
 $t_mon = substr($t_date,4,2);
 $t_day = substr($t_date,6,2);
 $f_date = date("Ymd", mktime(0,0,0,$f_mon,$f_day,$f_year));
 $t_date = date("Ymd", mktime(0,0,0,$t_mon,$t_day,$t_year));
}  else {                                    // 받은 날짜 argument 가 없거나, 이상할 때 오늘날짜로 세팅...
 $today = getdate();
 $f_mon = $today['mon'];$f_day = $today['mday'];$f_year = $today['year'];
 $t_mon = $today['mon'];$t_day = $today['mday'];$t_year = $today['year'];   

 $f_date = date("Ymd", mktime(0,0,0,$f_mon,$f_day,$f_year));
 $t_date = date("Ymd", mktime(0,0,0,$t_mon,$t_day+1,$t_year));
}

// 카테고리 이름 얻기
function get_cat_name($cat_id) 
{

    $row=sql_fetch(" SELECT cat_name FROM cs_cat WHERE cat_id = '$cat_id' ");
    return $row[cat_name];
}

//보드 카테고리 리스트형식으로 출력
function get_category_list($bo_table)
{
    global $g4, $category_location;

    $sql = " select bo_category_list from $g4[board_table] where bo_table = '$bo_table' ";
    $row = sql_fetch($sql);
    $arr = explode("|", $row[bo_category_list]); // 구분자가 , 로 되어 있음
    $str = "";
    for ($i=0; $i<count($arr); $i++) {
        if($i>0) $str .= " | ";
        if (trim($arr[$i])) $str .= "<a href=\"javascript:location='{$category_location}$arr[$i]'\">$arr[$i]</a> \n"; 
    }
    return $str;
}

// 정렬리스트 얻기
function get_sort_list($sortlist)
{
    global $bo_table, $sca, $sst;

    $s_href = $_SERVER["PHP_SELF"]."?bo_table=$bo_table&sca=$sca&sst=";
    for($i=0;$i<count($sortlist);$i++){
        $css1=$css2="";
        if($sst==$sortlist[$i][0]) $css1 ="<span class='l_cat_s'>"; $css2 = "</span>"; 
        if($i>0) $str .= " | ";
        $str .= "<a href='{$s_href}{$sortlist[$i][0]}'>{$css1}{$sortlist[$i][1]}{$css2}</a>\n";
    }
    return $str;
}

function Up_Cate($bo_table) {
	global $bo_table, $write_table;
	
	$sql1 = "SELECT r_info_name FROM {$write_table}_r_info ORDER BY r_info_order DESC ;";
	$up_cate = "";
	$result = sql_query($sql1);
	for ($i=0; $r_info = sql_fetch_array($result); $i++)  {
		if($up_cate)
			$up_cate = $r_info[r_info_name] . "|" . $up_cate ;
		else
			$up_cate = $r_info[r_info_name];
	}
	
	$sql2 = "UPDATE g4_board SET bo_category_list = '$up_cate', bo_use_category = '1', bo_use_secret = '2' WHERE bo_table ='$bo_table' LIMIT 1 ;";
	sql_fetch($sql2);
}

function Get_Room($bo_table) {
	global $bo_table, $write_table;
	
	$sql1 = "SELECT r_info_name FROM {$write_table}_r_info ORDER BY r_info_order DESC ;";
	$up_cate = "";
	$result = sql_query($sql1);
	for ($i=0; $r_info = sql_fetch_array($result); $i++)  {
		if($up_cate)
			$up_cate = $r_info[r_info_name] . "|" . $up_cate ;
		else
			$up_cate = $r_info[r_info_name];
	}
	
	return $up_cate;
}

function Get_Room_Select($bo_table,$f_name,$r_name) {
	global $bo_table, $write_table;
	
	$sql1 = "SELECT r_info_name FROM {$write_table}_r_info ORDER BY r_info_order DESC ;";
	$up_cate = "";
	$result = sql_query($sql1);
	
	for ($i=0; $r_info = sql_fetch_array($result); $i++)  {
		if($r_info[r_info_name] == $r_name)
			$up_cate .= "<option value='{$r_info[r_info_name]}' selected>$r_info[r_info_name]</option>";
		else
			$up_cate .= "<option value='{$r_info[r_info_name]}'>$r_info[r_info_name]</option>";
	}
	
	$r_value = "<select name='{$f_name}'>" . $up_cate . "</select>";
	return $r_value;
}

function Get_Room_Cost($bo_table, $cost_field) {
	global $bo_table, $write_table;
	
	$info_sql = "SELECT r_info_id FROM {$write_table}_r_info ORDER BY r_info_order DESC ;";
	$cost_value = "";
	$ss = "r_cost_" . $cost_field;
	$result_info = sql_query($info_sql);
	for ($i=0; $r_info = sql_fetch_array($result_info); $i++)  {
		$cost_sql = "SELECT $ss FROM {$write_table}_r_cost WHERE r_info_id = '$r_info[r_info_id]' ";
		$room_cost = sql_fetch($cost_sql);
		if($cost_value)
			$cost_value = $room_cost[$ss] . "|" . $cost_value;
		else
			$cost_value = $room_cost[$ss];
	}
	
	return $cost_value;
}

function Get_Room_Cost_One($bo_table, $r_name, $cost_field) {
	global $bo_table, $write_table;
	
	$ss = "r_cost_" . $cost_field;
	
	$info_sql = "SELECT r_info_id FROM {$write_table}_r_info WHERE r_info_name = '$r_name' ";
	$r_info = sql_fetch($info_sql);

	if($r_info) {
		$cost_sql = "SELECT $ss FROM {$write_table}_r_cost WHERE r_info_id = '$r_info[r_info_id]' ";
		$room_cost = sql_fetch($cost_sql);
		$cost_value = $room_cost[$ss];
		
		return $cost_value;
	}
}

function Get_Room_Info_One($bo_table, $r_name, $info_field) {
	global $bo_table, $write_table;
	
	$ss = "r_info_" . $info_field;
	$info_sql = "SELECT $ss FROM {$write_table}_r_info WHERE r_info_name = '$r_name' ";
	$r_info = sql_fetch($info_sql);
	
	return $r_info[$ss];
}

function Get_Date_Type($time) {
	global $bo_table, $write_table;
	
	$r_date = sql_fetch(" SELECT r_date_name FROM {$write_table}_r_date WHERE ( $time BETWEEN r_date_sdate - 86400 AND r_date_edate ) ");

	if($r_date[r_date_name]) {
		$date_type = $r_date[r_date_name];
	} else {
		$date_type = "";
	}

	return $date_type;
}

function Get_Date_Type_Cal($time) {
	global $bo_table, $write_table;

	$r_date = sql_fetch(" SELECT r_date_name FROM {$write_table}_r_date WHERE ( $time BETWEEN r_date_sdate AND r_date_edate ) ");
	
	if($r_date[r_date_name]) {
		$date_type = $r_date[r_date_name];
	} else {
		$date_type = "";
	}

	return $date_type;
}

function Get_Date_Week($time) {
	global $bo_table, $write_table;
	
	$checkweek = date("w",$time);
	
	if($checkweek == "5") {
		$weektype = "금요일";
	} else if($checkweek == "6") {
		$weektype = "토요일";
	} else if($checkweek == "0") {
		$weektype = "일요일";
	} else {
		$weektype = "평일";
	}
	
	$time1 = $time + 86400 + 86400;
	$r_off = sql_fetch(" SELECT r_off_name FROM {$write_table}_r_off WHERE ($time1 BETWEEN r_off_date AND r_off_date2 + 86400)");
	if($r_off) $weektype = "공휴일전날";
	
	return $weektype;
}

function Get_Date_Off($time) {
	global $bo_table, $write_table;
	
	$checkweek = date("w",$time);
	
	$r_off = sql_fetch(" SELECT r_off_name FROM {$write_table}_r_off WHERE ($time BETWEEN r_off_date AND r_off_date2)");
	if($r_off) $weektype = $r_off[r_off_name];
	return $weektype;
}

function Get_Date_Close($time,$r_name) {
	global $bo_table, $write_table;
	
	$checkweek = date("w",$time);
	$r_close = "";
	//$sql = " SELECT r_close_name FROM {$write_table}_r_close WHERE r_close_date2 >= '$time' and r_close_date <= '$time'";
	$sql = " SELECT r_close_name FROM {$write_table}_r_close WHERE ($time BETWEEN r_close_date AND r_close_date2)";
	$result = sql_query($sql);
	for ($i=0; $r_info = sql_fetch_array($result); $i++)  {
		if($r_name == $r_info[r_close_name]) {
			$r_close = $r_name;
			break;
		}
	}
	return $r_close;
}

function Get_Date_Tel($time,$r_name) {
	global $bo_table, $write_table;
	
	$checkweek = date("w",$time);
	$r_tel = "";
	$sql = " SELECT r_tel_name FROM {$write_table}_r_tel WHERE ($time BETWEEN r_tel_date AND r_tel_date2)";
	$result = sql_query($sql);
	for ($i=0; $r_info = sql_fetch_array($result); $i++)  {
		if($r_name == $r_info[r_tel_name]) {
			$r_tel = $r_name;
			break;
		}
	}
	return $r_tel;
}

function Get_Date_Cost($time, $r_name) {
	global $bo_table, $write_table;
	
	$type = Get_Date_Type($time);
	$week = Get_Date_Week($time);

	if($type) {
		switch($week) {
			case "공휴일전날" :
				$field = "r_date_cost_5";
				break;
			case "공휴일" :
				$field = "r_date_cost_5";
				break;
			case "평일" :
				$field = "r_date_cost_1";
				break;
			case "금요일" :
				$field = "r_date_cost_2";
				break;
			case "토요일" :
				$field = "r_date_cost_3";
				break;
			case "일요일" :
				$field = "r_date_cost_4";
				break;
			default :
				$field = "r_date_cost_1";
				break;
		}
		
		$sql1 = sql_fetch(" SELECT r_info_id FROM {$write_table}_r_info WHERE r_info_name='$r_name' ");
		$sql2 = sql_fetch(" SELECT r_date_idx FROM {$write_table}_r_date WHERE r_date_name='$type' and ($time BETWEEN r_date_sdate - 86400 AND r_date_edate) ");
		$Cost = sql_fetch(" SELECT $field FROM {$write_table}_r_date_cost WHERE r_info_id = '{$sql1[r_info_id]}' 
			and r_date_idx = '{$sql2[r_date_idx]}'");
	} else {
		switch($week) {
			case "공휴일전날" :
				$field = "r_cost_15";
				break;
			case "공휴일" :
				$field = "r_cost_15";
				break;
			case "평일" :
				$field = "r_cost_11";
				break;
			case "금요일" :
				$field = "r_cost_12";
				break;
			case "토요일" :
				$field = "r_cost_13";
				break;
			case "일요일" :
				$field = "r_cost_14";
				break;
			default :
				$field = "r_cost_11";
				break;
		}

		$r_id = sql_fetch(" SELECT r_info_id FROM {$write_table}_r_info WHERE r_info_name = '$r_name' LIMIT 1");
		$Cost = sql_fetch(" SELECT $field FROM {$write_table}_r_cost WHERE r_info_id = '$r_id[r_info_id]' LIMIT 1");
	}

	return $Cost[$field];
}

function Get_Option_list($bo_table, $type, $op_id) {
	global $bo_table, $write_table;

	if($type == "chk_list" || $type == "total_cost") {
		$tmp_array = $op_id;
		$op_cost = 0;
		$op_print = "";
		for ($i=count($tmp_array)-1; $i>=0; $i--) 
		{
				$option_sql = " SELECT * FROM {$write_table}_r_option WHERE r_op_id = '{$tmp_array[$i]} LIMIT 1' ;";
				$r_op = sql_fetch($option_sql);
				$op_print = $op_print . "<dt style='padding-left:10px;'>- " . $r_op[r_op_name] . " : " . number_format($r_op[r_op_cost]) . "원</dt>";
				$op_cost = $op_cost + $r_op[r_op_cost];
		}
		
		if($type == "chk_list") {
			if($op_print) return "<dt>추가옵션</dt>" . $op_print;
		} else if($type == "total_cost") {
			return $op_cost;
		}
	} else if($type == "list") {
		$option_sql = " SELECT * FROM {$write_table}_r_option ORDER BY r_op_name DESC ;";
	
		$result_op = sql_query($option_sql);
		for ($i=0; $r_op = sql_fetch_array($result_op); $i++)  {
			echo "<dt>";
			echo "<label><input type=checkbox name='chk_wr_op[]' value='{$r_op[r_op_id]}'> {$r_op[r_op_name]} : ".number_format($r_op[r_op_cost])."원</label>";
			echo "</dt>";
		}
		return;
	}
}

function Get_Date_Reserv_List($bo_table, $r_name, $time, $link_url) {
	global $g4, $bo_table, $write_table, $is_admin, $board_skin_path;

	$rstate_ye = " <img src='{$board_skin_path}/img_n/ye.gif' align='absmiddle' />";
	$rstate_wan = " <img src='{$board_skin_path}/img_n/wan.gif' align='absmiddle' />";
	$rstate_jen = " <img src='{$board_skin_path}/img_n/jen.gif' align='absmiddle' />";
	$rstate_dae = " <img src='{$board_skin_path}/img_n/dae.gif' align='absmiddle' />";
	$rstate_jong = " <img src='{$board_skin_path}/img_n/jong.gif' align='absmiddle' />";
	$rstate_bool = " <img src='{$board_skin_path}/img_n/bool.gif' align='absmiddle' />";

	$py = substr($time,0,4);
	$pm = substr($time,4,2);
	$pd = substr($time,6,2);
	$pdate = mktime(12,0,0,$pm,$pd,$py);

	$r_print = "";
	
	$sql = " SELECT sum(wr_9) as cnt FROM {$write_table} WHERE ca_name='$r_name' and wr_4!='예약취소' and wr_link1 <= '$time' and wr_link2 > '$time'";
	$row = sql_fetch($sql);

	if($row[cnt]) {
		$r_print .= "<div style='margin-bottom:10px;'>";
		$r_print .= "<dt style='font-weight:none;'><img src='{$board_skin_path}/img_n/ico_home.gif' align='absmiddle' /><a href='{$g4[bbs_path]}/board.php?view_mode=list&bo_table={$bo_table}&sca={$r_name}&sfl=wr_link1&sop=and&stx={$time}' style='color:#595959;'>{$r_name}[{$row[cnt]}]</a></dt>";
		
		$sql2 = " SELECT wr_id, wr_name, wr_9, wr_4 FROM {$write_table} WHERE ca_name='$r_name' and wr_4!='예약취소' and wr_link1 <= '$time' and wr_link2 > '$time'";
		$result2 = sql_query($sql2);		
		for ($i=0; $r_list = sql_fetch_array($result2); $i++)  {
			$r_print .= "<dt style='font-weight:none;'>&nbsp;&bull; <a href='{$g4[bbs_path]}/board.php?bo_table={$bo_table}&wr_id={$r_list[wr_id]}' style='color:#4d8cb0;'>{$r_list[wr_name]}";
			if($r_list[wr_9] > 1) $r_print .= "({$r_list[wr_9]})";
			if($r_list[wr_4] == "예약완료") $r_print .= $rstate_wan;
			if($r_list[wr_4] == "예약확인중") $r_print .= $rstate_dae;
			$r_print .= "</a></dt>";
		}
		$r_print .= "</div>";
	}

	return $r_print;
}

function Get_Date_Reserv_List_Start($bo_table, $r_name, $time, $link_url) {
	global $g4, $bo_table, $write_table, $is_admin, $board_skin_path;

	$rstate_ye = " <img src='{$board_skin_path}/img_n/ye.gif' align='absmiddle' />";
	$rstate_wan = " <img src='{$board_skin_path}/img_n/wan.gif' align='absmiddle' />";
	$rstate_jen = " <img src='{$board_skin_path}/img_n/jen.gif' align='absmiddle' />";
	$rstate_dae = " <img src='{$board_skin_path}/img_n/dae.gif' align='absmiddle' />";
	$rstate_jong = " <img src='{$board_skin_path}/img_n/jong.gif' align='absmiddle' />";
	$rstate_bool = " <img src='{$board_skin_path}/img_n/bool.gif' align='absmiddle' />";

	$py = substr($time,0,4);
	$pm = substr($time,4,2);
	$pd = substr($time,6,2);
	$pdate = mktime(12,0,0,$pm,$pd,$py);

	$r_print = "";
	
	$sql = " SELECT sum(wr_9) as cnt FROM {$write_table} WHERE ca_name='$r_name' and wr_4!='예약취소' and wr_link1 = '$time'";
	$row = sql_fetch($sql);

	if($row[cnt]) {
		$r_print .= "<div style='margin-bottom:10px;'>";
		$r_print .= "<dt style='font-weight:none;'><img src='{$board_skin_path}/img_n/ico_home.gif' align='absmiddle' /><a href='{$g4[bbs_path]}/board.php?view_mode=list&bo_table={$bo_table}&sca={$r_name}&sfl=wr_link1&sop=and&stx={$time}' style='color:#595959;'>{$r_name}[{$row[cnt]}]</a></dt>";
		
		$sql2 = " SELECT wr_id, wr_name, wr_9, wr_8, wr_4 FROM {$write_table} WHERE wr_link1 = '$time' and ca_name='$r_name' and wr_4!='예약취소'";
		$result2 = sql_query($sql2);		
		for ($i=0; $r_list = sql_fetch_array($result2); $i++)  {
			$r_print .= "<dt style='font-weight:none;'>&nbsp;&bull; <a href='{$g4[bbs_path]}/board.php?bo_table={$bo_table}&wr_id={$r_list[wr_id]}' style='color:#4d8cb0;'>{$r_list[wr_name]}";
			if($r_list[wr_9] > 1) $r_print .= "({$r_list[wr_9]})";
			if($r_list[wr_8] > 1) $r_print .=  "-{$r_list[wr_8]}박";
			if($r_list[wr_4] == "예약완료") $r_print .= $rstate_wan;
			if($r_list[wr_4] == "예약확인중") $r_print .= $rstate_dae;
			$r_print .= "</a></dt>";
		}
		$r_print .= "</div>";
	}

	return $r_print;
}

function Get_Date_Reserv($bo_table, $r_name, $time, $link_url) {
	global $g4, $bo_table, $write_table, $is_admin, $board_skin_path;
	
	$rstate_ye = "<img src='{$board_skin_path}/img_n/ye.gif' align='absmiddle' /> ";
	$rstate_wan = "<img src='{$board_skin_path}/img_n/wan.gif' align='absmiddle' /> ";
	$rstate_jen = "<img src='{$board_skin_path}/img_n/jen.gif' align='absmiddle' /> ";
	$rstate_dae = "<img src='{$board_skin_path}/img_n/dae.gif' align='absmiddle' /> ";
	$rstate_jong = "<img src='{$board_skin_path}/img_n/jong.gif' align='absmiddle' /> ";
	$rstate_bool = "<img src='{$board_skin_path}/img_n/bool.gif' align='absmiddle' /> ";

	$jtips = "";
	//$jtips = "<a href='{$board_skin_path}/list.jtips.php?bo_table={$bo_table}&pdate={$time}&r_name={$r_name}' class='jTip' id='{$time}{$r_name}' name='{$r_name} 예약 정보'>";
	$rstate_ye2 = $jtips . "<img src='{$board_skin_path}/img_n/ye.gif' align='absmiddle' /> " . "</a>";
	$rstate_wan2 = $jtips . "<img src='{$board_skin_path}/img_n/wan.gif' align='absmiddle' /> " . "</a>";
	$rstate_jen2 = $jtips . "<img src='{$board_skin_path}/img_n/jen.gif' align='absmiddle' /> " . "</a>";
	$rstate_dae2 = $jtips . "<img src='{$board_skin_path}/img_n/dae.gif' align='absmiddle' /> " . "</a>";
	$rstate_jong2 = $jtips . "<img src='{$board_skin_path}/img_n/jong.gif' align='absmiddle' /> " . "</a>";
	$rstate_bool2 = $jtips . "<img src='{$board_skin_path}/img_n/bool.gif' align='absmiddle' /> " . "</a>";

	$chk_sql = " SELECT sum(wr_9) as cnt FROM {$write_table} WHERE ca_name='$r_name' and wr_link1 <= '$time' and wr_link2 > '$time'";
	$chk_list = sql_fetch($chk_sql);
	if($chk_list[cnt]) {
		$rstate_ye = $rstate_ye2;
		$rstate_wan = $rstate_wan2;
		$rstate_jen = $rstate_jen2;
		$rstate_dae = $rstate_dae2;
		$rstate_jong = $rstate_jong2;
		$rstate_bool = $rstate_bool2;
	}

	//$r_name2 = "<span style='color:#000000;'>{$r_name}</span>";
	$r_name2 = "<span class='col_r_name'>{$r_name}</span>";
	$r_name_wan = "<span class='col_wan'>{$r_name}</span>";
	$r_name_dae = "<span class='col_dae'>{$r_name}</span>";

	$py = substr($time,0,4);
	$pm = substr($time,4,2);
	$pd = substr($time,6,2);
	$pdate = mktime(12,0,0,$pm,$pd,$py);

	$r_state = 0;
	
	if(Get_Date_Close($pdate,$r_name) == $r_name) {
		
		if($is_admin) $r_print = "{$rstate_bool}{$r_name2}";
			else $r_print = "{$rstate_wan}{$r_name_wan}";
			
	} else {
	
		$sql = " SELECT sum(wr_9) as cnt FROM {$write_table} WHERE ca_name='$r_name' and wr_4!='예약취소' and wr_link1 <= '$time' and wr_link2 > '$time'";
		$row = sql_fetch($sql);
		
		if(Get_Room_Info_One($bo_table, $r_name, 'over') == "O") {
			$r_state = Get_Room_Info_One($bo_table, $r_name, 'cnt') - $row[cnt]; // 예약취소를 제외한 갯수
			
			if($r_state >= 1) {
				$r_print = "{$rstate_ye}<a href='{$link_url}'>{$r_name2}({$r_state})</a>";
	
				if(Get_Date_Tel($pdate,$r_name) == $r_name) {
					if($is_admin) $r_print = "{$rstate_jen}<a href='{$link_url}'>{$r_name2}</a>";
						else $r_print = "{$rstate_jen}{$r_name2}";
				}
			} else {
				## 예약완료 갯수 Start
				$sql_wan = " SELECT sum(wr_9) as cnt FROM {$write_table} WHERE ca_name='$r_name' and wr_4='예약완료' and wr_link1 <= '$time' and wr_link2 > '$time'";
				$row_wan = sql_fetch($sql_wan);
			
				$r_state2 = Get_Room_Info_One($bo_table, $r_name, 'cnt') - $row_wan[cnt]; // 예약완료 갯수
				## 예약완료갯수 End
				
				if($r_state2 <= 0) {
					$r_print = "{$rstate_wan}{$r_name_wan}";
				} else {
					$r_print = "{$rstate_dae}{$r_name_dae}";
				}
			}
		} else {
			if($row[cnt]) {
				$sql2 = " SELECT wr_4 FROM {$write_table} WHERE ca_name='$r_name' and wr_4!='예약취소' and wr_link1 <= '$time' and wr_link2 > '$time'";
				$row2 = sql_fetch($sql2);
				if($row2['wr_4'] == "예약확인중") {
					$r_print = "{$rstate_dae}{$r_name_dae}";
				} else if($row2['wr_4'] == "예약완료") {
					$r_print = "{$rstate_wan}{$r_name_wan}";
				} else {
					$r_print = "{$rstate_wan}{$r_name_wan}";
				}
			} else {
				$r_print = "{$rstate_ye}<a href='{$link_url}'>{$r_name2}</a>";
				if(Get_Date_Tel($pdate,$r_name) == $r_name) {
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

function Get_Date_Reserv_Cnt($bo_table, $r_name, $time1, $time2) {
	global $bo_table, $write_table;

### 2009.7.27 중복기간 검사 수정
	$ori_r_cnt = Get_Room_Info_One($bo_table, $r_name, 'cnt');
	$j = 0;
	
	$sy = substr($time1,0,4);
	$sm = substr($time1,4,2);
	$sd = substr($time1,6,2);
	$sdate = mktime(12,0,0,$sm,$sd,$sy);
	
	$ey = substr($time2,0,4);
	$em = substr($time2,4,2);
	$ed = substr($time2,6,2);
	$edate = mktime(12,0,0,$em,$ed,$ey);
	
	for($i=$sdate; $i < $edate; $i += 86400) {
		$tdate = date("Ymd", $i);
		$sql = " SELECT sum(wr_9) as cnt FROM {$write_table} WHERE ca_name='$r_name' and wr_4!='예약취소' and wr_link1 <= '$tdate' and wr_link2 > '$tdate'";
		$row = sql_fetch($sql);
		if($ori_r_cnt <= $row[cnt]) {
			$r_state_full = 1;
			$j = $row[cnt];
			break;
		} else {
			if($row[cnt] > $j) {
				$j = $row[cnt];
			}
		}
	}

	$r_state = $ori_r_cnt - $j;

	return $r_state;
}

function Get_Date_Reserv_List_Pop($bo_table, $r_name, $time) {
	global $g4, $bo_table, $write_table, $is_admin, $board_skin_path;

	$py = substr($time,0,4);
	$pm = substr($time,4,2);
	$pd = substr($time,6,2);
	$pdate = mktime(12,0,0,$pm,$pd,$py);

	$r_print = "";
	$total1 = 0;
	$total2 = 0;
	$total3 = 0;
	$total_hap = 0;
	
	$sql = " SELECT sum(wr_9) as cnt FROM {$write_table} WHERE ca_name='$r_name' and wr_link1 <= '$time' and wr_link2 > '$time'";
	$row = sql_fetch($sql);

	if($row[cnt]) {
		$r_print .= "<div class='sjbox'><img src='{$board_skin_path}/img_n/ico_home.gif' align='absmiddle' />{$r_name}[{$row[cnt]}]</div>";
		
		$sql2 = " SELECT wr_3, ca_name, wr_name, wr_link1, wr_8, wr_7, wr_10, wr_2, wr_4, wr_datetime FROM {$write_table} WHERE  ca_name='$r_name' and wr_link1 <= '$time' and wr_link2 > '$time' ORDER BY wr_name, wr_datetime, wr_4 DESC ";
		$result2 = sql_query($sql2);
		
		$r_print .= "\n<table width='100%' border='0' cellpadding='3' cellspacing='1' bgcolor='#FFFFFF' class='conbox'>\n";
		$r_print .= "<tr align=center class='consjbox'><td>예약번호</td><td>객실명</td><td>예약자명</td><td>숙박일</td><td>추가인원</td><td>숙박요금</td><td>연락처</td><td>예약상태</td><td>작성일자</td></td></tr>\n";
		for ($i=0; $r_list = sql_fetch_array($result2); $i++)  {
			$j=($i)%2;
			$r_print .= "<tr align=center class='n_list{$j}'>\n";
			$r_print .= "<td>{$r_list[wr_3]}</td>"; //예약번호
			$r_print .= "<td>{$r_list[ca_name]}";
			if($r_list[wr_9] > 1) $r_print .= "({$r_list[wr_9]})";
			$r_print .= "</td>"; //객실명
			$r_print .= "<td>{$r_list[wr_name]}</td>"; //예약자명
			$from_date = substr($r_list[wr_link1],0,4).".".sprintf("%d",substr($r_list[wr_link1],4,2)).".".sprintf("%d",substr($r_list[wr_link1],6,2));
			$r_print .= "<td>{$from_date}({$r_list[wr_8]}박)</td>"; //숙박일
			$r_print .= "<td>{$r_list[wr_7]}</td>"; //추가인원
			$r_print .= "<td align=right style='padding-right:5px;'>".number_format($r_list[wr_10])."원</td>"; //숙박요금
			$r_print .= "<td>{$r_list[wr_2]}</td>"; //연락처
			$r_print .= "<td>{$r_list[wr_4]}</td>"; //예약상태
			$r_print .= "<td>".substr($r_list[wr_datetime],0,10)."</td>"; //작성일자
			$r_print .= "</td>\n";
			$r_print .= "</tr>\n";
			if($r_list[wr_4] == "예약완료") {
				$total1 += $r_list[wr_10];
			} else if($r_list[wr_4] == "예약취소") {
				$total3 += $r_list[wr_10];
			} else {
				$total2 += $r_list[wr_10];
			}
		}
		$r_print .= "</table>\n";
		
		$total_hap = $total1 + $total2 + $total3;
		$r_print .= "<div style='margin-bottom:20px; margin-top:-10px;'><table width='100%' border=0 cellpadding=0 cellspacing=0>
					<tr align=right><td>예약취소 합계 :</td><td width=80>".number_format($total3) . "원</td></tr>
					<tr align=right><td>예약대기 합계 :</td><td>".number_format($total2) . "원</td></tr>
					<tr align=right><td>예약완료 합계 :</td><td>".number_format($total1) . "원</td></tr>
					<tr align=right><td>총 합계 :</td><td>".number_format($total_hap) . "원</td></tr>
				</table></div>";
	}

	return $r_print;
}

function Get_Date_Reserv_List_Start_Pop($bo_table, $r_name, $time) {
	global $g4, $bo_table, $write_table, $is_admin, $board_skin_path;

	$py = substr($time,0,4);
	$pm = substr($time,4,2);
	$pd = substr($time,6,2);
	$pdate = mktime(12,0,0,$pm,$pd,$py);

	$r_print = "";
	$total1 = 0;
	$total2 = 0;
	$total3 = 0;
	$total_hap = 0;
	
	$sql = " SELECT sum(wr_9) as cnt FROM {$write_table} WHERE ca_name='$r_name' and wr_link1 = '$time'";
	$row = sql_fetch($sql);

	if($row[cnt]) {
		$r_print .= "<div class='sjbox'><img src='{$board_skin_path}/img_n/ico_home.gif' align='absmiddle' />{$r_name}[{$row[cnt]}]</div>";
		
		$sql2 = " SELECT wr_3, ca_name, wr_9, wr_name, wr_link1, wr_8, wr_7, wr_10, wr_2, wr_4, wr_datetime FROM {$write_table} WHERE wr_link1 = '$time' and ca_name='$r_name' ORDER BY wr_name, wr_datetime, wr_4 DESC ";
		$result2 = sql_query($sql2);
		
		$r_print .= "\n<table width='100%' border='0' cellpadding='3' cellspacing='1' bgcolor='#FFFFFF' class='conbox'>\n";
		$r_print .= "<tr align=center class='consjbox'><td>예약번호</td><td>객실명</td><td>예약자명</td><td>숙박일</td><td>추가인원</td><td>숙박요금</td><td>연락처</td><td>예약상태</td><td>작성일자</td></td></tr>\n";
		for ($i=0; $r_list = sql_fetch_array($result2); $i++)  {
			$j=($i)%2;
			$r_print .= "<tr align=center class='n_list{$j}'>\n";
			$r_print .= "<td>{$r_list[wr_3]}</td>"; //예약번호
			$r_print .= "<td>{$r_list[ca_name]}";
			if($r_list[wr_9] > 1) $r_print .= "({$r_list[wr_9]})";
			$r_print .= "</td>"; //객실명
			$r_print .= "<td>{$r_list[wr_name]}</td>"; //예약자명
			$from_date = substr($r_list[wr_link1],0,4).".".sprintf("%d",substr($r_list[wr_link1],4,2)).".".sprintf("%d",substr($r_list[wr_link1],6,2));
			$r_print .= "<td>{$from_date}({$r_list[wr_8]}박)</td>"; //숙박일
			$r_print .= "<td>{$r_list[wr_7]}</td>"; //추가인원
			$r_print .= "<td align=right style='padding-right:5px;'>".number_format($r_list[wr_10])."원</td>"; //숙박요금
			$r_print .= "<td>{$r_list[wr_2]}</td>"; //연락처
			$r_print .= "<td>{$r_list[wr_4]}</td>"; //예약상태
			$r_print .= "<td>".substr($r_list[wr_datetime],0,10)."</td>"; //작성일자
			$r_print .= "</td>\n";
			$r_print .= "</tr>\n";
			if($r_list[wr_4] == "예약완료") {
				$total1 += $r_list[wr_10];
			} else if($r_list[wr_4] == "예약취소") {
				$total3 += $r_list[wr_10];
			} else {
				$total2 += $r_list[wr_10];
			}
		}
		$r_print .= "</table>\n";
		
		$total_hap = $total1 + $total2 + $total3;
		$r_print .= "<div style='margin-bottom:20px; margin-top:-10px;'><table width='100%' border=0 cellpadding=0 cellspacing=0>
					<tr align=right><td>예약취소 합계 :</td><td width=80>".number_format($total3) . "원</td></tr>
					<tr align=right><td>예약대기 합계 :</td><td>".number_format($total2) . "원</td></tr>
					<tr align=right><td>예약완료 합계 :</td><td>".number_format($total1) . "원</td></tr>
					<tr align=right><td>총 합계 :</td><td>".number_format($total_hap) . "원</td></tr>
				</table></div>";
	}

	return $r_print;
}

$css[btn] = "ui-button ui-state-default";
$css[table] = "ui-widget-content";
$css[tr] = "ht center ui-state-default";
$css[td] = "ht center";

$css[no_table] = "<div class='$css[table]' style='padding:50px 0; text-align:center;'>테이블이 생성되지 않았습니다.</div>";
?>
