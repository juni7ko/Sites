
	<div id="subcon" style="padding:10px;text-align:center;"><a href="#"><img src="<?php echo $g4['url']?>/mobile/images/btn_top.png" width="81" class="top" /></a><br></div>

	<div class="main-btn">
		<a href="http://pension.so/" target="_blank">펜션플러스</a>
	</div>
	
	<div class="main-info">
	상담전화 : T.<a href="tel:0336426718">033-642-6718</a> / H.<a href="tel:01056526718">010-5652-6718</a><br />
	입금계좌 : 농협 301-0081-3040-81 조용만
	</div>
	
	<div class="copyright">
	상호 : 펜션다나와<br />주소 : 강원도 강릉시 강릉원주대학교 산학협력관 904호
	</div>
	
	<div class="pc-ver" style="padding-bottom:20px;">

   <?php if($is_member){?>
        <a href="<?php echo $g4['g4m_path']?>/logout.php?url=<?php echo urlencode($_SERVER['REQUEST_URI'])?>" <?php if(!$_GET['wr_id']){ echo "class='f'";} ?>>로그아웃</a>
        <?php }else{ ?>
        <a <?php if(!$_GET['wr_id']){ echo "class='f'";} ?> href="<?php echo $g4['g4m_path']?>/login.php?url=<?php echo urlencode($_SERVER['REQUEST_URI'])?>">로그인</a>
        <?php } ?>
 &nbsp;&nbsp;|&nbsp;&nbsp;
	<a href="<?php echo $g4['url']?>?from=mobile">PC버전 보기</a>
	</div>



</div><!-- /mobile-wrap -->


<!-- <address class="cr"><div class="copy_href"><a href="<?php echo $g4['url']?>?from=mobile">http://showmotel.com</a></div></address> -->

<?php
include_once "{$g4['g4m_path']}/tail.sub.php";
?>

