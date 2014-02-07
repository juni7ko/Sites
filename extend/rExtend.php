<?php
function view_file_link2($file, $width, $height, $content="") {
    global $config, $board;
    global $g4;
    static $ids;

    if (!$file) return;

    $ids++;

    // 파일의 폭이 게시판설정의 이미지폭 보다 크다면 게시판설정 폭으로 맞추고 비율에 따라 높이를 계산
    if ($width > $board[bo_image_width] && $board[bo_image_width])
    {
        $rate = $board[bo_image_width] / $width;
        $width = $board[bo_image_width];
        $height = (int)($height * $rate);
    }

    // 폭이 있는 경우 폭과 높이의 속성을 주고, 없으면 자동 계산되도록 코드를 만들지 않는다.
    if ($width)
        $attr = " width='$width' height='$height' ";
    else
        $attr = "";

    if (preg_match("/\.($config[cf_image_extension])$/i", $file))
        return "<img src='$g4[path]/data/file/$board[bo_table]/".urlencode($file)."' ".$attr."  name='target_resize_image[]'  onclick='image_window(this);' style='cursor:pointer;' title='$content'>";
}

function view_file_link3($file, $width, $height, $content="") {
    global $config, $board;
    global $g4;
    static $ids;

    if (!$file) return;

    $ids++;

    // 파일의 폭이 게시판설정의 이미지폭 보다 크다면 게시판설정 폭으로 맞추고 비율에 따라 높이를 계산
    if ($width > $board[bo_image_width] && $board[bo_image_width])
    {
        $rate = $board[bo_image_width] / $width;
        $width = $board[bo_image_width];
        $height = (int)($height * $rate);
    }

    // 폭이 있는 경우 폭과 높이의 속성을 주고, 없으면 자동 계산되도록 코드를 만들지 않는다.
    if ($width)
        $attr = " width='$width' height='$height' ";
    else
        $attr = "";

    if (preg_match("/\.($config[cf_image_extension])$/i", $file))
        return "<img src='$g4[path]/data/file/$board[bo_table]/".urlencode($file)."' ".$attr."  name='target_resize_image[]' style='cursor:pointer;' title='$content'>";
}

function get_file_room($bo_table, $wr_id) {
    global $g4, $qstr;

    $file["count"] = 0;
    $sql = " select * from $g4[pension_file_table] where bo_table = '$bo_table' and wr_id = '$wr_id' order by bf_no ";

    $result = sql_query($sql);
    while ($row = sql_fetch_array($result))
    {
        $no = $row[bf_no];
        $file[$no][href] = "./download.php?bo_table=$bo_table&wr_id=$wr_id&no=$no" . $qstr;
        $file[$no][download] = $row[bf_download];
        // 4.00.11 - 파일 path 추가
        $file[$no][path] = "$g4[path]/data/file/roomFile";
        //$file[$no][size] = get_filesize("{$file[$no][path]}/$row[bf_file]");
        $file[$no][size] = get_filesize($row[bf_filesize]);
        //$file[$no][datetime] = date("Y-m-d H:i:s", @filemtime("$g4[path]/data/file/$bo_table/$row[bf_file]"));
        $file[$no][datetime] = $row[bf_datetime];
        $file[$no][source] = addslashes($row[bf_source]);
        $file[$no][bf_content] = $row[bf_content];
        $file[$no][content] = get_text($row[bf_content]);
        //$file[$no][view] = view_file_link($row[bf_file], $file[$no][content]);
        $file[$no][view] = view_file_link($row[bf_file], $row[bf_width], $row[bf_height], $file[$no][content]);
        $file[$no][view_big] = view_file_link2($row[bf_file], 370, 246, $file[$no][content]);
        $file[$no][view_small] = view_file_link3($row[bf_file], 70, 47, $file[$no][content]);
        $file[$no][file] = $row[bf_file];
        // prosper 님 제안
        //$file[$no][imgsize] = @getimagesize("{$file[$no][path]}/$row[bf_file]");
        $file[$no][image_width] = $row[bf_width] ? $row[bf_width] : 640;
        $file[$no][image_height] = $row[bf_height] ? $row[bf_height] : 480;
        $file[$no][image_type] = $row[bf_type];
        $file["count"]++;
    }

    return $file;
}

