<?php $g4[title] = $wr_subject . "๊ธ??๋ ฅ";
include_once("./_common.php");
echo "<meta http-equiv='content-type' content='text/html; charset=euc-kr'>";
$write_table = "g4_write_pension_info";
// 090710
if (substr_count($wr_content, "&#") > 50) {
    alert("?ด์ฉ?? ?ฌ๋ฐ๋ฅด์?? ?์?? ์ฝ๋๊ฐ? ?ค์ ?ฌํจ?์ด ?์ต?๋ค.");
    exit;
}

@include_once("$board_skin_path/write_update.head.skin.php");

include_once("$g4[path]/lib/trackback.lib.php");

/*
$filters = explode(",", $config[cf_filter]);
for ($i=0; $i<count($filters); $i++) {
    $s = trim($filters[$i]); // ?ํฐ?จ์ด?? ?๋ค ๊ณต๋ฐฑ?? ?์ฐ
    if (stristr($wr_subject, $s)) {
        alert("?๋ชฉ?? ๊ธ์???จ์ด(\'{$s}\')๊ฐ? ?ฌํจ?์ด ?์ต?๋ค.");
        exit;
    }
    if (stristr($wr_content, $s)) {
        alert("?ด์ฉ?? ๊ธ์???จ์ด(\'{$s}\')๊ฐ? ?ฌํจ?์ด ?์ต?๋ค.");
        exit;
    }
}
*/

$upload_max_filesize = ini_get('upload_max_filesize');

if (empty($_POST))
    alert("?์ผ ?๋ ๊ธ??ด์ฉ?? ?ฌ๊ธฐ๊ฐ? ?๋ฒ?์ ?ค์ ?? ๊ฐ์ ?์ด ?ค๋ฅ๊ฐ? ๋ฐ์?์???ต๋??.\\n\\npost_max_size=".ini_get('post_max_size')." , upload_max_filesize=$upload_max_filesize\\n\\n๊ฒ์?๊??๋ฆฌ์ ?๋ ?๋ฒ๊ด?๋ฆฌ์?๊ฒ ๋ฌธ์ ๋ฐ๋?๋ค.");

// ๋ฆฌํผ?? ์ฒดํฌ
//referer_check();

$w = $_POST['w'];
$wr_link1 = mysql_real_escape_string(strip_tags($_POST['wr_link1']));
$wr_link2 = mysql_real_escape_string(strip_tags($_POST['wr_link2']));

$notice_array = explode("\n", trim($board[bo_notice]));

if ($w == "u" || $w == "r") {
    $wr = get_write($write_table, $wr_id);
    if (!$wr[wr_id])
        alert("๊ธ??? ์กด์ฌ?์?? ?์ต?๋ค.\\n\\n๊ธ??? ?? ?์๊ฑฐ๋ ?ด๋?์???? ?? ?์ต?๋ค."); 
}

// ?ธ๋???์ ๊ธ??? ?ฑ๋ก?? ?? ?๋ ๋ฒ๊ทธ๊ฐ? ์กด์ฌ?๋??๋ก? ๋น๋??๊ธ??? ?ฌ์ฉ?? ๊ฒฝ์ฐ?๋ง ๊ฐ??ฅํด?? ??
if (!$is_admin && !$board[bo_use_secret] && $secret)
	alert("๋น๋??๊ธ? ๋ฏธ์ฌ?? ๊ฒ์?? ?ด๋??๋ก? ๋น๋??๊ธ?๋ก? ?ฑ๋ก?? ?? ?์ต?๋ค.");

// ?ธ๋???์ ๊ธ??? ?ฑ๋ก?? ?? ?๋ ๋ฒ๊ทธ๊ฐ? ์กด์ฌ?๋??๋ก? ๋น๋??๊ธ? ๋ฌด์กฐ๊ฑ? ?ฌ์ฉ?ผ๋?? ๊ด?๋ฆฌ์๋ฅ? ?์ธ(๊ณต์??)?๊ณ  ๋ฌด์กฐ๊ฑ? ๋น๋??๊ธ?๋ก? ?ฑ๋ก
if (!$is_admin && $board[bo_use_secret] == 2) {
    $secret = "secret";
}

