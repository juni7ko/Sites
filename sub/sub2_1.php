<?php $g4_path = ".."; // common.php 의 상대 경로
include_once("$g4_path/common.php");

//현재 페이지에서 사용될 스킨명 적음
$skin_dirs = Array();
$skin_dirs[] = 'latest/gp_slider';

$background = "class=bg-ptn1";
include_once("$g4[path]/head.php");
$sub="2"
?>

<script type="text/javascript" src="js/jquery.livequery.js"></script>
<script type="text/javascript" src="js/jquery.livesetting.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.livequery.css" />

<div id="container">
	<div class="content-title">
		<h1>SPECIAL</h1>
		<span>80여평의 넓은 별관</span>
	</div>
	<div class="content-area">

		<?php $on1="on"?>
		<?php include("$g4[path]/sub/content_navi.php");?>

		<img src="<?php echo $g4['path']?>/img/sub2_01.png" alt="80여평의 넓은 별채" /><br />

		

	</div> <!-- content-area -->
</div><!-- container -->


<?php include("$g4[path]/sub/sub_footer.php");?>

<?php include_once("../tail.php"); 
?>
