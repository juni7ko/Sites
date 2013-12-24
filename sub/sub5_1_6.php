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

		<?php $on6="on"?>
		<?php include("$g4[path]/sub/content_navi.php");?>


		<div class="tour-area">

			<h1>주문진항과 수산시장</h1>

			<div class="t-main-img06">
				<a href="https://tour.gangneung.go.kr/Tours/sub.jsp?Mcode=10601" target="_blank" class="btn-homepage tip" title="홈페이지 바로가기">homepage link</a>
				<a href="#" class="btn-location tip" title="찾아가는 길 지도 확인">location map</a>
			</div>

			<div class="tour-content">
				<p>주문진항은 연안항으로 방파제 920m에 수면적 210,000㎡이며 500여척의 어선이 정박할수 있으며, 900가구 4천여명의 어민이 250여척의 배를 보유하여 연간 15,442톤의 오징어, 양미리, 명태 등을 잡고있다.
꽁치는 3~6월, 오징어는 4~12월, 명태는 10월에서 익년 3월사이에 잡히고 있다.
오징어는 7~10월사이에 많이 잡혀 산오징어를 관광객들은 스치로폼 상자에 오징어와 얼음을 넣어 신선도를 유지시켜 많이 구입하고 있으며, 이 곳에 계시는 부모님들은 오징어, 꽁치 등의 젓갈을 담아 마른 오징어와 함께 외지에 나가 있는 자식들에게 보내어 늘 고향의 맛을 선보이고 있다.
이 시기에 오징어잡이 배의 불빛이 온 바다에 넘쳐서 바다가 휘황 찬란한 네온싸인을 보는 것과 같은 착각에 빠지게 한다.</p>
			
				<p>또한 어항을 중심으로 대규모 회센타(주문진회센타,북방파제회센타, 주문진생선회센타, 수협종합판매장 회센타)가 자리잡고 있어 싱싱한 회를 맛볼수 있으며, 수협종합판매장에는 회센타,건어물등이 있으며,특히 성인병,피부미용에 좋은 사계절 해수사우나가 있으며 수용인원은 420명정도이다. 
바다낚시를 할 수 있는 어선이 30여척 정도 있어. 배를 타고 해상에서 직접 가자미, 우럭등을 잡아 먹는것도 일미이다.</p> 

				<p></p>
							
				<ul>
					<li>주소 : 강원도 강릉시 주문진항 </li>					
					<li>홈페이지 : <a href="https://tour.gangneung.go.kr/Tours/sub.jsp?Mcode=10601" target="_blank">홈페이지 바로가기</a></li>
					

				</ul>
				
				<div class="tour-thumb">
					<ul>
						<li><a href="images/sub5/t_org6_01.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb6_01.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org6_02.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb6_02.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org6_03.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb6_03.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org6_04.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb6_04.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org6_05.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb6_05.jpg" alt="" /></a></li>
						<!-- <li><a href="images/sub5/t_org6_06.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb6_06.jpg" alt="" /></a></li> -->
					</ul>
				</div>
				
			</div><!-- /tour-content -->
		</div><!-- /tour-area -->



	</div>
</div><!-- container -->


<?php include("$g4[path]/sub/sub_footer.php");?>

<?php include_once("../tail.php"); 
?> 
