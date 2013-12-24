<?php $g4[title] = $wr_subject . "湲??낅젰";
include_once("./_common.php");
echo "<meta http-equiv='content-type' content='text/html; charset=euc-kr'>";
$write_table = "g4_write_pension_info";
// 090710
if (substr_count($wr_content, "&#") > 50) {
    alert("?댁슜?? ?щ컮瑜댁?? ?딆?? 肄붾뱶媛? ?ㅼ닔 ?ы븿?섏뼱 ?덉뒿?덈떎.");
    exit;
}

@include_once("$board_skin_path/write_update.head.skin.php");

include_once("$g4[path]/lib/trackback.lib.php");

/*
$filters = explode(",", $config[cf_filter]);
for ($i=0; $i<count($filters); $i++) {
    $s = trim($filters[$i]); // ?꾪꽣?⑥뼱?? ?욌뮘 怨듬갚?? ?놁빊
    if (stristr($wr_subject, $s)) {
        alert("?쒕ぉ?? 湲덉???⑥뼱(\'{$s}\')媛? ?ы븿?섏뼱 ?덉뒿?덈떎.");
        exit;
    }
    if (stristr($wr_content, $s)) {
        alert("?댁슜?? 湲덉???⑥뼱(\'{$s}\')媛? ?ы븿?섏뼱 ?덉뒿?덈떎.");
        exit;
    }
}
*/

$upload_max_filesize = ini_get('upload_max_filesize');

if (empty($_POST))
    alert("?뚯씪 ?먮뒗 湲??댁슜?? ?ш린媛? ?쒕쾭?먯꽌 ?ㅼ젙?? 媛믪쓣 ?섏뼱 ?ㅻ쪟媛? 諛쒖깮?섏???듬땲??.\\n\\npost_max_size=".ini_get('post_max_size')." , upload_max_filesize=$upload_max_filesize\\n\\n寃뚯떆?먭??由ъ옄 ?먮뒗 ?쒕쾭愿?由ъ옄?먭쾶 臾몄쓽 諛붾엻?덈떎.");

// 由ы띁?? 泥댄겕
//referer_check();

$w = $_POST['w'];
$wr_link1 = mysql_real_escape_string(strip_tags($_POST['wr_link1']));
$wr_link2 = mysql_real_escape_string(strip_tags($_POST['wr_link2']));

$notice_array = explode("\n", trim($board[bo_notice]));

if ($w == "u" || $w == "r") {
    $wr = get_write($write_table, $wr_id);
    if (!$wr[wr_id])
        alert("湲??? 議댁옱?섏?? ?딆뒿?덈떎.\\n\\n湲??? ??젣?섏뿀嫄곕굹 ?대룞?섏???? ?? ?덉뒿?덈떎."); 
}

// ?몃???먯꽌 湲??? ?깅줉?? ?? ?덈뒗 踰꾧렇媛? 議댁옱?섎??濡? 鍮꾨??湲??? ?ъ슜?? 寃쎌슦?먮쭔 媛??ν빐?? ??
if (!$is_admin && !$board[bo_use_secret] && $secret)
	alert("鍮꾨??湲? 誘몄궗?? 寃뚯떆?? ?대??濡? 鍮꾨??湲?濡? ?깅줉?? ?? ?놁뒿?덈떎.");

// ?몃???먯꽌 湲??? ?깅줉?? ?? ?덈뒗 踰꾧렇媛? 議댁옱?섎??濡? 鍮꾨??湲? 臾댁“嫄? ?ъ슜?쇰븣?? 愿?由ъ옄瑜? ?쒖쇅(怨듭??)?섍퀬 臾댁“嫄? 鍮꾨??湲?濡? ?깅줉
if (!$is_admin && $board[bo_use_secret] == 2) {
    $secret = "secret";
}

