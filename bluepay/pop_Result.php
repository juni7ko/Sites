<?php
    /*
		 * =============================================
		 * Filename	:	pop_Result.php
		 * Function	:	Bluepay 팝업 결제 후, 팝업에서 이동하는 페이지(PGNW 사용업체 배포용)
		 * Author	:	All contents Copyright 2013 Bankwell Co. all rights reserved
		 * =============================================
		 */


		/*
     * 결제 결과 파라미터
     */
    $BKW_RESULTCD       = $_POST["BKW_RESULTCD"];
    $BKW_RESULTMSG      = $_POST["BKW_RESULTMSG"];
    $BKW_TRADENO        = $_POST["BKW_TRADENO"];
    $BKW_PAYTYPE        = $_POST["BKW_PAYTYPE"];
    $BKW_AUTHDATE       = $_POST["BKW_AUTHDATE"];
    $BKW_AMOUNT        	= $_POST["BKW_AMOUNT"];
    $BKW_BANKNM         = $_POST["BKW_BANKNM"];
    $BKW_BANKACCOUNT    = $_POST["BKW_BANKACCOUNT"];
    $BKW_PHONENO        = $_POST["BKW_PHONENO"];
    $BKW_PHONECOMMTYPE  = $_POST["BKW_PHONECOMMTYPE"];
    $BKW_AUTHNO         = $_POST["BKW_AUTHNO"];
    $BKW_CARDNAME       = $_POST["BKW_CARDNAME"];
    $BKW_QUOTA         	= $_POST["BKW_QUOTA"];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>BLUEPAY RESULT</title>
		<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
		<script language="javascript" type="text/javascript" src="https://pay.bluepay.co.kr/Script/BluePayAPI.js"></script>
		<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
	</head>
	<body onload="javascript:Pay_Result_PGNW();">
		<form name="BLUEPAY_FORM">
		<!--공통 파라미터-->
		<input type="hidden" name='BKW_RESULTCD'  value="<?=$BKW_RESULTCD?>">   <!--// 승인결과코드 0000 성공  0000이외 오류 -->
		<input type="hidden" name='BKW_RESULTMSG'  value="<?=$BKW_RESULTMSG?>"> <!--// 결과 메세지-->
		<input type="hidden" name='BKW_TRADENO'  value="<?=$BKW_TRADENO?>">   	<!--// 뱅크웰 결제 고유번호-->
		<input type="hidden" name='BKW_PAYTYPE'  value="<?=$BKW_PAYTYPE?>">   	<!--// 결제수단-->

		<input type="hidden" name='BKW_AUTHDATE'  value="<?=$BKW_AUTHDATE?>">   	<!--// 승인일자-->
		<input type="hidden" name='BKW_AMOUNT'  value="<?=$BKW_AMOUNT?>">   			<!--// 승인금액-->

		<!--계좌이체 가상계좌-->
		<input type="hidden" name='BKW_BANKNM'  value="<?=$BKW_BANKNM?>">         	<!--// 은행이름-->
		<input type="hidden" name='BKW_BANKACCOUNT'  value="<?=$BKW_BANKACCOUNT?>">	<!--// 은행계좌-->

		<!--헨드폰소액 ARS-->
		<input type="hidden" name='BKW_PHONENO'  value="<?=$BKW_PHONENO?>">              <!--// 헨드폰소액 전화번호-->
		<input type="hidden" name='BKW_PHONECOMMTYPE'  value="<?=$BKW_PHONECOMMTYPE?>">  <!--// 헨드폰소액 통신사-->

		<!--CARD-->
		<input type="hidden" name='BKW_AUTHNO'  value="<?=$BKW_AUTHNO?>">       <!--// 승인번호-->
		<input type="hidden" name='BKW_CARDNAME'  value="<?=$BKW_CARDNAME?>">  	<!--// 카드번호-->
		<input type="hidden" name='BKW_QUOTA'  value="<?=$BKW_QUOTA?>">         <!--// 할부개월 00 일시불 02 2개월-->
		</form>
		<input type="button" onclick="Pay_Result_PGNW();" value="확인">
	</body>
</html>