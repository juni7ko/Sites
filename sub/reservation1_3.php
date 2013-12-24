<?php $g4_path = ".."; // common.php 의 상대 경로
include_once("$g4_path/common.php");
$background = "class=bg-ptn1";
include_once("$g4[path]/head.php");
?>

<link rel="stylesheet" type="text/css" href="css/reservation.css">

<div id="container">
	<div class="content-title">
		<h1>RESERVATION</h1>
		<span>종합안내</span>
	</div>
	<div class="content-area">

		<div class="reservation-area">
			<div class="res-header">
				<div class="comment">
				24시간 이내에 예약금 50%입금을 완료하여야 예약이 확정되며 결제를 진행 안하시거나 입금확인이 안되실경우에는 자동으로 예약이 취소됩니다. 예약자와 입금자가 틀리실 경우 전화로 알려주시면 빠르게 완료처리해드립니다.
				</div>
			</div>
			
			<div class="res-contents">
				
				<div class="res-comment">
					<ul>
						<li class="title"><h2>예약자명</h2>
							<ol>
								<li>인터포</li>
							</ol>
						</li>
					</ul>
	
					<ul>
						<li class="title"><h2>결제금액</h2>
							<ol>
								<li>총 100,000원</li>
							</ol>
						</li>
					</ul>
	
					<ul>
						<li class="title"><h2>결제자명</h2>
							<ol>
								<li>인터포</li>
							</ol>
						</li>
					</ul>
	
					<ul>
						<li class="title"><h2>연락전화번호</h2>
							<ol>
								<li>123-4560-7897</li>
							</ol>
						</li>
					</ul>
	
					<ul>
						<li class="title"><h2>입금계좌</h2>
							<ol>
								<li>농협 301-0081-3040-81 조용만</li>
							</ol>
						</li>
					</ul>
	
					<ul>
						<li class="title"><h2>입금시간안내</h2>
							<ol>
								<li>2013년 05월 29일 22시 30분까지 (예약후 24시간 이내)</li>
								<li>지정된 시간까지 입금되지 않으면 자동으로 예약취소됩니다.</li>
								<li>입금시간후 입금하셨을 경우에는 확인절차를 거쳐 환불처리 됩니다.</li>
								<li>1일전예약 또는 당일예약일 경우는 예약후 바로 입금하셔야 예약완료가 됩니다. </li>
							</ol>
						</li>
					</ul>
	


				</div><!-- /res-comment -->

			</div><!-- /res-contents -->


			<div class="res-footer">
				<div class="res-footer-btn-area">
					<a href="reservation1_1.php" class="res-footer-btn">예약완료</a>
				</div>
			</div>

		</div>

	</div>
</div><!-- container -->


<?php include("$g4[path]/sub/sub_footer.php");?>

<?php include_once("../tail.php"); 
?>
