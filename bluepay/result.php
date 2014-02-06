<?php
    /*
     * =============================================
		 * Filename	:	result.php
		 * Function	:	PG사에서 승인 결과를 받아 DB처리하는 페이지
		 * Author		:	All contents Copyright 2013 Bankwell Co. all rights reserved
		 * =============================================
		 */


		/*
     * 1. 결제관련 변수 받아오기
     * 결제요청페이지 pay.php의 PGIOForm 안에 선언된 요소들이 모두 넘어옵니다.
     */
    $BKW_TRADENO      	= $_POST["BKW_TRADENO"];
    $BKW_RESULTCD      	= $_POST["BKW_RESULTCD"];
    $BKW_RESULTMSG     	= $_POST["BKW_RESULTMSG"];
    $BKW_PAYTYPE     	= $_POST["BKW_PAYTYPE"];

    /*
     * 2. 결제성공시 DB처리
     */
    if ($BKW_RESULTCD == "0000"){
     		// 결제 성공시 처리 작업
     		// 이곳에서 데이터 베이스 작업을 하시면 됩니다.
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<head>
		<title>뱅크웰(주) 전자결제 샘플 페이지(Bluepay)</title>
		<!--
    	* 3. 결제기본모듈 Include
    	* 뱅크웰 결제모듈인 OpenPayAPI.js를 include 합니다.
    	*	모든 브라우저와의 호환성과 스크립트 호출순서를 확실히 하기 위해서 꼭 <head> tag 상단에 추가하시기 바랍니다.
    -->
		<script language="javascript" type="text/javascript" src="https://pay.bluepay.co.kr/Script/BluePayAPI.js"></script>

		<!--
			* 4. 신용카드 매출전표 출력 연동을 위한 함수 선언
			* 전표보기 버튼을 생성 후 아래 함수를 호출하면 됩니다.
		-->
		<script language='javascript'>
		// 신용카드 매출전표 보기
		function openWindow(url, width, height, taxOptn) {
				var urlOpt = "scrollbars=no, resizable=no, copyhistory=no, location=no, width=" + width + ",height=" + height + ", left=0, top=0";
				window.open(url , 'slipPop', urlOpt);
		}
		</script>
</head>
<body>

	<!--
	 * 거래 성공 후 결과페이지를 구현하시면 되니다.
	 * 추가 버튼을 이용해서 카드매출전표도 연동하시면 구매 후 매출전표 출력이 가능합니다.
	-->
	<table width="650" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td height="75" align="center">
				<span style="font-family:굴림;font-size:12pt;color:#6d4c29;width:100%;line-height:100px;">
							<h2>결제가 정상적으로 이루어졌습니다.</h2>
						</span>
						카드결제는 아래 [매출전표보기] 버튼을 통해 매출전표를 출력하시면 됩니다.
			</td>
		</tr>
		<tr>
			<td height="75" align="center">
				<input type="button" value="매출전표보기" onClick='javascript:openWindow("https://biz.bluepay.co.kr/Modules/Bill/ADTS_Bill_Blue.jsp?c_trade_no=<?=$BKW_TRADENO?>&trade_type=<?=$BKW_PAYTYPE?>", "400", "600");'>
			</td>
		</tr>
	</table>

</body>
</html>
<?
     }
?>



