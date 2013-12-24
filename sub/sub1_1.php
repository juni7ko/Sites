<?php $g4_path = ".."; // common.php 의 상대 경로
include_once("$g4_path/common.php");
$background = "class=bg-ptn1";
include_once("$g4[path]/head.php");
$sub="1"

?>

<div id="container">
	<div class="content-title">
		<h1>PROLOGUE</h1>
		<span>인사말</span>
	</div>
	<div class="content-area">

		<?php $on1="on"?>
		<?php include("$g4[path]/sub/content_navi.php");?>

		<img src="<?php echo $g4['path']?>/img/sub1_01.png" alt="인사말" /><br />
		<!-- <img src="<?php echo $g4['path']?>/img/goldpine_1.png" alt="" /><br />
		<img src="<?php echo $g4['path']?>/img/goldpine_1.png" alt="" /><br /><br /><br /><br /><br />
		<img src="<?php echo $g4['path']?>/img/goldpine_2.png" alt="" /><br />
		<img src="<?php echo $g4['path']?>/img/goldpine_2.png" alt="" /><br />
		<img src="<?php echo $g4['path']?>/img/goldpine_2.png" alt="" /><br /> -->

	</div>
</div><!-- container -->


<?php include("$g4[path]/sub/sub_footer.php");?>

<?php include_once("../tail.php"); 
?>
