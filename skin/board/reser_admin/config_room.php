<?php
include_once "_common.php";
include_once("$g4[path]/head.sub.php");
include_once("$board_skin_path/config.php");
//echo $pension_id;   // 펜션 아이디
if($is_admin != 'super') alert("관리자만 접근이 가능합니다.");

if(!$bo_table) alert("정상적인 접근이 아닙니다.");

if ($board[bo_include_head]) include ("../../$board[bo_include_head]");
if ($board[bo_image_head]) echo "<img src='$g4[path]/data/file/$bo_table/$board[bo_image_head]' border='0'>";
if ($board[bo_content_head]) echo stripslashes($board[bo_content_head]);
############# 헤드
$is_dhtml_editor = true;
$this_page = "{$_SERVER['PHP_SELF']}?bo_table={$bo_table}";

$upload_max_filesize = ini_get('upload_max_filesize');
$bo_table3 = "bbs34_r_info";

$file = get_file_room($bo_table3, $id);

// 가변 파일
$file_script = "";
$file_length = -1;

if($id) $w = "u";

if ($w == "u")
{
    for ($i=0; $i<$file[count]; $i++)
    {
		$fsql = " select bf_file, bf_content from $g4[pension_file_table] where bo_table = '$bo_table3' and wr_id = '$id' and bf_no = '$i' ";

        $row = sql_fetch($fsql);
        if ($row[bf_file])
        {
            $file_script .= "add_file(\" <input type='checkbox' name='bf_file_del[$i]' value='1'>  <img src={$g4[path]}/data/file/roomFile/".$row[bf_file]." width=80> <a href='{$file[$i][href]}'>{$file[$i][source]}({$file[$i][size]})</a>  파일 삭제 ";

            if ($is_file_content)
                //$file_script .= "<br><input type='text' class=ed size=50 name='bf_content[$i]' value='{$row[bf_content]}' title='업로드 이미지 파일에 해당 되는 내용을 입력하세요.'>";
                // 첨부파일설명에서 ' 또는 " 입력되면 오류나는 부분 수정
                $file_script .= "<br><input type='text' class=ed size=50 name='bf_content[$i]' value='".addslashes(get_text($row[bf_content]))."' title='업로드 이미지 파일에 해당 되는 내용을 입력하세요.'>";
            $file_script .= "\");\n";
        }
        else
            $file_script .= "add_file('');\n";
    }
    $file_length = $file[count] - 1;
}

if ($file_length < 0)
{
    $file_script .= "add_file('');\n";
    $file_length = 0;
}
?>
<link rel="stylesheet" href="<?=$board_skin_path?>/jQuery/jquery-ui-1.7.1.css" type="text/css">
<link rel="stylesheet" href="<?=$board_skin_path?>/mstyle.css" type="text/css">
<script type="text/javascript" src="<?=$board_skin_path?>/jQuery/jquery.js"></script>
<script type="text/javascript" src="<?=$board_skin_path?>/jQuery/jquery-ui-1.7.1.js"></script>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr><td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) left top;"></td>
		<td bgcolor="#ffffff">&nbsp;</td>
		<td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) right top;"></td></tr>
	<tr>
        <td colspan="3" valign="top" style="background:#FFF; padding:10px;">
<?php
include_once("{$board_skin_path}/inc_top_menu.php");

$tit = "객 실 관 리";
if($u == "add") {
	$tit .= " - 추가";
} else if($u == "edit") {
	$tit .= " - 수정";
} else {
	$tit .= "";
}
$tit .=  " [".$pension_id."]";
?>
<div class="ui-state-highlight ui-corner-all" style="margin: 20px 0 5px; padding: 5px .7em;">
    <span class="ui-icon ui-icon-power" style="float: left; margin-right: .3em;"></span>
    <strong><?=$tit?></strong>