if ($w == "" || $w == "u") {
    // 源??좎슜 1.00 : 湲??곌린 沅뚰븳怨? ?섏젙?? 蹂꾨룄濡? 泥섎━?섏뼱?? ??
    if($w =="u" && $member['mb_id'] && $wr['mb_id'] == $member['mb_id'])
        ;
    else if ($member[mb_level] < $board[bo_write_level]) 
        alert("湲??? ?? 沅뚰븳?? ?놁뒿?덈떎.");

	// ?몃???먯꽌 湲??? ?깅줉?? ?? ?덈뒗 踰꾧렇媛? 議댁옱?섎??濡? 怨듭???? 愿?由ъ옄留? ?깅줉?? 媛??ν빐?? ??
	if (!$is_admin && $notice)
		alert("愿?由ъ옄留? 怨듭???? ?? ?덉뒿?덈떎.");
} 
else if ($w == "r") 
{
    if (in_array((int)$wr_id, $notice_array))
        alert("怨듭???먮뒗 ?듬?? ?? ?? ?놁뒿?덈떎.");

    if ($member[mb_level] < $board[bo_reply_level]) 
        alert("湲??? ?듬???? 沅뚰븳?? ?놁뒿?덈떎.");

    // 寃뚯떆湲? 諛곗뿴 李몄“
    $reply_array = &$wr;

    // 理쒕?? ?듬???? ?뚯씠釉붿뿉 ?≪븘?볦?? wr_reply ?ъ씠利덈쭔?쇰쭔 媛??ν빀?덈떎.
    if (strlen($reply_array[wr_reply]) == 10)
        alert("?? ?댁긽 ?듬???섏떎 ?? ?놁뒿?덈떎.\\n\\n?듬???? 10?④퀎 源뚯??留? 媛??ν빀?덈떎.");

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
    else if ($row[reply] == $end_reply_char) // A~Z?? 26 ?낅땲??.
        alert("?? ?댁긽 ?듬???섏떎 ?? ?놁뒿?덈떎.\\n\\n?듬???? 26媛? 源뚯??留? 媛??ν빀?덈떎.");
    else
        $reply_char = chr(ord($row[reply]) + $reply_number);

    $reply = $reply_array[wr_reply] . $reply_char;
} else 
    alert("w 媛믪씠 ?쒕??濡? ?섏뼱?ㅼ?? ?딆븯?듬땲??."); 


if ($w == "" || $w == "r") 
{
	/*
    if ($_SESSION["ss_datetime"] >= ($g4[server_time] - $config[cf_delay_sec]) && !$is_admin) 
        alert("?덈Т 鍮좊Ⅸ ?쒓컙?댁뿉 寃뚯떆臾쇱쓣 ?곗냽?댁꽌 ?щ┫ ?? ?놁뒿?덈떎.");

    set_session("ss_datetime", $g4[server_time]);


    // ?숈씪?댁슜 ?곗냽 ?깅줉 遺덇??
    $row = sql_fetch(" select MD5(CONCAT(wr_ip, wr_subject, wr_content)) as prev_md5 from $write_table order by wr_id desc limit 1 ");
    $curr_md5 = md5($_SERVER[REMOTE_ADDR].$wr_subject.$wr_content);
    if ($row[prev_md5] == $curr_md5 && !$is_admin)
        alert("?숈씪?? ?댁슜?? ?곗냽?댁꽌 ?깅줉?? ?? ?놁뒿?덈떎.");
*/
} 

// ?먮룞?깅줉諛⑹?? 寃???
//include_once ("./norobot_check.inc.php");
if ($bo_table != "pension_info") {
	if (!$is_member) {
		if ($w=='' || $w=='r') {
			$key = get_session("captcha_keystring");
			if (!($key && $key == $_POST[wr_key])) {
				unset($_SESSION['captcha_keystring']);
				alert("?뺤긽?곸씤 ?묎렐?? ?꾨땶寃? 媛숈뒿?덈떎.");
			}
		}
	}
}

