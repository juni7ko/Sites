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
	<!-- <a href="http://www.showmotel.com/bbs/board.php?bo_table=bbs13"><img src="<?=$g4['path']?>/mobile/images/community_01.gif" width="100%" /></a><br />
    <a href="http://www.showmotel.com/bbs/board.php?bo_table=bbs41"><img src="<?=$g4['path']?>/mobile/images/community_02.gif" width="100%" /></a><br />
    <a href="http://www.showmotel.com/bbs/board.php?bo_table=bbs61"><img src="<?=$g4['path']?>/mobile/images/community_03.gif" width="100%" /></a><br />
    <a href="http://blog.naver.com/PostThumbnailList.nhn?blogId=bsb0332&amp;widgetTypeCall=true&amp;categoryNo=1&amp;topReferer=http%3A%2F%2Fadmin.blog.naver.com%2Fbsb0332%2Fconfig%2Ftopmenu"><img src="<?=$g4['path']?>/mobile/images/community_04.gif" width="100%" /></a><br />
    <a href="http://www.showmotel.com/bbs/board.php?bo_table=bbs36"><img src="<?=$g4['path']?>/mobile/images/community_05.gif" width="100%" /></a><br /><img src="<?=$g4['path']?>/mobile/images/community_06.gif" width="100%" /> -->
	
	<a href="<?php echo $g4['url']?>/m/bbs/board.php?bo_table=bbs13"><img src="<?=$g4['path']?>/mobile/images/community_01.gif" width="100%" /></a><br />
    <a href="<?php echo $g4['url']?>/m/bbs/board.php?bo_table=bbs41"><img src="<?=$g4['path']?>/mobile/images/community_02.gif" width="100%" /></a><br />
    <a href="<?php echo $g4['url']?>/m/bbs/board.php?bo_table=bbs61"><img src="<?=$g4['path']?>/mobile/images/community_03.gif" width="100%" /></a><br />
    <a href="http://blog.naver.com/PostThumbnailList.nhn?blogId=bsb0332&amp;widgetTypeCall=true&amp;categoryNo=1&amp;topReferer=http%3A%2F%2Fadmin.blog.naver.com%2Fbsb0332%2Fconfig%2Ftopmenu" target="_blank"><img src="<?=$g4['path']?>/mobile/images/community_04.gif" width="100%" /></a><br />
    <a href="<?php echo $g4['url']?>/m/bbs/board.php?bo_table=bbs36"><img src="<?=$g4['path']?>/mobile/images/community_05.gif" width="100%" /></a><br /><img src="<?=$g4['path']?>/mobile/images/community_06.gif" width="100%" />

	</div>


</div><!-- /visual -->
	

<?php include_once './_tail.php';
?>

