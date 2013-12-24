<?php
include_once "./_common.php";
if($_GET['from'] == 'pc'){
    set_session("frommoblie", "");
}
include_once './_head.php';
?>


	<div id="visual">
		<ul id="slider1">
			<!-- <li><img src="images/visual_01.jpg" /></li>
			<li><img src="images/visual_02.jpg" /></li>
			<li><img src="images/visual_03.jpg" /></li>
			<li><img src="images/visual_04.jpg" /></li>
			<li><img src="images/visual_05.jpg" /></li> -->
		</ul>
	</div><!-- /visual -->
	

<?php include_once './_tail.php';
?>
