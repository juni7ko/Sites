<?php

if (!defined('_GNUBOARD_'))
    exit;
/*
 * 그룹 메뉴 출력용,
 * $hide_group = "group_2,group_3"; 출력하지 그룹명 입력, 여러 그룹일 경우 쉼표 ','로 구분해서 입력한다.
 * group_menu($hide_group);
 *
 */

function print_ta($var) {
    echo "<textarea style='width:99%; height:200px'>";
    print_r($var);
    echo "</textarea>";
}

// 파일을 보이게 하는 링크 (이미지, 플래쉬, 동영상)
function m_view_file_link($file, $width, $height, $content="") {
    global $config, $board;
    global $g4;
    static $ids;

    if (!$file)
        return;

    $ids++;

    // 파일의 폭이 게시판설정의 이미지폭 보다 크다면 게시판설정 폭으로 맞추고 비율에 따라 높이를 계산
    if ($width > $board['bo_image_width'] && $board['bo_image_width']) {
        $rate = $board['bo_image_width'] / $width;
        $width = $board['bo_image_width'];
        $height = (int) ($height * $rate);
    }

    // 폭이 있는 경우 폭과 높이의 속성을 주고, 없으면 자동 계산되도록 코드를 만들지 않는다.
    if ($width)
        $attr = " width='$width' height='$height' ";
    else
        $attr = "";

    if (preg_match("/\.({$config['cf_image_extension']})$/i", $file))
        return "<img src='{$g4['path']}/data/file/{$board['bo_table']}/" . urlencode($file) . "' name='target_resize_image[]' onclick='image_window(this);' style='cursor:pointer;' title='$content'>";
}

// 게시글에 첨부된 파일을 얻는다. (배열로 반환)
function m_get_file($bo_table, $wr_id) {
    global $g4, $qstr;

    $file["count"] = 0;
    $sql = " select * from {$g4['board_file_table']} where bo_table = '$bo_table' and wr_id = '$wr_id' order by bf_no ";
    $result = sql_query($sql);
    while ($row = sql_fetch_array($result)) {
        $no = $row['bf_no'];
        $file[$no]['href'] = "./download.php?bo_table=$bo_table&wr_id=$wr_id&no=$no" . $qstr;
        $file[$no]['download'] = $row[bf_download];
        $file[$no]['path'] = "{$g4['path']}/data/file/$bo_table";
        $file[$no]['size'] = get_filesize($row['bf_filesize']);
        $file[$no]['datetime'] = $row['bf_datetime'];
        $file[$no]['source'] = addslashes($row['bf_source']);
        $file[$no]['bf_content'] = $row['bf_content'];
        $file[$no]['content'] = get_text($row['bf_content']);
        $file[$no]['view'] = m_view_file_link($row['bf_file'], $row['bf_width'], $row['bf_height'], $file[$no]['content']);
        $file[$no]['file'] = $row['bf_file'];
        $file[$no]['image_width'] = $row['bf_width'] ? $row['bf_width'] : 640;
        $file[$no]['image_height'] = $row['bf_height'] ? $row['bf_height'] : 480;
        $file[$no]['image_type'] = $row['bf_type'];
        $file["count"]++;
    }

    return $file;
}