function get_rResult($rCode) {
    switch ($rCode) {
        case '0010':
            $rResult = "예약대기";
            break;
        case '0020':
            $rResult = "예약완료";
            break;
        case '0030':
            $rResult = "예약취소";
            break;
        case '0040':
            $rResult = "관리자예약";
            break;
        default:
            $rResult = "예약대기";
            break;
    }

    return $rResult;
}

function get_payMent($pCode) {
    switch ($pCode) {
        case '1':
            $rResult = "무통장입금";
            break;
        case '2':
            $rResult = "실시간계좌이체";
            break;
        case '3':
            $rResult = "신용카드";
            break;
        default:
            $rResult = "무통장입금";
            break;
    }

    return $rResult;
}

function get_list2($write_row, $board, $skin_path, $subject_len=40)
{
    global $g4, $config;
    global $qstr, $page;
    global $pension_id;

    //$t = get_microtime();

    // 배열전체를 복사
    $list = $write_row;
    unset($write_row);

    $list['is_notice'] = preg_match("/[^0-9]{0,1}{$list['wr_id']}[\r]{0,1}/",$board['bo_notice']);

    if ($subject_len)
        $list['subject'] = conv_subject($list['wr_subject'], $subject_len, "…");
    else
        $list['subject'] = conv_subject($list['wr_subject'], $board['bo_subject_len'], "…");

    // 목록에서 내용 미리보기 사용한 게시판만 내용을 변환함 (속도 향상) : kkal3(커피)님께서 알려주셨습니다.
    if ($board['bo_use_list_content'])
    {
        $html = 0;
        if (strstr($list['wr_option'], "html1"))
            $html = 1;
        else if (strstr($list['wr_option'], "html2"))
            $html = 2;

        $list['content'] = conv_content($list['wr_content'], $html);
    }

    $list['comment_cnt'] = "";
    if ($list['wr_comment'])
        $list['comment_cnt'] = "($list[wr_comment])";

    // 당일인 경우 시간으로 표시함
    $list['datetime'] = substr($list['wr_datetime'],0,10);
    $list['datetime2'] = $list['wr_datetime'];
    if ($list['datetime'] == $g4['time_ymd'])
        $list['datetime2'] = substr($list['datetime2'],11,5);
    else
        $list['datetime2'] = substr($list['datetime2'],5,5);
    // 4.1
    $list['last'] = substr($list['wr_last'],0,10);
    $list['last2'] = $list['wr_last'];
    if ($list['last'] == $g4['time_ymd'])
        $list['last2'] = substr($list['last2'],11,5);
    else
        $list['last2'] = substr($list['last2'],5,5);

    $list['wr_homepage'] = get_text(addslashes($list['wr_homepage']));

    $tmp_name = get_text(cut_str($list['wr_name'], $config['cf_cut_name'])); // 설정된 자리수 만큼만 이름 출력
    if ($board['bo_use_sideview'])
        $list['name'] = get_sideview($list['mb_id'], $tmp_name, $list['wr_email'], $list['wr_homepage']);
    else
        $list['name'] = "<span class='".($list['mb_id']?'member':'guest')."'>$tmp_name</span>";

    $reply = $list['wr_reply'];

    $list['reply'] = "";
    if (strlen($reply) > 0)
    {
        for ($k=0; $k<strlen($reply); $k++)
            $list['reply'] .= ' &nbsp;&nbsp; ';
    }

    $list['icon_reply'] = "";
    if ($list['reply'])
        $list['icon_reply'] = "<img src='$skin_path/img/icon_reply.gif' align='absmiddle'>";

    $list['icon_link'] = "";
    if ($list['wr_link1'] || $list['wr_link2'])
        $list['icon_link'] = "<img src='$skin_path/img/icon_link.gif' align='absmiddle'>";

    // 분류명 링크
    $list['ca_name_href'] = "$g4[bbs_path]/resList.php?bo_table=$board[bo_table]&pension_id=$pension_id&sca=".urlencode($list['ca_name']);

    $list['href'] = "$g4[bbs_path]/resList.php?bo_table=$board[bo_table]&pension_id=$pension_id&wr_id=$list[wr_id]" . $qstr;
    //$list['href'] = "$g4[bbs_path]/resList.php?bo_table=$board[bo_table]&pension_id=$pension_id&wr_id=$list[wr_id]";
    if ($board['bo_use_comment'])
        $list['comment_href'] = "javascript:win_comment('$g4[bbs_path]/resList.php?bo_table=$board[bo_table]&pension_id=$pension_id&wr_id=$list[wr_id]&cwin=1');";
    else
        $list['comment_href'] = $list['href'];

    $list['icon_new'] = "";
    if ($list['wr_datetime'] >= date("Y-m-d H:i:s", $g4['server_time'] - ($board['bo_new'] * 3600)))
        $list['icon_new'] = "<img src='$skin_path/img/icon_new.gif' align='absmiddle'>";

    $list['icon_hot'] = "";
    if ($list['wr_hit'] >= $board['bo_hot'])
        $list['icon_hot'] = "<img src='$skin_path/img/icon_hot.gif' align='absmiddle'>";

    $list['icon_secret'] = "";
    if (strstr($list['wr_option'], "secret"))
        $list['icon_secret'] = "<img src='$skin_path/img/icon_secret.gif' align='absmiddle'>";

    // 링크
    for ($i=1; $i<=$g4['link_count']; $i++)
    {
        $list['link'][$i] = set_http(get_text($list["wr_link{$i}"]));
        $list['link_href'][$i] = "$g4[bbs_path]/link.php?bo_table=$board[bo_table]&wr_id=$list[wr_id]&no=$i" . $qstr;
        $list['link_hit'][$i] = (int)$list["wr_link{$i}_hit"];
    }

    // 가변 파일
    $list['file'] = get_file($board['bo_table'], $list['wr_id']);

    if ($list['file']['count'])
        $list['icon_file'] = "<img src='$skin_path/img/icon_file.gif' align='absmiddle'>";

    return $list;
}

