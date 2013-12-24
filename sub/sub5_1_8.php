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

		<?php $on8="on"?>
		<?php include("$g4[path]/sub/content_navi.php");?>



		<div class="tour-area">

			<h1>대관령 양떼목장</h1>

			<div class="t-main-img08">
				<a href="http://www.yangtte.co.kr" target="_blank" class="btn-homepage tip" title="홈페이지 바로가기">homepage link</a>
				<a href="#" class="btn-location tip" title="찾아가는 길 지도 확인">location map</a>
			</div>

			<div class="tour-content">
				<p>1988년 지금의 목장주인인 전영대씨 부부가 풍전목장이란 이름으로 운영해오다가 2000년 겨울에 '대관령양떼목장'으로 이름이 바뀌었으며 현재 초지면적 63,000여평, 총목책길이 6Km, 200두의 양을 사육하면서 국내 제일의 청정목장, 자연생태관광목장으로 발돋움하고 있다.</p>
			
				<p>목장 초지가 형성되는 5월 초부터 11월 10일 정도까지 200두의 양을 축사(양을 키우는 장소)에 들이지 않고 24시간 초지에서 5일간 10개구역으로 나누어 구역별로 방목을 실시하여 50일이면 다시 처음 방목지로 이동케하는 '윤환방목'을 실시하고 있다.</p>
				
				<ul>
					<li>주소 : 강원도 평창군 대관령면 횡계리 14-104</li>
					<li>전화번호 : 033.335.1966</li>
					<li>홈페이지 : <a href="http://www.yangtte.co.kr" target="_blank">http://www.yangtte.co.kr</a></li>
				</ul>
				
				<div class="tour-thumb">
					<ul>
						<li><a href="images/sub5/t_org8_01.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb8_01.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org8_02.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb8_02.jpg" alt="" /></a></li>
						<!-- <li><a href="images/sub5/t_org1_03.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb1_03.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org1_04.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb1_04.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org1_05.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb1_05.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org1_06.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb1_06.jpg" alt="" /></a></li> -->
					</ul>
				</div>
				
			</div><!-- /tour-content -->
		</div><!-- /tour-area -->
	

	</div>
</div><!-- container -->


<?php include("$g4[path]/sub/sub_footer.php");?>

<?php include_once("../tail.php"); 
?> 
