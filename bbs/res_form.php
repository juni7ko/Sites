<?php include_once("./_common.php");
$res = "true";
if (!$bo_table) 
    alert("bo_table 값이 넘어오지 않았습니다.\\n\\nres_form.php?bo_table=code 와 같은 방식으로 넘겨 주세요.", $g4[path]);

include_once("./board_head.php");
include_once("$g4[path]/head.sub.php");


include_once ("$board_skin_path/res_form.skin.php");


include_once("./board_tail.php");
include_once("$g4[path]/tail.sub.php");

?>