function get_list_roomInfo($write_row, $board, $skin_path, $subject_len=40, $pDate=0)
{
    global $g4, $config;
    global $qstr, $page;

    //$t = get_microtime();

    // 배열전체를 복사
    $list = $write_row;
    unset($write_row);

    $list['r_info_id']         = $list['r_info_id'];
    $list['r_info_name']       = $list['r_info_name'];
    $list['r_info_area']       = $list['r_info_area'];
    $list['r_info_cnt']        = $list['r_info_cnt'];
    $list['r_info_type']       = $list['r_info_type'];
    $list['r_info_over']       = $list['r_info_over'];
    $list['r_info_multi']      = $list['r_info_multi'];
    $list['pension_id']        = $list['pension_id'];
    $list['r_info_rCnt']       = $list['r_info_rCnt'];
    $list['r_info_tCnt']       = $list['r_info_tCnt'];
    $list['r_info_content']    = $list['r_info_content'];
    $list['r_info_person1']    = $list['r_info_person1'];
    $list['r_info_person2']    = $list['r_info_person2'];
    $list['r_info_person3']    = $list['r_info_person3'];
    $list['r_info_person_add'] = $list['r_info_person_add'];
    $list['rowspan']           = 1;

    // 날짜가 있을 경우 해당 날짜의 가격을 검색한다.
    if($pDate) {
        $viewCostRow = viewCostRow($list['r_info_id'], $list['pension_id'], pDateType($pDate), $pDate);
        $list['minCost1'] = $viewCostRow['typeCost1'];
        $list['minCost2'] = $viewCostRow['typeCost2'];
        $list['minCost3'] = $viewCostRow['typeCost3'];
    } else {
        // 날짜가 없을 경우 최저 가격 검색
        $sql_cost = " SELECT * from g4_write_bbs34_r_cost  where pension_id = '{$list['pension_id']}' and  r_info_id = '{$list['r_info_id']}' ";
        $r_cost2 = sql_fetch($sql_cost);

        $list['minCost1'] = $r_cost2['r_cost_11'];
        $list['minCost2'] = $r_cost2['r_cost_21'];
        $list['minCost3'] = $r_cost2['r_cost_31'];

        for($mc = 1; $mc <= 5; $mc++) {
            $diffCost1 = "r_cost_1" . $mc;
            $diffCost2 = "r_cost_2" . $mc;
            $diffCost3 = "r_cost_3" . $mc;
            if( $list['minCost3'] > $r_cost2[$diffCost3] ) {
                $list['minCost1'] = $r_cost2[$diffCost1];
                $list['minCost2'] = $r_cost2[$diffCost2];
                $list['minCost3'] = $r_cost2[$diffCost3];
            }
        }
    }

    $pensql = " SELECT * from g4_write_pension_info  where pension_id = '{$list['pension_id']}' LIMIT 1 ";
    $penname = sql_fetch($pensql);

    $list['wr_subject'] = $penname['wr_subject'];
    if ($subject_len)
        $list['subject'] = conv_subject($list['wr_subject'], $subject_len, "…");
    else
        $list['subject'] = conv_subject($list['wr_subject'], $board['bo_subject_len'], "…");

    $list['wr_id'] = $penname['wr_id'];
    $list['mb_addr1'] = $penname['mb_addr1'];
    $list['mb_addr2'] = $penname['mb_addr2'];

    // 가변 파일
    $list['file'] = get_file($board['bo_table'], $list['wr_id']);

    if ($list['file']['count'])
        $list['icon_file'] = "<img src='$skin_path/img/icon_file.gif' align='absmiddle'>";

    $list['href'] = "$g4[bbs_path]/board.php?bo_table=$board[bo_table]&wr_id=$list[wr_id]" . $qstr;

    return $list;
}

