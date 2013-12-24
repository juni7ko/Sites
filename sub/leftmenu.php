		

<div id="snb">

	<?php if($sub=='1'){?>			
				
				<!-- sub navi 1 -->
				<ul>
					<li><a href="<?=$g4['path']?>/sub/sub.php?ct_id=1" class="snb1-1<?=$on1?>">소개</a></li>
					<li><a href="<?=$g4['path']?>/sub/sub.php?ct_id=2" class="snb1-2<?=$on2?>">회사연혁</a></li>
					<li><a href="<?=$g4['path']?>/sub/sub.php?ct_id=3" class="snb1-3<?=$on3?>">인증서</a></li>
					<li><a href="<?=$g4['path']?>/sub/sub.php?ct_id=4" class="snb1-4<?=$on4?>">오시는길</a></li>
				</ul>


  <?php }else if($sub=='2'){?>

				<!-- sub navi 2 -->
				<ul>
					<li><a href="<?=$g4['path']?>/sub/sub.php?ct_id=5" class="snb2-1<?=$on1?>">연구소</a></li>
					<li><a href="<?=$g4['path']?>/sub/sub.php?ct_id=6" class="snb2-2<?=$on2?>">조직배양실</a></li>
					<li><a href="<?=$g4['path']?>/sub/sub.php?ct_id=7" class="snb2-3<?=$on3?>">신품종감자</a></li>
					<li><a href="<?php echo $g4['path']?>/bbs/board.php?bo_table=propety" class="snb3-4<?=$on4?>">특허</a></li>
				</ul>

  <?php }else if($sub=='3'){?> <!-- 제품소개 -->

				<!-- sub navi 3 -->
				<ul>
					<li><a href="<?=$g4['path']?>/sub/sub.php?ct_id=9" class="snb3-1<?=$on1?>">감자</a></li>
					<li><a href="<?=$g4['path']?>/sub/sub.php?ct_id=10" class="snb3-2<?=$on2?>">산채</a></li>
					<li><a href="<?=$g4['path']?>/sub/sub.php?ct_id=11" class="snb3-3<?=$on3?>">고구마</a></li>
					<li><a href="<?=$g4['path']?>/sub/sub.php?ct_id=12" class="snb3-4<?=$on4?>">가공식품</a></li>
				</ul>

  <?php }else if($sub=='4'){?> 

				<!-- sub navi 5  자료실 -->
				<ul>
					<li><a href="<?php echo $g4['path']?>/bbs/board.php?bo_table=data1" class="snb4-1<?=$on1?>">감자</a></li>
					<li><a href="<?php echo $g4['path']?>/bbs/board.php?bo_table=data2" class="snb4-2<?=$on2?>">산채</a></li>
					<li><a href="<?php echo $g4['path']?>/bbs/board.php?bo_table=data3" class="snb4-3<?=$on3?>">고구마</a></li>
					<li><a href="<?php echo $g4['path']?>/bbs/board.php?bo_table=news" class="snb4-4<?=$on4?>">농업뉴스</a></li>
					<li><a href="<?php echo $g4['path']?>/bbs/board.php?bo_table=site" class="snb4-5<?=$on5?>">관련사이트</a></li>
					<li><a href="<?php echo $g4['path']?>/bbs/board.php?bo_table=gallery" class="snb4-6<?=$on6?>">갤러리</a></li>
				</ul>


  <?php }else if($sub=='5'){?>

				<!-- sub navi 5 -->
				<ul>
					<li><a href="<?php echo $g4['path']?>/bbs/board.php?bo_table=notice" class="snb5-1<?=$on1?>">공지사항</a></li>
					<li><a href="<?php echo $g4['path']?>/bbs/board.php?bo_table=faq" class="snb5-2<?=$on2?>">FAQ</a></li>
					<li><a href="<?php echo $g4['path']?>/bbs/board.php?bo_table=qna" class="snb5-3<?=$on3?>">문의하기</a></li>
				</ul>

	 <?php }else{?>


	<?php }?>

	</div>

			<div class="snb-cs-center">
				<span class="blind">문의전화 : 033.241.0068</span>
			</div>

	</div>
