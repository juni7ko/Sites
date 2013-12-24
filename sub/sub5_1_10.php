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

		<?php $on10="on"?>
		<?php include("$g4[path]/sub/content_navi.php");?>


		<div class="tour-area">

			<h1>허균·허난설헌기념공원</h1>

			<div class="t-main-img10">
				<a href="http://www.hongkildong.or.kr" target="_blank" class="btn-homepage tip" title="홈페이지 바로가기">homepage link</a>
				<a href="#" class="btn-location tip" title="찾아가는 길 지도 확인">location map</a>
			</div>

			<div class="tour-content">
				<p>우리나라 최초의 한글소설인 ‘홍길동전’의 저자 허균(1569∼1618)과 그의 누이이자 조선시대 유명 여류시인인 허난설헌의 문학적 업적을 기리는 ‘허균·허난설헌 기념관’은 강릉시 초당동 4223m² 터에 지상 1층 연면적 186m² 규모의 목조한옥형태로 한옥의 장점을 잘 살려 허난설헌 유적공원 근처에 세워졌다.</p>
			
				<p>기념관의 건립으로 강릉이 배출한 개혁 사상가 허균과 여류 천재시인 허난설헌의 얼을 선양하는 두 남매의 사상과 문학세계를 연구, 계승 발전시킬 수 있는 문화공간으로 조성되었다.</p> 

				<p></p>
							
				<ul>
					<li>주소 : 강원도 강릉시 초당동 474-8 </li>					
					<li>홈페이지 : <a href="http://www.hongkildong.or.kr" target="_blank">http://www.hongkildong.or.kr</a></li>
					

				</ul>
				
				<div class="tour-thumb">
					<ul>
						<li><a href="images/sub5/t_org10_01.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb10_01.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org10_02.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb10_02.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org10_03.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb10_03.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org10_04.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb10_04.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org10_05.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb10_05.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org10_06.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb10_06.jpg" alt="" /></a></li>						
					</ul>
				</div>
				
			</div><!-- /tour-content -->
		</div><!-- /tour-area -->



	</div>
</div><!-- container -->


<?php include("$g4[path]/sub/sub_footer.php");?>

<?php include_once("../tail.php"); 
?> 
