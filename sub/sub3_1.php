<?php $g4_path = ".."; // common.php 의 상대 경로
include_once("$g4_path/common.php");

//현재 페이지에서 사용될 스킨명 적음
$skin_dirs = Array();
$skin_dirs[] = 'latest/gp_slider';
$background = "class=bg-ptn1";

include_once("$g4[path]/head.php");
$sub="3-1"


?>
<style>

</style>
<div id="container">
	<div class="content-title">
		<h1>PREVIEW</h1>
		<span>본관미리보기</span>
	</div>
	<div class="content-area">

		<?php $on1="on"?>
		<?php include("$g4[path]/sub/content_navi.php");?>

	   

		<div class="preview-area">
			<!-- <div class="title f4"></div> -->
			<ul>
				<li><a href="<?=$g4[path]?>/sub/sub3_1_1.php" class="ch1"><h2>솔향기(101)</h2></a></li>
				<li><a href="<?=$g4[path]?>/sub/sub3_1_2.php" class="ch2"><h2>개구리울음소리(102)</h2></a></li>
				<li><a href="<?=$g4[path]?>/sub/sub3_1_3.php" class="ch3"><h2>오죽(103)</h2></a></li>			
				
			</ul>
		</div>

		<div class="preview-area">
			<!-- <div class="title f3"></div> -->
			<ul>
				<li><a href="<?=$g4[path]?>/sub/sub3_1_4.php" class="ch4"><h2>해향(201)</h2></a></li>
				<li><a href="<?=$g4[path]?>/sub/sub3_1_5.php" class="ch5"><h2>달빛사냥(202)</h2></a></li>
				<li><a href="<?=$g4[path]?>/sub/sub3_1_6.php" class="ch6"><h2>은빛고요(203)</h2></a></li>
				<li><a href="<?=$g4[path]?>/sub/sub3_1_7.php" class="ch7"><h2>강릉이래요(204)</h2></a></li>
				<!-- <li><a href="<?=$g4[path]?>/sub/sub3_1_8.php" class="ch7"><h2>배나무골</h2></a></li> -->
			</ul>
		</div>

		<!-- <div class="preview-area">
			<div class="title f2"></div>
			<ul>
				<li><a href="<?=$g4[path]?>/sub/sub3_1_7.php" class="f2-01"><h2>일반</h2></a></li>
				<li><a href="#" class="f2-02"><h2></h2></a></li>
				<li><a href="#" class="f2-03"><h2></h2></a></li>
			</ul>			
		</div> -->

	</div><!-- /content-area -->
</div><!-- /container -->


<?php include("$g4[path]/sub/sub_footer.php");?>

<?php include_once("../tail.php"); 
?> 
