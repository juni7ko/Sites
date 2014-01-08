<?php
include_once("./_common.php");

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

	$bo_skin = "basic";
	$bo_page_rows = "15";
	$bo_write_level = "1";
	$bo_use_secret = "0";
	$bo_upload_count = "2";

	switch ($rId) {
		case '1':
			$rName = $penName['wr_subject'] . " 이용후기";
			break;
		case '2':
			$rName = $penName['wr_subject'] . " 질문답변";
			$bo_use_secret = "2";
			break;
		case '3':
			$rName = $penName['wr_subject'] . " 포토갤러리";
			$bo_skin = "basic_gallery";
			$bo_page_rows = "16";
			$bo_upload_count = "0";
			break;
		case '4':
			$rName = $penName['wr_subject'] . " 공지사항";
			$bo_write_level = "5";
			break;
		default:
			$rName = $penName['wr_subject'];
			break;
	}

	echo $rName . " 게시판 생성중 .....<br />";
	//중복되지 않는 부분.
	$sql_diff = "bo_table           = '$br_id',
				gr_id               = '$gr_id',
				bo_subject          = '$rName',
				bo_use_secret       = '$bo_use_secret',
				bo_write_level      = '$bo_write_level',
				bo_image_width      = '900',
				bo_skin             = '$bo_skin',
				bo_gallery_cols     = '4',
				bo_page_rows        = '$bo_page_rows',
				bo_upload_count     = '$bo_upload_count'
				";

	// 중복되는 부분.
	$sql_common = "bo_admin         = '',
                bo_list_level       = '1',
                bo_read_level       = '1',
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
                bo_use_dhtml_editor = '1',
                bo_use_rss_view     = '0',
                bo_use_comment      = '0',
                bo_use_good         = '0',
                bo_use_nogood       = '0',
                bo_use_name         = '1',
                bo_use_signature    = '0',
                bo_use_ip_view      = '0',
                bo_use_trackback    = '0',
                bo_use_list_view    = '1',
                bo_use_list_content = '0',
                bo_use_email        = '0',
                bo_table_width      = '97',
                bo_subject_len      = '80',
                bo_new              = '24',
                bo_hot              = '100',
                bo_include_head     = '',
                bo_include_tail     = '',
                bo_content_head     = '',
                bo_content_tail     = '',
                bo_insert_content   = '',
                bo_upload_size      = '11048576',
                bo_reply_order      = '1',
                bo_use_search       = '1',
                bo_order_search     = '0',
                bo_write_min        = '0',
                bo_write_max        = '0',
                bo_comment_min      = '0',
                bo_comment_max      = '0',
                bo_sort_field       = '' ";

	$b_sql = " INSERT INTO g4_board SET
                bo_count_write = '0',
                bo_count_comment = '0',
				$sql_diff,
				$sql_common ";
    sql_query($b_sql);

	$brdSql = "CREATE TABLE IF NOT EXISTS `g4_write_{$br_id}` (
		  `wr_id` int(11) NOT NULL auto_increment,
		  `wr_num` int(11) NOT NULL default '0',
		  `wr_reply` varchar(10) NOT NULL default '',
		  `wr_parent` int(11) NOT NULL default '0',
		  `wr_is_comment` tinyint(4) NOT NULL default '0',
		  `wr_comment` int(11) NOT NULL default '0',
		  `wr_comment_reply` varchar(5) NOT NULL default '',
		  `ca_name` varchar(255) NOT NULL default '',
		  `wr_option` set('html1','html2','secret','mail') NOT NULL default '',
		  `wr_subject` varchar(255) NOT NULL default '',
		  `wr_content` text NOT NULL,
		  `wr_link1` text NOT NULL,
		  `wr_link2` text NOT NULL,
		  `wr_link1_hit` int(11) NOT NULL default '0',
		  `wr_link2_hit` int(11) NOT NULL default '0',
		  `wr_trackback` varchar(255) NOT NULL default '',
		  `wr_hit` int(11) NOT NULL default '0',
		  `wr_good` int(11) NOT NULL default '0',
		  `wr_nogood` int(11) NOT NULL default '0',
		  `mb_id` varchar(255) NOT NULL default '',
		  `wr_password` varchar(255) NOT NULL default '',
		  `wr_name` varchar(255) NOT NULL default '',
		  `wr_email` varchar(255) NOT NULL default '',
		  `wr_homepage` varchar(255) NOT NULL default '',
		  `wr_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
		  `wr_last` varchar(19) NOT NULL default '',
		  `wr_ip` varchar(255) NOT NULL default '',
		  `wr_1` varchar(255) NOT NULL default '',
		  `wr_2` varchar(255) NOT NULL default '',
		  `wr_3` varchar(255) NOT NULL default '',
		  `wr_4` varchar(255) NOT NULL default '',
		  `wr_5` varchar(255) NOT NULL default '',
		  `wr_6` varchar(255) NOT NULL default '',
		  `wr_7` varchar(255) NOT NULL default '',
		  `wr_8` varchar(255) NOT NULL default '',
		  `wr_9` varchar(255) NOT NULL default '',
		  `wr_10` varchar(255) NOT NULL default '',
		  PRIMARY KEY  (`wr_id`),
		  KEY `wr_num_reply_parent` (`wr_num`,`wr_reply`,`wr_parent`),
		  KEY `wr_is_comment` (`wr_is_comment`,`wr_id`)
		); ";
	sql_query($brdSql);
}

goto_url("{$g4[path]}/bbs/board.php?bo_table=$br_id");
?>
