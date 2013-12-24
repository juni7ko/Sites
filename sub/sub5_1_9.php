<?php $g4_path = ".."; // common.php 의 상대 경로
include_once("$g4_path/common.php");

//현재 페이지에서 사용될 스킨명 적음
$skin_dirs = Array();
$skin_dirs[] = 'latest/gp_slider';
$background = "class=bg-ptn1";

include_once("$g4[path]/head.php");
$sub="5"
?>

<!-- tooltip javascript -->
<script type="text/javascript" src="<?=$g4[path]?>/js/jquery.tips.js"></script>
<script type="text/javascript">
/* tooltip */
$("document").ready(function (){ 
	$('.tip').tipsy({gravity: 'e',fade: true});
});

$(function(){
	$("a[rel=gallery_zoom]").fancybox({
		'titlePosition' : 'over'
	});
});
</script>
<!-- tooltip javascript -->

<div id="container">
	<div class="content-title">
		<h1>TRAVEL</h1>
		<span>주변관광지</span>
	</div>
	<div class="content-area">

		<?php $on9="on"?>
		<?php include("$g4[path]/sub/content_navi.php");?>


		<div class="tour-area">

			<h1>강릉솔향수목원</h1>

			<div class="t-main-img09">
				<a href="https://tour.gangneung.go.kr/Tours/sub.jsp?Mcode=10113" target="_blank" class="btn-homepage tip" title="홈페이지 바로가기">homepage link</a>
				<a href="#" class="btn-location tip" title="찾아가는 길 지도 확인">location map</a>
			</div>

			<div class="tour-content">
				<p>강릉솔향수목원은 강릉시 구정면 구정리 산135번지일원에 2008년부터 조성하여 2011년 문을 열었습니다. 수목원이 조성된 지역은 강릉지역의 대표 수종인 금강소나무를 잘 가꾸어 온 곳으로 천연숲 본연의 모습그대로를 자랑하고 있습니다. 
또한, 용소골로서 2개의 용소가 자리잡고 있으며, 맑은 계곡물이 흐르는 청정한 지역입니다. 우리수목원은 약 7만평의 부지에 『천년숲속의 만남의 장』이라는 주제로 천년숲을 관찰하고 학습할 수 있는 숲생태관찰로, 천년숨결 치유의 길 등과 전시원인 원추리원, 약용식물원, 암석원, 향기원 등 다양한 23개의 전시원에 1004종의 15만본의 식물로 조성되어 있습니다.</p>
			
				<p>강릉솔향수목원에서는 천년숲과 함께하는 학습원, 체험공간을 즐기는 웰빙문화를 창조하고 하루를 함께할 때 천년의 기쁨을 나눌 수 있는 치유효과의 장을 마련하고 자연을 중시하고 약간의 인공적 시설도입으로 산림기능의 극대화를 위합니다.</p> 

				<p></p>
							
				<ul>
					<li>주소 : 강원도 강릉시 강동면 정동진리 </li>					
					<li>홈페이지 : <a href="https://tour.gangneung.go.kr/Tours/sub.jsp?Mcode=10113" target="_blank">홈페이지 바로가기</a></li>
					

				</ul>
				
				<div class="tour-thumb">
					<ul>
						<li><a href="images/sub5/t_org9_01.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb9_01.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org9_02.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb9_02.jpg" alt="" /></a></li>
						<!-- <li><a href="images/sub5/t_org9_03.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb9_03.jpg" alt="" /></a></li> -->
						<li><a href="images/sub5/t_org9_04.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb9_04.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org9_05.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb9_05.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org9_06.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb9_06.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org9_07.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb9_07.jpg" alt="" /></a></li>
					</ul>
				</div>
				
			</div><!-- /tour-content -->
		</div><!-- /tour-area -->



	</div>
</div><!-- container -->


<?php include("$g4[path]/sub/sub_footer.php");?>

<?php include_once("../tail.php"); 
?> 
