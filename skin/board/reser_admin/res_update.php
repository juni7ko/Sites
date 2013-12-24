<?php include_once "_common.php";
include_once "$g4[path]/head.sub.php";

if($is_admin) {
	$sql = " update $write_table set wr_4 = '$wr_4' where wr_id = '$wr_id' ";
	sql_query($sql);

	$f_year = substr($write[wr_link1],0,4);
	$f_mon = substr($write[wr_link1],4,2);
	$f_day = substr($write[wr_link1],6,2);
	$t_year = substr($write[wr_link2],0,4);
	$t_mon = substr($write[wr_link2],4,2);
	$t_day = substr($write[wr_link2],6,2);

	if($wr_4 == "예약완료") {
		$en_msg1 = urlencode("예약완료:{$write[wr_name]}{$write[wr_link1]}~{$t_mon}{$t_day}{$write[ca_name]}, http://gyungpopension.co.kr");
	} else if($wr_4 == "예약취소") {
		//$en_msg1 = urlencode("예약이 취소되었습니다. 재 예약을 원하시면 전화주세요. http://gyungpopension.co.kr");
	}

	if($en_msg1) {
		$mid = "interfo";
	    $mpwd = "d2cc689dccc2c1733d9446b8a54e8b63";
		$t_tel = explode("-",$write[wr_2]);
		$tel = "";
		for($i=0; $i < count($t_tel); $i++) {
			$tel .= $t_tel[$i];
		}
		$mreceivers = $tel;
//		$msender = "01096968112";
		
		if($g4['sms']){
			$msender = $g4['sms'];
		}else{
			$msender = "01096968112";
		}
	
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

	alert("수정되었습니다.","$g4[bbs_path]/board.php?bo_table=$bo_table&wr_id=$wr_id");
}

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

include_once "$g4[path]/tail.sub.php";
?>
