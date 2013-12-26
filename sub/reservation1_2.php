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

				<table cellpadding="0" cellspacing="0">
				<caption>예약신청확인</caption>
				<tr>
					<th colspan="2" class="first">예약신청하신 내용은 아래와 같습니다.</th>
					<th colspan="2" class="last">예약정보를 입력해 주세요 *항목은 필수사항으로 입력하셔야 합니다.</th>
				</tr>
				<tbody>
				<tr>
					<td class="first" width="100">객실명</td>
					<td>방1</td>

					<td width="100">예약자명 *</td>
					<td class="last left"><input name="wr_name" type="text" class="text w130" /></td>
				</tr>
				<tr>
					<td class="first">예약인원</td>
					<td>2명</td>

					<td>연락처 *</td>
					<td class="last left">
						<select name="person_1">
							<option value="010">010</option>
							<option value="011">011</option>
							<option value="016">016</option>
							<option value="017">017</option>
							<option value="019">019</option>
						</select>
						<!-- <input name="wr_tel1" type="text" class="text" size="4" maxlength="4"/> -->
						-
						<input name="wr_tel2" type="text" class="text" size="4" maxlength="4"/>
						-
						<input name="wr_tel3" type="text" class="text" size="4" size="4" maxlength="4"/>
					</td>
				</tr>
				<tr>
					<td class="first">금액</td>
					<td>05월30일(비수기 주중요금) 기본 2명 100,000원</td>

					<td>이메일</td>
					<td class="last left"><input name="wr_email" type="text" class="text w130" /></td>
				</tr>
				<tr>
					<td class="first">바베큐그릴</td>
					<td>신청안함</td>

					<td>출발지역 *</td>
					<td class="last left">
						<select name="wr_area">
							<option value="">지역을 선택하세요.</option>
							<option value="01">강원도</option>
							<option value="02">경기도</option>
							<option value="03">제주도</option>
							<option value="04">충청남도</option>
							<option value="05">충청북도</option>
							<option value="06">경상남도</option>
							<option value="07">경상북도</option>
							<option value="08">전라남도</option>
							<option value="09">전라북도</option>
							<option value="17">세종시</option>
							<option value="10">서울특별시</option>
							<option value="11">부산광역시</option>
							<option value="12">인천광역시</option>
							<option value="13">대전광역시</option>
							<option value="14">대구광역시</option>
							<option value="15">광주광역시</option>
							<option value="16">울산광역시</option>
						</select>
					</td>
				</tr>
				<tr>
					<td class="first">객실선택</td>
					<td>방1 (총1실)</td>

					<td>도착일시</td>
					<td class="last left">
						<input name="arrive_year" type="text" class="text" value="2013" size="4" />
						년
						<input name="arrive_month" type="text" value="5" class="text" size="2" />
						월
						<input name="arrive_day" type="text" value="29" class="text" size="2" />
						일
						<select name="arrive_time">
							<option value="14">14</option>
							<option value="15">15</option>
							<option value="16">16</option>
							<option value="17">17</option>
							<option value="18">18</option>
							<option value="19">19</option>
							<option value="20">20</option>
							<option value="21">21</option>
							<option value="22">22</option>
							<option value="23">23</option>
							<option value="24">24</option>
						</select>
					</td>
				</tr>
				<tr>
					<td class="first">예약기간</td>
					<td>2013년 5월 29일 (1박 2일)</td>

					<td>결제방법 *</td>
					<td class="last left"><input name="paycheck" type="radio" checked="checked" /> 무통장입금</td>
				</tr>
				<tr>
					<td class="first">예약인원</td>
					<td>총2명 (추가지원 0명)</td>
					<td rowspan="2">기타사항</td>
					<td rowspan="2" class="last left"><textarea name="wr_content" cols="50" rows="4" class="w100p"></textarea></td>
				</tr>
				<tr>
					<td class="first">확정금액</td>
					<td>100,000원</td>
				</tr>
				</tbody>
				</table>

			</div><!-- /res-contents -->



			<div class="res-footer">
				<!-- <div class="highlight-blue">
					<input type="checkbox" name="agree" value="1" /> 위 유의사항과 환불기준에 동의하시면 <span class="highlight-pink">체크</span>하신후 다음단계로 진행해 주세요!
				</div> -->
				<div class="res-footer-btn-area">
					<a href="reservation1_3.php" class="res-footer-btn">예약하기</a>
				</div>
			</div>

		</div>

	</div>
</div><!-- container -->


<?php include("$g4[path]/sub/sub_footer.php");?>

<?php include_once("../tail.php");
?>