</div>
<?php
function show_list() {
	global $g4, $write_table, $css, $pension_id;
## 리스트 시작
	$sql = " SELECT * FROM {$write_table}_r_info where  pension_id = '$pension_id' order by r_info_order ASC ";
//	echo $sql;
	$result = sql_query($sql);

	echo "<table width='100%' border='0' cellpadding='3' cellspacing='1' class='$css[table]'>";
	echo "<tr class='$css[tr]'>
		<td>No</td>
		<td>객실명</td>
		<td>평수</td>
		<td>기본인원</td>
		<td>최대인원</td>
		<td>추가요금</td>
		<!--<td>객실수</td>-->
		<td>설명</td>
		<td>방수</td>
		<td>화장실수</td>
		<!--<td>복수접수</td>
		<td>다중예약</td>-->
		<td>출력순서</td>
		<td>관리</td>
		</tr>";
	for ($i=0; $r_info = sql_fetch_array($result); $i++)  {
		$j = $i+1;
		$list = $i%2;
		echo "<tr class='ht center list$list'>";
		echo "<td>" . $j . "</td>";
		echo "<td>" . $r_info[r_info_name] . "</td>";
		echo "<td>" . $r_info[r_info_area] . "</td>";
		echo "<td>" . number_format($r_info[r_info_person1]) . "</td>";
		echo "<td>" . number_format($r_info[r_info_person2]) . "</td>";
		echo "<td>" . number_format($r_info[r_info_person_add]) . "</td>";
		//echo "<td>" . number_format($r_info[r_info_cnt]) . "</td>";
		echo "<td>" . $r_info[r_info_type] . "</td>";
		echo "<td>" . $r_info[r_info_rCnt] . "</td>";
		echo "<td>" . $r_info[r_info_tCnt] . "</td>";
		//echo "<td>" . $r_info[r_info_over] . "</td>";
		//echo "<td>" . $r_info[r_info_multi] . "</td>";
		echo "<td>" . number_format($r_info[r_info_order]) . "</td>";
		echo "<td><input type=button class='$css[btn]' value='요금' onClick=\"Process('cost',{$r_info[r_info_id]}); return false;\">
			<input type=button class='$css[btn]' value='수정' onClick=\"Process('edit',{$r_info[r_info_id]}); return false;\">
			<input type=button class='$css[btn]' value='삭제' onClick=\"Process('del',{$r_info[r_info_id]}); return false;\"></td>";
		echo "</tr>";
	}
	if ($i == 0)
		echo "<tr><td colspan='11' align=center height=100 bgcolor=#ffffff>자료가 없습니다.</td></tr>";
	echo "</table>";
	echo "<div style='margin-top:5px; text-align:right;'><input type=button class='$css[btn]' value=\"추가\" onClick=\"Process('add',0); return false;\"></div>";
## 리스트 끝
}

if ($is_dhtml_editor) {
    include_once ("{$g4[path]}/lib/cheditor4.lib.php");
    echo "<script src='{$g4[path]}/cheditor5/cheditor.js'></script>";
    echo cheditor1('r_info_content', '100%', '250');
}
?>
<form name="process" method="POST" enctype="multipart/form-data" style="margin:0; padding:0;">
<input type="hidden" name="bo_table" value="<?=$bo_table?>" />
<input type="hidden" name="u" value="">
<input type="hidden" name="id" value="">

<input type="hidden" name="pension_id" value="<?=$pension_id?>">