if (!isset($_POST[wr_subject]) || !trim($_POST[wr_subject])) 
    alert("?쒕ぉ?? ?낅젰?섏뿬 二쇱떗?쒖삤."); 

// ?붾젆?좊━媛? ?녿떎硫? ?앹꽦?⑸땲??. (?쇰??섎룄 蹂?寃쏀븯援ъ슂.)
@mkdir("$g4[path]/data/file/$bo_table", 0707);
@chmod("$g4[path]/data/file/$bo_table", 0707);

// "?명꽣?룹샃?? > 蹂댁븞 > ?ъ슜?먯젙?섏닔以? > ?ㅽ겕由쏀똿 > Action ?ㅽ겕由쏀똿 > ?ъ슜 ?? ??" ?? 寃쎌슦?? ?ㅻ쪟 泥섎━
// ?? ?듭뀡?? ?ъ슜 ?? ?⑥쑝濡? ?ㅼ젙?? 寃쎌슦 ?대뼡 ?ㅽ겕由쏀듃?? ?ㅽ뻾 ?섏?? ?딆뒿?덈떎.
//if (!$_POST[wr_content]) die ("?댁슜?? ?낅젰?섏뿬 二쇱떗?쒖삤.");

$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));
//print_r2($chars_array); exit;

// 媛?蹂? ?뚯씪 ?낅줈??
$file_upload_msg = "";
$upload = array();
for ($i=0; $i<count($_FILES[bf_file][name]); $i++) 
{
    // ??젣?? 泥댄겕媛? ?섏뼱?덈떎硫? ?뚯씪?? ??젣?⑸땲??.
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

    // ?쒕쾭?? ?ㅼ젙?? 媛믩낫?? ?고뙆?쇱쓣 ?낅줈?? ?쒕떎硫?
    if ($filename)
    {
        if ($_FILES[bf_file][error][$i] == 1)
        {
            $file_upload_msg .= "\'{$filename}\' ?뚯씪?? ?⑸웾?? ?쒕쾭?? ?ㅼ젙($upload_max_filesize)?? 媛믩낫?? ?щ??濡? ?낅줈?? ?? ?? ?놁뒿?덈떎.\\n";
            continue;
        }
        else if ($_FILES[bf_file][error][$i] != 0)
        {
            $file_upload_msg .= "\'{$filename}\' ?뚯씪?? ?뺤긽?곸쑝濡? ?낅줈?? ?섏?? ?딆븯?듬땲??.\\n";
            continue;
        }
    }

    if (is_uploaded_file($tmp_file)) 
    {
        // 愿?由ъ옄媛? ?꾨땲硫댁꽌 ?ㅼ젙?? ?낅줈?? ?ъ씠利덈낫?? ?щ떎硫? 嫄대꼫??
        if (!$is_admin && $filesize > $board[bo_upload_size]) 
        {
            $file_upload_msg .= "\'{$filename}\' ?뚯씪?? ?⑸웾(".number_format($filesize)." 諛붿씠??)?? 寃뚯떆?먯뿉 ?ㅼ젙(".number_format($board[bo_upload_size])." 諛붿씠??)?? 媛믩낫?? ?щ??濡? ?낅줈?? ?섏?? ?딆뒿?덈떎.\\n";
            continue;
        }

        //=================================================================\
        // 090714
        // ?대?吏??? ?뚮옒?? ?뚯씪?? ?낆꽦肄붾뱶瑜? ?ъ뼱 ?낅줈?? ?섎뒗 寃쎌슦瑜? 諛⑹??
        // ?먮윭硫붿꽭吏??? 異쒕젰?섏?? ?딅뒗??.
        //-----------------------------------------------------------------
        $timg = @getimagesize($tmp_file);
        // image type
        if ( preg_match("/\.($config[cf_image_extension])$/i", $filename) ||
             preg_match("/\.($config[cf_flash_extension])$/i", $filename) ) 
        {
            if ($timg[2] < 1 || $timg[2] > 16)
            {
                //$file_upload_msg .= "\'{$filename}\' ?뚯씪?? ?대?吏??? ?뚮옒?? ?뚯씪?? ?꾨떃?덈떎.\\n";
                continue;
            }
        }
        //=================================================================

        $upload[$i][image] = $timg;

        // 4.00.11 - 湲??듬???먯꽌 ?뚯씪 ?낅줈?쒖떆 ?먭???? ?뚯씪?? ??젣?섎뒗 ?ㅻ쪟瑜? ?섏젙
        if ($w == 'u')
        {
            // 議댁옱?섎뒗 ?뚯씪?? ?덈떎硫? ??젣?⑸땲??.
            $row = sql_fetch(" select bf_file from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_no = '$i' ");
            @unlink("$g4[path]/data/file/$bo_table/$row[bf_file]");
        }

        // ?꾨줈洹몃옩 ?먮옒 ?뚯씪紐?
        $upload[$i][source] = $filename;
        $upload[$i][filesize] = $filesize;

        // ?꾨옒?? 臾몄옄?댁씠 ?ㅼ뼱媛? ?뚯씪?? -x 瑜? 遺숈뿬?? ?밴꼍濡쒕? ?뚮뜑?쇰룄 ?ㅽ뻾?? ?섏?? 紐삵븯?꾨줉 ??
        $filename = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);

        // ?묐??щ? 遺숈씤 ?뚯씪紐?
        //$upload[$i][file] = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr(md5(uniqid($g4[server_time])),0,8).'_'.urlencode($filename);
        // ?щ튆?⑤룄?? ?섏젙 : ?쒓???뚯씪?? urlencode($filename) 泥섎━瑜? ?좉꼍?? '%'瑜? 遺숈뿬二쇨쾶 ?섎뒗?? '%'?쒖떆?? 誘몃뵒?댄뵆?덉씠?닿?? ?몄떇?? 紐삵븯湲? ?뚮Ц?? ?ъ깮?? ?덈맗?덈떎. 洹몃옒?? 蹂?寃쏀븳 ?뚯씪紐낆뿉?? '%'遺?遺꾩쓣 鍮쇱＜硫? ?닿껐?⑸땲??. 
        //$upload[$i][file] = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr(md5(uniqid($g4[server_time])),0,8).'_'.str_replace('%', '', urlencode($filename)); 
        shuffle($chars_array);
        $shuffle = implode("", $chars_array);

        // 泥⑤???뚯씪 泥⑤???? 泥⑤???뚯씪紐낆뿉 怨듬갚?? ?ы븿?섏뼱 ?덉쑝硫? ?쇰?? PC?먯꽌 蹂댁씠吏? ?딄굅?? ?ㅼ슫濡쒕뱶 ?섏?? ?딅뒗 ?꾩긽?? ?덉뒿?덈떎. (湲몄긽?ъ쓽 ?? 090925)
        //$upload[$i][file] = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr($shuffle,0,8).'_'.str_replace('%', '', urlencode($filename)); 
        $upload[$i][file] = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr($shuffle,0,8).'_'.str_replace('%', '', urlencode(str_replace(' ', '_', $filename))); 

        $dest_file = "$g4[path]/data/file/$bo_table/" . $upload[$i][file];

        // ?낅줈?쒓?? ?덈맂?ㅻ㈃ ?먮윭硫붿꽭吏? 異쒕젰?섍퀬 二쎌뼱踰꾨┰?덈떎.
        $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES[bf_file][error][$i]);

        // ?щ씪媛? ?뚯씪?? ?쇰??섏쓣 蹂?寃쏀빀?덈떎.
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
        // 鍮꾪쉶?먯쓽 寃쎌슦 ?대쫫?? ?꾨씫?섎뒗 寃쎌슦媛? ?덉쓬
        $wr_name = strip_tags(mysql_escape_string($_POST['wr_name']));
        if (!trim($wr_name))
            alert("?대쫫?? ?꾪엳 ?낅젰?섏뀛?? ?⑸땲??.");
        $wr_password = sql_password($wr_password);
    }

    if ($w == "r") 
    {
        // ?듬???? ?먭???? 鍮꾨??湲??대씪硫? ?⑥뒪?뚮뱶?? ?먭??怨? ?숈씪?섍쾶 ?ｋ뒗??.
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

    // 遺?紐? ?꾩씠?붿뿉 UPDATE
    sql_query(" update $write_table set wr_parent = '$wr_id', pension_id = '$wr_id' where wr_id = '$wr_id' ");

    // ?덇?? INSERT
    //sql_query(" insert into $g4[board_new_table] ( bo_table, wr_id, wr_parent, bn_datetime ) values ( '$bo_table', '$wr_id', '$wr_id', '$g4[time_ymdhis]' ) ");
    sql_query(" insert into $g4[board_new_table] ( bo_table, wr_id, wr_parent, bn_datetime, mb_id ) values ( '$bo_table', '$wr_id', '$wr_id', '$g4[time_ymdhis]', '$member[mb_id]' ) ");

    // 寃뚯떆湲? 1 利앷??
    sql_query("update $g4[board_table] set bo_count_write = bo_count_write + 1 where bo_table = '$bo_table'");

    // ?곌린 ?ъ씤?? 遺???
    if ($w == '') 
    {
        if ($notice)
        {
            $bo_notice = $wr_id . "\n" . $board[bo_notice];
            sql_query(" update $g4[board_table] set bo_notice = '$bo_notice' where bo_table = '$bo_table' ");
        }

        insert_point($member[mb_id], $board[bo_write_point], "$board[bo_subject] $wr_id 湲??곌린", $bo_table, $wr_id, '?곌린');
    }
    else 
    {
        // ?듬???? 肄붾찘?? ?ъ씤?몃? 遺??ы븿
        // ?듬?? ?ъ씤?멸?? 留롮?? 寃쎌슦 肄붾찘?? ???? ?듬???? ?섎뒗 寃쎌슦媛? 留롮쓬
        insert_point($member[mb_id], $board[bo_comment_point], "$board[bo_subject] $wr_id 湲??듬??", $bo_table, $wr_id, '?곌린');
    }
} 
else if ($w == "u") 
{
    if (get_session('ss_bo_table') != $_POST['bo_table'] || get_session('ss_wr_id') != $_POST['wr_id']) {
      //  alert('?щ컮瑜? 諛⑸쾿?쇰줈 ?섏젙?섏뿬 二쇱떗?쒖삤.');
    }

    if ($is_admin == "super") // 理쒓퀬愿?由ъ옄 ?듦낵
        ;
    else if ($is_admin == "group") { // 洹몃９愿?由ъ옄
        $mb = get_member($write[mb_id]);
        if ($member[mb_id] != $group[gr_admin]) // ?먯떊?? 愿?由ы븯?? 洹몃９?멸???
            alert("?먯떊?? 愿?由ы븯?? 洹몃９?? 寃뚯떆?먯씠 ?꾨땲誘?濡? ?섏젙?? ?? ?놁뒿?덈떎.");
        else if ($member[mb_level] < $mb[mb_level]) // ?먯떊?? ?덈꺼?? ?ш굅?? 媛숇떎硫? ?듦낵
            alert("?먯떊?? 沅뚰븳蹂대떎 ?믪?? 沅뚰븳?? ?뚯썝?? ?묒꽦?? 湲??? ?섏젙?? ?? ?놁뒿?덈떎.");
    } else if ($is_admin == "board") { // 寃뚯떆?먭??由ъ옄?대㈃
        $mb = get_member($write[mb_id]);
        if ($member[mb_id] != $board[bo_admin]) // ?먯떊?? 愿?由ы븯?? 寃뚯떆?먯씤媛??
            alert("?먯떊?? 愿?由ы븯?? 寃뚯떆?먯씠 ?꾨땲誘?濡? ?섏젙?? ?? ?놁뒿?덈떎.");
        else if ($member[mb_level] < $mb[mb_level]) // ?먯떊?? ?덈꺼?? ?ш굅?? 媛숇떎硫? ?듦낵
            alert("?먯떊?? 沅뚰븳蹂대떎 ?믪?? 沅뚰븳?? ?뚯썝?? ?묒꽦?? 湲??? ?섏젙?? ?? ?놁뒿?덈떎.");
    } else if ($member[mb_id]) {
        if ($member[mb_id] != $write[mb_id])
            alert("?먯떊?? 湲??? ?꾨땲誘?濡? ?섏젙?? ?? ?놁뒿?덈떎.");
    } else {
        if ($write[mb_id]) {
            alert("濡쒓렇?? ?? ?섏젙?섏꽭??.", "./login.php?url=".urlencode("./board.php?bo_table=$bo_table&wr_id=$wr_id"));
        }
    }

    if ($member[mb_id]) 
    {
        // ?먯떊?? 湲??대씪硫?
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
        // 鍮꾪쉶?먯쓽 寃쎌슦 ?대쫫?? ?꾨씫?섎뒗 寃쎌슦媛? ?덉쓬
        //if (!trim($wr_name)) alert("?대쫫?? ?꾪엳 ?낅젰?섏뀛?? ?⑸땲??.");
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

    // 遺꾨쪟媛? ?섏젙?섎뒗 寃쎌슦 ?대떦?섎뒗 肄붾찘?몄쓽 遺꾨쪟紐낅룄 紐⑤몢 ?섏젙??
    // 肄붾찘?몄쓽 遺꾨쪟瑜? ?섏젙?섏?? ?딆쑝硫? 寃??됱씠 ?쒕??濡? ?섏?? ?딆쓬
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
// 媛?蹂? ?뚯씪 ?낅줈??
// ?섏쨷?? ?뚯씠釉붿뿉 ???ν븯?? ?댁쑀?? $wr_id 媛믪쓣 ???ν빐?? ?섍린 ?뚮Ц?낅땲??.
for ($i=0; $i<count($upload); $i++) 
{
    if (!get_magic_quotes_gpc()) {
        $upload[$i]['source'] = addslashes($upload[$i]['source']);
    }

    $row = sql_fetch(" select count(*) as cnt from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_no = '$i' ");
    if ($row[cnt]) 
    {
        // ??젣?? 泥댄겕媛? ?덇굅?? ?뚯씪?? ?덈떎硫? ?낅뜲?댄듃瑜? ?⑸땲??.
        // 洹몃젃吏? ?딅떎硫? ?댁슜留? ?낅뜲?댄듃 ?⑸땲??.
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

// ?낅줈?쒕맂 ?뚯씪 ?댁슜?먯꽌 媛??? ?? 踰덊샇瑜? ?살뼱 嫄곌씀濡? ?뺤씤?? 媛?硫댁꽌
// ?뚯씪 ?뺣낫媛? ?녿떎硫? ?뚯씠釉붿쓽 ?댁슜?? ??젣?⑸땲??.
$row = sql_fetch(" select max(bf_no) as max_bf_no from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$wr_id' ");
for ($i=(int)$row[max_bf_no]; $i>=0; $i--) 
{
    $row2 = sql_fetch(" select bf_file from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_no = '$i' ");

    // ?뺣낫媛? ?덈떎硫? 鍮좎쭛?덈떎.
    if ($row2[bf_file]) break;

    // 洹몃젃吏? ?딅떎硫? ?뺣낫瑜? ??젣?⑸땲??.
    sql_query(" delete from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_no = '$i' ");
}
//------------------------------------------------------------------------------

// 鍮꾨??湲??대씪硫? ?몄뀡?? 鍮꾨??湲??? ?꾩씠?붾? ???ν븳??. ?먯떊?? 湲??? ?ㅼ떆 ?⑥뒪?뚮뱶瑜? 臾살?? ?딄린 ?꾪븿
if ($secret) 
    set_session("ss_secret_{$bo_table}_{$wr_num}", TRUE);

// 硫붿씪諛쒖넚 ?ъ슜 (?섏젙湲??? 諛쒖넚?섏?? ?딆쓬)
if (!($w == "u" || $w == "cu") && $config[cf_email_use] && $board[bo_use_email]) 
{
    // 愿?由ъ옄?? ?뺣낫瑜? ?산퀬
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

    $warr = array( ""=>"?낅젰", "u"=>"?섏젙", "r"=>"?듬??", "c"=>"肄붾찘??", "cu"=>"肄붾찘?? ?섏젙" );
    $str = $warr[$w];

    $subject = "'{$board[bo_subject]}' 寃뚯떆?먯뿉 {$str}湲??? ?щ씪?붿뒿?덈떎.";
    $link_url = "$g4[url]/$g4[bbs]/board.php?bo_table=$bo_table&wr_id=$wr_id&$qstr";

    include_once("$g4[path]/lib/mailer.lib.php");

    ob_start();
    include_once ("./write_update_mail.php");
    $content = ob_get_contents();
    ob_end_clean();

    $array_email = array();
    // 寃뚯떆?먭??由ъ옄?먭쾶 蹂대궡?? 硫붿씪
    if ($config[cf_email_wr_board_admin]) $array_email[] = $board_admin[mb_email];
    // 寃뚯떆?먭렇猷밴??由ъ옄?먭쾶 蹂대궡?? 硫붿씪
    if ($config[cf_email_wr_group_admin]) $array_email[] = $group_admin[mb_email];
    // 理쒓퀬愿?由ъ옄?먭쾶 蹂대궡?? 硫붿씪
    if ($config[cf_email_wr_super_admin]) $array_email[] = $super_admin[mb_email];

    // ?듭뀡?? 硫붿씪諛쏄린媛? 泥댄겕?섏뼱 ?덇퀬, 寃뚯떆?먯쓽 硫붿씪?? ?덈떎硫?
    if (strstr($wr[wr_option], "mail") && $wr[wr_email]) {
        // ?먭?? 硫붿씪諛쒖넚?? 泥댄겕媛? ?섏뼱 ?덈떎硫?
        if ($config[cf_email_wr_write]) $array_email[] = $wr[wr_email];

        // 肄붾찘?? ?? 紐⑤뱺?댁뿉寃? 硫붿씪 諛쒖넚?? ?섏뼱 ?덈떎硫? (?먯떊?먭쾶?? 諛쒖넚?섏?? ?딅뒗??)
        if ($config[cf_email_wr_comment_all]) {
            $sql = " select distinct wr_email from $write_table
                      where wr_email not in ( '$wr[wr_email]', '$member[mb_email]', '' )
                        and wr_parent = '$wr_id' ";
            $result = sql_query($sql);
            while ($row=sql_fetch_array($result))
                $array_email[] = $row[wr_email];
        }
    }

    // 以묐났?? 硫붿씪 二쇱냼?? ?쒓굅
    $unique_email = array_unique($array_email);
    $unique_email = array_values($unique_email);
    for ($i=0; $i<count($unique_email); $i++) {
    //    mailer($wr_name, $wr_email, $unique_email[$i], $subject, $content, 1);
    }
}

// ?ъ슜?? 肄붾뱶 ?ㅽ뻾
@include_once ("$board_skin_path/write_update.skin.php");

// ?몃옓諛? 二쇱냼媛? ?덈떎硫?
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
