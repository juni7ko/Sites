<?php
define("_GNUBOARD_", TRUE);
$g4['use_mobile']           = true;
$g4['g4m']                  = "m";
$g4['g4m_path']             = "{$g4['path']}/{$g4['g4m']}";
$g4['g4m_bbs']              = "bbs";
$g4['g4m_bbs_path']         = "{$g4['g4m_path']}/{$g4['g4m_bbs']}";
$g4['g4m_url']              = "{$g4['url']}/{$g4['g4m']}";
$g4['g4m_admin']            = "adm";
$g4['g4m_admin_path']       = $g4['g4m_path'] . "/" . $g4['g4m_admin'];
$g4['thumb']                = $g4['g4m_path'] . "/thumb.php";

//모바일 체크 함수 적용법.
/*
 모바일 하단에 PC버전 링크에 ?from=mobile 추가, 추가 하지 않으면 클릭해도 다시 모바일로 돌아온다.
 PC버전 index.php 파일에 아래 내용 추가
 PC 버전 하단에 모바일 링크 제공 <a href="<?=$g4[path]?>/m/?from=pc">모바일</a> 
 이 링크는 frommoblie세션을 삭제해 모바일로 PC접버전 접속시 자동으로 모바일로 이동되게 한다.

//모바일 index.php 상단에 아래 추가  include_once "./_common.php"; 아래에 추가할것
//모바일 기기에서 PC버전 페이지의 모바일가기 링크 클릭하면 세션을 삭제.
if($_GET['from'] == 'pc'){
    set_session("frommoblie", "");
}

PC 버전 index.php 파일 상단에 아래 추가  include_once "./_common.php"; 아래에 추가할것
$chk_mobile = chkMobile();
if($_GET['from'] == 'mobile'){
    //새션 생성 이유는 모바일기기에서 PC버전 갔을경우 index.php을 다시 접속했을때 모바일로 오지않고 pc버전 유지하기 위해서이다.
    set_session("frommoblie", "1");
}
 
//모바일페이지로 이동,
if($chk_mobile == true && !$_SESSION['frommoblie']){
    header("location:/{$g4['g4m_path'] }");
}
 * 말로 표현할 방법이 없네요.;;;
 * 한마디로 왔다갔다 꼬임 방지;;;
 * PC버전 바로가기 링크 클릭하면 모바일로 자동 이동 기능이 중지됨.
 * PC버전 페이지에서 모바일로 바로가기를 클릭하면 모바일로 자동 이동 기능이 활성화 됨.
 */
function chkMobile(){
    $mobile_browser = '0';
    if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
        $mobile_browser++;
    }
    if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']), 'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
        $mobile_browser++;
    }
    $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
    $mobile_agents = array(
        'w3c ', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq', 'bird', 'blac',
        'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno',
        'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-',
        'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-',
        'newt', 'noki', 'oper', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox',
        'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar',
        'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-',
        'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp',
        'wapr', 'webc', 'winw', 'winw', 'xda', 'xda-');

    if (in_array($mobile_ua, $mobile_agents)) {
        $mobile_browser++;
    }
    if (strpos(strtolower($_SERVER['ALL_HTTP']), 'OperaMini') > 0) {
        $mobile_browser++;
    }
    if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') > 0) {
        $mobile_browser = 0;
    }


    if ($mobile_browser > 0 && $_GET['from'] != 'mobile') {
        return false;
        //모바일 기기일 경우 모바일 페이지로
        /*
        if (!strstr($_SERVER['HTTP_REFERER'], "")) {
            header("location:");
        }
         *
         */
    }else{
        return false;
    }
}
?>