<?php
if($u == "add") {
	echo "<input type=hidden name=r_info_over value='X' />"; //복수접수
	echo "<input type=hidden name=r_info_multi value='X' />"; // 다중예약
	echo "<input type=hidden name=r_info_cnt value='1'>"; // 객실수
	echo "<table width='100%' border='0' cellpadding='0' cellspacing='1' class='$css[table]'>";
	echo "<tr class='$css[tr]'>
			<td>객실명</td>
			<td>평수</td>
			<td>기본인원</td>
			<td>최대인원</td>
			<td>추가요금</td>
			<!--<td>객실수</td>-->
			<td>설명</td>
			<td>방수</td>
			<td>화장실수</td>
			<!--<td>복수접수</td>
			<td>다중예약</td>-->
			<td>출력순서</td>
		</tr>";
	echo "<tr class='ht center'>";
	echo "<td><input type=input size=20 name=r_info_name required value='" . $r_info[r_info_name] . "'></td>";
	echo "<td><input type=input size=8 name=r_info_area value='" . $r_info[r_info_area] . "'></td>";
	echo "<td><input type=input size=3 name=r_info_person1 value='" . $r_info[r_info_person1] . "'></td>";
	echo "<td><input type=input size=3 name=r_info_person2 value='" . $r_info[r_info_person2] . "'></td>";
	echo "<td><input type=input size=6 name=r_info_person_add value='" . $r_info[r_info_person_add] . "'></td>";
	//echo "<td><input type=input size=3 name=r_info_cnt value='" . $r_info[r_info_cnt] . "'></td>"; // 객실수
	echo "<td><input type=text size=20 name=r_info_type value='" . $r_info[r_info_type] . "'></td>";
	echo "<td><input type=input size=3 name=r_info_rCnt value='" . $r_info[r_info_rCnt] . "'></td>"; // 방수
	echo "<td><input type=input size=3 name=r_info_tCnt value='" . $r_info[r_info_tCnt] . "'></td>"; // 화장실수
/*
	echo "<td><select name=r_info_over><option value='X'";
	if($r_info[r_info_over] == "X" || !$r_info[r_info_over]) echo " selected";
	echo ">X</option><option value='O'";
	if($r_info[r_info_over] == "O") echo " selected";
	echo ">O</option></select></td>";
	echo "<td><select name=r_info_multi><option value='X'";
	if($r_info[r_info_multi] == "X" || !$r_info[r_info_multi]) echo " selected";
	echo ">X</option><option value='O'";
	if($r_info[r_info_multi] == "O") echo " selected";
	echo ">O</option></select></td>";
*/
	echo "<td><input type=input size=3 name=r_info_order value='" . $r_info[r_info_order] . "'></td>";
	echo "</tr>";
?>
	<tr>
		<td>객실정보</td>
        <td colspan="8" style='padding:5 0 5 10;'>
            <?php if ($is_dhtml_editor) { ?>
                <?=cheditor2('r_info_content', $r_info['r_info_content']);?>
            <?php } else { ?>
            <textarea id="r_info_content" name="r_info_content" class=tx style='width:100%; word-break:break-all;' rows=10 itemname="객실정보" required><?=$r_info['r_info_content']?></textarea>
            <?php } ?>
        </td>
	</tr>
</table>
<div style="text-align:right; margin-top:10px;">
	<input type=button class="<?=$css[btn]?>" value="추가" onClick="Process('insert',0); return false;">
</div>
<?php
} else if($u == "edit") {
	## 업데이트 리스트
	$r_info = sql_fetch(" SELECT * FROM {$write_table}_r_info WHERE r_info_id='$id' ");
	echo "<input type=hidden name=r_info_cnt value='" . $r_info[r_info_cnt] . "' />";
	echo "<input type=hidden name=r_info_over value='" . $r_info[r_info_over] . "' />";
	echo "<input type=hidden name=r_info_multi value='" . $r_info[r_info_multi] . "' />";
	echo "<table width='100%' border='0' cellpadding='0' cellspacing='1' class='$css[table]'>";
	echo "<tr class='$css[tr]'>
			<td>객실명</td>
			<td>평수</td>
			<td>기본인원</td>
			<td>최대인원</td>
			<td>추가요금</td>
			<!--<td>객실수</td>-->
			<td>설명</td>
			<td>방수</td>
			<td>화장실수</td>
			<!--<td>복수접수</td>
			<td>다중예약</td>-->
			<td>출력순서</td>
		</tr>";
	echo "<tr class='ht center'>";
	echo "<td><input type=input size=20 name=r_info_name required value='" . $r_info[r_info_name] . "'></td>";
	echo "<td><input type=input size=8 name=r_info_area value='" . $r_info[r_info_area] . "'></td>";
	echo "<td><input type=input size=3 name=r_info_person1 value='" . $r_info[r_info_person1] . "'></td>";
	echo "<td><input type=input size=3 name=r_info_person2 value='" . $r_info[r_info_person2] . "'></td>";
	echo "<td><input type=input size=6 name=r_info_person_add value='" . $r_info[r_info_person_add] . "'></td>";
	//echo "<td><input type=input size=3 name=r_info_cnt value='" . $r_info[r_info_cnt] . "'></td>";
	echo "<td><input type=text size=20 name=r_info_type value='" . $r_info[r_info_type] . "'></td>";
	echo "<td><input type=text size=3 name=r_info_rCnt value='" . $r_info[r_info_rCnt] . "'></td>";
	echo "<td><input type=text size=3 name=r_info_tCnt value='" . $r_info[r_info_tCnt] . "'></td>";
/*
	echo "<td><select name=r_info_over><option value='X'";
	if($r_info[r_info_over] == "X" || !$r_info[r_info_over]) echo " selected";
	echo ">X</option><option value='O'";
	if($r_info[r_info_over] == "O") echo " selected";
	echo ">O</option></select></td>";
	echo "<td><select name=r_info_multi><option value='X'";
	if($r_info[r_info_multi] == "X" || !$r_info[r_info_multi]) echo " selected";
	echo ">X</option><option value='O'";
	if($r_info[r_info_multi] == "O") echo " selected";
	echo ">O</option></select></td>";
*/
	echo "<td><input type=input size=3 name=r_info_order value='" . $r_info[r_info_order] . "'></td>";
	echo "</tr>";
?>
	<tr>
		<td>객실정보</td>
        <td colspan="8" style='padding:5 0 5 10;'>
            <?php if ($is_dhtml_editor) { ?>
                <?=cheditor2('r_info_content', $r_info['r_info_content']);?>
            <?php } else { ?>
            <textarea id="r_info_content" name="r_info_content" class=tx style='width:100%; word-break:break-all;' rows=10 itemname="객실정보" required><?=$r_info['r_info_content']?></textarea>
            <?php } ?>
        </td>
	</tr>
	<tr>
		<td>
			객실사진<br>
			<span onclick="add_file();" style="cursor:pointer;"><img src="<?=$g4[path]?>/skin/board/basic/img/btn_file_add.gif"></span>
			<span onclick="del_file();" style="cursor:pointer;"><img src="<?=$g4[path]?>/skin/board/basic/img/btn_file_minus.gif"></span>
		</td>
		<td colspan="9" style='padding:5 0 5 0;'>
			<table id="variableFiles" cellpadding=0 cellspacing=0></table><?php // print_r2($file); ?>
	        <script type="text/javascript">
	        var flen = 0;
	        function add_file(delete_code)
	        {
	            var upload_count = 10;
	            if (upload_count && flen >= upload_count)
	            {
	                alert("이 게시판은 "+upload_count+"개 까지만 파일 업로드가 가능합니다.");
	                return;
	            }

	            var objTbl;
	            var objRow;
	            var objCell;
	            if (document.getElementById)
	                objTbl = document.getElementById("variableFiles");
	            else
	                objTbl = document.all["variableFiles"];

	            objRow = objTbl.insertRow(objTbl.rows.length);
	            objCell = objRow.insertCell(0);

	            objCell.innerHTML = " <input type='file' class='ed' name='bf_file[]' title='파일 용량 <?=$upload_max_filesize?> 이하만 업로드 가능'>";
	            if (delete_code)
	                objCell.innerHTML += delete_code;
	            else
	            {
	                <?php if ($is_file_content) { ?>
	                objCell.innerHTML += "<br> <input type='text' class='ed' size=50 name='bf_content[]' title='업로드 이미지 파일에 해당 되는 내용을 입력하세요.'>";
	                <?php } ?>
	                ;
	            }

	            flen++;
	        }

	        <?=$file_script; //수정시에 필요한 스크립트?>

	        function del_file()
	        {
	            // file_length 이하로는 필드가 삭제되지 않아야 합니다.
	            var file_length = <?=(int)$file_length?>;
	            var objTbl = document.getElementById("variableFiles");
	            if (objTbl.rows.length - 1 > file_length)
	            {
	                objTbl.deleteRow(objTbl.rows.length - 1);
	                flen--;
	            }
	        }

			add_file();
	        </script>

			</td>
		</tr>
	</table>
	<div style="text-align:right; margin-top:10px;">
		<input type=button class="<?=$css[btn]?>" value="수정" onClick="Process('update',<?=$id?>); return false;">
	</div>
<?php
	## 업데이트 리스트 끝
} else {
	if($u == "del") {
		// 객실정보 삭제
		$sql = "DELETE FROM {$write_table}_r_info WHERE r_info_id ='$id' AND pension_id = '$pension_id' ";
		Up_Cate($bo_table);
		sql_query($sql);
		// 객실 기본 가격 삭제
		$sql2 = " DELETE FROM {$write_table}_r_cost WHERE r_info_id = '$id' AND pension_id = '$pension_id' ";
		sql_query($sql2);
		// 예약불가 삭제
		$sql3 = " DELETE FROM {$write_table}_r_close WHERE r_info_id = '$id' AND pension_id = '$pension_id' ";
		sql_query($sql3);
		// 전화예약 삭제
		$sql4 = " DELETE FROM {$write_table}_r_tel WHERE r_info_id = '$id' AND pension_id = '$pension_id' ";
		sql_query($sql4);
		// 객실기간별 요금의 해당 객실 데이터 삭제
		$sql5 = " DELETE FROM {$write_table}_r_date_cost WHERE r_info_id = '$id' AND pension_id = '$pension_id' ";
		sql_query($sql5);

		// 데이터 저장시 펜션정보에 최대 할인율과 최저 가격 입력 - Start
		include "lowCost.lib.php";
		// 데이터 저장시 펜션정보에 최대 할인율과 최저 가격 입력 - End
	} else if($u == "update") {
		$r_info_person3 = $r_info_person2 - $r_info_person1;
		$sql = "UPDATE {$write_table}_r_info SET r_info_name = '$r_info_name',
					r_info_area = '$r_info_area',
					r_info_person1 = '$r_info_person1',
					r_info_person2 = '$r_info_person2',
					r_info_person3 = '$r_info_person3',
					r_info_person_add = '$r_info_person_add',
					r_info_cnt = '$r_info_cnt',
					r_info_type = '$r_info_type',
					r_info_over = '$r_info_over',
					r_info_order = '$r_info_order',
					r_info_multi = '$r_info_multi',
					pension_id = '$pension_id',
					r_info_rCnt = '$r_info_rCnt',
					r_info_tCnt = '$r_info_tCnt',
					r_info_content = '$r_info_content'
				WHERE r_info_id ='$id' LIMIT 1 ;";

		$result = sql_query($sql);

// File Upload <-
		// 디렉토리가 없다면 생성합니다. (퍼미션도 변경하구요.)
		@mkdir("$g4[path]/data/file/roomFile", 0707);
		@chmod("$g4[path]/data/file/roomFile", 0707);

		$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));
		//print_r2($chars_array); exit;

		// 가변 파일 업로드
		$file_upload_msg = "";
		$upload = array();

		for ($i=0; $i<count($_FILES[bf_file][name]); $i++)
		{
		    // 삭제에 체크가 되어있다면 파일을 삭제합니다.
		    if ($_POST[bf_file_del][$i])
		    {
		        $upload[$i][del_check] = true;

		        $row = sql_fetch(" select bf_file from $g4[pension_file_table] where bo_table = '$bo_table3' and wr_id = '$id' and bf_no = '$i' ");
		        @unlink("$g4[path]/data/file/roomFile/$row[bf_file]");
		    }
		    else
		        $upload[$i][del_check] = false;

		    $tmp_file  = $_FILES[bf_file][tmp_name][$i];
		    $filesize  = $_FILES[bf_file][size][$i];
		    $filename  = $_FILES[bf_file][name][$i];
		    $filename  = preg_replace('/(\s|\<|\>|\=|\(|\))/', '_', $filename);

		    // 서버에 설정된 값보다 큰파일을 업로드 한다면
		    if ($filename)
		    {
		        if ($_FILES[bf_file][error][$i] == 1)
		        {
		            $file_upload_msg .= "\'{$filename}\' 파일의 용량이 서버에 설정($upload_max_filesize)된 값보다 크므로 업로드 할 수 없습니다.\\n";
		            continue;
		        }
		        else if ($_FILES[bf_file][error][$i] != 0)
		        {
		            $file_upload_msg .= "\'{$filename}\' 파일이 정상적으로 업로드 되지 않았습니다.\\n";
		            continue;
		        }
		    }

		    if (is_uploaded_file($tmp_file))
		    {
		        // 관리자가 아니면서 설정한 업로드 사이즈보다 크다면 건너뜀
		        if (!$is_admin && $filesize > $board[bo_upload_size])
		        {
		            $file_upload_msg .= "\'{$filename}\' 파일의 용량(".number_format($filesize)." 바이트)이 게시판에 설정(".number_format($board[bo_upload_size])." 바이트)된 값보다 크므로 업로드 하지 않습니다.\\n";
		            continue;
		        }

		        //=================================================================\
		        // 090714
		        // 이미지나 플래시 파일에 악성코드를 심어 업로드 하는 경우를 방지
		        // 에러메세지는 출력하지 않는다.
		        //-----------------------------------------------------------------
		        $timg = @getimagesize($tmp_file);
		        // image type
		        if ( preg_match("/\.($config[cf_image_extension])$/i", $filename) ||
		             preg_match("/\.($config[cf_flash_extension])$/i", $filename) )
		        {
		            if ($timg[2] < 1 || $timg[2] > 16)
		            {
		                //$file_upload_msg .= "\'{$filename}\' 파일이 이미지나 플래시 파일이 아닙니다.\\n";
		                continue;
		            }
		        }
		        //=================================================================

		        $upload[$i][image] = $timg;

		        // 4.00.11 - 글답변에서 파일 업로드시 원글의 파일이 삭제되는 오류를 수정
		        if ($w == 'u')
		        {
		            // 존재하는 파일이 있다면 삭제합니다.
		            $row = sql_fetch(" select bf_file from $g4[pension_file_table] where bo_table = '$bo_table3' and wr_id = '$id' and bf_no = '$i' ");
		            @unlink("$g4[path]/data/file/roomFile/$row[bf_file]");
		        }

		        // 프로그램 원래 파일명
		        $upload[$i][source] = $filename;
		        $upload[$i][filesize] = $filesize;

		        // 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
		        $filename = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);

		        // 접미사를 붙인 파일명
		        //$upload[$i][file] = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr(md5(uniqid($g4[server_time])),0,8).'_'.urlencode($filename);
		        // 달빛온도님 수정 : 한글파일은 urlencode($filename) 처리를 할경우 '%'를 붙여주게 되는데 '%'표시는 미디어플레이어가 인식을 못하기 때문에 재생이 안됩니다. 그래서 변경한 파일명에서 '%'부분을 빼주면 해결됩니다.
		        //$upload[$i][file] = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr(md5(uniqid($g4[server_time])),0,8).'_'.str_replace('%', '', urlencode($filename));
		        shuffle($chars_array);
		        $shuffle = implode("", $chars_array);

		        // 첨부파일 첨부시 첨부파일명에 공백이 포함되어 있으면 일부 PC에서 보이지 않거나 다운로드 되지 않는 현상이 있습니다. (길상여의 님 090925)
		        //$upload[$i][file] = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr($shuffle,0,8).'_'.str_replace('%', '', urlencode($filename));
		        $upload[$i][file] = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr($shuffle,0,8).'_'.str_replace('%', '', urlencode(str_replace(' ', '_', $filename)));

		        $dest_file = "$g4[path]/data/file/roomFile/" . $upload[$i][file];

		        // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
		        $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES[bf_file][error][$i]);

		        // 올라간 파일의 퍼미션을 변경합니다.
		        chmod($dest_file, 0606);

		        //$upload[$i][image] = @getimagesize($dest_file);

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

		    $row = sql_fetch(" SELECT count(*) as cnt from $g4[pension_file_table] where bo_table = '$bo_table3' and wr_id = '$id' and bf_no = '$i' ");

		    if ($row[cnt])
		    {
		        // 삭제에 체크가 있거나 파일이 있다면 업데이트를 합니다.
		        // 그렇지 않다면 내용만 업데이트 합니다.
		        if ($upload[$i][del_check] || $upload[$i][file])
		        {
		            $sql = " UPDATE $g4[pension_file_table]
		                        set bf_source = '{$upload[$i][source]}',
		                            bf_file = '{$upload[$i][file]}',
		                            bf_content = '{$bf_content[$i]}',
		                            bf_filesize = '{$upload[$i][filesize]}',
		                            bf_width = '{$upload[$i][image][0]}',
		                            bf_height = '{$upload[$i][image][1]}',
		                            bf_type = '{$upload[$i][image][2]}',
		                            bf_datetime = '$g4[time_ymdhis]'
		                      where bo_table = '$bo_table3'
		                        and wr_id = '$id'
		                        and bf_no = '$i' ";
		            sql_query($sql);
		        }
		        else
		        {
		            $sql = " UPDATE $g4[pensoin_file_table]
		                        set bf_content = '{$bf_content[$i]}'
		                      where bo_table = '$bo_table3'
		                        and wr_id = '$id'
		                        and bf_no = '$i' ";
		            //sql_query($sql);
		        }
		    }
		    else
		    {
		        $sql = " INSERT into $g4[pension_file_table]
		                    set bo_table = '$bo_table3',
		                        wr_id = '$id',
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
		$row = sql_fetch(" select max(bf_no) as max_bf_no from $g4[pension_file_table] where bo_table = '$bo_table3' and wr_id = '$id' ");
		for ($i=(int)$row[max_bf_no]; $i>=0; $i--)
		{
		    $row2 = sql_fetch(" select bf_file from $g4[pension_file_table] where bo_table = '$bo_table3' and wr_id = '$id' and bf_no = '$i' ");

		    // 정보가 있다면 빠집니다.
		    if ($row2[bf_file]) break;

		    // 그렇지 않다면 정보를 삭제합니다.
		    sql_query(" delete from $g4[pension_file_table] where bo_table = '$bo_table3' and wr_id = '$id' and bf_no = '$i' ");
		}
		//------------------------------------------------------------------------------


		Up_Cate($bo_table);
// File Upload ->
	} else if($u == "insert") {
		$r_info_person3 = $r_info_person2 - $r_info_person1;
		$sql = "INSERT INTO {$write_table}_r_info (
					r_info_name,
					r_info_area,
					r_info_person1,
					r_info_person2,
					r_info_person3,
					r_info_person_add,
					r_info_cnt,
					r_info_type,
					r_info_over,
					r_info_order,
					r_info_multi,
					pension_id,
					r_info_rCnt,
					r_info_tCnt,
					r_info_content
				) VALUES (
					'$r_info_name',
					'$r_info_area',
					'$r_info_person1',
					'$r_info_person2',
					'$r_info_person3',
					'$r_info_person_add',
					'$r_info_cnt',
					'$r_info_type',
					'$r_info_over',
					'$r_info_order',
					'$r_info_multi',
					'$pension_id',
					'$r_info_rCnt',
					'$r_info_tCnt',
					'$r_info_content'
				);";
		sql_query($sql);
		Up_Cate($bo_table);
	}

	show_list();
}
?>
</form>
</td>
    </tr>
