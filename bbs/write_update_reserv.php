<?php
$g4[title] = $wr_subject . "예약입력";
include_once("./_common.php");

$write_table = $write_table2;
$secret = "secret";

// 090710
if (substr_count($wr_content, "&#") > 50) {
    alert("내용에 올바르지 않은 코드가 다수 포함되어 있습니다.");
    exit;
}

@include_once("$board_skin_path/write_update.head.skin.php");

include_once("$g4[path]/lib/trackback.lib.php");

$upload_max_filesize = ini_get('upload_max_filesize');

if (empty($_POST))
    alert("파일 또는 글내용의 크기가 서버에서 설정한 값을 넘어 오류가 발생하였습니다.\\n\\npost_max_size=".ini_get('post_max_size')." , upload_max_filesize=$upload_max_filesize\\n\\n게시판관리자 또는 서버관리자에게 문의 바랍니다.");

// 리퍼러 체크
//referer_check();

$w = $_POST['w'];
$wr_link1 = mysql_real_escape_string(strip_tags($_POST['wr_link1']));
$wr_link2 = mysql_real_escape_string(strip_tags($_POST['wr_link2']));

$notice_array = explode("\n", trim($board[bo_notice]));

if ($w == "u" || $w == "r") {
    $wr = get_write($write_table, $wr_id);
    if (!$wr[wr_id])
        alert("글이 존재하지 않습니다.\\n\\n글이 삭제되었거나 이동하였을 수 있습니다.");
}

// 외부에서 글을 등록할 수 있는 버그가 존재하므로 비밀글은 사용일 경우에만 가능해야 함
//if (!$is_admin && !$board[bo_use_secret] && $secret)
//	alert("비밀글 미사용 게시판 이므로 비밀글로 등록할 수 없습니다.");

// 외부에서 글을 등록할 수 있는 버그가 존재하므로 비밀글 무조건 사용일때는 관리자를 제외(공지)하고 무조건 비밀글로 등록
if (!$is_admin && $board[bo_use_secret] == 2) {
    $secret = "secret";
}

if ($w == "" || $w == "u") {
    // 김선용 1.00 : 글쓰기 권한과 수정은 별도로 처리되어야 함
    if($w =="u" && $member['mb_id'] && $wr['mb_id'] == $member['mb_id'])
        ;
    else if ($member[mb_level] < $board[bo_write_level])
        alert("글을 쓸 권한이 없습니다.");

	// 외부에서 글을 등록할 수 있는 버그가 존재하므로 공지는 관리자만 등록이 가능해야 함
	if (!$is_admin && $notice)
		alert("관리자만 공지할 수 있습니다.");
}
else if ($w == "r")
{
    if (in_array((int)$wr_id, $notice_array))
        alert("공지에는 답변 할 수 없습니다.");

    if ($member[mb_level] < $board[bo_reply_level])
        alert("글을 답변할 권한이 없습니다.");

    // 게시글 배열 참조
    $reply_array = &$wr;

    // 최대 답변은 테이블에 잡아놓은 wr_reply 사이즈만큼만 가능합니다.
    if (strlen($reply_array[wr_reply]) == 10)
        alert("더 이상 답변하실 수 없습니다.\\n\\n답변은 10단계 까지만 가능합니다.");

    $reply_len = strlen($reply_array[wr_reply]) + 1;
    if ($board[bo_reply_order]) {
        $begin_reply_char = "A";
        $end_reply_char = "Z";
        $reply_number = +1;
        $sql = " select MAX(SUBSTRING(wr_reply, $reply_len, 1)) as reply from $write_table where wr_num = '$reply_array[wr_num]' and SUBSTRING(wr_reply, $reply_len, 1) <> '' ";
    } else {
        $begin_reply_char = "Z";
        $end_reply_char = "A";
        $reply_number = -1;
        $sql = " select MIN(SUBSTRING(wr_reply, $reply_len, 1)) as reply from $write_table where wr_num = '$reply_array[wr_num]' and SUBSTRING(wr_reply, $reply_len, 1) <> '' ";
    }
    if ($reply_array[wr_reply]) $sql .= " and wr_reply like '$reply_array[wr_reply]%' ";
    $row = sql_fetch($sql);

    if (!$row[reply])
        $reply_char = $begin_reply_char;
    else if ($row[reply] == $end_reply_char) // A~Z은 26 입니다.
        alert("더 이상 답변하실 수 없습니다.\\n\\n답변은 26개 까지만 가능합니다.");
    else
        $reply_char = chr(ord($row[reply]) + $reply_number);

    $reply = $reply_array[wr_reply] . $reply_char;
} else
    alert("w 값이 제대로 넘어오지 않았습니다.");

