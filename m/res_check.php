<?php include_once("./_common.php");
// 예약확인
if (!$wr_3 || !$wr_6) alert_and_back("예약정보가 입력되지 않았습니다.");

function alert_and_back($msg){ 
        echo("<script language=javascript> 
                <!-- 
                        alert('$msg'); 
                        history.back(); 
                //--> 
                </script>"); 
} 



$write_table = "g4_write_bbs34";

// 예약내용이 있는지 확인 
if($type == "code") {
	$query = "select * from $write_table WHERE wr_3 = '$wr_3' and wr_6 = '$wr_6' ORDER BY wr_id ASC"; 
} else if($type == "id") {
	$query = "select * from $write_table WHERE 	mb_id = '$wr_3'  and wr_6 = '$wr_6' ORDER BY wr_id ASC LIMIT 1";
} else {
	$res_error = 1; 
}
//echo $query;
//$query = "select * from $write_table WHERE wr_3 = '$wr_3' ORDER BY wr_id ASC"; 
$result = mysql_query($query); 
$tmp_total = mysql_num_rows($result); 

if($tmp_total == 0){
  $res_error = 1;
} else {
	for($i = 0; $i < $tmp_total; $i++){ 
		$rows = mysql_fetch_array($result); 

		if($type == "code") {
			if($wr_3 == $rows[wr_3] && $wr_6 == $rows[wr_6]) { 
					goto_url("./1_3.php?bo_table=$bo_table&wr_id=$rows[wr_id]" . $qstr);
			} else { 
					$res_error = 1; 
			} 
		} else if($type == "id") {
			if($wr_3 == $rows[mb_id] && $wr_6 == $rows[wr_6]) { 
					goto_url("./1_3.php?bo_table=$bo_table&wr_id=$rows[wr_id]" . $qstr);
			} else { 
					$res_error = 1; 
			} 
		}
/*
		if($wr_3 == $rows[wr_3] && $wr_6 == $rows[wr_6]) { 
				//echo $rows[wr_id]."<br>";
				//echo $bo_table."<br>";
				//echo "./view.php?bo_table=".$bo_table."&wr_id=".$rows[wr_id];
				goto_url("./board.php?bo_table=$bo_table&wr_id=$rows[wr_id]" . $qstr);
		} else { 
				$res_error = 1; 
		}
*/
	}
}
if($res_error){ 
    $msg = '검색하신 것과 일치하는 예약내용이 없습니다. \n\n다시 확인해 주십시오. \n\n확인을 누르시면 뒤로 돌아갑니다'; 
    alert_and_back($msg); 
    exit; 
} 

?>
