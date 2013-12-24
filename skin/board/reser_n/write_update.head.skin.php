<?php
// 자신만의 코드를 넣어주세요.
include_once ("$board_skin_path/config.php");

if($w != "u") {

	function alert_and_back($msg){ 
		echo("<script language=javascript> 
			<!-- 
			alert('$msg'); 
			history.back(); 
			//--> 
			</script>"); 
	}

	// 사용시간이 겹치는지 확인
	if(!$wr_9) $wr_9 = 1;

	//if(Get_Room_Info_One($bo_table, $ca_name, 'over') == "O") {
	if(Get_Date_Reserv_Cnt($bo_table, $ca_name, $wr_link1, $wr_link2) < $wr_9) {
		$ca_error = 1;
	}

	$py = substr($wr_link1,0,4);
	$pm = substr($wr_link1,4,2);
	$pd = substr($wr_link1,6,2);
	$pdate = mktime(12,0,0,$pm,$pd,$py);

	$py2 = substr($wr_link2,0,4);
	$pm2 = substr($wr_link2,4,2);
	$pd2 = substr($wr_link2,6,2);
	$pdate2 = mktime(12,0,0,$pm2,$pd2,$py2);

	for($i=$pdate; $i<$pdate2; $i += 86400) {

		if(Get_Date_Close($i,$ca_name) == $ca_name) {
			$ca_error = 1;
			break;
		}
	}

	if($ca_error){ 
			$msg = '예약할 수 없는 날짜입니다! \n\n다른 분이 예약하신 날짜와 겹칩니다! \n\n예약일자를 다시 확인해 주십시오'; 
			alert_and_back($msg); 
			exit; 
	}
}

//전화번호 
$wr_2 = "$tel1-$tel2-$tel3";

$sql = "UPDATE $write_table 
            SET wr_2   = '$wr_2'
            WHERE wr_id = '$wr_id' ";
sql_query($sql);

?>
<SCRIPT language="JavaScript" type="text/javascript">
<!-- Overture Korea
window.ysm_customData = new Object();
window.ysm_customData.conversion = "transId=,currency=,amount=";
var ysm_accountid  = "1OCCO2V2KSVIFVLM4ULHQFL83N4";
document.write("<SCR" + "IPT language='JavaScript' type='text/javascript' " + "SRC=//" + "srv1.wa.marketingsolutions.yahoo.com" + "/script/ScriptServlet" + "?aid=" + ysm_accountid + "></SCR" + "IPT>");
// -->
</SCRIPT>