/*
if ($w == "" || $w == "r")
{

    if ($_SESSION["ss_datetime"] >= ($g4[server_time] - $config[cf_delay_sec]) && !$is_admin)
        alert("너무 빠른 시간내에 게시물을 연속해서 올릴 수 없습니다.");

    set_session("ss_datetime", $g4[server_time]);


    // 동일내용 연속 등록 불가
    $row = sql_fetch(" select MD5(CONCAT(wr_ip, wr_subject, wr_content)) as prev_md5 from $write_table order by wr_id desc limit 1 ");
    $curr_md5 = md5($_SERVER[REMOTE_ADDR].$wr_subject.$wr_content);
    if ($row[prev_md5] == $curr_md5 && !$is_admin)
        alert("동일한 내용을 연속해서 등록할 수 없습니다.");
}
*/

// 자동등록방지 검사
//include_once ("./norobot_check.inc.php");

/*
if ($bo_table != "pension") {
	if (!$is_member) {
		if ($w=='' || $w=='r') {
			$key = get_session("captcha_keystring");
			if (!($key && $key == $_POST[wr_key])) {
				unset($_SESSION['captcha_keystring']);
				alert("정상적인 접근이 아닌것 같습니다.");
			}
		}
	}
}
*/

// 디렉토리가 없다면 생성합니다. (퍼미션도 변경하구요.)
@mkdir("$g4[path]/data/file/$bo_table", 0707);
@chmod("$g4[path]/data/file/$bo_table", 0707);

// "인터넷옵션 > 보안 > 사용자정의수준 > 스크립팅 > Action 스크립팅 > 사용 안 함" 일 경우의 오류 처리
// 이 옵션을 사용 안 함으로 설정할 경우 어떤 스크립트도 실행 되지 않습니다.
//if (!$_POST[wr_content]) die ("내용을 입력하여 주십시오.");

$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));
//print_r2($chars_array); exit;

