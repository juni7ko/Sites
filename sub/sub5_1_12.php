<?php $g4_path = ".."; // common.php 의 상대 경로
include_once("$g4_path/common.php");

//현재 페이지에서 사용될 스킨명 적음
$skin_dirs = Array();
$skin_dirs[] = 'latest/gp_slider';
$background = "class=bg-ptn1";

include_once("$g4[path]/head.php");
$sub="5"
?>

<div id="container">
	<div class="content-title">
		<h1>TRAVEL</h1>
		<span>주변관광지</span>
	</div>
	<div class="content-area">

		<?php $on12="on"?>
		<?php include("$g4[path]/sub/content_navi.php");?>

		<div>
		<?=latest("gp_slider", "tour12", 3, 26);?>
		</div>


		<div class="pension-info">
			<table>
			<caption>객실안내</caption>
				<thead>
				<tr>
					<th width="120" class="border-left">객실형태</th>
					<th width="80">평수</th>
					<th width="140">수용인원</th>
					<th class="border-right">객실요금(원)</th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td class="border-left">침대1/1층</td>
					<td>16평</td>
					<td>기준2명/최대4명</td>
					<td class="border-right">주중:100,000 / <span class="pink">주말:120,000</span> / <span class="blue">성수기:130,000</span></td>
				</tr>
				</tbody>
			</table>

			<div class="infomation">
				<ul>
					<li class="info-title"><img src="images/info_title1.gif" alt="객실집기 및 외부시설" /></li>
					<li>TV,QOOK(쿡),인터넷,침대,침구,화장대,식탁,주방시설 및 주방집기, 전기밥솥,샤워용품 등</li>
					<li>객실별 테라스, 야외데크(바비큐시설) 등</li>
				 
					<li>※ 일부 객실집기품목은 객실유형별로 차이가 날 수 있습니다.</li>
					<li>※ 바비큐그릴+참숯 포함 대(4~6인용):20,000원 / 소(2~4인용):10,000원입니다.</li>
					<li class="f-red ps">(예약시 미리 말씀해 주세요)</li>

					<li class="info-title"><img src="images/info_title2.gif" alt="객실집기 및 외부시설" /></li>
					<li>여름 7월25일~8월15일 / 겨울 12월20일~1월31일</li>
					<li class="f-red">성수기에는 주중에도 주말(금~일, 법정공휴일) 요금 적용</li>

					<li class="info-title"><img src="images/info_title3.gif" alt="객실집기 및 외부시설" /></li>
					<li>금,토요일은 주말요금이 적용됩니다.(일~목요일은 평일요금)</li>

					<li class="info-title"><img src="images/info_title4.gif" alt="객실집기 및 외부시설" /></li>
					<li>법정공휴일 전날과 당일에는 주말요금이 적용 됩니다.</li>
				</ul>
			</div><!-- infomation -->
		</div><!-- room-info -->

	</div>
</div><!-- container -->


<?php include("$g4[path]/sub/sub_footer.php");?>

<?php include_once("../tail.php"); 
?> 
