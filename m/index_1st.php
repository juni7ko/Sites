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

    echo g4m_latest(g4m_basic, "bbs13");  // 공지사항
    echo g4m_latest(g4m_basic, "bbs61");  //여행후기
    echo g4m_latest(g4m_basic, "bbs36");  // 예약문의
    echo g4m_latest(g4m_basic, "bbs41");  //포토갤러리
    echo g4m_latest(g4m_basic, "bbs12");   // 자주하는질문


include_once './_tail.php';
?>
