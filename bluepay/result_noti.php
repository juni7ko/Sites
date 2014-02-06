<?php
	 /*
	  * ================================================================================================
	  * Filename	:	result_noti.php
	  * Function	:	가상계좌 입금통보 페이지
	  * Author		:	All contents Copyright 2013 Bankwell Co. all rights reserved
	  * ================================================================================================
	  */


		/*
     * 1. 입금통보URL로 전송되는 주요변수 받아오기
     * 상점에서 구현한 입금통보 페이지는 블루페이 상점관리자 페이지에 등록하셔야 입금완료 시 입금통보를 받으실 수 있습니다.
     * 등록할 위치 : 상점관리자페이지 HOME > 사이트 정보조회 > 사이트 정보관리 메뉴에서 가상계좌 입금통지URL
     */
    $BKW_TRADENO					= $_GET["BKW_TRADENO"];						// 원거래에 대한 뱅크웰(PG사) 고유 거래번호
    $BKW_SHOP_ORDER_NO		= $_GET["BKW_SHOP_ORDER_NO"];			// 원거래에 대한 상점고유 거래번호
    $BKW_RESULTCD  				= $_GET["BKW_RESULTCD"];					// 거래결과코드(0000인 경우 성공. 그 외는 실패를 나타냅니다)
    $BKW_PAYTYPE					= $_GET["BKW_PAYTYPE"];						// 결제수단, 가상계좌의 경우 PA10
    $BKW_IPKUMSTATUS			= $_GET["BKW_IPKUMSTATUS"];				// 가상계좌 입금상태, 입금완료의 경우 IM01

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

