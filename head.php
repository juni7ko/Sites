<?php
if(!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once($g4['path'].'/head.sub.php');
include_once($g4['path'].'/lib/outlogin.lib.php');
include_once($g4['path'].'/lib/poll.lib.php');
include_once($g4['path'].'/lib/visit.lib.php');
include_once($g4['path'].'/lib/connect.lib.php');
include_once($g4['path'].'/lib/latest.lib.php');
include_once($g4['path'].'/lib/latest.gr.lib.php');
?>

<?php
// 해드호출
include_once($g4['path'].'/skin/layout/head.php');

// 레프트메뉴호출
if($Menu_Sub_Id)
	include_once($g4['path'].'/skin/layout/aside.php');
?>
