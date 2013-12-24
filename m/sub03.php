<?php
include_once "./_common.php";
//pc버전에서 모바일가기 링크 타고 들어올 경우 세션을 삭제한다. 세션이 삭제되면 모바일 기기에서 PC버전 접속시 자동으로 모바일로 이동된다. /extend/g4m.config.php 파일 참고.
if($_GET['from'] == 'pc'){
    set_session("frommoblie", "");
}
include_once './_head.php';


?>




<div id="visual">

     
  <div id="subcon">
  <!-- 오시는길 -->
	<img src="./images/map1.gif" width="100%"><br />
    <!-- <a href="sub2_1.php"><img src="images/google.gif"></a><br /> -->
	<img src="./images/map2.gif" width="100%"></div>



</div><!-- /visual -->
	

<?php include_once './_tail.php';
?>