if ($w == "" || $w == "r")
{
    if ($member[mb_id])
    {
        $mb_id = $member[mb_id];
        $wr_homepage = $member[mb_homepage];
        //$wr_password = $member[mb_password];
    }
    else
    {
        $mb_id = "";
        if (!trim($res2_wr_name))
            alert("이름은 필히 입력하셔야 합니다.");
        //$wr_password = sql_password('$res2_wr_password');
    }

    /* 예약 내용이 넘어온 것을 게시판에 맞게 변경하여 입력하도록 한다.
    ## 시작
    */
    // 공통 내용 정리
    $pension_id = $pension_id;
    $roomCount = $res2_roomCount; // 객실 갯수
    $wr_name = strip_tags(mysql_escape_string($_POST['res2_wr_name']));; // 예약자명
    $wr_password = sql_password($res2_wr_password); // 비밀번호
    $wr_email = $res2_wr_email; // 이메일
    $wr_tel1 = $wr_tel1; // 전화번호
    $wr_tel2 = $wr_tel2; // 전화번호
    $wr_tel3 = $wr_tel3; // 전화번호
    $wr_2 = $wr_tel1 . "-" . $wr_tel2 . "-" . $wr_tel3; // 전화번호
    $wr_3 = $res2_r_info_id[0] . mktime(); // 예약코드
    $wr_5 = $wr_area; // 출발지역
    $wr_6 = $res2_wr_password; // 비밀번호
    $wr_7 = $payCheck; // 결제방법
    $wr_8 = $payName; // 결제자명
    $wr_10 = $res2_totalCost; // 총 결제금액
    $rResult = $res2_rResult; // 진행상태
    $wr_content = $wr_content; // 기타사항

    if ($w == "r")
    {
        // 답변의 원글이 비밀글이라면 패스워드는 원글과 동일하게 넣는다.
        if ($secret)
            $wr_password = $wr[wr_password];

        $wr_id = $wr_id . $reply;
        $wr_num = $write[wr_num];
        $wr_reply = $reply;
    }
    else
    {
        $wr_num = get_next_num($write_table); // Juni7
        $wr_reply = "";
    }

    // 객실 개별 내용 정리
    for($i=0; $i < $res2_roomCount; $i++)
    {
        $wr_subject[$i] = $res2_rDate[$i] . "(" . $res2_rWeek[$i] . ") " . $wr_name . " " . $res2_r_info_name[$i]; // 제목설정
        $ca_name[$i] = $res2_r_info_name[$i]; // 객실명
        $wr_link1[$i] = date("Ymd", $res2_rDateTmp[$i]); // 날짜 저장
        $wr_link2[$i] = $res2_rDateTmp[$i]; // 날짜 tmp 값 저장
        $r_info_id[$i] = $res2_r_info_id[$i]; // 객실ID
        $person1[$i] = (int)$res2_person1[$i]; // 성인
        $person2[$i] = (int)$res2_person2[$i]; // 아동
        $person3[$i] = (int)$res2_person3[$i]; // 유아
        $wr_1[$i] = (int)$person1[$i] + (int)$person2[$i] + (int)$person3[$i]; // 객실 예약인원
        $costType[$i] = $res2_dateType[$i] . "/" .  $res2_weekType2[$i]; // 요금타입
        $cost1[$i] = (int)$res2_typeCost1[$i]; // 기본가격
        $cost2[$i] = (int)$res2_typeCost2[$i]; // 할인가격
        $cost3[$i] = (int)$res2_typeCost3[$i]; // 결제가격
        $overCount[$i] = (int)$res2_personOver[$i]; // 추가인원
        $overCost[$i] = (int)$res2_personOverCost[$i]; // 추가가격


        $sql = " insert into $write_table
                    set wr_num = '$wr_num',
                        wr_reply = '$wr_reply',
                        wr_comment = 0,
                        ca_name = '$ca_name[$i]',
                        wr_option = '$secret',
                        wr_subject = '$wr_subject[$i]',
                        wr_content = '$wr_content',
                        wr_link1 = '$wr_link1[$i]',
                        wr_link2 = '$wr_link2[$i]',
                        wr_link1_hit = 0,
                        wr_link2_hit = 0,

                        wr_hit = 0,
                        wr_good = 0,
                        wr_nogood = 0,
                        mb_id = '$member[mb_id]',
                        wr_password = '$wr_password',
                        wr_name = '$wr_name',
                        wr_email = '$wr_email',
                        wr_homepage = '$wr_homepage',
                        wr_datetime = '$g4[time_ymdhis]',
                        wr_last = '$g4[time_ymdhis]',
                        wr_ip = '$_SERVER[REMOTE_ADDR]',
                        wr_1 = '$wr_1[$i]',
                        wr_2 = '$wr_2',
                        wr_3 = '$wr_3',
                        wr_4 = '$wr_4',
                        wr_5 = '$wr_5',
                        wr_6 = '$wr_6',
                        wr_7 = '$wr_7',
                        wr_8 = '$wr_8',
                        wr_9 = '$wr_9',
                        wr_10 = '$wr_10',
                        wr_reserv = '$wr_reserv',

                        pension_id = '$pension_id',
                        r_info_id = '$r_info_id[$i]',
                        rResult = '$rResult',
                        person1 = '$person1[$i]',
                        person2 = '$person2[$i]',
                        person3 = '$person3[$i]',
                        costType = '$costType[$i]',
                        cost1 = '$cost1[$i]',
                        cost2 = '$cost2[$i]',
                        cost3 = '$cost3[$i]',
                        overCount = '$overCount[$i]',
                        overCost = '$overCost[$i]' ; ";

        sql_query($sql);

        $wr_id = mysql_insert_id();

        // 부모 아이디에 UPDATE
        sql_query(" update $write_table set wr_parent = '$wr_id' where wr_id = '$wr_id' ");

        // 새글 INSERT
        //sql_query(" insert into $g4[board_new_table] ( bo_table, wr_id, wr_parent, bn_datetime ) values ( '$bo_table', '$wr_id', '$wr_id', '$g4[time_ymdhis]' ) ");
        sql_query(" insert into $g4[board_new_table] ( bo_table, wr_id, wr_parent, bn_datetime, mb_id ) values ( '$bo_table', '$wr_id', '$wr_id', '$g4[time_ymdhis]', '$member[mb_id]' ) ");

        // 게시글 1 증가
        sql_query("update $g4[board_table] set bo_count_write = bo_count_write + 1 where bo_table = '$bo_table'");

        // 쓰기 포인트 부여
        if ($w == '')
        {
            if ($notice)
            {
                $bo_notice = $wr_id[$i] . "\n" . $board[bo_notice];
                sql_query(" update $g4[board_table] set bo_notice = '$bo_notice' where bo_table = '$bo_table' ");
            }

            insert_point($member[mb_id], $board[bo_write_point], "$board[bo_subject] $wr_id 글쓰기", $bo_table, $wr_id, '쓰기');
        }
        else
        {
            // 답변은 코멘트 포인트를 부여함
            // 답변 포인트가 많은 경우 코멘트 대신 답변을 하는 경우가 많음
            insert_point($member[mb_id], $board[bo_comment_point], "$board[bo_subject] $wr_id 글답변", $bo_table, $wr_id, '쓰기');
        }

    } // end for
    /* 예약 내용이 넘어온 것을 게시판에 맞게 변경하여 입력하도록 한다.
    ## 끝
    */
}
else if ($w == "u")
{
    if (get_session('ss_bo_table') != $_POST['bo_table'] || get_session('ss_wr_id') != $_POST['wr_id']) {
        alert('올바른 방법으로 수정하여 주십시오.');
    }

    if ($is_admin == "super") // 최고관리자 통과
        ;
    else if ($is_admin == "group") { // 그룹관리자
        $mb = get_member($write[mb_id]);
        if ($member[mb_id] != $group[gr_admin]) // 자신이 관리하는 그룹인가?
            alert("자신이 관리하는 그룹의 게시판이 아니므로 수정할 수 없습니다.");
        else if ($member[mb_level] < $mb[mb_level]) // 자신의 레벨이 크거나 같다면 통과
            alert("자신의 권한보다 높은 권한의 회원이 작성한 글은 수정할 수 없습니다.");
    } else if ($is_admin == "board") { // 게시판관리자이면
        $mb = get_member($write[mb_id]);
        if ($member[mb_id] != $board[bo_admin]) // 자신이 관리하는 게시판인가?
            alert("자신이 관리하는 게시판이 아니므로 수정할 수 없습니다.");
        else if ($member[mb_level] < $mb[mb_level]) // 자신의 레벨이 크거나 같다면 통과
            alert("자신의 권한보다 높은 권한의 회원이 작성한 글은 수정할 수 없습니다.");
    } else if ($member[mb_id]) {
        if ($member[mb_id] != $write[mb_id])
            alert("자신의 글이 아니므로 수정할 수 없습니다.");
    } else {
        if ($write[mb_id]) {
            alert("로그인 후 수정하세요.", "./login.php?url=".urlencode("./board.php?bo_table=$bo_table&wr_id=$wr_id"));
        }
    }

    if ($member[mb_id])
    {
        // 자신의 글이라면
        if ($member[mb_id] == $wr[mb_id])
        {
            $mb_id = $member[mb_id];
            $wr_name = $board[bo_use_name] ? $member[mb_name] : $member[mb_nick];
            $wr_email = $member[mb_email];
            $wr_homepage = $member[mb_homepage];
        }
        else
        {
            $mb_id = $wr[mb_id];
            $wr_name = $wr[wr_name];
            $wr_email = $wr[wr_email];
            $wr_homepage = $wr[wr_homepage];
        }
    }
    else
    {
        $mb_id = "";
        // 비회원의 경우 이름이 누락되는 경우가 있음
        //if (!trim($wr_name)) alert("이름은 필히 입력하셔야 합니다.");
    }

    $sql_password = $wr_password ? " , wr_password = '".sql_password($wr_password)."' " : "";

    $sql_ip = "";
    if (!$is_admin)
        $sql_ip = " , wr_ip = '$_SERVER[REMOTE_ADDR]' ";

    $sql = " update $write_table
                set ca_name = '$ca_name',
                    wr_option = '$html,$secret,$mail',
                    wr_subject = '$wr_subject',
                    wr_content = '$wr_content',
                    wr_link1 = '$wr_link1',
                    wr_link2 = '$wr_link2',
                    mb_id = '$mb_id',
                    wr_name = '$wr_name',
                    wr_email = '$wr_email',
                    wr_homepage = '$wr_homepage',
                    wr_1 = '$wr_1',
                    wr_2 = '$wr_2',
                    wr_3 = '$wr_3',
                    wr_4 = '$wr_4',
                    wr_5 = '$wr_5',
                    wr_6 = '$wr_6',
                    wr_7 = '$wr_7',
                    wr_8 = '$wr_8',
                    wr_9 = '$wr_9',
                    wr_10= '$wr_10'
                    $sql_ip
                    $sql_password
              where wr_id = '$wr[wr_id]' ";
    sql_query($sql);

    // 분류가 수정되는 경우 해당되는 코멘트의 분류명도 모두 수정함
    // 코멘트의 분류를 수정하지 않으면 검색이 제대로 되지 않음
    $sql = " update $write_table set ca_name = '$ca_name' where wr_parent = '$wr[wr_id]' ";
    sql_query($sql);

    if ($notice)
    {
        //if (!preg_match("/[^0-9]{0,1}{$wr_id}[\r]{0,1}/",$board[bo_notice]))
        if (!in_array((int)$wr_id, $notice_array))
        {
            $bo_notice = $wr_id . '\n' . $board[bo_notice];
            sql_query(" update $g4[board_table] set bo_notice = '$bo_notice' where bo_table = '$bo_table' ");
        }
    }
    else
    {
        $bo_notice = '';
        for ($i=0; $i<count($notice_array); $i++)
            if ((int)$wr_id != (int)$notice_array[$i])
                $bo_notice .= $notice_array[$i] . '\n';
        $bo_notice = trim($bo_notice);
        //$bo_notice = preg_replace("/^".$wr_id."[\n]?$/m", "", $board[bo_notice]);
        sql_query(" update $g4[board_table] set bo_notice = '$bo_notice' where bo_table = '$bo_table' ");
    }
}


