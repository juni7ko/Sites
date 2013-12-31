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
$this_page = "{$_SERVER['PHP_SELF']}?bo_table={$bo_table}";

$file = get_file_room("bbs34_r_info", $id);

// 가변 파일
$file_script = "";
$file_length = -1;

if($id) $w = "u";
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
		<td>객실수</td>

		<td>설명</td>

		<td>복수접수</td>
		<td>다중예약</td>
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
		echo "<td>" . number_format($r_info[r_info_cnt]) . "</td>";

		echo "<td>" . $r_info[r_info_type] . "</td>";

		echo "<td>" . $r_info[r_info_over] . "</td>";
		echo "<td>" . $r_info[r_info_multi] . "</td>";
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
?>
<script type="text/javascript">
<!--
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
	f.submit();
}
-->
</script>
<form name="process" method="POST" style="margin:0; padding:0;">
<input type="hidden" name="bo_table" value="<?=$bo_table?>" />
<input type="hidden" name="u" value="">
<input type="hidden" name="id" value="">

<input type="hidden" name="pension_id" value="<?=$pension_id?>">

<?php
if($u == "add") {
	echo "<table width='100%' border='0' cellpadding='0' cellspacing='1' class='$css[table]'>";
	echo "<tr class='$css[tr]'>
			<td>객실명</td>
			<td>평수</td>
			<td>기본인원</td>
			<td>최대인원</td>
			<td>추가요금</td>
			<td>객실수</td>
			<td>설명</td>
			<td>복수접수</td>
			<td>다중예약</td>
			<td>출력순서</td>
			<td>관리</td>
		</tr>";
	echo "<tr class='ht center'>";
	echo "<td><input type=input size=20 name=r_info_name required value='" . $r_info[r_info_name] . "'></td>";
	echo "<td><input type=input size=8 name=r_info_area value='" . $r_info[r_info_area] . "'></td>";
	echo "<td><input type=input size=3 name=r_info_person1 value='" . $r_info[r_info_person1] . "'></td>";
	echo "<td><input type=input size=3 name=r_info_person2 value='" . $r_info[r_info_person2] . "'></td>";
	echo "<td><input type=input size=6 name=r_info_person_add value='" . $r_info[r_info_person_add] . "'></td>";
	echo "<td><input type=input size=3 name=r_info_cnt value='" . $r_info[r_info_cnt] . "'></td>";
	echo "<td><input type=text size=20 name=r_info_type value='" . $r_info[r_info_type] . "'></td>";
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
	echo "<td><input type=input size=3 name=r_info_order value='" . $r_info[r_info_order] . "'></td>";
	echo "<td><input type=button class='$css[btn]' value=\"추가\" onClick=\"Process('insert',0); return false;\"></td>";
	echo "</tr>";
?>
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
<?php
	echo "</table>";
} else if($u == "edit") {
	## 업데이트 리스트
	$r_info = sql_fetch(" SELECT * FROM {$write_table}_r_info WHERE r_info_id='$id' ");

	echo "<table width='100%' border='0' cellpadding='0' cellspacing='1' class='$css[table]'>";
	echo "<tr class='$css[tr]'>
			<td>객실명</td>
			<td>평수</td>
			<td>기본인원</td>
			<td>최대인원</td>
			<td>추가요금</td>
			<td>객실수</td>
			<td>설명</td>
			<td>복수접수</td>
			<td>다중예약</td>
			<td>출력순서</td>
			<td align=center>관리</td>
		</tr>";
	echo "<tr class='ht center'>";
	echo "<td><input type=input size=20 name=r_info_name required value='" . $r_info[r_info_name] . "'></td>";
	echo "<td><input type=input size=8 name=r_info_area value='" . $r_info[r_info_area] . "'></td>";
	echo "<td><input type=input size=3 name=r_info_person1 value='" . $r_info[r_info_person1] . "'></td>";
	echo "<td><input type=input size=3 name=r_info_person2 value='" . $r_info[r_info_person2] . "'></td>";
	echo "<td><input type=input size=6 name=r_info_person_add value='" . $r_info[r_info_person_add] . "'></td>";
	echo "<td><input type=input size=3 name=r_info_cnt value='" . $r_info[r_info_cnt] . "'></td>";
	echo "<td><input type=text size=20 name=r_info_type value='" . $r_info[r_info_type] . "'></td>";
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
	echo "<td><input type=input size=3 name=r_info_order value='" . $r_info[r_info_order] . "'></td>";
	echo "<td rowspan='2'><input type=button class='$css[btn]' value=\"수정\" onClick=\"Process('update',$id); return false;\"></td>";
	echo "</tr>";
	echo "<tr>";
?>
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
<?php
	echo "</tr>";
	echo "</table>";
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
			pension_id = '$pension_id'
			WHERE r_info_id ='$id' LIMIT 1 ;";

		$result = sql_query($sql);
		Up_Cate($bo_table);

// File Upload <-
		if ($w == "u")
		{
		    for ($i=0; $i<$file[count]; $i++)
		    {
				$fsql = " select bf_file, bf_content from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$pension_id' and bf_no = '$i' ";
			//	echo $fsql;
		        $row = sql_fetch($fsql);
		        if ($row[bf_file])
		        {
		            $file_script .= "add_file(\" <input type='checkbox' name='bf_file_del[$i]' value='1'>  <img src=../data/file/".$bo_table."/".$row[bf_file]." width=80> <a href='{$file[$i][href]}'>{$file[$i][source]}({$file[$i][size]})</a>  파일 삭제 ";

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
// File Upload ->
	} else if($u == "insert") {
		$r_info_person3 = $r_info_person2 - $r_info_person1;
		$sql = "INSERT INTO {$write_table}_r_info (r_info_name, r_info_area, r_info_person1, r_info_person2, r_info_person3, r_info_person_add, r_info_cnt,r_info_type, r_info_over, r_info_order, r_info_multi, pension_id) VALUES ('$r_info_name', '$r_info_area', '$r_info_person1', '$r_info_person2', '$r_info_person3', '$r_info_person_add', '$r_info_cnt', '$r_info_type', '$r_info_over', '$r_info_order', '$r_info_multi', '$pension_id');";
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
<?php
############# 푸터
if ($board[bo_content_tail]) echo stripslashes($board[bo_content_tail]);
if ($board[bo_image_tail]) echo "<img src='$g4[path]/data/file/$bo_table/$board[bo_image_tail]' border='0'>";
if ($board[bo_include_tail]) @include ("../../$board[bo_include_tail]");

include_once("$g4[path]/tail.sub.php");
?>
