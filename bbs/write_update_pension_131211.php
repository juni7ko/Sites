<?php $g4[title] = $wr_subject . "�??�력";
include_once("./_common.php");
echo "<meta http-equiv='content-type' content='text/html; charset=euc-kr'>";
$write_table = "g4_write_pension_info";
// 090710
if (substr_count($wr_content, "&#") > 50) {
    alert("?�용?? ?�바르�?? ?��?? 코드�? ?�수 ?�함?�어 ?�습?�다.");
    exit;
}

@include_once("$board_skin_path/write_update.head.skin.php");

include_once("$g4[path]/lib/trackback.lib.php");

/*
$filters = explode(",", $config[cf_filter]);
for ($i=0; $i<count($filters); $i++) {
    $s = trim($filters[$i]); // ?�터?�어?? ?�뒤 공백?? ?�앰
    if (stristr($wr_subject, $s)) {
        alert("?�목?? 금�???�어(\'{$s}\')�? ?�함?�어 ?�습?�다.");
        exit;
    }
    if (stristr($wr_content, $s)) {
        alert("?�용?? 금�???�어(\'{$s}\')�? ?�함?�어 ?�습?�다.");
        exit;
    }
}
*/

$upload_max_filesize = ini_get('upload_max_filesize');

if (empty($_POST))
    alert("?�일 ?�는 �??�용?? ?�기�? ?�버?�서 ?�정?? 값을 ?�어 ?�류�? 발생?��???�니??.\\n\\npost_max_size=".ini_get('post_max_size')." , upload_max_filesize=$upload_max_filesize\\n\\n게시?��??리자 ?�는 ?�버�?리자?�게 문의 바랍?�다.");

// 리퍼?? 체크
//referer_check();

$w = $_POST['w'];
$wr_link1 = mysql_real_escape_string(strip_tags($_POST['wr_link1']));
$wr_link2 = mysql_real_escape_string(strip_tags($_POST['wr_link2']));

$notice_array = explode("\n", trim($board[bo_notice]));

if ($w == "u" || $w == "r") {
    $wr = get_write($write_table, $wr_id);
    if (!$wr[wr_id])
        alert("�??? 존재?��?? ?�습?�다.\\n\\n�??? ??��?�었거나 ?�동?��???? ?? ?�습?�다."); 
}

// ?��???�서 �??? ?�록?? ?? ?�는 버그�? 존재?��??�? 비�??�??? ?�용?? 경우?�만 �??�해?? ??
if (!$is_admin && !$board[bo_use_secret] && $secret)
	alert("비�??�? 미사?? 게시?? ?��??�? 비�??�?�? ?�록?? ?? ?�습?�다.");

// ?��???�서 �??? ?�록?? ?? ?�는 버그�? 존재?��??�? 비�??�? 무조�? ?�용?�때?? �?리자�? ?�외(공�??)?�고 무조�? 비�??�?�? ?�록
if (!$is_admin && $board[bo_use_secret] == 2) {
    $secret = "secret";
}

if ($w == "" || $w == "u") {
    // �??�용 1.00 : �??�기 권한�? ?�정?? 별도�? 처리?�어?? ??
    if($w =="u" && $member['mb_id'] && $wr['mb_id'] == $member['mb_id'])
        ;
    else if ($member[mb_level] < $board[bo_write_level]) 
        alert("�??? ?? 권한?? ?�습?�다.");

	// ?��???�서 �??? ?�록?? ?? ?�는 버그�? 존재?��??�? 공�???? �?리자�? ?�록?? �??�해?? ??
	if (!$is_admin && $notice)
		alert("�?리자�? 공�???? ?? ?�습?�다.");
} 
else if ($w == "r") 
{
    if (in_array((int)$wr_id, $notice_array))
        alert("공�???�는 ?��?? ?? ?? ?�습?�다.");

    if ($member[mb_level] < $board[bo_reply_level]) 
        alert("�??? ?��???? 권한?? ?�습?�다.");

    // 게시�? 배열 참조
    $reply_array = &$wr;

    // 최�?? ?��???? ?�이블에 ?�아?��?? wr_reply ?�이즈만?�만 �??�합?�다.
    if (strlen($reply_array[wr_reply]) == 10)
        alert("?? ?�상 ?��???�실 ?? ?�습?�다.\\n\\n?��???? 10?�계 까�??�? �??�합?�다.");

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
    else if ($row[reply] == $end_reply_char) // A~Z?? 26 ?�니??.
        alert("?? ?�상 ?��???�실 ?? ?�습?�다.\\n\\n?��???? 26�? 까�??�? �??�합?�다.");
    else
        $reply_char = chr(ord($row[reply]) + $reply_number);

    $reply = $reply_array[wr_reply] . $reply_char;
} else 
    alert("w 값이 ?��??�? ?�어?��?? ?�았?�니??."); 


