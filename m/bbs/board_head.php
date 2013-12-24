<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

// 게시판 관리의 상단 파일 경로
if ($board['bo_m_include_head'])
    @include $board['bo_m_include_head'];
/*
if ($board[bo_image_head]) 
    echo "<img src='$g4[path]/data/file/$bo_table/{$board['bo_image_head']}' border='0'>";
*/
// 게시판 관리의 상단 내용
if ($board['bo_m_content_head'])
    echo stripslashes($board['bo_m_content_head']);
?>



    <div class="rk">
        <h2> 

<?php if($bo_table == 'bbs61' || $bo_table == 'bbs41') {?>

		<!-- <a href="<?php echo $g4['g4m_bbs_path']?>/new.php">최신게시물</a> -->
				<a href="<?php echo $g4['g4m_bbs_path']?>/board.php?bo_table=bbs61">여행후기</a> &nbsp;&nbsp;|&nbsp;&nbsp;
				<a href="<?php echo $g4['g4m_bbs_path']?>/board.php?bo_table=bbs41">포토앨범</a> &nbsp;&nbsp;|&nbsp;&nbsp;
				<a href="http://blog.naver.com/PostThumbnailList.nhn?blogId=bsb0332&widgetTypeCall=true&categoryNo=1&topReferer=http%3A%2F%2Fadmin.blog.naver.com%2Fbsb0332%2Fconfig%2Ftopmenu" target="_blank">동영상</a>	 	

<?php }else {?>
				<a href="<?php echo $g4['g4m_bbs_path']?>/board.php?bo_table=bbs13">공지사항</a> &nbsp;&nbsp;|&nbsp;&nbsp;
				<a href="<?php echo $g4['g4m_bbs_path']?>/board.php?bo_table=bbs36">예약문의</a>	 &nbsp;&nbsp;|&nbsp;&nbsp;
				<a href="<?php echo $g4['g4m_bbs_path']?>/board.php?bo_table=bbs12">자주하는질문</a>
<?php }?>


		</h2>


        <!-- <h2> <a href="<?php echo $g4['g4m_bbs_path']?>/new.php">최신게시물</a></h2> -->
        <!-- <div id="rkc_top" class="rkc">
            <p class="dy"><?php echo $g4['time_ymdhis']?></p>
            <a class="btop" id="rkc_more" href="javascript:;">펼치기</a>
            <div id="rank">
                <p><span class="nc">쇼앤뉴그린 mobile</span></p>
                <div style="display: table;margin:0 auto; text-align: center;padding:10px; overflow: hidden">
                    <?php
//관리자 그룹 설정 첫번째 추가필드gr_1 를 정렬에 사용한다.
                    $hide_group = ""; //출력하지 않을 그룹 id 입력, 여러 그룹일 경우 쉼표(,)로 구분
                    echo group_menu($hide_group);
                    ?>
                </div>

            </div>
            <div class="pgw"><p class="pg"><a href="#" id="close_group">menu</a></p></div>
        </div> -->
    </div><!--//.rk-->
