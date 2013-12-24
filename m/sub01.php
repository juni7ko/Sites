<?php
include_once "./_common.php";
//pc버전에서 모바일가기 링크 타고 들어올 경우 세션을 삭제한다. 세션이 삭제되면 모바일 기기에서 PC버전 접속시 자동으로 모바일로 이동된다. /extend/g4m.config.php 파일 참고.
if($_GET['from'] == 'pc'){
    set_session("frommoblie", "");
}
include_once './_head.php';


?>




<div id="visual">

     
<div id="subcon"><img src="<?=$g4['path']?>/mobile/images/sub01_01.gif" width="100%"/><br />
<!-- <div id="subinfo">매년 여름 4만 7천명이 방문하는 
경포해수욕장 NO.1 브랜드 쇼앤뉴그린입니다.
  <br />
  2012년 2호점 (빅토리아펜션) 까지 오픈하였습니다.
  <br />
  단순한 숙박업소를 넘어서
경포해수욕장의 명물로 자리 잡아가는 쇼앤뉴그린입니다.<br />
먹고, 자고, 즐기는 이 세가지 욕구를 한번에 충족하는 버라이어티 펜션모텔입니다.<br />
<br />
<span style="color:#FC0">* 1호점 쇼앤뉴그린 (총 객실 105개) / 2호점 빅토리아 (총 객실 80개)</span></div> -->
 <img src="<?=$g4['path']?>/mobile/images/sub01_02.gif" width="100%" />
 <img src="<?=$g4['path']?>/mobile/images/sub01_03.gif" width="100%" />



<!-- 오시는길 -->
	<img src="./images/map.gif" width="100%"><br />
    <!-- <a href="sub2_1.php"><img src="images/google.gif"></a><br />
	<img src="./images/map2.gif" width="100%"></div> -->








  </div>
  <!-- <div><img src="<?=$g4['path']?>/mobile/images/showfam_01.jpg" width="100%" /><br /><img src="<?=$g4['path']?>/mobile/images/showfam_02.jpg" width="100%" /><br /><img src="<?=$g4['path']?>/mobile/images/showfam_03.jpg" width="100%" /><br /><img src="<?=$g4['path']?>/mobile/images/showfam_04.jpg" width="100%" /></div>
  <div><img src="<?=$g4['path']?>/mobile/images/vicfam_01.jpg" width="100%" /><br /><img src="<?=$g4['path']?>/mobile/images/vicfam_02.jpg" width="100%" /><br /><img src="<?=$g4['path']?>/mobile/images/vicfam_03.jpg" width="100%" /></div> -->





</div><!-- /visual -->
	

<?php include_once './_tail.php';
?>

