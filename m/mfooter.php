

	<div id="subcon" style="padding:10px;text-align:center;"><a href="#"><img src="<?php echo $g4['url']?>/mobile/images/btn_top.png" width="81" class="top" /></a><br></div>

	<div class="main-btn">
	<!-- <a href="<?php echo $g4['url']?>/bbs/board.php?bo_table=bbs34">쇼앤뉴그린 예약</a> / <a href="http://victoriamotel.net/bbs/board.php?bo_table=bbs34">빅토리아 예약</a> -->
	<!-- <a href="<?php echo $g4['url']?>/m/1_1.php?bo_table=bbs34">쇼앤뉴그린 예약</a> /  --><a href="http://victoriamotel.net/m/" target="_blank">빅토리아 모바일사이트 바로가기</a>
	</div>
	
	<div class="main-info">
	상담전화 : T.<a href="tel:0336552776">033.655.2776</a> / <a href="tel:0336442777">033.644.2777</a> / H.<a href="tel:01041831777">010.4183.1777</a><br />
	입금계좌 : 농협 351-0612-3360-83 이석순
	</div>
	
	<div class="copyright">
	상호 : 쇼앤뉴그린<br />주소 : 강원도 강릉시 강문동 302-9 쇼모텔
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