//------------------------------------------------------------------------------
// 가변 파일 업로드
// 나중에 테이블에 저장하는 이유는 $wr_id 값을 저장해야 하기 때문입니다.
for ($i=0; $i<count($upload); $i++)
{
    if (!get_magic_quotes_gpc()) {
        $upload[$i]['source'] = addslashes($upload[$i]['source']);
    }

    $row = sql_fetch(" select count(*) as cnt from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_no = '$i' ");
    if ($row[cnt])
    {
        // 삭제에 체크가 있거나 파일이 있다면 업데이트를 합니다.
        // 그렇지 않다면 내용만 업데이트 합니다.
        if ($upload[$i][del_check] || $upload[$i][file])
        {
            $sql = " update $g4[board_file_table]
                        set bf_source = '{$upload[$i][source]}',
                            bf_file = '{$upload[$i][file]}',
                            bf_content = '{$bf_content[$i]}',
                            bf_filesize = '{$upload[$i][filesize]}',
                            bf_width = '{$upload[$i][image][0]}',
                            bf_height = '{$upload[$i][image][1]}',
                            bf_type = '{$upload[$i][image][2]}',
                            bf_datetime = '$g4[time_ymdhis]'
                      where bo_table = '$bo_table'
                        and wr_id = '$wr_id'
                        and bf_no = '$i' ";
            sql_query($sql);
        }
        else
        {
            $sql = " update $g4[board_file_table]
                        set bf_content = '{$bf_content[$i]}'
                      where bo_table = '$bo_table'
                        and wr_id = '$wr_id'
                        and bf_no = '$i' ";
            sql_query($sql);
        }
    }
    else
    {
        $sql = " insert into $g4[board_file_table]
                    set bo_table = '$bo_table',
                        wr_id = '$wr_id',
                        bf_no = '$i',
                        bf_source = '{$upload[$i][source]}',
                        bf_file = '{$upload[$i][file]}',
                        bf_content = '{$bf_content[$i]}',
                        bf_download = 0,
                        bf_filesize = '{$upload[$i][filesize]}',
                        bf_width = '{$upload[$i][image][0]}',
                        bf_height = '{$upload[$i][image][1]}',
                        bf_type = '{$upload[$i][image][2]}',
                        bf_datetime = '$g4[time_ymdhis]' ";
        sql_query($sql);
    }
}

