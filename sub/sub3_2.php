<?php $g4_path = ".."; // common.php 의 상대 경로
include_once("$g4_path/common.php");

//현재 페이지에서 사용될 스킨명 적음
$skin_dirs = Array();
$skin_dirs[] = 'latest/gp_slider';
$background = "class=bg-ptn1";

include_once("$g4[path]/head.php");
$sub="3-1"

?>

<div id="container">
	<div class="content-title">
		<h1>PREVIEW</h1>
		<span>별관미리보기</span>
	</div>

	<div class="content-area">

	    <?php $on2="on"?>
		<?php include("$g4[path]/sub/content_navi.php");?>

		<div class="preview-area-bg2">
			<ul>
				<li><a href="<?=$g4[path]?>/sub/sub3_2_1.php" class="v1"><h2>별관1층</h2></a></li>
				<li><a href="<?=$g4[path]?>/sub/sub3_2_2.php" class="v2"><h2>별관2층A</h2></a></li>	
			</ul>
		</div>

		<div class="preview-area-bg2">
			<ul>
				<li><a href="<?=$g4[path]?>/sub/sub3_2_3.php" class="v3"><h2>별관2층B</h2></a></li>			
				<li><a href="<?=$g4[path]?>/sub/sub3_2_4.php" class="v4"><h2>별관3층</h2></a></li>
			</ul>
		</div>


	</div><!-- /content-area -->
	
</div><!-- container -->


<?php include("$g4[path]/sub/sub_footer.php");?>

<?php include_once("../tail.php"); 
?> 
