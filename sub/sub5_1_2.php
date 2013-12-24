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

		<?php $on2="on"?>
		<?php include("$g4[path]/sub/content_navi.php");?>


		<div class="tour-area">

			<h1>오죽헌</h1>

			<div class="t-main-img02">
				<a href="https://ojukheon.gangneung.go.kr"  target="_blank" class="btn-homepage tip" title="홈페이지 바로가기">homepage link</a>
				<a href="#" class="btn-location tip" title="찾아가는 길 지도 확인">location map</a>
			</div>

			<div class="tour-content">
				<p>1536년(중종31년)율곡 이이선생이 탄생한 곳으로 조선시대 상류주택의 별당 사랑채로 우리나라 주거 건축 중 가장 오래된 것 중 하나이다. 율곡이 태어난 오죽헌은 정면 3칸, 측면 2칸의 단층 팔작지붕의 건축물이다. 세종조(世宗朝)당시 공조참판과 예문관 제학의 벼슬에 오른 강릉 12향현 중의 한 분인 최치운에 의해 건립된 조선시대 양반가옥의 별당 사랑채로 사용되었던 곳으로 처음 오죽헌이 지어진 것은 지금으로부터 약600여년 전이다. 오죽헌을 정면서 보면 왼쪽 2칸은 대청으로 사용하게 하였고 오른쪽 한칸은 온돌방으로 사용하게 하였는데, 이 방이 바로 율곡 이이가 태어난 몽룡실이다. 최치운은 이후 오죽헌을 아들인 최응현에게 물려주었고, 최응현은 다시 그의 사위인 이사온에게 물려 주었으며 이사온은 그의 사위인 신명화에게 물려 주었으니 이때 율곡 이이가 태어난 것이다.</p>
			
				<p>문성사는 율곡 이이선생의 영정(影幀)을 모신 사당이며, 어제각은 율곡 이이선생이 어릴때 사용하던 벼루가 보관되어 있다.</p>
				
				<ul>
					<li>주소 : 강원도 강릉시 율곡로 3139번길 24</li>
					<li>전화번호 : 033.640.4457</li>
					<li>홈페이지 : <a href="https://ojukheon.gangneung.go.kr" target="_blank">https://ojukheon.gangneung.go.kr</a></li>
				</ul>
				
				<div class="tour-thumb">
					<ul>
						<li><a href="images/sub5/t_org2_01.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb2_01.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org2_02.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb2_02.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org2_03.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb2_03.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org2_04.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb2_04.jpg" alt="" /></a></li>
						<!-- <li><a href="images/sub5/t_org2_05.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb2_05.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org2_06.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb2_06.jpg" alt="" /></a></li> -->
					</ul>
				</div>
				
			</div><!-- /tour-content -->
		</div><!-- /tour-area -->



	</div>
</div><!-- container -->


<?php include("$g4[path]/sub/sub_footer.php");?>

<?php include_once("../tail.php"); 
?> 
