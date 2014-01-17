<?php include_once "_common.php";

include_once("$g4[path]/head.sub.php");
include_once("$board_skin_path/config.php");

if($is_admin != 'super' || $is_auth) alert("관리자만 접근이 가능합니다.");

if(!$bo_table) alert("정상적인 접근이 아닙니다.");

$g4_sql_table = "g4_write_";
$res_table = $g4_sql_table . $bo_table;

//전화번호
$wr_2 = "$tel1-$tel2-$tel3";
$wr_content = addslashes($wr_content);

$sql = "UPDATE $res_table SET
						wr_2   = '$wr_2',
						wr_name = '$wr_name',
						wr_email = '$wr_email',
						wr_6 = '$wr_6',
						wr_password = password('$wr_6'),
						wr_content = '$wr_content'
            WHERE wr_id = '$wr_id' ";
sql_query($sql);

alert("수정되었습니다.", "$g4[bbs_path]/board.php?bo_table=$bo_table&view_mode=list");
?>
