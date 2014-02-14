<?php
// 예약 문자 발송
// 예약 완료후 이동할 페이지 지정.
$goto_url = $g4[path] . "/reserv/chkReserv.php?wr_3=" . $wr_3;

	/* 문자 전송 */
	include_once("$g4[path]/sms/nusoap_tong.php");

	// 문자메세지 받는 사람 3명(예약자, 펜션관리자, 스테이스토어)
	$phone[0] = "";
	$phone[1] = "";
	$phone[2] = "";

	// 예약자 번호
	$tel0 = explode( "-", $wr_2 );
	for($i=0; $i < count($tel0); $i++) {
		$phone[0] .= $tel0[$i];
	}

	// 스테이스토어
	$tel1 = explode( "-", get_text($config[cf_7]) );
	for($i=0; $i < count($tel1); $i++) {
		$phone[1] .= $tel1[$i];
	}

	// 펜션관리자
	$pen_tel = sql_fetch(" SELECT * FROM g4_write_pension_info WHERE pension_id = '$pension_id' LIMIT 1 ");
	$tel2 = explode( "-", $pen_tel['wr_phone1'] );
	for($i=0; $i < count($tel2); $i++) {
		$phone[2] .= $tel2[$i];
	}

	$snd_number = get_text($config[cf_7]);		// 보내는 사람 번호를 받음
	// $rcv_number = join(",", $phone); 				// 받는 사람 번호
	$rcv_number1 = $phone[1];
	$rcv_number2 = $phone[2];
	$rcv_number3 = $phone[0];

	//$sms_content  = "{$pen_tel[wr_subject]} 예약접수:{$wr_name} / 예약번호:{$wr_3} / {$wr_10}원 / http://staystore.co.kr";	 // 전송 내용을 받음
	$cntR = count($wr_link1);
	$smsDate = substr($wr_link1[0],4,2) . "-" . substr($wr_link1[0],6,2);
	$bankNum = get_text($config[cf_1]);
	$resCost = number_format($wr_10);

	$rName = cut_str($ca_name[0], 12, "…"); // 객실명
	$pName = cut_str($pen_tel[wr_subject], 12, "…"); // 객실명

	if($wr_7[0] == "2" || $wr_7[0] == "3") {
		// 카드결제
		$sms_content1  = "StayStore 예약대기중/{$rName}/{$smsDate}({$cntR})/{$wr_name}/{$wr_1[0]}명/{$resCost}원";	 // 펜션용
		$sms_content2  = $sms_content1;	 // 회사용
		$sms_content3  = "StayStore 예약대기중/{$pName}/{$rName}/{$smsDate}({$cntR})/{$wr_1[0]}명/예약번호:{$wr_3}";	 // 고객용
	}  else {
		//무통장 입금
		$sms_content1  = "StayStore 예약대기중/{$rName}/{$smsDate}($cntR)/{$wr_name}/{$wr_1[0]}명/{$resCost}원";	 // 펜션용
		$sms_content2  = $sms_content1;	 // 회사용
		$sms_content3  = "StayStore 계좌:{$bankNum}/입금액:{$resCost}원/{$wr_3}";	 // 고객용
	}
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
	// $result=$sms->SendSMS($sms_id,$sms_pwd,$snd_number,$rcv_number,$sms_content); // 5개의 인자로 함수를 호출합니다.
	$result=$sms->SendSMS($sms_id,$sms_pwd,$snd_number,$rcv_number1,$sms_content1); // 5개의 인자로 함수를 호출합니다.
	$result=$sms->SendSMS($sms_id,$sms_pwd,$snd_number,$rcv_number2,$sms_content2); // 5개의 인자로 함수를 호출합니다.
	$result=$sms->SendSMS($sms_id,$sms_pwd,$snd_number,$rcv_number3,$sms_content3); // 5개의 인자로 함수를 호출합니다.
?>
<form name='resform1' method='post' enctype='multipart/form-data' style='margin:0px;' accept-charset="UTF-8">
<input type="hidden" name="wr_3" value="<?=$wr_3?>" />
<input type="hidden" name="wr_name" value="<?=$wr_name?>" />
<input type="hidden" name="wr_password" value="<?=$wr_6?>" />
<input type="hidden" name=null />
<input type="hidden" name="type" value="resrv" />
<input type="hidden" name="bo_table" value="bbs34" />
</form>
<script type="text/javascript">
function resform_submit(f)
{
    f.action = "<?=$g4[path]?>/reserv/chkReserv.php";
    f.submit();
}
resform_submit(document.resform1);
</script>
