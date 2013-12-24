<?php $g4_path = ".."; // common.php 의 상대 경로
include_once("$g4_path/common.php");
$background = "class=bg-ptn1";
include_once("$g4[path]/head.php");
$sub="4"
?>

<div id="container">
	<div class="content-title">
		<h1>RESERVATION</h1>
		<span>종합안내</span>
	</div>
	<div class="content-area">

	    <?php $on4="on"?>
		<?php include("$g4[path]/sub/content_navi.php");?>

			<!-- 유의사항 -->
			<div class="caution">
			<ul>
				<li class="title"><h1>유의사항</h1></li>
				<li><span class="highlight-pink">인터넷이나 전화예약이 가능</span>합니다.</li>
				<li><span class="highlight-pink">예약 신청 후 24시간 이내에 지정 계좌로 입금 하셔야 예약이 완료</span>되며 <span class="highlight-blue">24시간 이내에 미 입금시 예약이 자동 취소</span>됩니다.</li>
				<li><span class="highlight-pink">예약금 입금시 반드시 예약자 이름 </span>으로 하셔야합니다.</li>
				<li>다른 이름으로 입금 하셨을 경우 미리 전화주세요.</li>
				<li><span class="highlight-pink">당일과 하루 전 예약은 예약 후 3시간내에 입금완료 하셔야 예약이 완료</span>됩니다.</li>				
				<li>기준인원 초과시 1인에 10,000원(1박 기준)의 요금이 추가됩니다.(유아,어린이 포함)</li>
				<li>바베큐시설 이용은 10,000원의 요금이 추가됩니다.</li>
				<li>입실은 객실정비관계로 당일 14시부터 가능하며, 퇴실은 마지막날 12시를 원칙으로 합니다.</li>				
				<li><span class="highlight-blue">주말(공휴일) 요금 : 금요일, 토요일, 공휴일 전날 / 주중요금 : 일요일 ~ 목요일</span></li>
				<!-- <li><span class="highlight-blue">성수기 기준 : 여름성수기 7월 14일 ~ 8월 20일 / 겨울 성수기 12월 14일 ~ 2월 28일</span></li>	 -->			
			</ul>
		</div>


		<hr class="line" />


		<!-- 환불안내 -->
		<div class="caution">
			<ul>
				<li class="title"><h1>환불안내</h1></li>
				<li>취소 및 환불처리는 전화로 꼭 확인해 주시기 바랍니다.</li>
				<li>취소시 10%의 환불 수수료가 부가되오니 신중히 생각하신 후 예약해주십시오.</li>
				<li>예약 후 날짜 변경, 객실변경은 예약 취소 후 다시 예약하셔야 합니다. (환불수수료 적용)</li>
				<li>날씨로 인한 예약변경이나 취소는 천재지변이 아니므로 환불기준대로 수수료 적용됩니다.</li>
				<li>취소환불 수수료는 아래와 같습니다.</li>
				<li class="no-bullet"><span class="highlight-blue">※ 성수기 중 환불 수수료</span>
					<ul>
						<li>· 이용일 <span class="highlight-pink">1주일내 환불 불가능</span></li>
						<li>· 이용일 <span class="highlight-pink">1~2주 사이 50%</span> 환불</li>
						<li>· 이용일 <span class="highlight-pink">2주 이상 90%</span> 환불</li>
					</ul>
				</li>
				<li class="no-bullet"><span class="highlight-blue">※ 비수기 중 환불 수수료</span>
					<ul>
						<li>· 이용당일 혹은 <span class="highlight-pink">하루전 환불 없음</span></li>
						<li>· 이용일 <span class="highlight-pink">2일전 50%</span> 환불</li>
						<li>· 이용일 <span class="highlight-pink">3일전 70%</span> 환불</li>
						<li>· 이용일 <span class="highlight-pink">4일전 80%</span> 환불</li>
						<li>· 이용일 <span class="highlight-pink">5일전 90%</span> 환불</li>
					</ul>
				</li>
			</ul>
		</div>









	</div>

</div><!-- container -->


<?php include("$g4[path]/sub/sub_footer.php");?>

<?php include_once("../tail.php"); 
?>