if ($w == "" || $w == "u") {
    // ๊น?? ์ฉ 1.00 : ๊ธ??ฐ๊ธฐ ๊ถํ๊ณ? ?์ ?? ๋ณ๋๋ก? ์ฒ๋ฆฌ?์ด?? ??
    if($w =="u" && $member['mb_id'] && $wr['mb_id'] == $member['mb_id'])
        ;
    else if ($member[mb_level] < $board[bo_write_level]) 
        alert("๊ธ??? ?? ๊ถํ?? ?์ต?๋ค.");

	// ?ธ๋???์ ๊ธ??? ?ฑ๋ก?? ?? ?๋ ๋ฒ๊ทธ๊ฐ? ์กด์ฌ?๋??๋ก? ๊ณต์???? ๊ด?๋ฆฌ์๋ง? ?ฑ๋ก?? ๊ฐ??ฅํด?? ??
	if (!$is_admin && $notice)
		alert("๊ด?๋ฆฌ์๋ง? ๊ณต์???? ?? ?์ต?๋ค.");
} 
else if ($w == "r") 
{
    if (in_array((int)$wr_id, $notice_array))
        alert("๊ณต์???๋ ?ต๋?? ?? ?? ?์ต?๋ค.");

    if ($member[mb_level] < $board[bo_reply_level]) 
        alert("๊ธ??? ?ต๋???? ๊ถํ?? ?์ต?๋ค.");

    // ๊ฒ์๊ธ? ๋ฐฐ์ด ์ฐธ์กฐ
    $reply_array = &$wr;

    // ์ต๋?? ?ต๋???? ?์ด๋ธ์ ?ก์?์?? wr_reply ?ฌ์ด์ฆ๋ง?ผ๋ง ๊ฐ??ฅํฉ?๋ค.
    if (strlen($reply_array[wr_reply]) == 10)
        alert("?? ?ด์ ?ต๋???์ค ?? ?์ต?๋ค.\\n\\n?ต๋???? 10?จ๊ณ ๊น์??๋ง? ๊ฐ??ฅํฉ?๋ค.");

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
    else if ($row[reply] == $end_reply_char) // A~Z?? 26 ?๋??.
        alert("?? ?ด์ ?ต๋???์ค ?? ?์ต?๋ค.\\n\\n?ต๋???? 26๊ฐ? ๊น์??๋ง? ๊ฐ??ฅํฉ?๋ค.");
    else
        $reply_char = chr(ord($row[reply]) + $reply_number);

    $reply = $reply_array[wr_reply] . $reply_char;
} else 
    alert("w ๊ฐ์ด ?๋??๋ก? ?์ด?ค์?? ?์?ต๋??."); 


if ($w == "" || $w == "r") 
{
	/*
    if ($_SESSION["ss_datetime"] >= ($g4[server_time] - $config[cf_delay_sec]) && !$is_admin) 
        alert("?๋ฌด ๋น ๋ฅธ ?๊ฐ?ด์ ๊ฒ์๋ฌผ์ ?ฐ์?ด์ ?ฌ๋ฆด ?? ?์ต?๋ค.");

    set_session("ss_datetime", $g4[server_time]);


    // ?์ผ?ด์ฉ ?ฐ์ ?ฑ๋ก ๋ถ๊??
    $row = sql_fetch(" select MD5(CONCAT(wr_ip, wr_subject, wr_content)) as prev_md5 from $write_table order by wr_id desc limit 1 ");
    $curr_md5 = md5($_SERVER[REMOTE_ADDR].$wr_subject.$wr_content);
    if ($row[prev_md5] == $curr_md5 && !$is_admin)
        alert("?์ผ?? ?ด์ฉ?? ?ฐ์?ด์ ?ฑ๋ก?? ?? ?์ต?๋ค.");
*/
} 

// ?๋?ฑ๋ก๋ฐฉ์?? ๊ฒ???
//include_once ("./norobot_check.inc.php");
if ($bo_table != "pension_info") {
	if (!$is_member) {
		if ($w=='' || $w=='r') {
			$key = get_session("captcha_keystring");
			if (!($key && $key == $_POST[wr_key])) {
				unset($_SESSION['captcha_keystring']);
				alert("?์?์ธ ?๊ทผ?? ?๋๊ฒ? ๊ฐ์ต?๋ค.");
			}
		}
	}
}

