<?php
$g4_path = ".."; // common.php 의 상대 경로
include_once("$g4_path/common.php");
include_once($g4['path'].'/head.sub.php');

if(!$rId && !$pId) alert("Error");

$gr_id = "pen_" . $pId; // 그룹 ID
$br_id = $gr_id . "_" . $rId; // 게시판 ID

// 1단계 - 그룹 생성 여부 확인
$chkGrp = sql_fetch(" SELECT count(*) as cnt FROM g4_group WHERE gr_id = '$gr_id' ");

if(!$chkGrp[cnt]) {
	// 그룹 생성
	echo "게시판 그룹 생성중 .....<br />";

	// 펜션 이름 추출 후 그룹명으로 지정한다.
	$penName = sql_fetch(" SELECT wr_subject FROM g4_write_pension_info WHERE pension_id = '$pId' LIMIT 1 ");

	// 그룹 생성..
	$g_sql = " INSERT INTO g4_group (
			`gr_id`,
			`gr_subject`,
			`gr_admin`,
			`gr_use_access`
		) VALUES (
			'$gr_id',
			'$penName[wr_subject]',
			'',
			0
		); ";

	sql_query($g_sql);

	echo "게시판 그룹 생성 완료 .....<br />";
}

// 2단계 - 게시판 생성 여부 확인
$chkBrd = sql_fetch(" SELECT count(*) as cnt FROM g4_board WHERE gr_id = '$gr_id' AND bo_table = '$br_id' ");

if(!$chkBrd[cnt]) {
	$penName = sql_fetch(" SELECT wr_subject FROM g4_write_pension_info WHERE pension_id = '$pId' LIMIT 1 ");

	switch ($rId) {
		case '1':
			$rName = $penName['wr_subject'] . " 이용후기";
			break;
		case '2':
			$rName = $penName['wr_subject'] . " 질문답변";
			break;
		case '3':
			$rName = $penName['wr_subject'] . " 포토갤러리";
			break;
		case '4':
			$rName = $penName['wr_subject'] . " 공지사항";
			break;
		default:
			$rName = $penName['wr_subject'];
			break;
	}

	echo $rName . " 게시판 생성중 .....<br />";
	//중복되지 않는 부분.
	$sql_diff = "gr_id              = '$gr_id',
				bo_subject          = '$rName',
				bo_use_secret       = '0',";

	// 중복되는 부분.
	$sql_common = "bo_admin            = '',
                bo_list_level       = '1',
                bo_read_level       = '1',
                bo_write_level      = '1',
                bo_reply_level      = '3',
                bo_comment_level    = '1',
                bo_html_level       = '1',
                bo_link_level       = '1',
                bo_trackback_level  = '1',
                bo_count_modify     = '1',
                bo_count_delete     = '1',
                bo_upload_level     = '1',
                bo_download_level   = '1',
                bo_read_point       = '0',
                bo_write_point      = '0',
                bo_comment_point    = '0',
                bo_download_point   = '0',
                bo_use_category     = '0',
                bo_category_list    = '',
                bo_disable_tags     = '',
                bo_use_sideview     = '0',
                bo_use_file_content = '0',
                bo_use_dhtml_editor = '$_POST[bo_use_dhtml_editor]',
                bo_use_rss_view     = '$_POST[bo_use_rss_view]',
                bo_use_comment      = '$_POST[bo_use_comment]',
                bo_use_good         = '$_POST[bo_use_good]',
                bo_use_nogood       = '$_POST[bo_use_nogood]',
                bo_use_name         = '$_POST[bo_use_name]',
                bo_use_signature    = '$_POST[bo_use_signature]',
                bo_use_ip_view      = '$_POST[bo_use_ip_view]',
                bo_use_trackback    = '$_POST[bo_use_trackback]',
                bo_use_list_view    = '$_POST[bo_use_list_view]',
                bo_use_list_content = '$_POST[bo_use_list_content]',
                bo_use_email        = '$_POST[bo_use_email]',
                bo_table_width      = '$_POST[bo_table_width]',
                bo_subject_len      = '$_POST[bo_subject_len]',
                bo_page_rows        = '$_POST[bo_page_rows]',
                bo_new              = '24',
                bo_hot              = '100',
                bo_image_width      = '$_POST[bo_image_width]',
                bo_skin             = '$_POST[bo_skin]',
                bo_include_head     = '',
                bo_include_tail     = '',
                bo_content_head     = '',
                bo_content_tail     = '',
                bo_insert_content   = '',
                bo_gallery_cols     = '$_POST[bo_gallery_cols]',
                bo_upload_count     = '$_POST[bo_upload_count]',
                bo_upload_size      = '$_POST[bo_upload_size]',
                bo_reply_order      = '$_POST[bo_reply_order]',
                bo_use_search       = '$_POST[bo_use_search]',
                bo_order_search     = '$_POST[bo_order_search]',
                bo_write_min        = '$_POST[bo_write_min]',
                bo_write_max        = '$_POST[bo_write_max]',
                bo_comment_min      = '$_POST[bo_comment_min]',
                bo_comment_max      = '$_POST[bo_comment_max]',
                bo_sort_field       = '$_POST[bo_sort_field]' ";

	$b_sql = " INSERT INTO g4_board SET
				bo_table = '$br_id',
                bo_count_write = '0',
                bo_count_comment = '0',
				$sql_common ";
	echo $b_sql;
    //sql_query($sql);

}


$sql = "CREATE TABLE IF NOT EXISTS `{$res_table}_r_cost` (
  `r_info_id` int(11) NOT NULL default '0',
  `r_cost_11` int(7) NOT NULL default '0',
  `r_cost_12` int(7) NOT NULL default '0',
  `r_cost_13` int(7) NOT NULL default '0',
  `r_cost_14` int(7) NOT NULL default '0',
  `r_cost_15` int(7) NOT NULL default '0',
  PRIMARY KEY  (`r_info_id`)
);";
//sql_query($sql);
?>


<?php
include_once("$g4[path]/tail.sub.php");
?>
