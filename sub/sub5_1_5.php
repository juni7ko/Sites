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

		<?php $on5="on"?>
		<?php include("$g4[path]/sub/content_navi.php");?>


		<div class="tour-area">

			<h1>강릉항(안목) 커피거리</h1>

			<div class="t-main-img05">
				<a href="http://www.coffeefestival.net" target="_blank" class="btn-homepage tip" title="홈페이지 바로가기">homepage link</a>
				<a href="#" class="btn-location tip" title="찾아가는 길 지도 확인">location map</a>
			</div>

			<div class="tour-content">
				<p>강릉항(안목)일대는 커피거리로 유명하다. 1박2일에서 이승기가 미션수행을 하던 곳이고, 매년 10월 커피축제가 열리는 장소이다.</p>
			
				<p>해안도로를 따라 커피 전문점들이 자리잡고 있어 연인들의 데이트장소로도 아주 좋은 곳이다. 어는 곳에서 맛있는 커피를 마시며 드넓은 동해바다를 감상할 수 있다.</p> 

				<p></p>
							
				<ul>
					<li>주소 : 강원도 강릉시 강릉항 </li>					
					<li>홈페이지 : <a href="#" target="_blank">http://www.coffeefestival.net</a></li>
					

				</ul>
				
				<div class="tour-thumb">
					<ul>
						<li><a href="images/sub5/t_org5_01.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb5_01.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org5_02.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb5_02.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org5_03.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb5_03.jpg" alt="" /></a></li>
						<!-- <li><a href="images/sub5/t_org5_04.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb5_04.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org5_05.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb5_05.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org5_06.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb5_06.jpg" alt="" /></a></li> -->
					</ul>
				</div>
				
			</div><!-- /tour-content -->
		</div><!-- /tour-area -->



	</div>
</div><!-- container -->


<?php include("$g4[path]/sub/sub_footer.php");?>

<?php include_once("../tail.php"); 
?> 
