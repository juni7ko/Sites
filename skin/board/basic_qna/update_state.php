<?php
include_once "_common.php";

if($is_admin) {
	$sql = " update $write_table set wr_link2 = '$wr_link2' where wr_id = '$wr_id' ";
	sql_query($sql);

	alert("수정되었습니다.","$g4[bbs_path]/board.php?bo_table=$bo_table&wr_id=$wr_id");
}
?>