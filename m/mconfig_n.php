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
//아이콘
/*
	$rstate_ye = "<img src='{$board_skin_path}/img_n/ye.gif' align='absmiddle' /> ";
	$rstate_wan = "<img src='{$board_skin_path}/img_n/wan.gif' align='absmiddle' /> ";
	$rstate_jen = "<img src='{$board_skin_path}/img_n/jen.gif' align='absmiddle' /> ";
	$rstate_dae = "<img src='{$board_skin_path}/img_n/dae.gif' align='absmiddle' /> ";
	$rstate_jong = "<img src='{$board_skin_path}/img_n/jong.gif' align='absmiddle' /> ";
	$rstate_bool = "<img src='{$board_skin_path}/img_n/bool.gif' align='absmiddle' /> ";
*/
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
		$row2[wr_4] = "";
		for($i=0; $i < count($rd_day); $i++) {
			if($rd_day[$i][ca_name] == $r_name && $rd_day[$i][wr_link1] <= $time && $rd_day[$i][wr_link2] > $time) {
				$row[cnt] += $rd_day[$i][wr_9];
				if($rd_day[$i][wr_4] == "예약완료")
					$row_wan[cnt] += $rd_day[$i][wr_9];
				$row2[wr_4] = $rd_day[$i][wr_4];
			}
		}

		if(Get_Room_Info_One2($bo_table, $r_name, 'over') == "O") {
			$r_state = Get_Room_Info_One2($bo_table, $r_name, 'cnt') - $row[cnt]; // 예약취소를 제외한 갯수
			
			if($r_state >= 1) {
				
				$free = 1;
				//if($is_admin)
				//	$r_print = "{$rstate_ye}<a href='{$link_url}'>{$r_name2}({$r_state})</a>";
				//else
	//				$r_print = "{$rstate_ye}<a href='{$link_url}'>{$r_name2}</a>";         // 링크삭제
					$r_print = "{$r_name2}";



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
				if($row2[wr_4] == "예약확인중") {
					$r_print = "{$rstate_dae}{$r_name_dae}";
				} else if($row2[wr_4] == "예약완료") {
					$r_print = "{$rstate_wan}{$r_name_wan}";
				} else {
					$r_print = "{$rstate_wan}{$r_name_wan}";
				}
			} else {
				$free = 1;
				$r_print = "{$rstate_ye}<a href='{$link_url}'>{$r_name2}</a>";
				if(Get_Date_Tel2($pdate,$r_name) == $r_name) {
					if($is_admin) $r_print = "{$rstate_jen}<a href='{$link_url}'>{$r_name2}</a>";
						else $r_print = "{$rstate_jen}{$r_name2}";
				}
			}
		}

	}

	if($is_admin && $row[cnt]) $r_print .= "<a href='{$g4[bbs_path]}/board.php?view_mode=list&bo_table={$bo_table}&sca={$r_name}&sfl=wr_link1&sop=and&stx={$time}' style='color:blue;'>[" . $row[cnt] . "]</a>";
	
//	$r_print = "<dt>" . $r_print . "</dt>";
	
 // 남은 객실 갯수

//echo "완료 = ".$row[cnt];

if($free) {

$r_print ="

<tr>
	<!-- <td>
	<input type='checkbox' name='chkroom[]' value='1'>
		</td> -->
	<input type='hidden' name='r_name[]' value='$r_name'>

	<td>
" . $r_print . "
		</td>
		<td>
			<select name='date[]' class='pilsu'>
				<option value='0'>숙박일선택</option>
				<option value='1'>1박 2일</option>
				<option value='2'>2박 3일</option>
				<option value='3'>3박 4일</option>
				<option value='4'>4박 5일</option>
				<option value='5'>5박 6일</option>
				<option value='6'>6박 7일</option>
				<option value='7'>7박 8일</option>
				<option value='8'>8박 9일</option>
				<option value='9'>9박 10일</option>
				<option value='10'>10박 11일</option>
			</select>
		</td>
		<td>
			<select name='p1[]' class='sel2'>
				<option value='0'>객실수선택</option>
				<option value='1' selected>1</option>
				<option value='2'>2</option>
				<option value='3'>3</option>
				<option value='4'>4</option>
				<option value='5'>5</option>
			</select>
		</td>
		<td>
			<select name='p2[]'>
				<option value='0'>없음</option>
				<option value='1'>1명</option>
				<option value='2'>2명</option>
				<option value='3'>3명</option>
				<option value='4'>4명</option>
				<option value='5'>5명</option>
			</select>
		</td>
		<!-- <td>-  </td>    -->
		</tr>
";

}else{

$r_print ="
<tr>
	<!-- <td>
	<input type='checkbox' name='r_sel' disabled>
	</td> -->
	<td>
			<u>  " . $r_print . " </u>
	</td>
		<td>
				 완료
		</td>
		<td>
				완료
		</td>
		<td>
				완료
		</td>
		<!-- <td>-  </td>    -->
		</tr>

";

}



	return $r_print;

}
?>
