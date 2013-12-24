<?php
/*
 * g4m mobile
 * http://www.g4m.kr
 */
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$begin_time = get_microtime();

if (!$g4['title'])
    $g4['title'] = $config['cf_title'];

// 쪽지를 받았나?
if ($member['mb_memo_call']) {
    $mb = get_member($member['mb_memo_call'], "mb_nick");
    sql_query(" update {$g4['member_table']} set mb_memo_call = '' where mb_id = '{$member['mb_id']}' ");

    alert($mb[mb_nick]."님으로부터 쪽지가 전달되었습니다.", $_SERVER['REQUEST_URI']);
}


// 현재 접속자
//$lo_location = get_text($g4[title]);
//$lo_location = $g4[title];
// 게시판 제목에 ' 포함되면 오류 발생
$lo_location = addslashes($g4['title']);
if (!$lo_location)
    $lo_location = $_SERVER['REQUEST_URI'];
//$lo_url = $g4[url] . $_SERVER['REQUEST_URI'];
$lo_url = $_SERVER['REQUEST_URI'];
if (strstr($lo_url, "/$g4[admin]/") || $is_admin == "super") $lo_url = "";

// 자바스크립트에서 go(-1) 함수를 쓰면 폼값이 사라질때 해당 폼의 상단에 사용하면
// 캐쉬의 내용을 가져옴. 완전한지는 검증되지 않음
header("Content-Type: text/html; charset={$g4['charset']}");
$gmnow = gmdate("D, d M Y H:i:s") . " GMT";
header("Expires: 0"); // rfc2616 - Section 14.21
header("Last-Modified: " . $gmnow);
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: pre-check=0, post-check=0, max-age=0"); // HTTP/1.1
header("Pragma: no-cache"); // HTTP/1.0
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">
    <head>
        <meta name="Author" content="showmotel.com">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi" > 
        <meta http-equiv="content-type" content="text/html; charset=<?php echo $g4['charset'] ?>">
        <title><?php echo $g4['title'] ?></title>

        <script type="text/javascript">
            // 자바스크립트에서 사용하는 전역변수 선언
            var g4_path      = "<?php echo $g4['path'] ?>";
            var g4m_path     = "<?php echo $g4['g4m_path'] ?>";
            var g4_bbs       = "<?php echo $g4['bbs'] ?>";
            var g4m_bbs      = "<?php echo $g4['g4m_bbs'] ?>";
            var g4_bbs_img   = "<?php echo $g4['bbs_img'] ?>";
            var g4_url       = "<?php echo $g4['url'] ?>";
            var g4_is_member = "<?php echo $is_member ?>";
            var g4_is_admin  = "<?php echo $is_admin ?>";
            var g4_bo_table  = "<?php echo isset($bo_table) ? $bo_table : ''; ?>";
            var g4_sca       = "<?php echo isset($sca) ? $sca : ''; ?>";
            var g4_charset   = "<?php echo $g4['charset'] ?>";
            var g4_cookie_domain = "<?php echo $g4['cookie_domain'] ?>";
            var g4_is_gecko  = navigator.userAgent.toLowerCase().indexOf("gecko") != -1;
            var g4_is_ie     = navigator.userAgent.toLowerCase().indexOf("msie") != -1;
            <?php if ($is_admin) {
                echo "var g4_admin = '{$g4['admin']}';";
            } ?>
        </script>
        <!-- <script type="text/javascript" src="<?php echo $g4['g4m_path'] ?>/js/jquery-1.5.2.min.js"></script> -->
        <!-- <script type="text/javascript" src="<?php echo $g4['g4m_path'] ?>/js/jquery-ui-1.8.11.custom.min.js"></script> -->
        <script type="text/javascript" src="<?php echo $g4['g4m_path'] ?>/js/common.js"></script>

         <!--
		 <link  rel="stylesheet" type="text/css" href="<?php echo $g4['g4m_path'] ?>/css/mobile.css" ></link>
		 <link  rel="stylesheet" type="text/css" href="<?php echo $g4['g4m_path'] ?>/css/redmond/jquery-ui-1.8.11.custom.css" ></link>
		 <link  rel="stylesheet" type="text/css" href="<?php echo $g4['g4m_path'] ?>/css/showmotel.css" ></link> 
		 -->



<link  rel="stylesheet" type="text/css" href="<?php echo $g4['g4m_path'] ?>/css/mobile.css" ></link>


<script type="text/javascript" src="<?php echo $g4['g4m_path'] ?>/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo $g4['g4m_path'] ?>/js/jquery.slider.js"></script>
<script type="text/javascript" src="<?php echo $g4['g4m_path'] ?>/js/jquery.slider.setting.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo $g4['g4m_path'] ?>/css/slider.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $g4['g4m_path'] ?>/css/style.css" />





    </head>
    <body>


<div id="mobile-wrap">

	<h1 class="logo"><a href="<?php echo $g4['g4m_path'] ?>/index.php">펜션할인 펜션다나와</a></h1>

	<nav id="gnb">
		<ul>
			<?php include "mtopmenu.php";?>
		</ul>
	</nav>




<div class="clear-bottom"></div>