if ($w == "" || $w == "r") 
{
	/*
    if ($_SESSION["ss_datetime"] >= ($g4[server_time] - $config[cf_delay_sec]) && !$is_admin) 
        alert("?�무 빠른 ?�간?�에 게시물을 ?�속?�서 ?�릴 ?? ?�습?�다.");

    set_session("ss_datetime", $g4[server_time]);


    // ?�일?�용 ?�속 ?�록 불�??
    $row = sql_fetch(" select MD5(CONCAT(wr_ip, wr_subject, wr_content)) as prev_md5 from $write_table order by wr_id desc limit 1 ");
    $curr_md5 = md5($_SERVER[REMOTE_ADDR].$wr_subject.$wr_content);
    if ($row[prev_md5] == $curr_md5 && !$is_admin)
        alert("?�일?? ?�용?? ?�속?�서 ?�록?? ?? ?�습?�다.");
*/
} 

// ?�동?�록방�?? �???
//include_once ("./norobot_check.inc.php");
if ($bo_table != "pension_info") {
	if (!$is_member) {
		if ($w=='' || $w=='r') {
			$key = get_session("captcha_keystring");
			if (!($key && $key == $_POST[wr_key])) {
				unset($_SESSION['captcha_keystring']);
				alert("?�상?�인 ?�근?? ?�닌�? 같습?�다.");
			}
		}
	}
}

if (!isset($_POST[wr_subject]) || !trim($_POST[wr_subject])) 
    alert("?�목?? ?�력?�여 주십?�오."); 

// ?�렉?�리�? ?�다�? ?�성?�니??. (?��??�도 �?경하구요.)
@mkdir("$g4[path]/data/file/$bo_table", 0707);
@chmod("$g4[path]/data/file/$bo_table", 0707);

// "?�터?�옵?? > 보안 > ?�용?�정?�수�? > ?�크립팅 > Action ?�크립팅 > ?�용 ?? ??" ?? 경우?? ?�류 처리
// ?? ?�션?? ?�용 ?? ?�으�? ?�정?? 경우 ?�떤 ?�크립트?? ?�행 ?��?? ?�습?�다.
//if (!$_POST[wr_content]) die ("?�용?? ?�력?�여 주십?�오.");

$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));
//print_r2($chars_array); exit;

