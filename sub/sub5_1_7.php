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

		<?php $on7="on"?>
		<?php include("$g4[path]/sub/content_navi.php");?>


		<div class="tour-area">

			<h1>정동진역과 모래시계공원</h1>

			<div class="t-main-img07">
				<a href="https://tour.gangneung.go.kr/Tours/sub.jsp?Mcode=10104" target="_blank" class="btn-homepage tip" title="홈페이지 바로가기">homepage link</a>
				<a href="#" class="btn-location tip" title="찾아가는 길 지도 확인">location map</a>
			</div>

			<div class="tour-content">
				<p>정동진은 서울 광화문에서 정(正)동쪽에 위치하여 붙여진 이름으로 세계에서 바다와 가장 가까운 역으로 드라마 '모래시계' 촬영지로 유명해진 정동진 역이 있으며, 세계 최대의 모래시계로 상부의 모래는 미래의 시간, 흐르는 모래는 현재의 시간을, 황금빛 원형의 모습은 정동의 떠오르는 태양을, 평행선의 기차 레일은 시간의 영원성을 의미하는 모래시계 공원이 볼거리를 제공한다.</p>
			
				<p>정동진은 여름 피서철 뿐만 아니라 매년 12월31일부터 1월1일까지 진행되는 해돋이축제 등 사계절 관광지로 젊은 연인들에게 특히 인기가 있다.</p> 

				<p>주변에는 조각공원과 타임스토리 박물관 등이 있다.</p>
							
				<ul>
					<li>주소 : 강원도 강릉시 강동면 정동진리 </li>					
					<li>홈페이지 : <a href="https://tour.gangneung.go.kr/Tours/sub.jsp?Mcode=10104" target="_blank">홈페이지 바로가기</a></li>
					

				</ul>
				
				<div class="tour-thumb">
					<ul>
						<li><a href="images/sub5/t_org7_01.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb7_01.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org7_02.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb7_02.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org7_03.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb7_03.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org7_04.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb7_04.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org7_05.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb7_05.jpg" alt="" /></a></li>
						<!-- <li><a href="images/sub5/t_org7_06.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb7_06.jpg" alt="" /></a></li> -->
					</ul>
				</div>
				
			</div><!-- /tour-content -->
		</div><!-- /tour-area -->



	</div>
</div><!-- container -->


<?php include("$g4[path]/sub/sub_footer.php");?>

<?php include_once("../tail.php"); 
?> 