if (!isset($_POST[wr_subject]) || !trim($_POST[wr_subject])) 
    alert("?๋ชฉ?? ?๋ ฅ?์ฌ ์ฃผ์ญ?์ค."); 

// ?๋ ? ๋ฆฌ๊ฐ? ?๋ค๋ฉ? ?์ฑ?ฉ๋??. (?ผ๋??๋ ๋ณ?๊ฒฝํ๊ตฌ์.)
@mkdir("$g4[path]/data/file/$bo_table", 0707);
@chmod("$g4[path]/data/file/$bo_table", 0707);

// "?ธํฐ?ท์ต?? > ๋ณด์ > ?ฌ์ฉ?์ ?์์ค? > ?คํฌ๋ฆฝํ > Action ?คํฌ๋ฆฝํ > ?ฌ์ฉ ?? ??" ?? ๊ฒฝ์ฐ?? ?ค๋ฅ ์ฒ๋ฆฌ
// ?? ?ต์?? ?ฌ์ฉ ?? ?จ์ผ๋ก? ?ค์ ?? ๊ฒฝ์ฐ ?ด๋ค ?คํฌ๋ฆฝํธ?? ?คํ ?์?? ?์ต?๋ค.
//if (!$_POST[wr_content]) die ("?ด์ฉ?? ?๋ ฅ?์ฌ ์ฃผ์ญ?์ค.");

$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));
//print_r2($chars_array); exit;