// 게시물 정보($write_row)를 출력하기 위하여 $list로 가공된 정보를 복사 및 가공
function m_get_list($write_row, $board, $skin_path, $subject_len=40) {
    global $g4, $config;
    global $qstr, $page;

    //$t = get_microtime();
    // 배열전체를 복사
    $list = $write_row;
    unset($write_row);

    $list['is_notice'] = preg_match("/[^0-9]{0,1}{$list['wr_id']}[\r]{0,1}/", $board['bo_notice']);

    if ($subject_len)
        $list['subject'] = conv_subject($list['wr_subject'], $subject_len, "…");
    else
        $list['subject'] = conv_subject($list['wr_subject'], $board['bo_subject_len'], "…");

    // 목록에서 내용 미리보기 사용한 게시판만 내용을 변환함 (속도 향상) : kkal3(커피)님께서 알려주셨습니다.
    if ($board['bo_use_list_content']) {
        $html = 0;
        if (strstr($list['wr_option'], "html1"))
            $html = 1;
        else if (strstr($list['wr_option'], "html2"))
            $html = 2;

        $list['content'] = conv_content($list['wr_content'], $html);
    }

    $list['comment_cnt'] = "";
    if ($list['wr_comment'])
        $list['comment_cnt'] = "({$list['wr_comment']})";

    // 당일인 경우 시간으로 표시함
    $list['datetime'] = substr($list['wr_datetime'], 0, 10);
    $list['datetime2'] = $list['wr_datetime'];
    if ($list['datetime'] == $g4['time_ymd'])
        $list['datetime2'] = substr($list['datetime2'], 11, 5);
    else
        $list['datetime2'] = substr($list['datetime2'], 5, 5);
    // 4.1
    $list['last'] = substr($list['wr_last'], 0, 10);
    $list['last2'] = $list['wr_last'];
    if ($list['last'] == $g4['time_ymd'])
        $list['last2'] = substr($list['last2'], 11, 5);
    else
        $list['last2'] = substr($list['last2'], 5, 5);

    $list['wr_homepage'] = get_text(addslashes($list['wr_homepage']));

    $tmp_name = get_text(cut_str($list['wr_name'], $config['cf_m_cut_name'])); // 설정된 자리수 만큼만 이름 출력
    if ($board['bo_use_sideview'])
        $list['name'] = get_sideview($list['mb_id'], $tmp_name, $list['wr_email'], $list['wr_homepage']);
    else
        $list['name'] = "<span class='" . ($list['mb_id'] ? 'member' : 'guest') . "'>$tmp_name</span>";

    $reply = $list['wr_reply'];

    $list['reply'] = "";
    if (strlen($reply) > 0) {
        for ($k = 0; $k < strlen($reply); $k++)
            $list['reply'] .= ' &nbsp;&nbsp; ';
    }

    $list['icon_reply'] = "";
    if ($list['reply'])
        $list['icon_reply'] = "<img src='$skin_path/img/icon_reply.gif'>";

    $list['icon_link'] = "";
    if ($list['wr_link1'] || $list['wr_link2'])
        $list['icon_link'] = "<img src='$skin_path/img/icon_link.gif'>";

    // 분류명 링크
    $list['ca_name_href'] = "{$g4['g4m_bbs_path']}/board.php?bo_table={$board['bo_table']}&amp;sca=" . urlencode($list['ca_name']);

    $list['href'] = "{$g4['g4m_bbs_path']}/board.php?bo_table={$board['bo_table']}&amp;wr_id={$list['wr_id']}" . $qstr;
    //$list['href'] = "$g4[bbs_path]/board.php?bo_table=$board[bo_table]&amp;wr_id=$list[wr_id]";
    if ($board['bo_use_comment'])
        $list['comment_href'] = "javascript:win_comment('{$g4['g4m_bbs_path']}/board.php?bo_table={$board['bo_table']}&amp;wr_id={$list['wr_id']}&amp;cwin=1');";
    else
        $list['comment_href'] = $list['href'];

    $list['icon_new'] = "";
    if ($list['wr_datetime'] >= date("Y-m-d H:i:s", $g4['server_time'] - ($board['bo_new'] * 3600)))
        $list['icon_new'] = "<img src='$skin_path/img/icon_new.gif'>";

    $list['icon_hot'] = "";
    if ($list['wr_hit'] >= $board['bo_hot'])
        $list['icon_hot'] = "<img src='$skin_path/img/icon_hot.gif'>";

    $list['icon_secret'] = "";
    if (strstr($list['wr_option'], "secret"))
        $list['icon_secret'] = "<img src='$skin_path/img/icon_secret.gif'>";

    // 링크
    for ($i = 1; $i <= $g4['link_count']; $i++) {
        $list['link'][$i] = set_http(get_text($list["wr_link{$i}"]));
        $list['link_href'][$i] = "{$g4['g4m_bbs_path']}/link.php?bo_table={$board['bo_table']}&amp;wr_id={$list['wr_id']}&amp;no=$i" . $qstr;
        $list['link_hit'][$i] = (int) $list["wr_link{$i}_hit"];
    }

    // 가변 파일
    $list['file'] = m_get_file($board['bo_table'], $list['wr_id']);

    if ($list['file']['count'])
        $list['icon_file'] = "<img src='$skin_path/img/icon_file.gif'>";

    return $list;
}

// get_list 의 alias
function m_get_view($write_row, $board, $skin_path, $subject_len=125) {
    return m_get_list($write_row, $board, $skin_path, $subject_len);
}