// 업로드된 파일 내용에서 가장 큰 번호를 얻어 거꾸로 확인해 가면서
// 파일 정보가 없다면 테이블의 내용을 삭제합니다.
$row = sql_fetch(" select max(bf_no) as max_bf_no from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$wr_id' ");
for ($i=(int)$row[max_bf_no]; $i>=0; $i--)
{
    $row2 = sql_fetch(" select bf_file from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_no = '$i' ");

    // 정보가 있다면 빠집니다.
    if ($row2[bf_file]) break;

    // 그렇지 않다면 정보를 삭제합니다.
    sql_query(" delete from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_no = '$i' ");
}
//------------------------------------------------------------------------------

// 비밀글이라면 세션에 비밀글의 아이디를 저장한다. 자신의 글은 다시 패스워드를 묻지 않기 위함
if ($secret)
    set_session("ss_secret_{$bo_table}_{$wr_num}", TRUE);

// 메일발송 사용 (수정글은 발송하지 않음)
if (!($w == "u" || $w == "cu") && $config[cf_email_use] && $board[bo_use_email])
{
    // 관리자의 정보를 얻고
    $super_admin = get_admin("super");
    $group_admin = get_admin("group");
    $board_admin = get_admin("board");

    $wr_subject = get_text(stripslashes($wr_subject));

    $tmp_html = 0;
    if (strstr($html, "html1"))
        $tmp_html = 1;
    else if (strstr($html, "html2"))
        $tmp_html = 2;

    $wr_content = conv_content(stripslashes($wr_content), $tmp_html);

    $warr = array( ""=>"입력", "u"=>"수정", "r"=>"답변", "c"=>"코멘트", "cu"=>"코멘트 수정" );
    $str = $warr[$w];

    $subject = "'{$board[bo_subject]}' 게시판에 {$str}글이 올라왔습니다.";
    $link_url = "$g4[url]/$g4[bbs]/board.php?bo_table=$bo_table&wr_id=$wr_id&$qstr";

    include_once("$g4[path]/lib/mailer.lib.php");

    ob_start();
    include_once ("./write_update_mail.php");
    $content = ob_get_contents();
    ob_end_clean();

    $array_email = array();
    // 게시판관리자에게 보내는 메일
    if ($config[cf_email_wr_board_admin]) $array_email[] = $board_admin[mb_email];
    // 게시판그룹관리자에게 보내는 메일
    if ($config[cf_email_wr_group_admin]) $array_email[] = $group_admin[mb_email];
    // 최고관리자에게 보내는 메일
    if ($config[cf_email_wr_super_admin]) $array_email[] = $super_admin[mb_email];

    // 옵션에 메일받기가 체크되어 있고, 게시자의 메일이 있다면
    if (strstr($wr[wr_option], "mail") && $wr[wr_email]) {
        // 원글 메일발송에 체크가 되어 있다면
        if ($config[cf_email_wr_write]) $array_email[] = $wr[wr_email];

        // 코멘트 쓴 모든이에게 메일 발송이 되어 있다면 (자신에게는 발송하지 않는다)
        if ($config[cf_email_wr_comment_all]) {
            $sql = " select distinct wr_email from $write_table
                      where wr_email not in ( '$wr[wr_email]', '$member[mb_email]', '' )
                        and wr_parent = '$wr_id' ";
            $result = sql_query($sql);
            while ($row=sql_fetch_array($result))
                $array_email[] = $row[wr_email];
        }
    }

    // 중복된 메일 주소는 제거
    $unique_email = array_unique($array_email);
    $unique_email = array_values($unique_email);
    for ($i=0; $i<count($unique_email); $i++) {
        mailer($wr_name, $wr_email, $unique_email[$i], $subject, $content, 1);
    }
}

