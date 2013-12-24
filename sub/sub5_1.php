<?php $g4_path = ".."; // common.php 의 상대 경로
include_once("$g4_path/common.php");
$background = "class=bg-ptn1";
include_once("$g4[path]/head.php");
?>

<div id="container">
	<div class="content-title">
		<h1>TRAVEL</h1>
		<span>주변관광지</span>
	</div>
	<div class="content-area">

		<div class="travel-area">
			<ul>
				<li><a href="<?=$g4[path]?>/sub/sub5_1_1.php" class="travel_01">경포</a></li>
				<li><a href="<?=$g4[path]?>/sub/sub5_1_2.php" class="travel_02">오죽헌</a></li>
				<li><a href="<?=$g4[path]?>/sub/sub5_1_3.php" class="travel_03">선교장</a></li>
				<li><a href="<?=$g4[path]?>/sub/sub5_1_4.php" class="travel_04">참소리축음기박물관</a></li>
			</ul>
		</div>

		<div class="travel-area">
			<ul>
				<li><a href="<?=$g4[path]?>/sub/sub5_1_5.php" class="travel_05">커피거리</a></li>
				<li><a href="<?=$g4[path]?>/sub/sub5_1_6.php" class="travel_06">주문진수산시장</a></li>
				<li><a href="<?=$g4[path]?>/sub/sub5_1_7.php" class="travel_07">정동진</a></li>
				<li><a href="<?=$g4[path]?>/sub/sub5_1_8.php" class="travel_08">양떼목장</a></li>
			</ul>
		</div>

		<div class="travel-area" >
			<ul>
				<li><a href="<?=$g4[path]?>/sub/sub5_1_9.php" class="travel_09">솔향수목원</a></li>
				<li><a href="<?=$g4[path]?>/sub/sub5_1_10.php" class="travel_10">허균허난설헌기념공원</a></li>
				<!-- <li><a href="<?=$g4[path]?>/sub/sub5_1_11.php" class="travel_11">관광지안내</a></li>
				<li><a href="<?=$g4[path]?>/sub/sub5_1_12.php" class="travel_12">관광지안내</a></li> -->
			</ul>
		</div>

	</div>
</div><!-- container -->


<?php include("$g4[path]/sub/sub_footer.php");?>

<?php include_once("../tail.php"); 
?>