//출력하지 않을 그룹 id 입력, 여러 그룹일 경우 쉼표(,)로 구분
function group_menu($hide_group = false) {
    global $g4;
    if (!empty($hide_group)) {
        $hide = explode(",", $hide_group);
        $hide_group_count = count($hide);
        $where = ' where ';
        for ($i = 0; $i < $hide_group_count; $i++) {
            if ($i + 1 == $hide_group_count) {
                $and = "";
            } else {
                $and = " and ";
            }
            $where .= " gr_id != '" . $hide[$i] . "' $and ";
        }
    }
    $menu = "";
    $menu .= "<div class='lnb'>";
    $menu .= "<menu class='gr_menu'>";
    $group_sort = ' gr_1 '; //정렬에 사용할 필드
    $sql = "select gr_id, gr_subject from {$g4['group_table']} $where order by $group_sort ";
    $result = sql_query($sql);

    for ($i = 0; $gr_menu = sql_fetch_array($result); $i++) {
        $menu .= "<li><a href='{$g4['g4m_path']}/group.php?gr_id={$gr_menu['gr_id']}'>{$gr_menu['gr_subject']}</a></li>";
    }
    $menu .="</menu>";
    $menu .="</div>";
    return $menu;
}

/*
 * 게시판 메뉴 출력 함수
 * $hide_bbs = "bbs1,bbs2"; 출력하지 게시판id 입력, 여러일 경우 쉼표 ','로 구분해서 입력한다.
 *
 */

function board_menu($hide_bbs=false) {
    global $g4, $gr_id;
    if (!empty($hide_bbs)) {
        $hide = explode(",", $hide_bbs);
        $hide_bbs_count = count($hide);
        $where = '';
        for ($i = 0; $i < $hide_bbs_count; $i++) {
            if ($i + 1 == $hide_bbs_count) {
                $and = "";
            } else {
                $and = " and ";
            }
            $where .= " bo_table != '" . $hide[$i] . "' $and ";
        }
        $first_and = " and ";
    }
    $menu = "";
    $menu .= "<div class='le_menu'>";
    $menu .= "<div class='title'>메뉴</div>";
    $menu .= "<ul class='bo_menu'>";

    $group_id = !$gr_id ? $_GET['gr_id'] : $gr_id;
    $sql = "select bo_table, bo_subject from `{$g4['board_table']}` where `gr_id` = '{$group_id}' $first_and $where";
    $result = sql_query($sql);
    while ($bo_menu = sql_fetch_array($result)) {
        $menu .= "<li> &middot; <a href='{$g4['path']}/bbs/board.php?bo_table={$bo_menu['bo_table']}'>{$bo_menu['bo_subject']}</a></li>";
    }
    $menu .= "</ul>";
    $menu .= "</div>";
    if ($gr_id)
        return $menu;
}

// g4m 최신글 추출
function g4m_latest($skin_dir="", $bo_table, $options="") {
    global $g4;
    if ($skin_dir)
        $latest_skin_path = "{$g4['g4m_path']}/skin/latest/$skin_dir";
    else
        $latest_skin_path = "{$g4['g4m_path']}/skin/latest/g4m_basic";

    $list = array();

    $sql = " select * from $g4[board_table] where bo_table = '$bo_table'";
    $board = sql_fetch($sql);
    $tmp_write_table = $g4['write_prefix'] . $bo_table; // 게시판 테이블 전체이름
    //$sql = " select * from $tmp_write_table where wr_is_comment = 0 order by wr_id desc limit 0, $rows ";
    // 위의 코드 보다 속도가 빠름
    $sql = " select * from $tmp_write_table where wr_is_comment = 0 order by wr_num limit 0, {$board['bo_m_latest_rows']} ";
    //explain($sql);
    $result = sql_query($sql);
    for ($i = 0; $row = sql_fetch_array($result); $i++)
        $list[$i] = m_get_list($row, $board, $latest_skin_path, $board['bo_m_latestsub_len']);

    ob_start();
    include "$latest_skin_path/latest.skin.php";
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}

function g4m_skin_path() {
    global $g4, $board;
    // g4m 스킨경로
    $board_skin_path = '';
    if (isset($board['bo_m_skin']))
        $board_skin_path = "{$g4['g4m_path']}/skin/board/{$board['bo_m_skin']}"; // 게시판 스킨 경로
    return $board_skin_path;
}
?>