// 사용자 코드 실행
@include_once ("$board_skin_path/write_update.skin.php");

// 트랙백 주소가 있다면
if (($w != "u" && $wr_trackback) || ($w=="u" && $wr_trackback && $re_trackback))
{
    $trackback_url = "$g4[url]/$g4[bbs]/tb.php/$bo_table/$wr_id";
    $msg = "";
    $msg = send_trackback($wr_trackback, $trackback_url, $wr_subject, $board[bo_subject], $_POST[wr_content]);
    if ($msg) {
        echo "<meta http-equiv='content-type' content='text/html; charset={$g4['charset']}'>\n";
        echo "<script type='text/javascript'>alert('$msg $wr_trackback');</script>";
    }
}

@include_once("$board_skin_path/write_update.tail.skin.php");

if ($g4[https_url])
    $https_url = "$g4[url]/$g4[bbs]";
else
    $https_url = ".";

/*
if ($file_upload_msg)
    alert($file_upload_msg, "{$https_url}/board.php?bo_table=$bo_table&wr_id=$wr_id&page=$page" . $qstr);
else
    goto_url("{$https_url}/board.php?bo_table=$bo_table&wr_id=$wr_id&page=$page" . $qstr);
*/
// 예약완료후 페이지 이동
goto_url("{$g4[url]}/");
?>
