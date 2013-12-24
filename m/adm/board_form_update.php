<?php
$sub_menu = "300100";
include_once "./_common.php";

if ($w == 'u')
    check_demo();

auth_check($auth[$sub_menu], "w");

if (!$_POST['gr_id']) { alert("그룹 ID는 반드시 선택하세요."); }
if (!$bo_table) { alert("게시판 TABLE명은 반드시 입력하세요."); }
if (!preg_match("/^([A-Za-z0-9_]{1,20})$/", $bo_table)) { alert("게시판 TABLE명은 공백없이 영문자, 숫자, _ 만 사용 가능합니다. (20자 이내)"); }

if($file =  $_POST['bo_m_include_head']){
    if (!preg_match("/\.(php|htm[l]?)$/i",$file)) {
        alert("상단 파일 경로가 php, html 파일이 아닙니다.");
    }
}
if($file = $_POST['bo_m_include_tail']){
    if (!preg_match("/\.(php|htm[l]?)$/i", $file)) {
        alert("하단 파일 경로가 php, html 파일이 아닙니다.");
    }
}


check_token();

$board_path = "{$g4['path']}/data/file/$bo_table";

// 분류에 & 나 = 는 사용이 불가하므로 2바이트로 바꾼다.
$src_char = array('&', '=');
$dst_char = array('＆', '〓'); 
$bo_category_list = str_replace($src_char, $dst_char, $bo_category_list);

$sql_common = " bo_m_table_width        = '{$_POST['bo_m_table_width']}',
                bo_m_subject_len        = '{$_POST['bo_m_subject_len']}',
                bo_m_page_rows          = '{$_POST['bo_m_page_rows']}',
                bo_m_image_width        = '{$_POST['bo_m_image_width']}',
                bo_m_skin               = '{$_POST['bo_m_skin']}',
                bo_m_include_head       = '{$_POST['bo_m_include_head']}',
                bo_m_include_tail       = '{$_POST['bo_m_include_tail']}',
                bo_m_content_head       = '{$_POST['bo_m_content_head']}',
                bo_m_content_tail       = '{$_POST['bo_m_content_tail']}',
                bo_m_use                = '{$_POST['bo_m_use']}',
                bo_m_sort               = '{$_POST['bo_m_sort']}',
                bo_m_latest_skin        = '{$_POST['bo_m_latest_skin']}',
                bo_m_latest_rows        = '{$_POST['bo_m_latest_rows']}',
                bo_m_latestsub_len      = '{$_POST['bo_m_latestsub_len']}'
                ";

if ($w == "") {
    //모바일에서는 게시판을 생성하지 않는다.
    ;
} else if ($w == "u") {
    // 게시판의 글 수
    $sql = " select count(*) as cnt from {$g4['write_prefix']}$bo_table where wr_is_comment = 0 ";
    $row = sql_fetch($sql);
    $bo_count_write = $row['cnt'];

    // 게시판의 코멘트 수
    $sql = " select count(*) as cnt from {$g4['write_prefix']}$bo_table where wr_is_comment = 1 ";
    $row = sql_fetch($sql);
    $bo_count_comment = $row['cnt'];

    // 글수 조정
    if ($proc_count) {
        // 원글을 얻습니다.
        $sql = " select wr_id from {$g4['write_prefix']}$bo_table where wr_is_comment = 0 ";
        $result = sql_query($sql);
        for ($i=0; $row=sql_fetch_array($result); $i++) {
            // 코멘트수를 얻습니다.
            $sql2 = " select count(*) as cnt from {$g4['write_prefix']}$bo_table where wr_parent = '{$row['wr_id']}' and wr_is_comment = 1 ";
            $row2 = sql_fetch($sql2);

            sql_query(" update {$g4['write_prefix']}$bo_table set wr_comment = '{$row2['cnt']}' where wr_id = '{$row['wr_id']}' ");
        }
    }

    // 공지사항에는 등록되어 있지만 실제 존재하지 않는 글 아이디는 삭제합니다.
    $bo_notice = "";
    $lf = "";
    if ($board['bo_notice']) {
        $tmp_array = explode("\n", $board['bo_notice']);
        for ($i=0; $i<count($tmp_array); $i++) {
            $tmp_wr_id = trim($tmp_array[$i]);
            $row = sql_fetch(" select count(*) as cnt from {$g4['write_prefix']}$bo_table where wr_id = '$tmp_wr_id' ");
            if ($row['cnt'])
            {
                $bo_notice .= $lf . $tmp_wr_id;
                $lf = "\n";
            }
        }
    }

    $sql = " update {$g4['board_table']}
                set bo_notice = '$bo_notice',
                    bo_count_write = '$bo_count_write',
                    bo_count_comment = '$bo_count_comment',
                    $sql_common
              where bo_table = '$bo_table' ";
    sql_query($sql);
}


// 같은 그룹내 게시판 동일 옵션 적용
$s = "";
if ($chk_m_skin)            $s .= " , bo_m_skin =           '$bo_m_skin' ";
if ($chk_m_table_width)     $s .= " , bo_m_table_width =    '$bo_m_table_width' ";
if ($chk_m_page_rows)       $s .= " , bo_m_page_rows =      '$bo_m_page_rows' ";
if ($chk_m_subject_len)     $s .= " , bo_m_subject_len =    '$bo_m_subject_len' ";
if ($chk_m_image_width)     $s .= " , bo_m_image_width =    '$bo_m_image_width' ";
if ($chk_m_include_head)    $s .= " , bo_m_include_head =   '$bo_m_include_head' ";
if ($chk_m_include_tail)    $s .= " , bo_m_include_tail =   '$bo_m_include_tail' ";
if ($chk_m_content_head)    $s .= " , bo_m_content_head =   '$bo_m_content_head' ";
if ($chk_m_content_tail)    $s .= " , bo_m_content_tail =   '$bo_m_content_tail' ";
if ($chk_m_use)             $s .= " , bo_m_use =            '$bo_m_use' ";
if ($chk_m_sort)            $s .= " , bo_m_sort =           '$bo_m_sort' ";
if ($chk_m_latest_skin)     $s .= " , bo_m_latest_skin =    '$bo_m_latest_skin' ";
if ($chk_m_latest_rows)     $s .= " , bo_m_latest_rows =    '$bo_m_latest_rows' ";
if ($chk_m_latestsub_len)   $s .= " , bo_m_latestsub_len =  '$bo_m_latestsub_len' ";

if ($s) {
    $sql = " update {$g4['board_table']} set bo_table = bo_table {$s} where gr_id = '$gr_id' ";
    sql_query($sql);
}
goto_url("./board_form.php?w=u&bo_table=$bo_table&$qstr");
?>
