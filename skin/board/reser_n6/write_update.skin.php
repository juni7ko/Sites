<?php
// 자신만의 코드를 넣어주세요.
$sql_table = "g4_write_" . $bo_table;
sql_query(" ALTER TABLE $sql_table ADD `wr_reserv` text NOT NULL ", FALSE);

$wr_res = addslashes($wr_reserv);
$sql = "UPDATE $write_table SET wr_reserv = '$wr_res', wr_password = password('$wr_6') WHERE wr_id = '$wr_id' ";
sql_query($sql);

if($wr_name2) {
	$wr_name = $wr_name2;
	$sql = "UPDATE $write_table SET wr_name='$wr_name2' WHERE wr_id = '$wr_id' ";
	sql_query($sql);
}

/*
if(!$w) {
	$mid = "";
	$mpwd = "";
	$t_tel = explode("-",$wr_2);
	$tel = "";
	for($i=0; $i < count($t_tel); $i++) {
		$tel .= $t_tel[$i];
	}
	$mreceivers = $tel;
	$msender = "01088599023";
	$en_msg1 = urlencode("예약번호:".$wr_3."/금액:".$wr_10."/".$wr_name."님의예약접수.");
	$url = "http://sms.nicesms.co.kr/cpsms/cpsms.aspx?userid=".$mid."&password=".$mpwd."&msgcnt=1&msg1=".$en_msg1."&receivers=".$mreceivers."&sender=".$msender."&resflag=N";
	
	$result = Array();

	$result = GetResultFromURL($url);   // "결과 출력 형식" 참조

	if($result['result'] == 'OK')
	{
	echo "전송 성공";
	}else {
	echo "전송실패<br>";
	echo "실패원인:". $result['MSG'];
	}
}
*/
function GetResultFromURL($url) 
{
	$socket = NULL;
	$port = 80;

	$arr_tmp_url1 = explode('?', $url, 2);

	$tmp_url = str_replace('http://', '', $arr_tmp_url1[0]);
	$arr_tmp_url2 = explode('/', $tmp_url, 2);		

	$host = $arr_tmp_url2[0];
	$uri = '/'.$arr_tmp_url2[1];

	if ($host == '' || $uri == '')
	{
		echo "에러 : URL이 명확하지 않습니다. ";
		exit;
	}

	$request_value = $arr_tmp_url1[1];

	$content_length = strlen($request_value);

	$request_header  = "POST ".$uri." HTTP/1.1\r\n";
	$request_header .= "Host: ".$host."\r\n";
	$request_header .= "User-Agent: nice\r\n";
	$request_header .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$request_header .= "Content-Length: ".$content_length."\r\n";
	$request_header .= "\r\n";
	$request_header .= $request_value;

	@$socket = fsockopen($host, $port, $errno, $errstr);
	if (!$socket)
	{
		echo "에러 : 소켓 열기 실패";
		exit;
	}
	else
	{
		socket_set_timeout($socket, 100);
		fwrite($socket, $request_header);
		do
		{
			$header .= fread($socket, 1);
		}
		while (!preg_match('/\\r\\n\\r\\n$/', $header));

		if (preg_match('/Transfer\\-Encoding:\\s+chunked\\r\\n/', $header))
		{
			do
			{
				$byte = '';
				$chunk_size = '';

				do
				{
					$chunk_size .= $byte;
					$byte = fread($socket, 1);
				}
				while ($byte != "\\r");

				fread($socket, 1);
				$chunk_size = hexdec($chunk_size);
				$response .= fread($socket, $chunk_size);
				fread($socket, 2);
			}
			while ($chunk_size);
		}
		else
		{
			if (preg_match('/Content\\-Length:\\s+([0-9]*)\\r\\n/', $header, $matches))
			{
				$bytesToRead = &$matches[1];
				$buffer = null;

				while($bytesToRead>0)
				{
					$buffer = fread($socket, $bytesToRead);
					$response .= $buffer;
					$bytesToRead -= strlen($buffer);
				}
			}
			else
			{
				while(!feof($socket))
				{
					$response .= fread($socket, 4096);
				}
			}
	   }

		if ($socket != NULL)
		{
			fclose($socket);
			$socket = NULL;
		}
	}

	$result = trim($response);

	parse_str($result, $arrayResult);

	return $arrayResult;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="JavaScript">
var line0 = '---------------------------------------';
var ment1 = '정상적으로 접수처리 되었습니다.';
var ment2 = '귀하의 예약코드는 <?=$wr_3?> 입니다.';
var ment3 = '예약확인을 위해 꼭 기억하시기 바랍니다.';
var ment4 = '예약금을 결재하시면 예약이 완료됩니다.';
var ment5 = '기타 문의사항은 전화주시면 친절히 안내해 드립니다.';
alert("\n"+ment1+" \n\n"+line0+" \n"+ment2+" \n"+line0+" \n\n"+ment3+" \n\n"+ment4+" \n\n"+ment5+"");
window.location='<?=$g4[bbs_path]?>/board.php?bo_table=<?=$bo_table?>';
</script>
</head>

<body>
</body>
</html>
