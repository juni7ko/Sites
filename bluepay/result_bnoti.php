<?
	 /*
	  * ================================================================================================
	  * Filename	:	result_bnoti.php
	  * Function	:	결제결과 공통통보 페이지.
	  							뱅크웰(PG사)에서 승인 결과를 받아 쇼핑몰 DB에 처리하는 페이지
	  * Author		:	All contents Copyright 2013 Bankwell Co. all rights reserved
	  * ================================================================================================
	  */

	 /*
	  * ================================================================================================
	  *	result_bnoti.php를 호출할때 인자로 넘어오는 구성요소

	   * 결제수단과 상관없이 공통적으로 넘어오는 변수
	    1. BKW_RESULTCD			  : 응답코드로 '0000'이면 정상 그외는 에러처리한다.
	    2. BKW_RESULTMSG			: 응답메시지
	    3. BKW_TRADENO				: 뱅크웰(PG사) 고유 거래번호
	    4. BKW_AUTHDATE			  : 승인일시(YYYYMMDDhhmmss)
	    5. BKW_AMOUNT				  : 승인금액
	    6. BKW_PAYTYPE				: 결제수단(PA11:신용카드, PA03:계좌이체, PA10:가상계좌, PA08:휴대폰소액결제, PA01:전화결제_폰빌)
	    7. BKW_SHOP_ORDER_NO	: 쇼핑몰 주문번호
	    8. BKW_SITECD				  : 쇼핑몰 사이트코드

	   * 가상계좌 관련 변수
	    9. BKW_BANKNM				  : 가상계좌 발급은행명
	   10. BKW_BANKACCOUNT		: 가상계좌 발급계좌번호
	   11. BKW_IPKUMSTATUS		: 가상계좌 입금상태(IM03: 입금대기, IM01:입금완료)
	   12. BKW_IPKUMUSERNM		: 주문자/입금자명

	   * 소액결제(휴대폰,전화) 관련 변수
	   13. BKW_PHONENO				: 결제 전화번호
	 	 14. BKW_PHONECOMMTYPE	: 통신사(CI01:SKT, CI02:KT, CI03:LG U+)

	 	 * 신용카드 관련 변수
	   15. BKW_AUTHNO				  : 카드 승인번호
	   16. BKW_CARDNAME			  : 카드명
	 	 17. BKW_QUOTA				  : 할부개월(00:일시불, 02:2개월...)

	 	 * 기타변수
	 	 18. BKW_ETC1					  : 쇼핑몰에서 사용하는 여유필드1
	 	 19. BKW_ETC2					  : 쇼핑몰에서 사용하는 여유필드2
	 	 20. BKW_ETC3					  : 쇼핑몰에서 사용하는 여유필드3
	 	 21. BKW_ETC4					  : 쇼핑몰에서 사용하는 여유필드4
	 	 22. BKW_ETC5					  : 쇼핑몰에서 사용하는 여유필드5

	  * ================================================================================================
	  */
?>
<?php

	 /*
    * 1. 결제관련 변수 받아오기
    * 쇼핑몰 자체변수는 넘어오지않으므로 유의하시기 바랍니다.
    * 단, 결제시 쇼핑몰에서 사용하도록 정의한 여유필드1~5에 setting한 경우 전송가능함.
    */

	$BKW_RESULTCD      = $_GET["BKW_RESULTCD"];
	$BKW_RESULTMSG     = $_GET["BKW_RESULTMSG"];
	$BKW_TRADENO       = $_GET["BKW_TRADENO"];
	$BKW_AUTHDATE      = $_GET["BKW_AUTHDATE"];
	$BKW_AMOUNT        = $_GET["BKW_AMOUNT"];
	$BKW_PAYTYPE       = $_GET["BKW_PAYTYPE"];
	$BKW_SHOP_ORDER_NO = $_GET["BKW_SHOP_ORDER_NO"];
	$BKW_SITECD        = $_GET["BKW_SITECD"];

	$BKW_BANKNM        = $_GET["BKW_BANKNM"];
	$BKW_BANKACCOUNT   = $_GET["BKW_BANKACCOUNT"];
	$BKW_IPKUMSTATUS   = $_GET["BKW_IPKUMSTATUS"];
	$BKW_IPKUMUSERNM   = $_GET["BKW_IPKUMUSERNM"];

	$BKW_PHONENO       = $_GET["BKW_PHONENO"];
	$BKW_PHONECOMMTYPE = $_GET["BKW_PHONECOMMTYPE"];

	$BKW_AUTHNO        = $_GET["BKW_AUTHNO"];
	$BKW_CARDNAME      = $_GET["BKW_CARDNAME"];
	$BKW_QUOTA         = $_GET["BKW_QUOTA"];

	$BKW_ETC1          = $_GET["BKW_ETC1"];
	$BKW_ETC2          = $_GET["BKW_ETC2"];
	$BKW_ETC3          = $_GET["BKW_ETC3"];
	$BKW_ETC4          = $_GET["BKW_ETC4"];
	$BKW_ETC5          = $_GET["BKW_ETC5"];

   /*
    * 2. 결제성공시 DB처리
    */
   if ($BKW_RESULTCD == "0000"){
    		// 결제 성공시 처리 작업
    		// 이곳에서 데이터 베이스 작업을 하시면 됩니다.


    		// 데이터 베이스 처리 후, 아래 print구문을 꼭 삽입해 주셔야합니다.
    		echo "<TID>".$BKW_TRADENO."</TID>";
   }
?>