// �?�? ?�일 ?�로??
$file_upload_msg = "";
$upload = array();
for ($i=0; $i<count($_FILES[bf_file][name]); $i++) 
{
    // ??��?? 체크�? ?�어?�다�? ?�일?? ??��?�니??.
    if ($_POST[bf_file_del][$i]) 
    {
        $upload[$i][del_check] = true;

        $row = sql_fetch(" select bf_file from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_no = '$i' ");
        @unlink("$g4[path]/data/file/$bo_table/$row[bf_file]");
    }
    else
        $upload[$i][del_check] = false;

    $tmp_file  = $_FILES[bf_file][tmp_name][$i];
    $filesize  = $_FILES[bf_file][size][$i];
    $filename  = $_FILES[bf_file][name][$i];
    $filename  = preg_replace('/(\s|\<|\>|\=|\(|\))/', '_', $filename);

    // ?�버?? ?�정?? 값보?? ?�파?�을 ?�로?? ?�다�?
    if ($filename)
    {
        if ($_FILES[bf_file][error][$i] == 1)
        {
            $file_upload_msg .= "\'{$filename}\' ?�일?? ?�량?? ?�버?? ?�정($upload_max_filesize)?? 값보?? ?��??�? ?�로?? ?? ?? ?�습?�다.\\n";
            continue;
        }
        else if ($_FILES[bf_file][error][$i] != 0)
        {
            $file_upload_msg .= "\'{$filename}\' ?�일?? ?�상?�으�? ?�로?? ?��?? ?�았?�니??.\\n";
            continue;
        }
    }

    if (is_uploaded_file($tmp_file)) 
    {
        // �?리자�? ?�니면서 ?�정?? ?�로?? ?�이즈보?? ?�다�? 건너??
        if (!$is_admin && $filesize > $board[bo_upload_size]) 
        {
            $file_upload_msg .= "\'{$filename}\' ?�일?? ?�량(".number_format($filesize)." 바이??)?? 게시?�에 ?�정(".number_format($board[bo_upload_size])." 바이??)?? 값보?? ?��??�? ?�로?? ?��?? ?�습?�다.\\n";
            continue;
        }

        //=================================================================\
        // 090714
        // ?��?�??? ?�래?? ?�일?? ?�성코드�? ?�어 ?�로?? ?�는 경우�? 방�??
        // ?�러메세�??? 출력?��?? ?�는??.
        //-----------------------------------------------------------------
        $timg = @getimagesize($tmp_file);
        // image type
        if ( preg_match("/\.($config[cf_image_extension])$/i", $filename) ||
             preg_match("/\.($config[cf_flash_extension])$/i", $filename) ) 
        {
            if ($timg[2] < 1 || $timg[2] > 16)
            {
                //$file_upload_msg .= "\'{$filename}\' ?�일?? ?��?�??? ?�래?? ?�일?? ?�닙?�다.\\n";
                continue;
            }
        }
        //=================================================================

        $upload[$i][image] = $timg;

        // 4.00.11 - �??��???�서 ?�일 ?�로?�시 ?��???? ?�일?? ??��?�는 ?�류�? ?�정
        if ($w == 'u')
        {
            // 존재?�는 ?�일?? ?�다�? ??��?�니??.
            $row = sql_fetch(" select bf_file from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_no = '$i' ");
            @unlink("$g4[path]/data/file/$bo_table/$row[bf_file]");
        }

        // ?�로그램 ?�래 ?�일�?
        $upload[$i][source] = $filename;
        $upload[$i][filesize] = $filesize;

        // ?�래?? 문자?�이 ?�어�? ?�일?? -x �? 붙여?? ?�경로�? ?�더?�도 ?�행?? ?��?? 못하?�록 ??
        $filename = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);

        // ?��??��? 붙인 ?�일�?
        //$upload[$i][file] = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr(md5(uniqid($g4[server_time])),0,8).'_'.urlencode($filename);
        // ?�빛?�도?? ?�정 : ?��???�일?? urlencode($filename) 처리�? ?�경?? '%'�? 붙여주게 ?�는?? '%'?�시?? 미디?�플?�이?��?? ?�식?? 못하�? ?�문?? ?�생?? ?�됩?�다. 그래?? �?경한 ?�일명에?? '%'�?분을 빼주�? ?�결?�니??. 
        //$upload[$i][file] = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr(md5(uniqid($g4[server_time])),0,8).'_'.str_replace('%', '', urlencode($filename)); 
        shuffle($chars_array);
        $shuffle = implode("", $chars_array);

        // 첨�???�일 첨�???? 첨�???�일명에 공백?? ?�함?�어 ?�으�? ?��?? PC?�서 보이�? ?�거?? ?�운로드 ?��?? ?�는 ?�상?? ?�습?�다. (길상?�의 ?? 090925)
        //$upload[$i][file] = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr($shuffle,0,8).'_'.str_replace('%', '', urlencode($filename)); 
        $upload[$i][file] = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr($shuffle,0,8).'_'.str_replace('%', '', urlencode(str_replace(' ', '_', $filename))); 

        $dest_file = "$g4[path]/data/file/$bo_table/" . $upload[$i][file];

        // ?�로?��?? ?�된?�면 ?�러메세�? 출력?�고 죽어버립?�다.
        $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES[bf_file][error][$i]);

        // ?�라�? ?�일?? ?��??�을 �?경합?�다.
        chmod($dest_file, 0606);

        //$upload[$i][image] = @getimagesize($dest_file);

    }
}

