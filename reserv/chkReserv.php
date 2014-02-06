<?php
include_once("./_common.php");
$background = "class=bg-ptn1";
include_once("$g4[path]/head.php");

$wr_password = sql_password($wr_password);

function alert_and_back($msg){
    echo("<script type='text/javascript'>
            alert('$msg');
            history.back();
        </script>");
}

function getRoomName($r_info_id) {
	global $write_table;
	$sql = " SELECT * FROM {$write_table}_r_info WHERE r_info_id = '$r_info_id' LIMIT 1; ";
	$result = sql_fetch($sql);
	return $result;
}

function GetDateWeek($week)
{
	switch($week) {
		case "1" :
			$weekP = "월";
			break;
		case "2" :
			$weekP = "화";
			break;
		case "3" :
			$weekP = "수";
			break;
		case "4" :
			$weekP = "목";
			break;
		case "5" :
			$weekP = "금";
			break;
		case "6" :
			$weekP = "토";
			break;
		case "0" :
			$weekP = "일";
			break;
		default :
			$weekP = "";
			break;
	}

	return $weekP;
}
?>

<link rel="stylesheet" type="text/css" href="css/reservation.css">

<div id="container">
	<div class="content-area">
		<div class="reservation-area">
			<div class="content-title">
				<h1>RESERVATION</h1>
				<span>예약확인</span>
			</div>
			<div class="res-header" style="display:none;">
				<div class="today">오늘 : 2013년 5월 28일 (화요일)</div>
				<div class="res-btn-area">
					<ul>
						<li><a href="<?=$g4['path']?>/reserv/chkReserv.php">예약확인</a></li>
						<li><a href="<?=$g4['path']?>/sub/reservation1_5.php">예약수정</a></li>
						<li><a href="<?=$g4['path']?>/sub/reservation1_6.php">예약취소</a></li>
					</ul>
				</div>
			</div>

			<div class="res-contents">

				<div class="res-comment">
					<table cellpadding="0" cellspacing="0">
					<caption>예약신청</caption>
					<thead>
						<tr>
							<th class="first">객실명</th>
							<th>기준/최대</th>
							<th>이용일</th>
							<th>성인</th>
							<th>아동</th>
							<th>유아</th>
							<th>요금타입</th>
							<th>이용요금</th>
							<th class="last">결제액</th>
						</tr>
					</thead>
					<tbody>

<?php
// 예약내용이 있는지 확인
if($type == "code") {
	$query = " SELECT * from $write_table WHERE wr_3 = '$wr_3' AND wr_name = '$wr_name' AND wr_password = '$wr_password' ORDER BY wr_link1 ASC ";
} else {
	$res_error = 1;
}

$resultList = sql_query($query);

for ($i=0; $rList = sql_fetch_array($resultList); $i++)
{
	$rList2[$i]         = getRoomName($rList['r_info_id']);
	$rList2['wr_name']  = $rList['wr_name'];
	$rList2['wr_10']    = $rList['wr_10'];
	$rList2['wr_2']     = $rList['wr_2'];
	$rList2['wr_8']     = $rList['wr_8'];
	$rList2['wr_7']     = $rList['wr_7'];
	$rList2['rResult']  = $rList['rResult'];
	$rList2['wr_email'] = $rList['wr_email'];
?>
							<tr>
								<td class="first"><?=$rList2[$i][r_info_name]?></td>
								<td><?=$rList2[$i][r_info_person1]?>명/<?=$rList2[$i][r_info_person2]?>명</td>
								<td><span class="highlight-pink"><?=date("Y-m-d", $rList['wr_link2']);?>(<?=GetDateWeek(date("w", $rList['wr_link2']))?>)</span></td>
								<td>
									<?=$rList['person1']?> 명
								</td>
								<td>
									<?=$rList['person2']?> 명
								</td>
								<td>
									<?=$rList['person3']?> 명
								</td>
								<td><?=$rList['costType']?></td>
								<td>
									<div>기본가 <?=number_format($rList['cost1'])?>원</div>
									<?php if($rList['cost2']) { ?><div><span class="highlight-blue">기본 객실할인</span> - <?=number_format($rList['cost2'])?>원</div><?php } ?>
									<?php if($rList['overCount']) { ?><div><span class="highlight-blue">추가인원 <?=$rList['overCount']?> +</span> <?=number_format($rList['overCost'])?>원</div><?php } ?>
								</td>
								<td class="last"><?=number_format($rList['cost3'] + $rList['overCost'])?>원</td>
							</tr>


<?php
}
if(!$i) $res_error = 1;

if($res_error){
    $msg = '검색하신 것과 일치하는 예약내용이 없습니다. \n\n다시 확인해 주십시오. \n\n확인을 누르시면 뒤로 돌아갑니다';
    alert_and_back($msg);
    exit;
}
?>
						</tbody>
					</table>
					<div class="res-comment">
						<ul>
							<li class="title"><h2>예약번호</h2>
								<ol>
									<li><span class="highlight-pink"><?=$wr_3?></span></li>
								</ol>
							</li>
						</ul>

						<ul>
							<li class="title"><h2>진행상태</h2>
								<ol>
									<li><span class="highlight-pink"><?=get_rResult($rList2['rResult'])?></span></li>
								</ol>
							</li>
						</ul>

						<ul>
							<li class="title"><h2>예약자명</h2>
								<ol>
									<li><?=$rList2['wr_name']?></li>
								</ol>
							</li>
						</ul>

						<ul>
							<li class="title"><h2>결제방법</h2>
								<ol>
									<li><span class="highlight-blue"><?=get_payMent($rList2['wr_7'])?></span></li>
								</ol>
							</li>
						</ul>

						<ul>
							<li class="title"><h2>결제금액</h2>
								<ol>
									<li>총 <span class="highlight-blue"><?=number_format($rList2['wr_10'])?></span> 원</li>
									<?php if( ($rList2['wr_7'] == 2 || $rList2['wr_7'] == 3) && $rList2['rResult'] == "0010" ) : ?>
									<!-- 카드결제 & 예약대기 상태일때 결제모듈을 띄운다. -->
									<div id="PGIOscreen" style="width:100%;">
										<div class="res-footer">
											<div class="res-footer-btn-area">
												<a onClick="startPayment();" class="res-footer-btn" style="cursor:pointer;">결제하기</a>
											</div>
										</div>
									</div>
									<?php endif; ?>
								</ol>
							</li>
						</ul>
<?php if($rList2['wr_8']) { ?>
						<ul>
							<li class="title"><h2>결제자명</h2>
								<ol>
									<li><?=$rList2['wr_8']?></li>
								</ol>
							</li>
						</ul>
<?php } ?>
						<ul>
							<li class="title"><h2>연락전화번호</h2>
								<ol>
									<li><?=$rList2['wr_2']?></li>
								</ol>
							</li>
						</ul>

						<ul>
							<li class="title"><h2>입금계좌</h2>
								<ol>
									<li>입금계좌: <?=get_text($config[cf_1])?></li>
									<li>문의 : <?=get_text($config[cf_2])?></li>
								</ol>
							</li>
						</ul>

						<ul>
							<li class="title"><h2>입금시간안내</h2>
								<table class="tbl">
								<tr>
									<th>예약 신청 시간</th>
									<th>입금 완료 시간</th>
								</tr>
								<tr>
									<td>당일 새벽 00시 부터 오전 8시 이전</td>
									<td>오전 10시 이전까지 입금</td>
								</tr>
								<tr>
									<td>오전 08시 부터 낮 12시 이전</td>
									<td>오후 2시 이전까지 입금</td>
								</tr>
								<tr>
									<td>오후 12시 부터 오후 4시 이전</td>
									<td>오후 6시 이전까지 입금</td>
								</tr>
								<tr>
									<td>오후 4시 부터 밤 8시 이전	</td>
									<td>오후 9시 이전까지 입금</td>
								</tr>
								<tr>
									<td>오후 8시 부터 밤 12시 이전</td>
									<td>다음날 오전 10시 이전까지 입금</td>
								</tr>
								</table>
								<ol>
									<li>지정된 시간까지 입금되지 않으면 자동으로 예약취소됩니다.</li>
									<li>입금시간후 입금하셨을 경우에는 확인절차를 거쳐 환불처리 됩니다.</li>
									<li>1일전예약 또는 당일예약일 경우는 예약후 바로 입금하셔야 예약완료가 됩니다. </li>
								</ol>
							</li>
						</ul>
					</div><!-- /res-comment -->
				</div><!-- /res-comment -->

			</div><!-- /res-contents -->


			<div class="res-footer">
				<div class="res-footer-btn-area">
					<a href="<?=$g4[url]?>/" class="res-footer-btn">홈으로</a>
				</div>
			</div>

		</div>

	</div>
</div><!-- container -->


<div class="paymemt-div">
	<script language="javascript" type="text/javascript">
		/*
		 * 3. 결제를 시작하기 위해서 호출하는 함수
		 * 블루페이 결제호출!
		 */
		function startPayment(){

			var payType = document.PGIOForm.Pay_Type.value;

			// 소액결제인경우 결제창에서 명의자 전화번호를 입력받기를 원하는 경우, 전화번호 초기화를 해주세요.
			if(payType == "MCASH" || payType == "PBILL"){
				 document.PGIOForm.buyr_tel2.value = "";
			}

			doTransaction(document.PGIOForm);
		}

		/*
		 * 5. OpenPayAPI의 결제 창을 통하여 결제가 완료 됨과 동시에 무조건 getPGIOresult() 라는 이름의 함수를 호출(callback) 합니다.
		 * 블루페이결제종료후 자동으로 호출되는 함수
		 * 주의: 결제 성공 후 상점 쪽에 결제정보가 저장되는 중에 alert 호출 등 사용자의 요청을 기다리는 소스는 삽입하지 마십시오.
		 *			 고객이 alert('결제성공') 이라는 메시지만 보고 브라우저를 종료 시에 결제정보가 상점 측으로 전달될 수 없습니다.
		 */
		function getPGIOresult() {

			var BKW_RESULTCD = getPGIOElement('BKW_RESULTCD');
			var BKW_RESULTMSG = getPGIOElement('BKW_RESULTMSG');

			// 함수안에 결제성공/실패 시 필요한 동작들에 대해서 선언해주시면 됩니다.
			// 함수안의 코드에 대해서는 샘플과 다르게 하셔도 무관합니다.

			// 1) 거래성공의 경우
			if (BKW_RESULTCD == '0000') {
				// 거래성공 경우, DB처리 및 결제성공결과 안내할 수 있는 페이지로 이동하시면 됩니다.
				// 타겟설정필수!
				document.PGIOForm.target = "_self";
				document.PGIOForm.action = './result.php';
				document.PGIOForm.submit();
			} else {
				// 2) 거래실패 경우 상점에서 원하는 형태로 구현하시면 됩니다.
				// 2-1) 실패에 대해서도 별도 처리가 필요한 경우
				//document.PGIOForm.action = './result.php';
				//document.PGIOForm.submit();

				// 2-2) 별도 처리없이 화면 refresh.
				alert("결제가 실패하였습니다. 사유:"+BKW_RESULTMSG);
				window.location.reload();
			}
		}
	</script>

	<!--
		* 2. 결제를 진행하기 위한 변수 값을 PGIOForm에 채워줍니다.
		* 아래는 결제를 위해서 필요한 input 태그입니다. 데이터를 적절히 가져와 내용을 채워주세요
		* 자세한 내용은 [BluePay 결제연동매뉴얼] 을 참고하세요.
	-->
	<!-- 결제정보 입력 form : PGIOForm -->
	<form name="PGIOForm" accept-charset="euc-kr" method="post">
		<!--
		===========================
		* 공통변수 : 필수정보
		===========================
		-->
		<input type="hidden" name="site_cd" value="P0430" />		<!-- 사이트코드(필수) : 뱅크웰로 부터 받은 사이트코드를 입력하세요 -->
		<input type="hidden" name="pg_type" value="PGNW" />			<!-- 결제모듈 타입(필수) : 변경하지마세요 -->
		<input type="hidden" name="charset"  value="UTF-8"/>		<!-- 페이지charset(필수) charset이 UTF-8인 경우, 대문자(UTF-8)로 설정 부탁드립니다 -->
		<input type="hidden" name="Result_URL" value="" />			<!-- 결제모듈(pop_Result)을 설치한 절대경로(필수)-->

		<!--
		* 2012년 8월 18일 정자상거래법 개정 관련 설정 부분
		* 자세한 설정방법은 결제연동 매뉴얼 참고
		-->
		<input type="hidden" name="goodperiod" value="" /><!-- [소액결제에 한해서 필수항목] 상품제공기간 -->
		<!--
		* 결제유형(Pay_Type) : 필수
		* 결제종류에 해당되는 값을 넘겨주세요
		* 신용카드: CARD, 계좌이체: ACNT, 가상계좌: VCNT, 휴대폰소액결제: MCASH,  폰빌전화결제: PBILL
		* 뱅크웰(주)에 신청된 결제수단으로만 결제가 가능합니다.
		-->
		<input type="hidden" name="Pay_Type" value="CARD" />
		<!--상점주문번호(ordr_idxx) : 필수 -->
		<input type="hidden" name="ordr_idxx" value="<?=$wr_3?>"/>
		<!-- 상품명(good_name) : 필수 -->
		<input type="hidden" name="good_name" value="StayStore 객실예약(<?=$rList2['wr_name']?>)"/>
		<!--상품가격(good_mny) : 필수(숫자만 넘겨주세요) -->
		<input type="hidden" name="good_mny" value="<?=$rList2['wr_10']?>"/>
		<!-- 구매자명(buyr_name) : 필수 -->
		<input type="hidden" name="buyr_name" value="<?=($rList2['wr_8']) ? $rList2['wr_8'] : $rList2['wr_name'];?>"/>
		<!--
		===========================
		* 공통변수 : 부가정보
		===========================
		-->
		<!--주문자 이메일(buyr_mail) : 권장 -->
		<input type="hidden" name="buyr_mail" value="<?=$rList2['wr_email']?>"/>
		<!--주문자 전화번호(buyr_tel1) : 권장 -->
		<?php
		$t_tel = explode("-",$rList2['wr_2']);
		$tel = "";
		for($i=0; $i < count($t_tel); $i++) {
			$tel .= $t_tel[$i];
		}
		?>
		<input type="hidden" name="buyr_tel1" value="<?=$tel?>"/>
		<!--배송지 주소(rcvr_zipx, rcvr_add1, rcvr_add2) : 옵션 -->
		<input type="hidden" name="rcvr_zipx" value=""/> <!-- 우펀번호 -->
		<input type="hidden" name="rcvr_add1" value=""/> <!-- 주소 -->
		<input type="hidden" name="rcvr_add2" value=""/> <!-- 상세주소 -->

		<input type="hidden" name="Noti_URL" value="" />		<!-- 백노티URL-->
		<input type="hidden" name="rcvr_name" value="" />		<!-- 수취인명-->
		<input type="hidden" name="rcvr_tel1" value="" />		<!-- 수취인 전화번호-->
		<input type="hidden" name="rcvr_mail" value="" />		<!-- 수취인 E-MAIL-->
		<input type="hidden" name="rcvr_date" value="" />		<!-- 배송 희망일-->
		<input type="hidden" name="rqst_msgx" value="" />		<!-- 배송 코멘트-->
		<input type="hidden" name="kindcss" value="" />			<!-- 결제창스킨(blue, green, pink, violet, yellow) -->
		<input type="hidden" name="goodoption1"  value=""/> <!-- 여유필드(상점에서 사용가능한 여유필드) -->
		<input type="hidden" name="goodoption2"  value=""/> <!-- 여유필드(상점에서 사용가능한 여유필드) -->
		<input type="hidden" name="goodoption3"  value=""/> <!-- 여유필드(상점에서 사용가능한 여유필드) -->
		<input type="hidden" name="goodoption4"  value=""/> <!-- 여유필드(상점에서 사용가능한 여유필드) -->
		<input type="hidden" name="goodoption5"  value=""/> <!-- 여유필드(상점에서 사용가능한 여유필드) -->


		<!--
		=================================
		* 결제수단별 변수 : 부가정보
		=================================
		-->
		<input type="hidden" name="card_quota"  value=""/> 	<!--[신용카드] 카드할부기간 -->
		<input type="hidden" name="cardtype"  value=""/> 		<!--[신용카드] 결제카드종류 -->

		<!--
		* 5만원이상의 계좌이체/가상계좌 거래에 대해서는 에스크로 결제여부를 묻는 창이 자동으로 표시됩니다.(단, 에스크로서비스를 신청한 상점에 한함)
		* 무조건 에스크로 결제만을 원하시는 경우 escrow_type 변수에 value값으로 "EA01" 를 넘겨주시면 됩니다.
		-->
		<input type="hidden" name="escrow_yn"  value="" />	<!-- [계좌이체/가상계좌] 에스크로 사용유무(Y/N)-->
		<input type="hidden" name="escrow_type"  value="" /><!-- [계좌이체/가상계좌] 에스크로결제여부(EA01:무조건 에스크로결제/EA02:고객선택 에스크로)-->

		<input type="hidden" name="bankcode" value="" />		<!-- [가상계좌] 발급은행코드 -->

		<!--
		* 뱅크웰에서 지정한 변수 외에 상점측에서 필요한 변수도 사용가능합니다.
		* 단, 상점측 변수는 뱅크웰시스템에 저장되지는 않으니, 별도로 관리하셔야합니다.
		* 만약 거래결과누락으로 인한 거래결과 재전송의 경우 상점측 변수 값은 전달되지않으니 유의바랍니다.
		-->


		<!--
		===========================
		* 결제응답 정보 : 선언 필수!!
		* 뱅크웰에서 결제를 진행하면서 값을 채우는 항목입니다.
		* 값을 설정하지 마세요.
		===========================
		-->
		<!--공통 파라미터-->
		<input type="hidden" name="BKW_RESULTCD"  value="">		<!-- 지불결과코드 0000 성공  0000이외 오류 -->
		<input type="hidden" name="BKW_RESULTMSG"  value="">	<!-- 지불결과메시지-->
		<input type="hidden" name="BKW_TRADENO"  value="">		<!-- 블루페이거래번호(자동채번되니 수정하지마세요)-->
		<input type="hidden" name="BKW_PAYTYPE"  value="">		<!-- 결제수단 신용카드: PA11 / 계좌이체: PA03 / 가상계좌: PA10 / 휴대폰 소액결제: PA08 / 폰빌 전화결제: PA01-->
		<input type="hidden" name="BKW_AUTHDATE"  value="">		<!-- 승인일자-->
		<input type="hidden" name="BKW_AMOUNT"  value="">			<!-- 승인금액-->

		<!--신용카드-->
		<input type="hidden" name="BKW_AUTHNO"  value="">			<!-- 카드승인번호-->
		<input type="hidden" name="BKW_CARDNAME" value="">		<!-- 카드명-->
		<input type="hidden" name="BKW_QUOTA"  value="">			<!-- 할부개월 00 일시불 02 2개월-->

		<!--계좌이체 가상계좌-->
		<input type="hidden" name="BKW_BANKNM"  value="">			<!-- 은행명-->
		<input type="hidden" name="BKW_BANKACCOUNT"  value=""><!-- 가상계좌 발급계좌번호-->

		<!--휴대폰/전화결제-->
		<input type="hidden" name="BKW_PHONENO"  value="">			<!--  결제전화번호-->
		<input type="hidden" name="BKW_PHONECOMMTYPE"  value=""><!--  통신사(SKT,KT,LGT)-->
	</form>
</div>


<?php
include_once("$g4[path]/tail.php");
?>