function resCheck2($penID, $pDate, $costID, $pDate2=0)
{
    global $write_table2;
    $rc = 0;
    // 1. 예약불가인지 전화예약인지 판별
    //   - 1순위 : 예약불가
    //   - 2순위 : 예약 여부 체크
    //   - 3순위 : 전화예약

    // 예약불가 체크
    //$read_close = sql_fetch(" SELECT * FROM {$write_table2}_r_close WHERE pension_id = '$penID' AND r_info_id = '$costID' AND ('$pDate' BETWEEN r_close_date AND r_close_date2) LIMIT 1");
    $read_close = sql_fetch(" SELECT * FROM {$write_table2}_r_close WHERE pension_id = '$penID' AND r_info_id = '$costID' AND (r_close_date BETWEEN '$pDate' AND '$pDate2') AND (r_close_date2 BETWEEN '$pDate' AND '$pDate2') LIMIT 1");
    if($read_close)
    {
        $resCheck['close']['r_close_name'] = $read_close['r_close_name'];
        $resCheck['close']['r_close_date'] = $read_close['r_close_date'];
        $resCheck['close']['r_close_date2'] = $read_close['r_close_date2'];

        $rc = 1;
    }

    // 예약 여부 체크 시작 - 예약취소가 아닌 데이터 추출.
    //$read_complete = sql_fetch(" SELECT * FROM {$write_table2} WHERE pension_id = '$penID' AND r_info_id = '$costID' AND wr_link2 = '$pDate' AND rResult != '0030' LIMIT 1 ");
    $read_complete = sql_fetch(" SELECT * FROM {$write_table2} WHERE pension_id = '$penID' AND r_info_id = '$costID' AND ( wr_link2 BETWEEN '$pDate' AND '$pDate2') AND rResult != '0030' LIMIT 1 ");
    if($read_complete)
    {
        switch ($read_complete[rResult]) {
            case '0020' :
                $resCheck['rResult'] = "완료";
                break;
            case '0010' :
                $resCheck['rResult'] = "대기";
                break;
            case '0040' :
                $resCheck['rResult'] = "완료";
                break;
            //case '0030' :
            //  $resCheck['rResult'] = "취소";
            default:
                $resCheck['rResult'] = NULL;
                break;
        }

        if(!$resCheck['rResult']) $rc = 1;
    }

    // 전화예약 체크
    //$read_tel = sql_fetch(" SELECT * FROM {$write_table2}_r_tel WHERE pension_id = '$penID' AND r_info_id = '$costID' AND ('$pDate' BETWEEN r_tel_date AND r_tel_date2) LIMIT 1");
    $read_tel = sql_fetch(" SELECT * FROM {$write_table2}_r_tel WHERE pension_id = '$penID' AND r_info_id = '$costID' AND (r_tel_date BETWEEN '$pDate' AND '$pDate2') AND (r_tel_date2 BETWEEN '$pDate' AND '$pDate2') LIMIT 1");
    if($read_tel)
    {
        $resCheck['tel']['r_tel_name'] = $read_tel['r_tel_name'];
        $resCheck['tel']['r_tel_date'] = $read_tel['r_tel_date'];
        $resCheck['tel']['r_tel_date2'] = $read_tel['r_tel_date2'];

        $rc = 1;
    }

    return $rc;
}

