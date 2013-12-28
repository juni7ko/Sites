<?php if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

	function alert_and_back($msg){
		echo("<script language=javascript>
			<!--
			alert('$msg');
			history.back();
			//-->
			</script>");
	}

	for($i=0; $i < $res2_roomCount; $i++)
	{
		$chkSql = " SELECT * FROM {$write_table2} WHERE pension_id = '$pension_id' AND r_info_id = '$res2_r_info_id[$i]' AND wr_link2 = '$res2_rDateTmp[$i]' LIMIT 1 ";
		$chkRoom = sql_fetch($chkSql);

		if($chkRoom)
		{
			$errCode = 1;
			break;
		}
		echo $errCode . "<br />";
	}

	if($errCode)
	{
		$msg = '예약할 수 없는 날짜입니다! \n\n다른 분이 예약하신 날짜와 겹칩니다! \n\n예약일자를 다시 확인해 주십시오';
		alert_and_back($msg);
		exit;
	}
?>
