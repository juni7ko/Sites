<?php
include_once "_common.php";
include_once "$g4[path]/head.sub.php";
include_once "$g4[path]/sms/nusoap_tong.php";
?>
<script language="javascript" type="text/javascript" src="https://pay.bluepay.co.kr/Script/BluePayAPI.js"></script>
<?php
if( $ordr_idxx && $BKW_RESULTCD == "0000") {
	sql_query( " INSERT INTO bluepay (`order_idxx`, `BKW_TRADENO`, `BKW_RESULTCD`, `BKW_RESULTMSG`, `BKW_PAYTYPE`) VALUES ('$ordr_idxx', '$BKW_TRADENO', '$BKW_RESULTCD', '$BKW_RESULTMSG', '$BKW_PAYTYPE');");

	$rResult = "0020";
	sql_query(" UPDATE g4_write_bbs34 SET rResult = '$rResult' WHERE wr_3 = '$ordr_idxx' ");

	// 예약완료 문자 다듬기.
	// $f_year = substr($write[wr_link1],0,4);
	// $f_mon = substr($write[wr_link1],4,2);
	// $f_day = substr($write[wr_link1],6,2);

	$pen_tel = sql_fetch(" SELECT * FROM g4_write_pension_info WHERE pension_id = '$goodoption1' LIMIT 1 ");

	if($rResult == "0020") { // 예약완료
		//$sms_content = urlencode("예약완료:{$write[wr_name]}{$write[wr_link1]} {$write[ca_name]}, http://staystore.co.kr");
		$sms_content = "{$pen_tel[wr_subject]} 예약완료 / 예약번호:{$ordr_idxx} / {$good_mny}원 / http://staystore.co.kr";
	} else if($rResult == "0030") { // 예약취소
		$sms_content = "{$pen_tel[wr_subject]} 예약취소 / 예약번호:{$ordr_idxx} / {$good_mny}원 / http://staystore.co.kr";
	}

	if($sms_content) {
		/* 문자 전송 */
		// 문자메세지 받는 사람 3명(예약자, 펜션관리자, 스테이스토어)
		$phone[0] = "";
		$phone[1] = "";
		$phone[2] = "";

		// 예약자 번호
		$tel0 = explode( "-", $buyr_tel1 );
		for($i=0; $i < count($tel0); $i++) {
			$phone[0] .= $tel0[$i];
		}

		// 스테이스토어
		$tel1 = explode( "-", get_text($config[cf_7]) );
		for($i=0; $i < count($tel1); $i++) {
			$phone[1] .= $tel1[$i];
		}

		// 펜션관리자
		$tel2 = explode( "-", $pen_tel['wr_phone1'] );
		for($i=0; $i < count($tel2); $i++) {
			$phone[2] .= $tel2[$i];
		}

		$snd_number   = get_text($config[cf_7]);		// 보내는 사람 번호를 받음
		$rcv_number   = join(",", $phone); 				// 받는 사람 번호
		$sms_content  = $sms_content;
		$reserve_date = "";			// 예약 일자를 받음
		$reserve_time = "";			// 예약 시간을 받음

		/******고객님 접속 정보************/
		$sms_id="interfo";			//고객님께서 부여 받으신 sms_id
		$sms_pwd="interfo6718";		//고객님께서 부여 받으신 sms_pwd
		/**********************************/
		$callbackURL = "sms.tongkni.co.kr";
		$userdefine = $sms_id;		//예약취소를 위해 넣어주는 구분자 정의값, 사용자 임의로 지정해주시면 됩니다. 영문으로 넣어주셔야 합니다. 사용자가 구분할 수 있는 값을 넣어주세요.
		$canclemode = "1";			//예약 취소 모드 1: 사용자정의값에 의한 삭제.  현제는 무조건 1을 넣어주시면 됩니다.

		//구축 테스트 주소와 일반 웹서비스 선택
		if (substr($sms_id,0,3) == "bt_"){
			$webService = "http://webservice.tongkni.co.kr/sms.3.bt/ServiceSMS_bt.asmx?WSDL";
		}
		else{
			$webService = "http://webservice.tongkni.co.kr/sms.3/ServiceSMS.asmx?WSDL";
		}

		$sms = new SMS($webService); //SMS 객체 생성
		/*즉시 전송으로 구성하실경우*/
		$result=$sms->SendSMS($sms_id,$sms_pwd,$snd_number,$rcv_number,$sms_content); // 5개의 인자로 함수를 호출합니다.
	}
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
?>
<form name='resform1' method='post' enctype='multipart/form-data' style='margin:0px;' accept-charset="UTF-8">
<input type="hidden" name="wr_3" value="<?=$ordr_idxx?>" />
<input type="hidden" name="type" value="resrv" />
<input type="hidden" name="bo_table" value="bbs34" />
<input type="hidden" name="BKW_TRADENO" value="<?=$_POST['BKW_TRADENO']?>" />
<input type="hidden" name="BKW_RESULTCD" value="<?=$_POST['BKW_RESULTCD']?>" />
<input type="hidden" name="BKW_RESULTMSG" value="<?=$_POST['BKW_RESULTMSG']?>" />
<input type="hidden" name="BKW_PAYTYPE" value="<?=$_POST['BKW_PAYTYPE']?>" />
</form>
<script type="text/javascript">
function resform_submit(f)
{
    f.action = "<?=$g4[path]?>/reserv/chkReserv.php";
    f.submit();
}
resform_submit(document.resform1);
</script>
<?php
include_once "$g4[path]/tail.sub.php";
?>
