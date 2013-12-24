<?php $g4_path = ".."; // common.php 의 상대 경로
include_once("$g4_path/common.php");
$background = "class=bg-ptn1";
include_once("$g4[path]/head.php");
$sub="7"
?>

<div id="container">
	<div class="content-title">
		<h1>COMMUNITY</h1>
		<span>자주하는 질문</span>
	</div>
	<div class="content-area">

	<?php $on3="on"?>
		<?php include("$g4[path]/sub/content_navi.php");?>

	
<img src="<?php echo $g4['path']?>/img/faq.png" alt="자주하는 질문" /><br />
	</div>
</div><!-- container -->


<?php include("$g4[path]/sub/sub_footer.php");?>

<?php include_once("../tail.php"); 
?>