<tr><td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) left bottom;"></td>
<td bgcolor="#ffffff">&nbsp;</td>
<td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) right bottom;"></td></tr>
</table>

<script type="text/javascript">
function Process(u,id) {
	f = document.process;
	if(u == "del") {
		var Result = confirm("자료가 영구히 삭제됩니다. 정말로 삭제하시겠습니까?");
		if(Result)
			f.action = "<?=$this_page?>";
		else
			return false;
	}

	if(u == "cost") {
		f.action = "<?=$board_skin_path?>/config_cost.php?bo_table=<?=$bo_table?>&pension_id=<?=$pension_id?>";
	} else {
		f.action = "<?=$this_page?>&pension_id=<?=$pension_id?>";
	}

	if((u == "update" || u == "insert") && !f.r_info_name.value) {
		alert("객실명을 입력해 주세요!!");
		f.r_info_name.focus();
		return false;
	}

	f.u.value = u;
	f.id.value = id;
	<?php
	    if ($is_dhtml_editor and ($u == "add" or $u == "edit")) {
        	echo cheditor3('r_info_content');
	    }
    ?>
	f.submit();
}
</script>
<?php
############# 푸터
if ($board[bo_content_tail]) echo stripslashes($board[bo_content_tail]);
if ($board[bo_image_tail]) echo "<img src='$g4[path]/data/file/$bo_table/$board[bo_image_tail]' border='0'>";
if ($board[bo_include_tail]) @include ("../../$board[bo_include_tail]");

include_once("$g4[path]/tail.sub.php");
?>
