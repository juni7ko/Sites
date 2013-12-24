<?php include_once "_common.php";

include_once("$g4[path]/head.sub.php"); 
include_once("$board_skin_path/config.php"); 

if($is_admin != 'super') alert("관리자만 접근이 가능합니다."); 

if(!$bo_table) alert("정상적인 접근이 아닙니다."); 

if ($board[bo_include_head]) include ("../../$board[bo_include_head]"); 
if ($board[bo_image_head]) echo "<img src='$g4[path]/data/file/$bo_table/$board[bo_image_head]' border='0'>"; 
if ($board[bo_content_head]) echo stripslashes($board[bo_content_head]); 
############# 헤드
$this_page = "{$_SERVER['PHP_SELF']}?bo_table={$bo_table}";
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr><td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) left top;"></td>
<td bgcolor="#ffffff">&nbsp;</td>
<td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) right top;"></td></tr>
</table>
<div style="background:#ffffff; text-align:left;">
<?php include_once("{$board_skin_path}/inc_top_menu.php");

// 예약테이블 생성하기.
$g4_sql_table = "g4_write_";
//$bo_table = "test_m";
$res_table = $g4_sql_table . $bo_table;

$sql = "CREATE TABLE IF NOT EXISTS `{$res_table}_r_cost` (
  `r_info_id` int(11) NOT NULL default '0',
  `r_cost_11` int(7) NOT NULL default '0',
  `r_cost_12` int(7) NOT NULL default '0',
  `r_cost_13` int(7) NOT NULL default '0',
  `r_cost_14` int(7) NOT NULL default '0',
  `r_cost_15` int(7) NOT NULL default '0',
  PRIMARY KEY  (`r_info_id`)
);";
sql_query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `{$res_table}_r_date` (
	`r_date_idx` int(11) NOT NULL auto_increment,
	`r_date_name` varchar(20) NOT NULL default '',
	`r_date_sdate` int(10) NOT NULL default '0',
	`r_date_edate` int(10) NOT NULL default '0',
	PRIMARY KEY  (`r_date_idx`)
);";
sql_query($sql);

// 기간별 요금 저장 DB
$sql = "CREATE TABLE IF NOT EXISTS `{$res_table}_r_date_cost` (
	`r_dcost_idx` int(11) NOT NULL auto_increment,
	`r_info_id` int(11) NOT NULL default '0',
	`r_date_idx` int(11) NOT NULL default '0',
	`r_date_cost_1` int(7) NOT NULL default '0',
	`r_date_cost_2` int(7) NOT NULL default '0',
	`r_date_cost_3` int(7) NOT NULL default '0',
	`r_date_cost_4` int(7) NOT NULL default '0',
	`r_date_cost_5` int(7) NOT NULL default '0',
	PRIMARY KEY  (`r_dcost_idx`)
);";
sql_query($sql);

## 2009-05-29 기간별 요금설정으로 인한 수정
/*
$sql = "CREATE TABLE IF NOT EXISTS `{$res_table}_r_date1` (
  `r_date1_idx` int(11) NOT NULL auto_increment,
  `r_date1_sdate` int(10) NOT NULL default '0',
  `r_date1_edate` int(10) NOT NULL default '0',
  PRIMARY KEY  (`r_date1_idx`)
);";
sql_query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `{$res_table}_r_date2` (
  `r_date2_idx` int(11) NOT NULL auto_increment,
  `r_date2_sdate` int(11) NOT NULL default '0',
  `r_date2_edate` int(11) NOT NULL default '0',
  PRIMARY KEY  (`r_date2_idx`)
);";
sql_query($sql);
*/
$sql = "CREATE TABLE IF NOT EXISTS `{$res_table}_r_info` (
  `r_info_id` int(11) NOT NULL auto_increment,
  `r_info_name` varchar(40) NOT NULL default '',
  `r_info_area` varchar(20) NOT NULL default '',
  `r_info_person1` int(2) NOT NULL default '2',
  `r_info_person2` int(2) NOT NULL default '4',
  `r_info_person3` int(2) NOT NULL default '2',
  `r_info_person_add` int(11) NOT NULL default '10000',
  `r_info_cnt` int(2) NOT NULL default '1',
  `r_info_over` char(1) NOT NULL default 'X',
  `r_info_order` int(7) NOT NULL default '0',
  PRIMARY KEY  (`r_info_id`),
  UNIQUE KEY `r_info_name` (`r_info_name`)
);";
sql_query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `{$res_table}_r_off` (
  `r_off_idx` int(11) NOT NULL auto_increment,
  `r_off_name` varchar(20) NOT NULL default '',
  `r_off_date` int(11) NOT NULL default '0',
  `r_off_date2` int(11) NOT NULL default '0',
  PRIMARY KEY  (`r_off_idx`)
);";
sql_query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `{$res_table}_r_close` (
  `r_close_idx` int(11) NOT NULL auto_increment,
  `r_close_name` varchar(20) NOT NULL default '',
  `r_close_date` int(11) NOT NULL default '0',
  `r_close_date2` int(11) NOT NULL default '0',
  PRIMARY KEY  (`r_close_idx`)
);";
sql_query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `{$res_table}_r_tel` (
  `r_tel_idx` int(11) NOT NULL auto_increment,
  `r_tel_name` varchar(20) NOT NULL default '',
  `r_tel_date` int(11) NOT NULL default '0',
  `r_tel_date2` int(11) NOT NULL default '0',
  PRIMARY KEY  (`r_tel_idx`)
);";
sql_query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `{$res_table}_r_option` (
  `r_op_id` int(11) NOT NULL auto_increment,
  `r_op_name` varchar(40) NOT NULL default '',
  `r_op_cost` int(7) NOT NULL default '0',
  PRIMARY KEY  (`r_op_id`)
);";
sql_query($sql);

// 2009.01.13 추가
sql_query(" ALTER TABLE `{$res_table}_r_info` ADD `r_info_multi` char( 1 ) NOT NULL default 'X' AFTER `r_info_order` ", FALSE);
sql_query(" UPDATE `{$res_table}` SET wr_9 = '1' WHERE wr_9 = '' ", FALSE);
sql_query(" ALTER TABLE `{$res_table}` ADD `wr_reserv` text NOT NULL ", FALSE);
?>
업그레이드 완료!!
</div>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr><td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) left bottom;"></td>
<td bgcolor="#ffffff">&nbsp;</td>
<td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) right bottom;"></td></tr>
</table>
<?php
############# 푸터
if ($board[bo_content_tail]) echo stripslashes($board[bo_content_tail]); 
if ($board[bo_image_tail]) echo "<img src='$g4[path]/data/file/$bo_table/$board[bo_image_tail]' border='0'>"; 
if ($board[bo_include_tail]) @include ("../../$board[bo_include_tail]"); 

include_once("$g4[path]/tail.sub.php"); 
?>
