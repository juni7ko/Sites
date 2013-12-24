<?php
// 상대 경로
$g4_path = "..";
include_once "./_common.php";
include_once "./_head.php";
$g4['title'] = $group['gr_subject'];

//  최신글
$sql = " select bo_table, bo_subject,bo_m_latest_skin from {$g4['board_table']} where gr_id = '$gr_id' and bo_list_level <= '{$member['mb_level']}' and bo_m_use ='1' order by bo_m_sort, bo_table ";
$result = sql_query($sql);
for ($i = 0; $row = sql_fetch_array($result); $i++) {
    // g4m_latest(스킨, 게시판아이디) 글자수,출력라인은 모바일 게시판 환경설정에서 한다.
    echo g4m_latest($row['bo_m_latest_skin'], $row['bo_table']);
}

include_once "./_tail.php";
?>
