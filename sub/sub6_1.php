<?php $g4_path = ".."; // common.php 의 상대 경로
include_once("$g4_path/common.php");
$background = "class=bg-ptn1";
include_once("$g4[path]/head.php");
?>

<div id="container">
	<div class="content-title">
		<h1>TRAFFIC</h1>
		<span>오시는길</span>
	</div>
	<div class="content-area">

	<img src="<?php echo $g4[path]?>/img/map.png" alt="배나무골지도" />

	<ul class="map-link">
		<li><a href="http://me2.do/xTQBSL2k" target="_blank">Naver Map</a></li>
		<li><a href="http://dmaps.kr/f6dg" target="_blank">Daum Map</a></li>
		<li><a href="http://goo.gl/maps/WHIhI" target="_blank">Google Map</a></li>
	</ul>

	<ul>
		<li>ADDRESS. 강원도 강릉시 안현동 730번지 경포배나무골펜션</li>
		<li>TELEPHONE. 033.641.7650 / 011.374.7650 / 016.235.7650</li>
	</ul>

	</div>
</div><!-- container -->


<?php include("$g4[path]/sub/sub_footer.php");?>

<?php include_once("../tail.php"); 
?>