// get_list 의 alias
function get_view2($write_row, $board, $skin_path, $subject_len=125)
{
    return get_list($write_row, $board, $skin_path, $subject_len);
}

// 검색 구문을 얻는다.
function get_sql_search2($search_ca_name, $search_field, $search_text, $search_operator='and', $cfSearch2)
{
    global $g4;

    $str = "";
    if ($search_ca_name)
        $str = " ca_name = '$search_ca_name' ";

    $search_text = strip_tags(($search_text));
    $search_text = trim(stripslashes($search_text));

    if (!$search_text) {
        if ($search_ca_name) {
            return $str;
        } else {
            return '0';
        }
    }

    if ($str)
        $str .= " and ";

    // 쿼리의 속도를 높이기 위하여 ( ) 는 최소화 한다.
    $op1 = "";

    // 검색어를 구분자로 나눈다. 여기서는 공백
    $s = array();
    $s = explode(" ", $search_text);

    // 검색필드를 구분자로 나눈다. 여기서는 +
    $tmp = array();
    $tmp = explode(",", trim($search_field));
    $field = explode("||", $tmp[0]);
    $not_comment = $tmp[1];

    $str .= "(";
    for ($i=0; $i<count($s); $i++) {
        // 검색어
        $search_str = trim($s[$i]);
        if ($search_str == "") continue;

        // 인기검색어
        $sql = " INSERT into $g4[popular_table] set pp_word = '$search_str', pp_date = '$g4[time_ymd]', pp_ip = '$_SERVER[REMOTE_ADDR]' ";
        sql_query($sql, FALSE);

        $str .= $op1;
        $str .= "(";

        $op2 = "";
        for ($k=0; $k<count($field); $k++) { // 필드의 수만큼 다중 필드 검색 가능 (필드1+필드2...)

            // SQL Injection 방지
            // 필드값에 a-z A-Z 0-9 _ , | 이외의 값이 있다면 검색필드를 wr_subject 로 설정한다.
            $field[$k] = preg_match("/^[\w\,\|]+$/", $field[$k]) ? $field[$k] : "wr_subject";

            $str .= $op2;
            switch ($field[$k]) {
                case "mb_id" :
                case "wr_name" :
                    $str .= " $field[$k] = '$s[$i]' ";
                    break;
                case "wr_hit" :
                case "wr_good" :
                case "wr_nogood" :
                    $str .= " $field[$k] >= '$s[$i]' ";
                    break;
                // 번호는 해당 검색어에 -1 을 곱함
                case "wr_num" :
                    $str .= "$field[$k] = ".((-1)*$s[$i]);
                    break;
                case "wr_ip" :
                case "wr_password" :
                    $str .= "1=0"; // 항상 거짓
                    break;
                // LIKE 보다 INSTR 속도가 빠름
                default :
                    if (preg_match("/[a-zA-Z]/", $search_str))
                        $str .= "INSTR(LOWER($field[$k]), LOWER('$search_str'))";
                    else
                        $str .= "INSTR($field[$k], '$search_str')";
                    break;
            }
            $op2 = " or ";
        }
        $str .= ")";

        $op1 = " $search_operator ";
    }
    $str .= " ) ";
    if ($not_comment)
        $str .= " and wr_is_comment = '0' ";

    return $str;
}

?>
