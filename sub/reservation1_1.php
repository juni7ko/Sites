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
				<div class="today">오늘 : 2013년 5월 28일 (화요일)</div>
				<div class="res-btn-area">
					<ul>
						<li><a href="reservation1_4.php">예약확인</a></li>
						<li><a href="reservation1_5.php">예약수정</a></li>
						<li><a href="reservation1_6.php">예약취소</a></li>
					</ul>
				</div>
				<div class="res-select">
					<select name="year">
						<option value="2012" >2012년</option>
						<option value="2013" selected>2013년</option>
						<option value="2014" >2014년</option>
					</select>년
					<select name="month">
						<option value="1" >1</option>
						<option value="2" >2</option>
						<option value="3" >3</option>
						<option value="4" >4</option>
						<option value="5" selected>5</option>
						<option value="6" >6</option>
						<option value="7" >7</option>
						<option value="8" >8</option>
						<option value="9" >9</option>
						<option value="10" >10</option>
						<option value="11" >11</option>
						<option value="12" >12</option>
					</select>월 
					<select name="day">
						<option value="1" >1</option>
						<option value="2" >2</option>
						<option value="3" >3</option>
						<option value="4" >4</option>
						<option value="5" >5</option>
						<option value="6" >6</option>
						<option value="7" >7</option>
						<option value="8" >8</option>
						<option value="9" >9</option>
						<option value="10" >10</option>
						<option value="11" >11</option>
						<option value="12" >12</option>
						<option value="13" >13</option>
						<option value="14" >14</option>
						<option value="15" >15</option>
						<option value="16" >16</option>
						<option value="17" >17</option>
						<option value="18" >18</option>
						<option value="19" >19</option>
						<option value="20" >20</option>
						<option value="21" >21</option>
						<option value="22" >22</option>
						<option value="23" >23</option>
						<option value="24" >24</option>
						<option value="25" >25</option>
						<option value="26" >26</option>
						<option value="27" >27</option>
						<option value="28" >28</option>
						<option value="29" >29</option>
						<option value="30" selected>30</option>
						<option value="31" >31</option>
					</select>
					일 ~ 
					<select name="stay">
						<option value="1">1박2일</option>
						<option value="2">2박3일</option>
						<option value="3">3박4일</option>
						<option value="4">4박5일</option>
						<option value="5">5박6일</option>
						<option value="6">6박7일</option>
						<option value="7">7박8일</option>
						<option value="8">8박9일</option>
						<option value="9">9박10일</option>
						<option value="10">10박11일</option>
						<option value="11">11박12일</option>
						<option value="12">12박13일</option>
						<option value="13">13박14일</option>
						<option value="14">14박15일</option>
						<option value="15">15박16일</option>
						<option value="16">16박17일</option>
						<option value="17">17박18일</option>
						<option value="18">18박19일</option>
						<option value="19">19박20일</option>
						<option value="20">20박21일</option>
					</select>

				</div>
			</div>
			
			<div class="res-contents">
				<div>
				<ul>
					<li>2013년 05월 30일 부터 1박2일 이용가능한 객실 현황입니다.</li>
					<li>2013년 05월 30일은 비수기 주중 요금이 적용됩니다!</li>
				</ul>
				</div>
				
				<table cellpadding="0" cellspacing="0">
				<caption>예약신청</caption>
				<thead>
				<tr>
					<th class="first">선택</th>
					<th>객실명(유형)</th>
					<th>기준인원</th>
					<th>최대인원</th>
					<th>예약인원</th>
					<th class="last">비수기</th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td class="first"><input type="checkbox" name="chkroom" value="1" /></td>
					<td>방1</td>
					<td>2명</td>
					<td>4명</td>
					<td>
						<select name="person_1">
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
						</select>
						명
					</td>
					<td class="last">100,000원</td>
				</tr>
				<tr>
					<td class="first">*</td>
					<td>바베큐 그릴 신청</td>
					<td colspan="2">
						<select name="person_1">
							<option value="2">신청안함</option>
							<option value="3">바베큐 그릴신청 小 : 10,000원</option>
							<option value="4">바베큐 그릴신청 大 : 20,000원</option>
						</select>
					</td>
					<td colspan="2" class="last">바베큐 그릴,숯,석쇠 1세트</td>
				</tr>
				</tbody>
				</table>

				
				<div class="res-comment">
					<ul>
						<li class="title"><h2>환불규정</h2>
							<ol>
								<li><span class="highlight-pink">성수기는 여름 7월25일 ~ 8월15일 / 겨울 12월 20일 ~ 1월 31일까지 입니다</span>.</li>
								<li>상기요금은 정원기준이며 추가인원 1인당 1만원의 추가요금임이 적용됨</li>
								<li>주말요금은 금요일, 토요일 그리고 공휴일 전날에 적용함</li>
								<li>TV, 냉장고, 전기밥솥, 가스렌지, 침구, 주방용구및 화장실, 샤워실 일체가 준비되어 있음</li>
								<li>1회용삼푸, 린스, 칫솔, 면도기, 모기향, 석쇠, 공기숯은 펜션내 구입가능함</li>
								<li>안전사고는 책임지지 않습니다.</li>
								<li>예약금액 : <span class="highlight-pink">예약금은 24시간 이내 50% 입금시 확정</span></li>
								<li>예약방법 : 홈페이지 실시간예약 + 전화</li>
								<li>주중요금 : 일요일 ~ 목요일</li>
								<li>주말요금 : 금요일, 토요일, 공휴일 전날</li>
							</ol>
						</li>
					</ul>
	
					<ul>
						<li class="title"><h2>주의사항</h2>
							<ol>
								<li>기준인원 초과 시 1인에 10,000원이 추가됩니다.</li>
								<li>입실시간은 오후2시부터입니다. 객실청소가 12~14시까지이기 때문에 오전입실이 어려우나 전날 사용하지 않은 객실의 오전 입실은 전화로 상담 받습니다.</li>
								<li>퇴실시간은 오전11시까지입니다.</li>
								<li>객실정리가 끝나시면 관리자에게 연락하시어 퇴실점검을 받으시기 바랍니다.</li>
								<li>오후 10시 이후의 입실은 사전에 반드시 연락주시기 바랍니다.</li>
								<li>집기 파손 시에는 관리자에게 알려주시기 바랍니다.</li>
								<li>애완동물은 부득이 타객실 및 손님을 위해 입실을 금하오니 양해바랍니다.</li>
								<li>쓰레기는 필히 분리수거하여 주십시오.</li>
								<li>고성방가는 절대 삼가 바랍니다.</li>
								<li>애완견은 입실이 불가능합니다.</li>
								<li>입실시간 PM 14:00, 퇴실시간 AM 11:00</li>
							</ol>
						</li>
						<li class="comment-ps">* 예약 취소에 따른 환불규정은 당콘도의 규정사항이므로 예약해지시 신중히 검토 예약하시길 바랍니다. *</li>
					</ul>
	
					<ul>
						<li class="title"><h2>환불규정</h2>
							<ol>
								<li>이용일 6일전 취소시 80% 환불</li>
								<li>이용일 5일전 취소시 70% 환불</li>
								<li>이용일 4일전 취소시 60% 환불</li>
								<li>이용일 3일전 취소시 50% 환불</li>
								<li>이용일 2일전 취소시 40% 환불</li>
								<li>이용일 1일전,당일 환불안됨</li>
								<li>모든환불금은 수수료 공제후 송금됩니다.</li>
							</ol>
						</li>
					</ul>
	
					<ul>
						<li class="title"><h2>환불규정</h2>
							<ol>
								<li>그 외에는 규정상 취소가 불가능하며 예약금을 반환되지 않는점 꼭 유념바랍니다.</li>
								<li>예약 완료 후 예약변경은 1회에 한하며 예약일 10일전에 변경 가능하며 변경후에는 재변경 및 취소가 불가능합니다.</li>
								<li>각 룸의 시설물, 집기류 등 파손 및 회손시 전액 변상하셔야 합니다.</li>
								<li>공휴일과 그 전날은 주말요금이 적용됩니다.</li>
								<li>퇴실 하시기전 꼭 체크아웃을 한후 퇴실바랍니다.</li>
							</ol>
						</li>
					</ul>
	
					<ul>
						<li class="title"><h2>환불규정</h2>
							<ol>
								<li>입금계좌: 농협 301-0081-3040-81 (조용만)</li>
								<li>문의 : 033-642-6718</li>
							</ol>
						</li>
					</ul>

				</div><!-- /res-comment -->

			</div><!-- /res-contents -->


			<div class="res-footer">
				<div class="highlight-blue">
					<input type="checkbox" name="agree" value="1" /> 위 유의사항과 환불기준에 동의하시면 <span class="highlight-pink">체크</span>하신후 다음단계로 진행해 주세요!
				</div>
				<div class="res-footer-btn-area">
					<a href="reservation1_2.php" class="res-footer-btn">다음</a>
				</div>
			</div>

		</div>

	</div>
</div><!-- container -->


<?php include("$g4[path]/sub/sub_footer.php");?>

<?php include_once("../tail.php"); 
?>
