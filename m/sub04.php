<?php
include_once "./_common.php";
//pc버전에서 모바일가기 링크 타고 들어올 경우 세션을 삭제한다. 세션이 삭제되면 모바일 기기에서 PC버전 접속시 자동으로 모바일로 이동된다. /extend/g4m.config.php 파일 참고.
if($_GET['from'] == 'pc'){
    set_session("frommoblie", "");
}
include_once './_head.php';
/*
//  최신글
$sql = " select bo_table, bo_subject,bo_m_latest_skin from {$g4['board_table']} where bo_m_use='1' order by gr_id, bo_m_sort, bo_table ";
$result = sql_query($sql);
for ($i = 0; $row = sql_fetch_array($result); $i++) {
		echo $row['bo_m_latest_skin']."&nbsp;&nbsp;&nbsp;".$row['bo_table']."<br>";
		 echo g4m_latest($row['bo_m_latest_skin'], $row['bo_table']);
}
*/
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



<?php echo g4m_latest(g4m_basic, "bbs13");  // 공지사항
//    echo g4m_latest(g4m_basic, "bbs61");  //여행후기
//    echo g4m_latest(g4m_gallery, "bbs41");  //포토갤러리
	echo g4m_latest(g4m_basic, "bbs36");  // 예약문의
    echo g4m_latest(g4m_basic, "bbs12");   // 자주하는질문


include_once './_tail.php';
?>
