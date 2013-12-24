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

		<?php $on4="on"?>
		<?php include("$g4[path]/sub/content_navi.php");?>


		<div class="tour-area">

			<h1>참소리축음기 에디슨과학박물관</h1>

			<div class="t-main-img04">
				<a href="http://www.edison.kr" target="_blank" class="btn-homepage tip" title="홈페이지 바로가기">homepage link</a>
				<a href="#" class="btn-location tip" title="찾아가는 길 지도 확인">location map</a>
			</div>

			<div class="tour-content">
				<p>참소리축음기박물관은 설립자 손성목관장이 소년시절 선친으로부터 받은 축음기가 인연이되어 한평생을 축음기 수집가로서 목숨을 건 위험속에서 세계60여개국을 돌며 수집한 축음기및 뮤직박스, 라디오,TV 4,000여점과 관련자료 15만여점이 전시되어 있는 소장품 규모면에서 세계 최대의 박물관입니다.</p>
			
				<p>1982년 강릉시 송정동에서 “참소리방”으로 설립된 이래 약30여년의 역사와 전통을 지니고 있으며 가이드의 안내로 소리를 직접 들을 수 있으며, 음악감상실에서는 최신오디오시스템으로 음악감상을 하실 수 있습니다.</p> 

				<p>참소리축음기박물관은 1320여평방미터 규모로 전시품의 성격에 따라 4개의 독립 전시관과 330여평방미터 규모의 전용 음악감상실이 있으며 3층에는 경포호수를 감상할 수 있는 전망대가 있다.</p>
							
				<ul>
					<li>주소 : 강원도 강릉시 저동 36번지 </li>
					<li>전화번호 : 033.655.1130</li>
					<li>홈페이지 : <a href="#" target="_blank">http://www.edison.kr</a></li>
					<li>관람시간 : </li>
					<li>관람요금 : 성인-개인:7,000원,단체:6,000원 / 청소년-개인:6,000원,단체:5,000원 / 어린이(4세이상)-개인:5,000원,단체:3,500원</li>
					<li>&nbsp;※ 단체 : 30인 이상부터 적용</li>

				</ul>
				
				<div class="tour-thumb">
					<ul>
						<li><a href="images/sub5/t_org4_01.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb4_01.jpg" alt="" /></a></li>
						<!-- <li><a href="images/sub5/t_org4_02.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb4_02.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org4_03.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb4_03.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org4_04.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb4_04.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org4_05.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb4_05.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org4_06.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb4_06.jpg" alt="" /></a></li> -->
					</ul>
				</div>
				
			</div><!-- /tour-content -->
		</div><!-- /tour-area -->



	</div>
</div><!-- container -->


<?php include("$g4[path]/sub/sub_footer.php");?>

<?php include_once("../tail.php"); 
?> 
