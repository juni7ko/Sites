<?php $g4_path = ".."; // common.php 의 상대 경로
include_once("$g4_path/common.php");
$background = "class=bg-ptn1";
include_once("$g4[path]/head.php");
?>

<div id="container">
	<div class="content-title">
		<h1>PROLOGUE</h1>
		<span>contents sub title</span>
	</div>
	<div class="content-area">
		<img src="<?php echo $g4['path']?>/sub/images/room_btn_01.png" alt="room1" width="300" />
		<img src="<?php echo $g4['path']?>/sub/images/room_btn_02.png" alt="room2" width="300" />
		<img src="<?php echo $g4['path']?>/sub/images/room_btn_03.png" alt="room3" width="300" />
		<img src="<?php echo $g4['path']?>/sub/images/room_btn_01.png" alt="room1" width="300" />
		<img src="<?php echo $g4['path']?>/sub/images/room_btn_02.png" alt="room2" width="300" />
		<img src="<?php echo $g4['path']?>/sub/images/room_btn_03.png" alt="room3" width="300" />
	</div>
</div><!-- container -->


<?php include("$g4[path]/sub/sub_footer.php");?>

<?php include_once("../tail.php"); 
?> 
