<?php
// 이 파일은 새로운 파일 생성시 반드시 포함되어야 함
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$begin_time = get_microtime();

if (!$g4['title'])
    $g4['title'] = $config['cf_title'];

// 쪽지를 받았나?
if ($member['mb_memo_call']) {
    $mb = get_member($member[mb_memo_call], "mb_nick");
    sql_query(" update {$g4[member_table]} set mb_memo_call = '' where mb_id = '$member[mb_id]' ");

    alert($mb[mb_nick]."님으로부터 쪽지가 전달되었습니다.", $_SERVER[REQUEST_URI]);
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
header("Content-Type: text/html; charset=$g4[charset]");
$gmnow = gmdate("D, d M Y H:i:s") . " GMT";
header("Expires: 0"); // rfc2616 - Section 14.21
header("Last-Modified: " . $gmnow);
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: pre-check=0, post-check=0, max-age=0"); // HTTP/1.1
header("Pragma: no-cache"); // HTTP/1.0
/*
// 만료된 페이지로 사용하시는 경우
header("Cache-Control: no-cache"); // HTTP/1.1
header("Expires: 0"); // rfc2616 - Section 14.21
header("Pragma: no-cache"); // HTTP/1.0
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">
<head>
<meta http-equiv="content-type" content="text/html; charset=<?=$g4['charset']?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>펜션할인사이트</title>
<script language="javascript" type="text/javascript" src="https://pay.bluepay.co.kr/Script/BluePayAPI.js"></script>
<!-- <script language="javascript" type="text/javascript" src="https://api.bluepay.co.kr/ajax/common/OpenPayAPI.js"></script> -->

<link rel="stylesheet" href="<?=$g4['path']?>/style.css" type="text/css">

<link rel="stylesheet" type="text/css" href="<?=$g4['path']?>/css/style.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?=$g4['path']?>/css/ui_theme/jquery-ui-1.8.13.custom.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?=$g4['path']?>/js/fancybox/jquery.fancybox-1.3.4.css" media="all" />
<?php if(stristr($_SERVER[PHP_SELF], "/bbs/board.php") == true && $bo_table && $wr_id){?>
<link rel="canonical" href="<?=$_SERVER[PHP_SELF];?>?bo_table=<?=$bo_table;?>&wr_id=<?=$wr_id;?>" />
<?php }?>

<link rel="stylesheet" type="text/css" href="<?=$g4['path']?>/css/skin.css"  media="all" />



<?php
//레이아웃 스킨 CSS 로드
if(!is_null($layout_skin_path) && file_exists($layout_skin_path . '/css/style.css'))
	echo '<link rel="stylesheet" type="text/css" href="'.$layout_skin_path.'/css/style.css" charset="UTF-8" media="all" />'."\n";
//회원서비스 스킨 CSS 로드
if(!is_null($member_skin_path) && file_exists($member_skin_path . '/css/style.css'))
	echo '<link rel="stylesheet" type="text/css" href="'.$member_skin_path.'/css/style.css" charset="UTF-8" media="all" />'."\n";
//게시판 스킨 CSS 로드
if(!is_null($board_skin_path) && file_exists($board_skin_path . '/css/style.css'))
	echo '<link rel="stylesheet" type="text/css" href="'.$board_skin_path.'/css/style.css" charset="UTF-8" media="all" />'."\n";
//최근게시물 스킨 CSS 로드
if(!is_null($new_skin_path) && file_exists($new_skin_path . '/css/style.css'))
	echo '<link rel="stylesheet" type="text/css" href="'.$new_skin_path.'/css/style.css" charset="UTF-8" media="all" />'."\n";
//현재접속자스킨 CSS 로드
if(!is_null($connect_skin_path) && file_exists($connect_skin_path . '/css/style.css'))
	echo '<link rel="stylesheet" type="text/css" href="'.$connect_skin_path.'/css/style.css" charset="UTF-8" media="all" />'."\n";
//사용자 정의 스킨
if(file_exists($g4['path'] . '/css/skin.css'))
	echo '<link rel="stylesheet" type="text/css" href="' . $g4['path'] . '/css/skin.css" charset="UTF-8" media="all" />'."\n";
/*
$latest_skin_path			//최근게시물 스킨
$outlogin_skin_path		//외부로그인 스킨
$poll_skin_path				//설문조사 스킨
$visit_skin_path			//현재접속자 스킨(외부호출, current_connect.php 페이지 제외)
위 변수는 함수내에서 스킨폴더를 정의하므로 head에서 호출 할 수 없습니다.
/css/skin.css 파일에 CSS를 직접 정의해두도록 합니다.
*/

// 최신글 스타일을 페이지 상단에 선언된 배열로 호출한다
if (is_array($skin_dirs)){

    foreach($skin_dirs as $skin_dir){

        $skin_dir_path = $g4['path'] . '/skin/' . $skin_dir . '/css';
        if (is_dir($skin_dir_path)) {

            $d = dir($skin_dir_path);

            while (false !== ($entry = $d->read())) {
                if (preg_match("`\.css$`i", $entry)) {
                    echo '<link rel="stylesheet" type="text/css" href="' . $skin_dir_path . '/' . $entry . '"  media="all" />'."\n";
                }
            }
            $d->close();
        }
    }
}


?>


<script type="text/javascript">
// 자바스크립트에서 사용하는 전역변수 선언
var g4_path      = "<?=$g4['path']?>";
var g4_bbs       = "<?=$g4['bbs']?>";
var g4_bbs_img   = "<?=$g4['bbs_img']?>";
var g4_url       = "<?=$g4['url']?>";
var g4_is_member = "<?=$is_member?>";
var g4_is_admin  = "<?=$is_admin?>";
var g4_bo_table  = "<?=isset($bo_table)?$bo_table:'';?>";
var g4_sca       = "<?=isset($sca)?$sca:'';?>";
var g4_charset   = "<?=$g4['charset']?>";
var g4_cookie_domain = "<?=$g4['cookie_domain']?>";
var g4_is_gecko  = navigator.userAgent.toLowerCase().indexOf("gecko") != -1;
var g4_is_ie     = navigator.userAgent.toLowerCase().indexOf("msie") != -1;
<?php if ($is_admin) { echo "var g4_admin = '{$g4['admin']}';"; } ?>
</script>
<script type="text/javascript" src="<?=$g4['path']?>/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?=$g4['path']?>/js/jquery.livequery.min.js"></script>
<script type="text/javascript" src="<?=$g4['path']?>/js/common.js"></script>


<script type="text/javascript" src="<?=$g4['path']?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?=$g4['path']?>/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?=$g4['path']?>/js/jquery.external.js"></script>
<script type="text/javascript" src="<?=$g4['path']?>/js/common.js"></script>
<script type="text/javascript" src="<?=$g4['path']?>/js/wrest.js"></script>
<script type="text/javascript" src="<?=$g4['path']?>/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>

	<!------------------------------------------------>
	<!-- * 추가                                     -->
	<!------------------------------------------------>

	<script type="text/javascript" src="<?=$g4['path']?>/layout/js/jquery.1.9.1.min.js"></script>
	<script type="text/javascript" src="<?=$g4['path']?>/layout/js/easing.js"></script>
	<script type="text/javascript" src="<?=$g4['path']?>/layout/js/jquery.bxslider.js"></script>
	<script type="text/javascript" src="<?=$g4['path']?>/layout/js/jquery.ui.totop.js"></script>
	<script type="text/javascript" src="<?=$g4['path']?>/layout/js/common.js"></script>

	<script type="text/javascript" src="<?=$g4['path']?>/js/jquery.msgbox.min.js"></script>

	<link rel="stylesheet" type="text/css" href="<?=$g4['path']?>/layout/css/common.css" />
	<link rel="stylesheet" type="text/css" href="<?=$g4['path']?>/layout/css/style.css" />
	<!--[if lte IE 7]><link rel="stylesheet" type="text/css" href="<?=$g4['path']?>/layout/css/ie.css" media="all" /><![endif]-->

</head>

<body topmargin="0" leftmargin="0" <?=isset($g4['body_script']) ? $g4['body_script'] : "";?>>
<a name="g4_head"></a>