if ($w == "" || $w == "r") 
{
    if ($member[mb_id]) 
    {
  //      $mb_id = $member[mb_id];
  //      $wr_name = $board[bo_use_name] ? $member[mb_name] : $member[mb_nick];
 //       $wr_password = $member[mb_password];
 //       $wr_email = $member[mb_email];
 //       $wr_homepage = $member[mb_homepage];
    } 
    else 
    {
        $mb_id = "";
        // 비회?�의 경우 ?�름?? ?�락?�는 경우�? ?�음
        $wr_name = strip_tags(mysql_escape_string($_POST['wr_name']));
        if (!trim($wr_name))
            alert("?�름?? ?�히 ?�력?�셔?? ?�니??.");
        $wr_password = sql_password($wr_password);
    }

    if ($w == "r") 
    {
        // ?��???? ?��???? 비�??�??�라�? ?�스?�드?? ?��??�? ?�일?�게 ?�는??.
        if ($secret) 
            $wr_password = $wr[wr_password];

        $wr_id = $wr_id . $reply;
        $wr_num = $write[wr_num];
        $wr_reply = $reply;
    } 
    else 
    {
        $wr_num = get_next_num($write_table);
        $wr_reply = "";
    }

    $sql = " insert into $write_table
                set wr_num = '$wr_num',
                    wr_reply = '$wr_reply',
                    wr_comment = 0,
                    ca_name = '$ca_name',
                    wr_option = '$html,$secret,$mail',
                    wr_subject = '$wr_subject',
                    wr_content = '$wr_content',
                    wr_link1 = '$wr_link1',
                    wr_link2 = '$wr_link2',
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
                    wr_1 = '$wr_1',
                    wr_2 = '$wr_2',
                    wr_3 = '$wr_3',
                    wr_4 = '$wr_4',
                    wr_5 = '$wr_5',
                    wr_6 = '$wr_6',
                    wr_7 = '$wr_7',
                    wr_8 = '$wr_8',
                    wr_9 = '$wr_9',
                    wr_10 = '$wr_10',
					
                    pre_name = '$pre_name',					
                    sale_number = '$sale_number',							
	                mb_zip1 = '$mb_zip1',					
                    mb_zip2 = '$mb_zip2',							
	                business_num = '$business_num',					
                    mb_addr1 = '$mb_addr1',						
		            mb_addr2 = '$mb_addr2',			
		            location1 = '$location1',			
					location2 = '$location2',						
                    wr_phone1 = '$wr_phone1',		
                    wr_phone2 = '$wr_phone2',		
                    wr_phone3 = '$wr_phone3',		
                    wr_phone4 = '$wr_phone4',		
                    wr_phone5 = '$wr_phone5',	
                    domain_name = '$domain_name',	
	                wr_fax = '$wr_fax',					
                    bank_name = '$bank_name',		
	                bank_number = '$bank_number',					
                    bank_username = '$bank_username',		
	                discount = '$discount',					
                    cf1 = '$cf1',							
                    cf2 = '$cf2',							
                    cf3 = '$cf3',							
                    cf4 = '$cf4',							
                    cf5 = '$cf5',							
	               
					cf11 = '$cf11',							
                    cf12 = '$cf12',							
                    cf13 = '$cf13',							
                    cf14 = '$cf14',							
                    cf15 = '$cf15',				
					cf16 = '$cf16',							
                    cf17 = '$cf17',							
                    cf18 = '$cf18',							
                    cf19 = '$cf19',							
                    cf20 = '$cf20',				
					cf21 = '$cf21',							
                    cf22 = '$cf22',							
                    cf23 = '$cf23',							
                    cf24 = '$cf24',							
                    cf25 = '$cf25',				
					cf26 = '$cf26',							
                    cf27 = '$cf27',							
                    cf28 = '$cf28',							
                    cf29 = '$cf29',							
                    cf30 = '$cf30',				
					cf31 = '$cf31',							
                    cf32 = '$cf32',							
                    cf33 = '$cf33',							
                    cf34 = '$cf34',							
                    cf35 = '$cf35',				
					cf36 = '$cf36',							
                    cf37 = '$cf37',							
                    cf38 = '$cf38',							
                    cf39 = '$cf39',							
                    cf40 = '$cf40',				
										

					cf51 = '$cf51',							
                    cf52 = '$cf52',							
                    cf53 = '$cf53',							
                    cf54 = '$cf54',							
                    cf55 = '$cf55',				
					cf56 = '$cf56',							
                    cf57 = '$cf57',							
                    cf58 = '$cf58',							
                    cf59 = '$cf59',							
                    cf60 = '$cf60',				
					cf61 = '$cf61',							
                    cf62 = '$cf62',							
                    cf63 = '$cf63',							
                    cf64 = '$cf64',							
                    cf65 = '$cf65',				
					cf66 = '$cf66',							
                    cf67 = '$cf67',							
                    cf68 = '$cf68',							
                    cf69 = '$cf69',	
					
					cf71 = '$cf71',							
                    cf72 = '$cf72',							
                    cf73 = '$cf73',							
                    cf74 = '$cf74',							
                    cf75 = '$cf75',				
					cf76 = '$cf76',							
                    cf77 = '$cf77',							
                    cf78 = '$cf78',							
                    cf79 = '$cf79',							
                    cf80 = '$cf80',		
					cf81 = '$cf81',							
                    cf82 = '$cf82',			

					cf91 = '$cf91',							
                    cf92 = '$cf92',							
                    cf93 = '$cf93',							
                    cf94 = '$cf94'
					";
    sql_query($sql);

    $wr_id = mysql_insert_id();

    // �?�? ?�이?�에 UPDATE
    sql_query(" update $write_table set wr_parent = '$wr_id', pension_id = '$wr_id' where wr_id = '$wr_id' ");

    // ?��?? INSERT
    //sql_query(" insert into $g4[board_new_table] ( bo_table, wr_id, wr_parent, bn_datetime ) values ( '$bo_table', '$wr_id', '$wr_id', '$g4[time_ymdhis]' ) ");
    sql_query(" insert into $g4[board_new_table] ( bo_table, wr_id, wr_parent, bn_datetime, mb_id ) values ( '$bo_table', '$wr_id', '$wr_id', '$g4[time_ymdhis]', '$member[mb_id]' ) ");

    // 게시�? 1 증�??
    sql_query("update $g4[board_table] set bo_count_write = bo_count_write + 1 where bo_table = '$bo_table'");

    // ?�기 ?�인?? �???
    if ($w == '') 
    {
        if ($notice)
        {
            $bo_notice = $wr_id . "\n" . $board[bo_notice];
            sql_query(" update $g4[board_table] set bo_notice = '$bo_notice' where bo_table = '$bo_table' ");
        }

        insert_point($member[mb_id], $board[bo_write_point], "$board[bo_subject] $wr_id �??�기", $bo_table, $wr_id, '?�기');
    }
    else 
    {
        // ?��???? 코멘?? ?�인?��? �??�함
        // ?��?? ?�인?��?? 많�?? 경우 코멘?? ???? ?��???? ?�는 경우�? 많음
        insert_point($member[mb_id], $board[bo_comment_point], "$board[bo_subject] $wr_id �??��??", $bo_table, $wr_id, '?�기');
    }
} 
else if ($w == "u") 
{
    if (get_session('ss_bo_table') != $_POST['bo_table'] || get_session('ss_wr_id') != $_POST['wr_id']) {
      //  alert('?�바�? 방법?�로 ?�정?�여 주십?�오.');
    }

    if ($is_admin == "super") // 최고�?리자 ?�과
        ;
    else if ($is_admin == "group") { // 그룹�?리자
        $mb = get_member($write[mb_id]);
        if ($member[mb_id] != $group[gr_admin]) // ?�신?? �?리하?? 그룹?��???
            alert("?�신?? �?리하?? 그룹?? 게시?�이 ?�니�?�? ?�정?? ?? ?�습?�다.");
        else if ($member[mb_level] < $mb[mb_level]) // ?�신?? ?�벨?? ?�거?? 같다�? ?�과
            alert("?�신?? 권한보다 ?��?? 권한?? ?�원?? ?�성?? �??? ?�정?? ?? ?�습?�다.");
    } else if ($is_admin == "board") { // 게시?��??리자?�면
        $mb = get_member($write[mb_id]);
        if ($member[mb_id] != $board[bo_admin]) // ?�신?? �?리하?? 게시?�인�??
            alert("?�신?? �?리하?? 게시?�이 ?�니�?�? ?�정?? ?? ?�습?�다.");
        else if ($member[mb_level] < $mb[mb_level]) // ?�신?? ?�벨?? ?�거?? 같다�? ?�과
            alert("?�신?? 권한보다 ?��?? 권한?? ?�원?? ?�성?? �??? ?�정?? ?? ?�습?�다.");
    } else if ($member[mb_id]) {
        if ($member[mb_id] != $write[mb_id])
            alert("?�신?? �??? ?�니�?�? ?�정?? ?? ?�습?�다.");
    } else {
        if ($write[mb_id]) {
            alert("로그?? ?? ?�정?�세??.", "./login.php?url=".urlencode("./board.php?bo_table=$bo_table&wr_id=$wr_id"));
        }
    }

    if ($member[mb_id]) 
    {
        // ?�신?? �??�라�?
        if ($member[mb_id] == $wr[mb_id]) 
        {
     //       $mb_id = $member[mb_id];
    //        $wr_name = $board[bo_use_name] ? $member[mb_name] : $member[mb_nick];
    //        $wr_email = $member[mb_email];
    //        $wr_homepage = $member[mb_homepage];
        } 
        else
        {
    //        $mb_id = $wr[mb_id];
    //        $wr_name = $wr[wr_name];
    //       $wr_email = $wr[wr_email];
     //       $wr_homepage = $wr[wr_homepage];
        }
    } 
    else 
    {
        $mb_id = "";
        // 비회?�의 경우 ?�름?? ?�락?�는 경우�? ?�음
        //if (!trim($wr_name)) alert("?�름?? ?�히 ?�력?�셔?? ?�니??.");
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
                   wr_10 = '$wr_10',
					
                    pre_name = '$pre_name',					
                    sale_number = '$sale_number',							
	                mb_zip1 = '$mb_zip1',					
                    mb_zip2 = '$mb_zip2',							
	                business_num = '$business_num',					
                    mb_addr1 = '$mb_addr1',						
		            mb_addr2 = '$mb_addr2',		
		            location1 = '$location1',			
					location2 = '$location2',							
                    wr_phone1 = '$wr_phone1',		
                    wr_phone2 = '$wr_phone2',		
                    wr_phone3 = '$wr_phone3',		
                    wr_phone4 = '$wr_phone4',		
                    wr_phone5 = '$wr_phone5',	
                    domain_name = '$domain_name',	
	                wr_fax = '$wr_fax',					
                    bank_name = '$bank_name',		
	                bank_number = '$bank_number',					
                    bank_username = '$bank_username',		
	                discount = '$discount',					
                    cf1 = '$cf1',							
                    cf2 = '$cf2',							
                    cf3 = '$cf3',							
                    cf4 = '$cf4',							
                    cf5 = '$cf5',							
	               
					cf11 = '$cf11',							
                    cf12 = '$cf12',							
                    cf13 = '$cf13',							
                    cf14 = '$cf14',							
                    cf15 = '$cf15',				
					cf16 = '$cf16',							
                    cf17 = '$cf17',							
                    cf18 = '$cf18',							
                    cf19 = '$cf19',							
                    cf20 = '$cf20',				
					cf21 = '$cf21',							
                    cf22 = '$cf22',							
                    cf23 = '$cf23',							
                    cf24 = '$cf24',							
                    cf25 = '$cf25',				
					cf26 = '$cf26',							
                    cf27 = '$cf27',							
                    cf28 = '$cf28',							
                    cf29 = '$cf29',							
                    cf30 = '$cf30',				
					cf31 = '$cf31',							
                    cf32 = '$cf32',							
                    cf33 = '$cf33',							
                    cf34 = '$cf34',							
                    cf35 = '$cf35',				
					cf36 = '$cf36',							
                    cf37 = '$cf37',							
                    cf38 = '$cf38',							
                    cf39 = '$cf39',							
                    cf40 = '$cf40',				
										

					cf51 = '$cf51',							
                    cf52 = '$cf52',							
                    cf53 = '$cf53',							
                    cf54 = '$cf54',							
                    cf55 = '$cf55',				
					cf56 = '$cf56',							
                    cf57 = '$cf57',							
                    cf58 = '$cf58',							
                    cf59 = '$cf59',							
                    cf60 = '$cf60',				
					cf61 = '$cf61',							
                    cf62 = '$cf62',							
                    cf63 = '$cf63',							
                    cf64 = '$cf64',							
                    cf65 = '$cf65',				
					cf66 = '$cf66',							
                    cf67 = '$cf67',							
                    cf68 = '$cf68',							
                    cf69 = '$cf69',	
					
					cf71 = '$cf71',							
                    cf72 = '$cf72',							
                    cf73 = '$cf73',							
                    cf74 = '$cf74',							
                    cf75 = '$cf75',				
					cf76 = '$cf76',							
                    cf77 = '$cf77',							
                    cf78 = '$cf78',							
                    cf79 = '$cf79',							
                    cf80 = '$cf80',		
					cf81 = '$cf81',							
                    cf82 = '$cf82',			

					cf91 = '$cf91',							
                    cf92 = '$cf92',							
                    cf93 = '$cf93',							
                    cf94 = '$cf94'
					
                    $sql_ip
                    $sql_password
              where wr_id = '$wr[wr_id]' ";
    sql_query($sql);

    // 분류�? ?�정?�는 경우 ?�당?�는 코멘?�의 분류명도 모두 ?�정??
    // 코멘?�의 분류�? ?�정?��?? ?�으�? �??�이 ?��??�? ?��?? ?�음
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
// �?�? ?�일 ?�로??
// ?�중?? ?�이블에 ???�하?? ?�유?? $wr_id 값을 ???�해?? ?�기 ?�문?�니??.
for ($i=0; $i<count($upload); $i++) 
{
    if (!get_magic_quotes_gpc()) {
        $upload[$i]['source'] = addslashes($upload[$i]['source']);
    }

    $row = sql_fetch(" select count(*) as cnt from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_no = '$i' ");
    if ($row[cnt]) 
    {
        // ??��?? 체크�? ?�거?? ?�일?? ?�다�? ?�데?�트�? ?�니??.
        // 그렇�? ?�다�? ?�용�? ?�데?�트 ?�니??.
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

// ?�로?�된 ?�일 ?�용?�서 �??? ?? 번호�? ?�어 거꾸�? ?�인?? �?면서
// ?�일 ?�보�? ?�다�? ?�이블의 ?�용?? ??��?�니??.
$row = sql_fetch(" select max(bf_no) as max_bf_no from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$wr_id' ");
for ($i=(int)$row[max_bf_no]; $i>=0; $i--) 
{
    $row2 = sql_fetch(" select bf_file from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_no = '$i' ");

    // ?�보�? ?�다�? 빠집?�다.
    if ($row2[bf_file]) break;

    // 그렇�? ?�다�? ?�보�? ??��?�니??.
    sql_query(" delete from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_no = '$i' ");
}
//------------------------------------------------------------------------------

// 비�??�??�라�? ?�션?? 비�??�??? ?�이?��? ???�한??. ?�신?? �??? ?�시 ?�스?�드�? 묻�?? ?�기 ?�함
if ($secret) 
    set_session("ss_secret_{$bo_table}_{$wr_num}", TRUE);

// 메일발송 ?�용 (?�정�??? 발송?��?? ?�음)
if (!($w == "u" || $w == "cu") && $config[cf_email_use] && $board[bo_use_email]) 
{
    // �?리자?? ?�보�? ?�고
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

    $warr = array( ""=>"?�력", "u"=>"?�정", "r"=>"?��??", "c"=>"코멘??", "cu"=>"코멘?? ?�정" );
    $str = $warr[$w];

    $subject = "'{$board[bo_subject]}' 게시?�에 {$str}�??? ?�라?�습?�다.";
    $link_url = "$g4[url]/$g4[bbs]/board.php?bo_table=$bo_table&wr_id=$wr_id&$qstr";

    include_once("$g4[path]/lib/mailer.lib.php");

    ob_start();
    include_once ("./write_update_mail.php");
    $content = ob_get_contents();
    ob_end_clean();

    $array_email = array();
    // 게시?��??리자?�게 보내?? 메일
    if ($config[cf_email_wr_board_admin]) $array_email[] = $board_admin[mb_email];
    // 게시?�그룹�??리자?�게 보내?? 메일
    if ($config[cf_email_wr_group_admin]) $array_email[] = $group_admin[mb_email];
    // 최고�?리자?�게 보내?? 메일
    if ($config[cf_email_wr_super_admin]) $array_email[] = $super_admin[mb_email];

    // ?�션?? 메일받기�? 체크?�어 ?�고, 게시?�의 메일?? ?�다�?
    if (strstr($wr[wr_option], "mail") && $wr[wr_email]) {
        // ?��?? 메일발송?? 체크�? ?�어 ?�다�?
        if ($config[cf_email_wr_write]) $array_email[] = $wr[wr_email];

        // 코멘?? ?? 모든?�에�? 메일 발송?? ?�어 ?�다�? (?�신?�게?? 발송?��?? ?�는??)
        if ($config[cf_email_wr_comment_all]) {
            $sql = " select distinct wr_email from $write_table
                      where wr_email not in ( '$wr[wr_email]', '$member[mb_email]', '' )
                        and wr_parent = '$wr_id' ";
            $result = sql_query($sql);
            while ($row=sql_fetch_array($result))
                $array_email[] = $row[wr_email];
        }
    }

    // 중복?? 메일 주소?? ?�거
    $unique_email = array_unique($array_email);
    $unique_email = array_values($unique_email);
    for ($i=0; $i<count($unique_email); $i++) {
    //    mailer($wr_name, $wr_email, $unique_email[$i], $subject, $content, 1);
    }
}

// ?�용?? 코드 ?�행
@include_once ("$board_skin_path/write_update.skin.php");

// ?�랙�? 주소�? ?�다�?
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
    $https_url = "$g4[url]/adm";
else
    $https_url = "$g4[url]/adm";

if ($file_upload_msg)
    alert($file_upload_msg, "{$https_url}/pen_reg.php");
else
    goto_url("{$https_url}/pen_admin.php?mode=reg");
?>