// ๊ฐ?๋ณ? ?์ผ ?๋ก??
$file_upload_msg = "";
$upload = array();
for ($i=0; $i<count($_FILES[bf_file][name]); $i++) 
{
    // ?? ?? ์ฒดํฌ๊ฐ? ?์ด?๋ค๋ฉ? ?์ผ?? ?? ?ฉ๋??.
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

    // ?๋ฒ?? ?ค์ ?? ๊ฐ๋ณด?? ?ฐํ?ผ์ ?๋ก?? ?๋ค๋ฉ?
    if ($filename)
    {
        if ($_FILES[bf_file][error][$i] == 1)
        {
            $file_upload_msg .= "\'{$filename}\' ?์ผ?? ?ฉ๋?? ?๋ฒ?? ?ค์ ($upload_max_filesize)?? ๊ฐ๋ณด?? ?ฌ๋??๋ก? ?๋ก?? ?? ?? ?์ต?๋ค.\\n";
            continue;
        }
        else if ($_FILES[bf_file][error][$i] != 0)
        {
            $file_upload_msg .= "\'{$filename}\' ?์ผ?? ?์?์ผ๋ก? ?๋ก?? ?์?? ?์?ต๋??.\\n";
            continue;
        }
    }

    if (is_uploaded_file($tmp_file)) 
    {
        // ๊ด?๋ฆฌ์๊ฐ? ?๋๋ฉด์ ?ค์ ?? ?๋ก?? ?ฌ์ด์ฆ๋ณด?? ?ฌ๋ค๋ฉ? ๊ฑด๋??
        if (!$is_admin && $filesize > $board[bo_upload_size]) 
        {
            $file_upload_msg .= "\'{$filename}\' ?์ผ?? ?ฉ๋(".number_format($filesize)." ๋ฐ์ด??)?? ๊ฒ์?์ ?ค์ (".number_format($board[bo_upload_size])." ๋ฐ์ด??)?? ๊ฐ๋ณด?? ?ฌ๋??๋ก? ?๋ก?? ?์?? ?์ต?๋ค.\\n";
            continue;
        }

        //=================================================================\
        // 090714
        // ?ด๋?์ง??? ?๋?? ?์ผ?? ?์ฑ์ฝ๋๋ฅ? ?ฌ์ด ?๋ก?? ?๋ ๊ฒฝ์ฐ๋ฅ? ๋ฐฉ์??
        // ?๋ฌ๋ฉ์ธ์ง??? ์ถ๋ ฅ?์?? ?๋??.
        //-----------------------------------------------------------------
        $timg = @getimagesize($tmp_file);
        // image type
        if ( preg_match("/\.($config[cf_image_extension])$/i", $filename) ||
             preg_match("/\.($config[cf_flash_extension])$/i", $filename) ) 
        {
            if ($timg[2] < 1 || $timg[2] > 16)
            {
                //$file_upload_msg .= "\'{$filename}\' ?์ผ?? ?ด๋?์ง??? ?๋?? ?์ผ?? ?๋?๋ค.\\n";
                continue;
            }
        }
        //=================================================================

        $upload[$i][image] = $timg;

        // 4.00.11 - ๊ธ??ต๋???์ ?์ผ ?๋ก?์ ?๊???? ?์ผ?? ?? ?๋ ?ค๋ฅ๋ฅ? ?์ 
        if ($w == 'u')
        {
            // ์กด์ฌ?๋ ?์ผ?? ?๋ค๋ฉ? ?? ?ฉ๋??.
            $row = sql_fetch(" select bf_file from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_no = '$i' ");
            @unlink("$g4[path]/data/file/$bo_table/$row[bf_file]");
        }

        // ?๋ก๊ทธ๋จ ?๋ ?์ผ๋ช?
        $upload[$i][source] = $filename;
        $upload[$i][filesize] = $filesize;

        // ?๋?? ๋ฌธ์?ด์ด ?ค์ด๊ฐ? ?์ผ?? -x ๋ฅ? ๋ถ์ฌ?? ?น๊ฒฝ๋ก๋? ?๋?ผ๋ ?คํ?? ?์?? ๋ชปํ?๋ก ??
        $filename = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);

        // ?๋??ฌ๋? ๋ถ์ธ ?์ผ๋ช?
        //$upload[$i][file] = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr(md5(uniqid($g4[server_time])),0,8).'_'.urlencode($filename);
        // ?ฌ๋น?จ๋?? ?์  : ?๊???์ผ?? urlencode($filename) ์ฒ๋ฆฌ๋ฅ? ? ๊ฒฝ?? '%'๋ฅ? ๋ถ์ฌ์ฃผ๊ฒ ?๋?? '%'?์?? ๋ฏธ๋?ดํ?์ด?ด๊?? ?ธ์?? ๋ชปํ๊ธ? ?๋ฌธ?? ?ฌ์?? ?๋ฉ?๋ค. ๊ทธ๋?? ๋ณ?๊ฒฝํ ?์ผ๋ช์?? '%'๋ถ?๋ถ์ ๋นผ์ฃผ๋ฉ? ?ด๊ฒฐ?ฉ๋??. 
        //$upload[$i][file] = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr(md5(uniqid($g4[server_time])),0,8).'_'.str_replace('%', '', urlencode($filename)); 
        shuffle($chars_array);
        $shuffle = implode("", $chars_array);

        // ์ฒจ๋???์ผ ์ฒจ๋???? ์ฒจ๋???์ผ๋ช์ ๊ณต๋ฐฑ?? ?ฌํจ?์ด ?์ผ๋ฉ? ?ผ๋?? PC?์ ๋ณด์ด์ง? ?๊ฑฐ?? ?ค์ด๋ก๋ ?์?? ?๋ ?์?? ?์ต?๋ค. (๊ธธ์?ฌ์ ?? 090925)
        //$upload[$i][file] = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr($shuffle,0,8).'_'.str_replace('%', '', urlencode($filename)); 
        $upload[$i][file] = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr($shuffle,0,8).'_'.str_replace('%', '', urlencode(str_replace(' ', '_', $filename))); 

        $dest_file = "$g4[path]/data/file/$bo_table/" . $upload[$i][file];

        // ?๋ก?๊?? ?๋?ค๋ฉด ?๋ฌ๋ฉ์ธ์ง? ์ถ๋ ฅ?๊ณ  ์ฃฝ์ด๋ฒ๋ฆฝ?๋ค.
        $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES[bf_file][error][$i]);

        // ?ฌ๋ผ๊ฐ? ?์ผ?? ?ผ๋??์ ๋ณ?๊ฒฝํฉ?๋ค.
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
        // ๋นํ?์ ๊ฒฝ์ฐ ?ด๋ฆ?? ?๋ฝ?๋ ๊ฒฝ์ฐ๊ฐ? ?์
        $wr_name = strip_tags(mysql_escape_string($_POST['wr_name']));
        if (!trim($wr_name))
            alert("?ด๋ฆ?? ?ํ ?๋ ฅ?์?? ?ฉ๋??.");
        $wr_password = sql_password($wr_password);
    }

    if ($w == "r") 
    {
        // ?ต๋???? ?๊???? ๋น๋??๊ธ??ด๋ผ๋ฉ? ?จ์ค?๋?? ?๊??๊ณ? ?์ผ?๊ฒ ?ฃ๋??.
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

    // ๋ถ?๋ช? ?์ด?์ UPDATE
    sql_query(" update $write_table set wr_parent = '$wr_id', pension_id = '$wr_id' where wr_id = '$wr_id' ");

    // ?๊?? INSERT
    //sql_query(" insert into $g4[board_new_table] ( bo_table, wr_id, wr_parent, bn_datetime ) values ( '$bo_table', '$wr_id', '$wr_id', '$g4[time_ymdhis]' ) ");
    sql_query(" insert into $g4[board_new_table] ( bo_table, wr_id, wr_parent, bn_datetime, mb_id ) values ( '$bo_table', '$wr_id', '$wr_id', '$g4[time_ymdhis]', '$member[mb_id]' ) ");

    // ๊ฒ์๊ธ? 1 ์ฆ๊??
    sql_query("update $g4[board_table] set bo_count_write = bo_count_write + 1 where bo_table = '$bo_table'");

    // ?ฐ๊ธฐ ?ฌ์ธ?? ๋ถ???
    if ($w == '') 
    {
        if ($notice)
        {
            $bo_notice = $wr_id . "\n" . $board[bo_notice];
            sql_query(" update $g4[board_table] set bo_notice = '$bo_notice' where bo_table = '$bo_table' ");
        }

        insert_point($member[mb_id], $board[bo_write_point], "$board[bo_subject] $wr_id ๊ธ??ฐ๊ธฐ", $bo_table, $wr_id, '?ฐ๊ธฐ');
    }
    else 
    {
        // ?ต๋???? ์ฝ๋ฉ?? ?ฌ์ธ?ธ๋? ๋ถ??ฌํจ
        // ?ต๋?? ?ฌ์ธ?ธ๊?? ๋ง์?? ๊ฒฝ์ฐ ์ฝ๋ฉ?? ???? ?ต๋???? ?๋ ๊ฒฝ์ฐ๊ฐ? ๋ง์
        insert_point($member[mb_id], $board[bo_comment_point], "$board[bo_subject] $wr_id ๊ธ??ต๋??", $bo_table, $wr_id, '?ฐ๊ธฐ');
    }
} 
else if ($w == "u") 
{
    if (get_session('ss_bo_table') != $_POST['bo_table'] || get_session('ss_wr_id') != $_POST['wr_id']) {
      //  alert('?ฌ๋ฐ๋ฅ? ๋ฐฉ๋ฒ?ผ๋ก ?์ ?์ฌ ์ฃผ์ญ?์ค.');
    }

    if ($is_admin == "super") // ์ต๊ณ ๊ด?๋ฆฌ์ ?ต๊ณผ
        ;
    else if ($is_admin == "group") { // ๊ทธ๋ฃน๊ด?๋ฆฌ์
        $mb = get_member($write[mb_id]);
        if ($member[mb_id] != $group[gr_admin]) // ?์ ?? ๊ด?๋ฆฌํ?? ๊ทธ๋ฃน?ธ๊???
            alert("?์ ?? ๊ด?๋ฆฌํ?? ๊ทธ๋ฃน?? ๊ฒ์?์ด ?๋๋ฏ?๋ก? ?์ ?? ?? ?์ต?๋ค.");
        else if ($member[mb_level] < $mb[mb_level]) // ?์ ?? ?๋ฒจ?? ?ฌ๊ฑฐ?? ๊ฐ๋ค๋ฉ? ?ต๊ณผ
            alert("?์ ?? ๊ถํ๋ณด๋ค ?์?? ๊ถํ?? ?์?? ?์ฑ?? ๊ธ??? ?์ ?? ?? ?์ต?๋ค.");
    } else if ($is_admin == "board") { // ๊ฒ์?๊??๋ฆฌ์?ด๋ฉด
        $mb = get_member($write[mb_id]);
        if ($member[mb_id] != $board[bo_admin]) // ?์ ?? ๊ด?๋ฆฌํ?? ๊ฒ์?์ธ๊ฐ??
            alert("?์ ?? ๊ด?๋ฆฌํ?? ๊ฒ์?์ด ?๋๋ฏ?๋ก? ?์ ?? ?? ?์ต?๋ค.");
        else if ($member[mb_level] < $mb[mb_level]) // ?์ ?? ?๋ฒจ?? ?ฌ๊ฑฐ?? ๊ฐ๋ค๋ฉ? ?ต๊ณผ
            alert("?์ ?? ๊ถํ๋ณด๋ค ?์?? ๊ถํ?? ?์?? ?์ฑ?? ๊ธ??? ?์ ?? ?? ?์ต?๋ค.");
    } else if ($member[mb_id]) {
        if ($member[mb_id] != $write[mb_id])
            alert("?์ ?? ๊ธ??? ?๋๋ฏ?๋ก? ?์ ?? ?? ?์ต?๋ค.");
    } else {
        if ($write[mb_id]) {
            alert("๋ก๊ทธ?? ?? ?์ ?์ธ??.", "./login.php?url=".urlencode("./board.php?bo_table=$bo_table&wr_id=$wr_id"));
        }
    }

    if ($member[mb_id]) 
    {
        // ?์ ?? ๊ธ??ด๋ผ๋ฉ?
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
        // ๋นํ?์ ๊ฒฝ์ฐ ?ด๋ฆ?? ?๋ฝ?๋ ๊ฒฝ์ฐ๊ฐ? ?์
        //if (!trim($wr_name)) alert("?ด๋ฆ?? ?ํ ?๋ ฅ?์?? ?ฉ๋??.");
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

    // ๋ถ๋ฅ๊ฐ? ?์ ?๋ ๊ฒฝ์ฐ ?ด๋น?๋ ์ฝ๋ฉ?ธ์ ๋ถ๋ฅ๋ช๋ ๋ชจ๋ ?์ ??
    // ์ฝ๋ฉ?ธ์ ๋ถ๋ฅ๋ฅ? ?์ ?์?? ?์ผ๋ฉ? ๊ฒ??์ด ?๋??๋ก? ?์?? ?์
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
// ๊ฐ?๋ณ? ?์ผ ?๋ก??
// ?์ค?? ?์ด๋ธ์ ???ฅํ?? ?ด์ ?? $wr_id ๊ฐ์ ???ฅํด?? ?๊ธฐ ?๋ฌธ?๋??.
for ($i=0; $i<count($upload); $i++) 
{
    if (!get_magic_quotes_gpc()) {
        $upload[$i]['source'] = addslashes($upload[$i]['source']);
    }

    $row = sql_fetch(" select count(*) as cnt from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_no = '$i' ");
    if ($row[cnt]) 
    {
        // ?? ?? ์ฒดํฌ๊ฐ? ?๊ฑฐ?? ?์ผ?? ?๋ค๋ฉ? ?๋ฐ?ดํธ๋ฅ? ?ฉ๋??.
        // ๊ทธ๋ ์ง? ?๋ค๋ฉ? ?ด์ฉ๋ง? ?๋ฐ?ดํธ ?ฉ๋??.
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

// ?๋ก?๋ ?์ผ ?ด์ฉ?์ ๊ฐ??? ?? ๋ฒํธ๋ฅ? ?ป์ด ๊ฑฐ๊พธ๋ก? ?์ธ?? ๊ฐ?๋ฉด์
// ?์ผ ?๋ณด๊ฐ? ?๋ค๋ฉ? ?์ด๋ธ์ ?ด์ฉ?? ?? ?ฉ๋??.
$row = sql_fetch(" select max(bf_no) as max_bf_no from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$wr_id' ");
for ($i=(int)$row[max_bf_no]; $i>=0; $i--) 
{
    $row2 = sql_fetch(" select bf_file from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_no = '$i' ");

    // ?๋ณด๊ฐ? ?๋ค๋ฉ? ๋น ์ง?๋ค.
    if ($row2[bf_file]) break;

    // ๊ทธ๋ ์ง? ?๋ค๋ฉ? ?๋ณด๋ฅ? ?? ?ฉ๋??.
    sql_query(" delete from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_no = '$i' ");
}
//------------------------------------------------------------------------------

// ๋น๋??๊ธ??ด๋ผ๋ฉ? ?ธ์?? ๋น๋??๊ธ??? ?์ด?๋? ???ฅํ??. ?์ ?? ๊ธ??? ?ค์ ?จ์ค?๋๋ฅ? ๋ฌป์?? ?๊ธฐ ?ํจ
if ($secret) 
    set_session("ss_secret_{$bo_table}_{$wr_num}", TRUE);

// ๋ฉ์ผ๋ฐ์ก ?ฌ์ฉ (?์ ๊ธ??? ๋ฐ์ก?์?? ?์)
if (!($w == "u" || $w == "cu") && $config[cf_email_use] && $board[bo_use_email]) 
{
    // ๊ด?๋ฆฌ์?? ?๋ณด๋ฅ? ?ป๊ณ 
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

    $warr = array( ""=>"?๋ ฅ", "u"=>"?์ ", "r"=>"?ต๋??", "c"=>"์ฝ๋ฉ??", "cu"=>"์ฝ๋ฉ?? ?์ " );
    $str = $warr[$w];

    $subject = "'{$board[bo_subject]}' ๊ฒ์?์ {$str}๊ธ??? ?ฌ๋ผ?์ต?๋ค.";
    $link_url = "$g4[url]/$g4[bbs]/board.php?bo_table=$bo_table&wr_id=$wr_id&$qstr";

    include_once("$g4[path]/lib/mailer.lib.php");

    ob_start();
    include_once ("./write_update_mail.php");
    $content = ob_get_contents();
    ob_end_clean();

    $array_email = array();
    // ๊ฒ์?๊??๋ฆฌ์?๊ฒ ๋ณด๋ด?? ๋ฉ์ผ
    if ($config[cf_email_wr_board_admin]) $array_email[] = $board_admin[mb_email];
    // ๊ฒ์?๊ทธ๋ฃน๊??๋ฆฌ์?๊ฒ ๋ณด๋ด?? ๋ฉ์ผ
    if ($config[cf_email_wr_group_admin]) $array_email[] = $group_admin[mb_email];
    // ์ต๊ณ ๊ด?๋ฆฌ์?๊ฒ ๋ณด๋ด?? ๋ฉ์ผ
    if ($config[cf_email_wr_super_admin]) $array_email[] = $super_admin[mb_email];

    // ?ต์?? ๋ฉ์ผ๋ฐ๊ธฐ๊ฐ? ์ฒดํฌ?์ด ?๊ณ , ๊ฒ์?์ ๋ฉ์ผ?? ?๋ค๋ฉ?
    if (strstr($wr[wr_option], "mail") && $wr[wr_email]) {
        // ?๊?? ๋ฉ์ผ๋ฐ์ก?? ์ฒดํฌ๊ฐ? ?์ด ?๋ค๋ฉ?
        if ($config[cf_email_wr_write]) $array_email[] = $wr[wr_email];

        // ์ฝ๋ฉ?? ?? ๋ชจ๋ ?ด์๊ฒ? ๋ฉ์ผ ๋ฐ์ก?? ?์ด ?๋ค๋ฉ? (?์ ?๊ฒ?? ๋ฐ์ก?์?? ?๋??)
        if ($config[cf_email_wr_comment_all]) {
            $sql = " select distinct wr_email from $write_table
                      where wr_email not in ( '$wr[wr_email]', '$member[mb_email]', '' )
                        and wr_parent = '$wr_id' ";
            $result = sql_query($sql);
            while ($row=sql_fetch_array($result))
                $array_email[] = $row[wr_email];
        }
    }

    // ์ค๋ณต?? ๋ฉ์ผ ์ฃผ์?? ?๊ฑฐ
    $unique_email = array_unique($array_email);
    $unique_email = array_values($unique_email);
    for ($i=0; $i<count($unique_email); $i++) {
    //    mailer($wr_name, $wr_email, $unique_email[$i], $subject, $content, 1);
    }
}

// ?ฌ์ฉ?? ์ฝ๋ ?คํ
@include_once ("$board_skin_path/write_update.skin.php");

// ?ธ๋๋ฐ? ์ฃผ์๊ฐ? ?๋ค๋ฉ?
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
